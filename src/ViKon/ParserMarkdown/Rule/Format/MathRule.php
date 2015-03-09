<?php

namespace ViKon\ParserMarkdown\Rule\Format;


use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractFormatRule;
use ViKon\Parser\TokenList;

class MathRule extends AbstractFormatRule {
    const NAME = 'MATH';
    const ORDER = 100;


    /**
     * Match
     *
     * @[inline math expression]
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '@\[(?=[^\n]*\])', '\]');
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
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleUnmatchedState($content, $position, TokenList $tokenList) {
        $tokenList->addToken($this->name, $position)
            ->set('expression', $content);
    }
}