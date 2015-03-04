<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Rule\AbstractFormatRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class StrongAltRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Format
 */
class StrongAltRule extends AbstractFormatRule {
    const NAME = 'STRONG_ALT';
    const ORDER = 90;

    /**
     * Match
     *
     * __strong__
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '__(?=(?:\\\\.|[^\n_\\\\])*__)', '__(?=[^_])', $set);
    }
}