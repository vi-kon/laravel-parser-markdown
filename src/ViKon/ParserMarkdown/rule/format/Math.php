<?php

namespace ViKon\ParserMarkdown\rule\format;

use ViKon\Parser\lexer\Lexer;
use ViKon\Parser\rule\AbstractFormatRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class Math
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\format
 */
class Math extends AbstractFormatRule {
    const NAME = 'math';

    /**
     * Create new Math rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 100, '@\[(?=[^\n]*\])', '\]', $set);
    }

    public function prepare(Lexer $lexer) {
        return $this;
    }
}