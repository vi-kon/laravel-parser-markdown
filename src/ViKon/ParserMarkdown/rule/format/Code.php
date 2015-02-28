<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\Parser\lexer\Lexer;
use ViKon\Parser\rule\AbstractFormatRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class Code
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\format
 */
class Code extends AbstractFormatRule {
    const NAME = 'code';

    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 140, '`(?=[^\n]*`)', '`', $set);
    }

    public function prepare(Lexer $lexer) {
        return $this;
    }
}