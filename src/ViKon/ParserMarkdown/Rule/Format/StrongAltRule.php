<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Rule\AbstractFormatRule;

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
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '__(?=(?:\\\\.|[^\n_\\\\])*__)', '__(?=[^_])');
    }
}