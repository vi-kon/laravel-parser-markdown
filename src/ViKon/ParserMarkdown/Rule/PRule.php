<?php

namespace ViKon\ParserMarkdown\Rule;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\Rule\AbstractRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\ConfigTrait;
use ViKon\ParserMarkdown\MarkdownRuleSet;
use ViKon\ParserMarkdown\Rule\Single\EolRule;

/**
 * Class PRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule
 */
class PRule extends AbstractRule {
    use ConfigTrait;

    const NAME = 'P';
    const ORDER = 230;

    /** @var string[] */
    protected $additionalOpeningTokens = [];
    /** @var string[] */
    protected $additionalClosingTokens = [];

    /** @var string[] */
    protected $openingTokens = [];
    /** @var string[] */
    protected $closingTokens = [];

    /**
     * @param string[] $openingTokens additional opening tokens
     * @param string[] $closingTokens additional closing tokens
     */
    public function __construct(array $openingTokens = [], array $closingTokens = []) {
        parent::__construct(self::NAME, self::ORDER);

        $this->additionalOpeningTokens = $openingTokens;
        $this->additionalClosingTokens = $closingTokens;
    }

    /**
     * @param \ViKon\Parser\TokenList $tokenList
     * @param bool                    $recursive
     *
     * @return $this
     */
    public function finalize(TokenList $tokenList, $recursive) {
        if ($recursive) {
            return $this;
        }

        $eolCount = 0;
        $pOpened = false;

        for ($i = 0; $i < count($tokenList); $i++) {
            $token = $tokenList->getTokenAt($i);
            $position = $token->getPosition();

            // Count end of line
            if ($token->getName() === EolRule::NAME) {
                $eolCount++;
                continue;
            }

            if ($this->isModeGfm() && $eolCount === 1 && $pOpened) {
                $tokenList->insertTokenAt($this->name . '_EOL', $position - $eolCount, $i - $eolCount);
            }

            // Close paragraph in more then 1 lines are between texts
            if ($eolCount > 1 && $pOpened) {
                $pOpened = false;
                $tokenList->insertTokenAt($this->name . AbstractBlockRule::CLOSE, $position - $eolCount, $i - $eolCount);
                $i++;
            }

            if ($eolCount >= 1 && !$pOpened) {
                $pOpened = true;
                $tokenList->insertTokenAt($this->name . AbstractBlockRule::OPEN, $position, $i);
                $i++;
            }

            $eolCount = 0;

            if (!$pOpened && in_array($token->getName(), $this->openingTokens)) {
                $pOpened = true;
                $tokenList->insertTokenAt($this->name . AbstractBlockRule::OPEN, $position, $i + 1);
                $i++;
            } elseif ($pOpened && in_array($token->getName(), $this->closingTokens)) {
                $pOpened = false;
                $tokenList->insertTokenAt($this->name . AbstractBlockRule::CLOSE, $position, $i);
                $i++;
            }
        }


        // Close p if left opened
        if ($pOpened) {
            $tokenList->insertTokenAt($this->name . AbstractBlockRule::CLOSE, $tokenList->last()
                ->getPosition(), count($tokenList) - $eolCount);
        }

        // Remove empty paragraphs
        $openingIndex = null;
        for ($i = 0; $i < count($tokenList); $i++) {
            if ($tokenList->getTokenAt($i)->getName() === $this->name . AbstractBlockRule::OPEN) {
                $openingIndex = $i;
            }
            if ($tokenList->getTokenAt($i)->getName() === $this->name . AbstractBlockRule::CLOSE && $openingIndex !== null) {
                $tokenList->removeTokenAt($openingIndex);
                $tokenList->removeTokenAt($i - 1);
                $i = $i - 2;
            }
            if ($tokenList->getTokenAt($i)->getName() !== EolRule::NAME && $tokenList->getTokenAt($i)->getName() !== $this->name . AbstractBlockRule::OPEN) {
                $openingIndex = null;
            }
        }

        return $this;
    }

    /**
     * @param \ViKon\Parser\Lexer\Lexer $lexer
     *
     * @return $this
     */
    public function prepare(Lexer $lexer) {
        $this->openingTokens = $this->additionalOpeningTokens;
        $this->closingTokens = $this->additionalClosingTokens;

        $singleRuleNames = $this->set->getRuleNamesByCategory(MarkdownRuleSet::CATEGORY_SINGLE);
        foreach ($singleRuleNames as $singleRuleName) {
            $this->closingTokens[] = $singleRuleName;
        }

        $blockRuleNames = $this->set->getRuleNamesByCategory(MarkdownRuleSet::CATEGORY_BLOCK);
        foreach ($blockRuleNames as $blockRuleName) {
            $this->openingTokens[] = $blockRuleName . AbstractBlockRule::CLOSE;
            $this->closingTokens[] = $blockRuleName . AbstractBlockRule::OPEN;
            $this->closingTokens[] = $blockRuleName . AbstractBlockRule::CLOSE;
        }

        return $this;
    }

}