<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\Parser\AbstractSet;
use ViKon\Parser\rule\AbstractFormatRule;

/**
 * Class ItalicAlt
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\format
 */
class ItalicAlt extends AbstractFormatRule {
    const NAME = 'italic_alt';

    public function __construct(AbstractSet $set) {
        parent::__construct(self::NAME, 110, '_(?:\\.|[^\n\\_])_', '_', $set);
    }
}