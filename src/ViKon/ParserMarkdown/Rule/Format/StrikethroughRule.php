<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Rule\AbstractFormatRule;

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
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '~~(?=(?:\\\\.|[^\n~\\\\])*~~)', '~~(?=[^~])');
    }
}