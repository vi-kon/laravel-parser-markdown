<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Rule\AbstractFormatRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class ItalicAltRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Format
 */
class ItalicAltRule extends AbstractFormatRule {
    const NAME = 'ITALIC_ALT';
    const ORDER = 110;

    /**
     * Match
     *
     * _italic_
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '_(?=(?:\\\\.|[^\n_\\\\])*_)', '_', $set);
    }
}