<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Rule\AbstractFormatRule;

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
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\*\*(?=(?:\\\\.|[^\n*\\\\])*\*\*)', '\*\*(?=[^\*])');
    }
}