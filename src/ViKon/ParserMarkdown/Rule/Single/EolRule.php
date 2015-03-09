<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;

/**
 * Class EolRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Single
 */
class EolRule extends AbstractSingleRule {
    const NAME = 'EOL';
    const ORDER = 220;

    /**
     * Match
     *
     * new line feed (\n)
     *
     * match all empty characters
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\n(?:[ \t]*(?=\n))?');
    }
}