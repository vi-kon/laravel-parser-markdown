<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Rule\AbstractFormatRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class StrongRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Format
 */
class StrongRule extends AbstractFormatRule {
    const NAME = 'STRONG';
    const ORDER = 80;

    /**
     * Match
     *
     * **strong**
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '\*\*(?=(?:\\\\.|[^\n*\\\\])*\*\*)', '\*\*(?=[^\*])', $set);
    }
}