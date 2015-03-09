<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Rule\AbstractFormatRule;

/**
 * Class ItalicRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Format
 */
class ItalicRule extends AbstractFormatRule {
    const NAME = 'ITALIC';
    const ORDER = 100;

    /**
     * Match
     *
     * *italic*
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\*(?=(?:\\\\.|[^\n*\\\\])*\*)', '\*');
    }
}