<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;

/**
 * Class BrRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Single
 */
class BrRule extends AbstractSingleRule {
    const NAME = 'BR';
    const ORDER = 20;

    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '  \n');
    }
}