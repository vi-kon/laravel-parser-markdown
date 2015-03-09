<?php

namespace ViKon\ParserMarkdown\Rule\Block;


use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class TableRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Block
 */
class TableRule extends AbstractBlockRule {
    const NAME = 'TABLE';
    const ORDER = 10;

    /** @var string[] */
    private $colAlign = [];
    /** @var int[] */
    private $colLength = [];

    /**
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '\n\|?(?:[^|\n]+\|)+(?:[^|\n]+\|?)\n(?:(?:\| *| {0,3}):?-+:? {0,3}\|)+(?:(?:\| *| {0,3}):?-+:? {0,3}\|?)', '(?=\n)', $set);
    }

    /**
     * @param string                    $parentRuleNameName
     * @param \ViKon\Parser\Lexer\Lexer $lexer
     *
     * @return $this
     */
    public function embedInto($parentRuleNameName, Lexer $lexer) {
        parent::embedInto($parentRuleNameName, $lexer);
        // Match next list item indicator
        $lexer->addSimplePattern('\n\|?(?:[^|\n]+\|)+(?:[^|\n]+\|?)', $this->name);

        return $this;
    }

    /**
     * @param string                  $content
     * @param int                     $position
     * @param int                     $state
     * @param \ViKon\Parser\TokenList $tokenList
     *
     * @throws \ViKon\Parser\Rule\RuleException
     */
    public function parseToken($content, $position, $state, TokenList $tokenList) {
        switch ($state) {
            case Lexer::STATE_MATCHED:
                $this->handleMatchedState($content, $position, $tokenList);
                break;
            default:
                parent::parseToken($content, $position, $state, $tokenList);
                break;
        }
    }

    /**
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     *
     * @return bool
     */
    protected function handleEntryState($content, $position, TokenList $tokenList) {
        $tokenList->addToken($this->name . self::OPEN, $position);

        $tokenList->addToken($this->name . '_HEADER_OPEN', $position)
            ->set('align', $this->colAlign);
        $tokenList->addToken($this->name . '_ROW_OPEN', $position);

        list(, $cols, $delimiters) = explode("\n", $content);
        $cols = explode('|', trim($cols, '|'));
        $delimiters = explode('|', trim($delimiters, '|'));

        foreach ($delimiters as &$delimiter) {
            $delimiter = trim($delimiter);
            if ($delimiter[0] === ':' && $delimiter[strlen($delimiter) - 1] === ':') {
                $delimiter = 'center';
            } elseif ($delimiter[0] === ':') {
                $delimiter = 'left';
            } elseif ($delimiter[strlen($delimiter) - 1] === ':') {
                $delimiter = 'right';
            } else {
                $delimiter = null;
            }
        }

        $this->colAlign = $delimiters;

        foreach ($cols as $i => $col) {
            $token = $tokenList->addToken($this->name . '_HEAD_COLL_OPEN', $position);
            if (isset($this->colAlign[$i]) && $this->colAlign[$i] !== null) {
                $token->set('align', $this->colAlign[$i]);
            }

            $this->parseCol($col, $tokenList);

            $tokenList->addToken($this->name . '_HEAD_COLL_CLOSE', $position);
        }

        $tokenList->addToken($this->name . '_ROW_CLOSE', $position);
        $tokenList->addToken($this->name . '_HEADER_CLOSE', $position)
            ->set('align', $this->colAlign);
    }

    /**
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleMatchedState($content, $position, TokenList $tokenList) {
        $cols = explode('|', trim($content, "\n|"));

        $tokenList->addToken($this->name . '_ROW_OPEN', $position);

        foreach ($cols as $i => $col) {
            $token = $tokenList->addToken($this->name . '_COLL_OPEN', $position);
            if (isset($this->colAlign[$i]) && $this->colAlign[$i] !== null) {
                $token->set('align', $this->colAlign[$i]);
            }

            $this->parseCol($col, $tokenList);

            $tokenList->addToken($this->name . '_COLL_CLOSE', $position);
        }

        $tokenList->addToken($this->name . '_ROW_CLOSE', $position);
    }

    /**
     * @param string                  $col col content
     * @param \ViKon\Parser\TokenList $tokenList
     */
    private function parseCol($col, TokenList $tokenList) {
        $startRule = $this->set->getStartRule();

        $colTokenList = $this->parseContent($col);

        for ($i = 0; $i < count($colTokenList); $i++) {
            if ($colTokenList->getTokenAt($i)->getName() === $this->name) {
                $token = $colTokenList->getTokenAt($i);
                $colTokenList->removeTokenAt($i);
                $colTokenList->insertTokenAt($startRule->getName(), $token->getPosition(), $i)
                    ->set('content', $token->get('content', ''));
            }
        }

        $tokenList->merge($colTokenList);
    }
}