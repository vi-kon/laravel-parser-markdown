<?php

namespace ViKon\ParserMarkdown\Rule\Block;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class CodeBlockRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Block
 */
class CodeBlockRule extends AbstractBlockRule {
    const NAME = 'CODE_BLOCK';
    const ORDER = 40;

    /**
     * Match
     *
     *     code block
     *     code block
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '\n(?: {4}|\t)', '(?=\n)', $set);
    }

    /**
     * Match
     *
     *     code block
     *
     *     code block
     *
     * @param string                    $parentRuleNameName
     * @param \ViKon\Parser\Lexer\Lexer $lexer
     *
     * @return $this
     */
    public function embedInto($parentRuleNameName, Lexer $lexer) {
        parent::embedInto($parentRuleNameName, $lexer);
        $lexer->addSimplePattern('(?:\n[ \t]*)*\n(?: {4}|\t)', $this->name);

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
                $token = $tokenList->addToken($this->name, $position);
                $token->set('content', str_repeat("\n", substr_count($content, "\n")));
                break;
            default:
                parent::parseToken($content, $position, $state, $tokenList);
                break;
        }
    }

    /**
     * @param \ViKon\Parser\Lexer\Lexer $lexer
     *
     * @return $this
     */
    public function prepare(Lexer $lexer) {
        return $this;
    }

    /**
     * Handle lexers unmatched state
     *
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleUnmatchedState($content, $position, TokenList $tokenList) {
        if (!empty($content)) {
            $this->parseContent($content, $tokenList);
        }
    }
}