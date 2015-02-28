<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\Parser\AbstractSet;
use ViKon\Parser\lexer\Lexer;
use ViKon\Parser\rule\AbstractFormatRule;

/**
 * Class CodeAlt
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\format
 */
class CodeAlt extends AbstractFormatRule {
    const NAME = 'code_alt';

    public function __construct(AbstractSet $set) {
        parent::__construct(self::NAME, 130, '``(?=[^\n]*``)', '``', $set);
    }

    public function prepare(Lexer $lexer) {
        return $this;
    }
}