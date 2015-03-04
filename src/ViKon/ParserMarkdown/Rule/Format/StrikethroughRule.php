<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Rule\AbstractFormatRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class StrikethroughRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Format
 */
class StrikethroughRule extends AbstractFormatRule {
    const NAME = 'STRIKETHROUGH';
    const ORDER = 95;

    /**
     * Match
     *
     * **strong**
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '~~(?=(?:\\\\.|[^\n~\\\\])*~~)', '~~(?=[^~])', $set);
    }
}