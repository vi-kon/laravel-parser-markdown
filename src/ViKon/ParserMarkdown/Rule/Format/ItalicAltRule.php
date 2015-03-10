<?php

namespace ViKon\ParserMarkdown\Rule\Format;

use ViKon\Parser\Rule\AbstractFormatRule;
use ViKon\ParserMarkdown\ConfigTrait;

/**
 * Class ItalicAltRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Format
 */
class ItalicAltRule extends AbstractFormatRule {
    use ConfigTrait;

    const NAME = 'ITALIC_ALT';
    const ORDER = 110;

    /**
     * Match
     *
     * _italic_
     *
     * _italic_gfm_style_
     */
    public function __construct() {
        $startPattern = '_(?=(?:\\\\.|[^\n_\\\\])*_)';
        if ($this->isModeGfm()) {
            $startPattern = '_(?=(?:\\\\.|[^\n_\\\\])*_\w)';
        }
        parent::__construct(self::NAME, self::ORDER, $startPattern, '_');
    }
}