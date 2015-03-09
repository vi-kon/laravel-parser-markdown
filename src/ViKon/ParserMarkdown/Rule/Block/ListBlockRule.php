<?php

namespace ViKon\ParserMarkdown\Rule\Block;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\Rule\PRule;
use ViKon\ParserMarkdown\Rule\Single\EolRule;
use ViKon\ParserMarkdown\Rule\Single\LinkInlineRule;
use ViKon\ParserMarkdown\Rule\Single\LinkReferenceRule;

/**
 * Class ListBlockRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Block
 */
class ListBlockRule extends AbstractBlockRule {
    const NAME = 'LIST_BLOCK';
    const ORDER = 50;

    /** @var bool[] */
    protected $open;
    /** @var int */
    protected $level;

    /**
     * Match
     *
     * * list item 1
     * * list item 2
     *   * sublist item 1
     *   * sublist item 2
     *
     *     paragraph in sublist item 2
     *
     * * list item 3
     *
     * * list item 4
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\n(?: {2}|\t)*(?:[\-\+\*]|\d+\.)(?: |\t)+', '(?=\n)');
    }

    /**
     * @param string                    $ruleNameName
     * @param \ViKon\Parser\Lexer\Lexer $lexer
     *
     * @return $this
     */
    public function embedInto($ruleNameName, Lexer $lexer) {
        parent::embedInto($ruleNameName, $lexer);
        // Match next list item indicator
        $lexer->addSimplePattern('(?:\n[ \t]*)*\n(?: {2}|\t)*(?:[\-\+\*]|\d+\.)(?: |\t)+', $this->name);
        // Match next line indicator
        $lexer->addSimplePattern('(?:\n[ \t]*)*\n[ \t]+', $this->name);

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

    public function prepare(Lexer $lexer) {
        $this->acceptedRuleNames = array_merge([
            CodeBlockRule::NAME,
            FencedCodeBlockRule::NAME,
            EolRule::NAME,
            LinkInlineRule::NAME,
            LinkReferenceRule::NAME,
        ]);
    }

    /**
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     *
     * @return bool
     */
    protected function handleEntryState($content, $position, TokenList $tokenList) {
        $this->level = 0;
        $this->open = [];
        $tokenList->addToken($this->name . self::OPEN, $position);

        $this->handleMatchedState($content, $position, $tokenList);
    }

    /**
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleExitState($content, $position, TokenList $tokenList) {
        $this->closeLevels($tokenList, 0, $position);
        $tokenList->addToken($this->name . self::CLOSE, $position);
    }

    /**
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     *
     * @return bool
     */
    protected function handleUnmatchedState($content, $position, TokenList $tokenList) {
        if (empty($content)) {
            return;
        }

        $lastToken = $tokenList->last();
        if ($lastToken !== null && $lastToken->getName() === $this->name) {
            $lastToken->set('content', $lastToken->get('content', '') . $content);
        } else {
            $tokenList->addToken($this->name, $position)
                ->set('content', $content);
        }
    }

    /**
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleMatchedState($content, $position, TokenList $tokenList) {
        if (preg_match('/((?:\n[ \t]*)*)\n((?: {2}|\t)*)([\-\+\*]|\d+\.)(?: |\t)+/', $content, $matches)) {
            $level = strlen(str_replace('  ', "\t", $matches[2])) + 1;
            $ordered = is_numeric(substr($matches[3], 0, -1));
            /*
             * Force paragraph indicates if match new line between list items:
             *
             * * list item 1
             *
             * * list item 2
             */
            $forceParagraph = strlen($matches[1]) > 0;

            $this->closeLevels($tokenList, $level, $position);
            $this->openLevels($tokenList, $level, $ordered, $position);

            if (isset($this->open[$this->level]) && $this->open[$this->level]) {
                $this->closeItem($tokenList, $position);
            }
            $this->open[$this->level] = true;
            $tokenList->addToken($this->name . '_ITEM_OPEN', $position)
                ->set('forceParagraph', $forceParagraph);
        } else {
            $lastToken = $tokenList->last();
            $lastToken->set('content', $lastToken->get('content', '') . $content);
        }
    }

    /**
     * @param TokenList $tokenList token list
     * @param int       $level     actual level deep
     * @param bool      $ordered   level is ordered or not
     * @param int       $position  match position
     */
    protected function openLevels(TokenList $tokenList, $level, $ordered, $position) {
        $this->parseListContent($tokenList);

        for ($this->level; $this->level < $level; $this->level++) {
            $tokenList->addToken($this->name . '_LEVEL_OPEN', $position)
                ->set('level', $this->level + 1)
                ->set('ordered', $ordered);
        }
    }

    /**
     * @param TokenList $tokenList token list
     * @param int       $level     actual level deep
     * @param int       $position  match position
     */
    protected function closeLevels(TokenList $tokenList, $level, $position) {
        for ($this->level; $this->level > $level; $this->level--) {
            if (isset($this->open[$this->level]) && $this->open[$this->level]) {
                $this->closeItem($tokenList, $position);
            }

            $tokenList->addToken($this->name . '_LEVEL_CLOSE', $position);
        }
    }

    /**
     * Add close element
     *
     * @param TokenList $tokenList
     * @param int       $position
     */
    protected function closeItem(TokenList $tokenList, $position) {
        $this->parseListContent($tokenList);

        $this->open[$this->level] = false;

        $tokenList->addToken($this->name . '_ITEM_CLOSE', $position);
    }

    /**
     * Parse list content and
     *
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function parseListContent(TokenList $tokenList) {
        $lastToken = $tokenList->last();
        if ($lastToken->getName() === $this->name) {
            $tokenList->removeTokenAt(-1); // Remove last LIST_BLOCK (content)

            $content = $lastToken->get('content', '');

            $containsParagraphs = $tokenList->last()->get('forceParagraph', false);

            if (preg_match('/(?:\n(?:[ \t]*(?=\n))?){2,}/i', $content) === 1) {
                $containsParagraphs = true;

                // Remove starting spaces or tab
                $content = explode("\n", $content);
                $pad = null;
                foreach ($content as $index => &$item) {
                    // Find out lin starting space length up to 4 characters
                    if ($pad === null && $index > 0 && preg_match('/^[ \t]*$/i', $item) !== 1) {
                        if (preg_match('/^[ ]{0,4}/', $item, $matches) === 1) {
                            $pad = strlen($matches[0]);
                        } else {
                            $pad = 4;
                        }
                    }

                    // Remove line starting space or tab characters
                    if ($pad !== null) {
                        $item = preg_replace('/^(?: {' . $pad . '}|\t)/', '', $item);
                    }
                }

                $content = implode("\n", $content);
            }

            $content = "\n" . $content . "\n";

            $contentTokenList = $this->parseContent($content, null, true);

            // Remove beginning and ending new line feed
            if ($contentTokenList->first()->getName() === EolRule::NAME
                && $contentTokenList->last()->getName() === EolRule::NAME
            ) {
                $contentTokenList->removeTokenAt(0);  // Remove first EOL
                $contentTokenList->removeTokenAt(-1); // Remove last EOL
            }

            // Remove paragraphs
            if (!$containsParagraphs
                && $contentTokenList->first()->getName() === PRule::NAME . AbstractBlockRule::OPEN
                && $contentTokenList->last()->getName() === PRule::NAME . AbstractBlockRule::CLOSE
            ) {
                $contentTokenList->removeTokenAt(0);  // Remove first P
                $contentTokenList->removeTokenAt(-1); // Remove last P
            }

            // Add new line indicator for paragraphs
            for ($i = 0; $i < count($contentTokenList); $i++) {
                $token = $contentTokenList->getTokenAt($i);
                if ($token->getName() === EolRule::NAME) {
                    $contentTokenList->removeTokenAt($i);
                    $contentTokenList->insertTokenAt($this->name . '_ITEM_EOL', $token->getPosition(), $i);
                }
            }

            // Change LIST_BLOCK to BASE token
            $startRule = $this->set->getStartRule();

            for ($i = 0; $i < count($contentTokenList); $i++) {
                if ($contentTokenList->getTokenAt($i)->getName() === $this->name) {
                    $token = $contentTokenList->getTokenAt($i);
                    $contentTokenList->removeTokenAt($i);
                    $contentTokenList->insertTokenAt($startRule->getName(), $token->getPosition(), $i)
                        ->set('content', $token->get('content', ''));
                }
            }

            $tokenList->merge($contentTokenList);
        }
    }


}