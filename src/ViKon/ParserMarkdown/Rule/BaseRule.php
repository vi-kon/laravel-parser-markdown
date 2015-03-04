<?php

namespace ViKon\ParserMarkdown\Rule;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class BaseRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule
 */
class BaseRule extends AbstractRule {
    const NAME = 'BASE';
    const ORDER = 0;

    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, $set);
    }

    /**
     * Accept all matches
     *
     * @param string                  $content
     * @param int                     $position
     * @param int                     $state
     * @param \ViKon\Parser\TokenList $tokenList
     */
    public function parseToken($content, $position, $state, TokenList $tokenList) {
        $tokenList->addToken($this->name, $position)
            ->set('content', $content);
    }

    /**
     * @param \ViKon\Parser\Lexer\Lexer $lexer
     *
     * @return $this
     */
    public function prepare(Lexer $lexer) {
        $this->acceptedRuleNames = array_merge(
            $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_BLOCK),
            $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_FORMAT),
            $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_SINGLE)
        );

        return $this;
    }
}