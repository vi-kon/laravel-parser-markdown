<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractFormatRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class CodeRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Format
 */
class CodeRule extends AbstractFormatRule {
    const NAME = 'code';
    const ORDER = 140;

    /**
     * Match
     *
     * `code`
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '`(?=[^\n]*`)', '`', $set);
    }

    /**
     * @param \ViKon\Parser\Lexer\Lexer $lexer
     *
     * @return $this
     */
    public function prepare(Lexer $lexer) {
        return $this;
    }
}