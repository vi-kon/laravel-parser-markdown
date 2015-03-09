<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractFormatRule;
use ViKon\Parser\TokenList;

/**
 * Class CodeAltRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Format
 */
class CodeAltRule extends AbstractFormatRule {
    const NAME = 'CODE_ALT';
    const ORDER = 130;

    /**
     * Match
     *
     * ``code``
     * `` ` ``
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '``(?=[^\n]*``)', '``');
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