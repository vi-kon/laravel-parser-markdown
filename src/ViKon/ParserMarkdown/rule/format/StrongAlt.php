<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\Parser\AbstractSet;
use ViKon\Parser\rule\AbstractFormatRule;

/**
 * Class StrongAlt
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\format
 */
class StrongAlt extends AbstractFormatRule {
    const NAME = 'strong_alt';

    public function __construct(AbstractSet $set) {
        parent::__construct(self::NAME, 90, '__(?:\\.|[^\n\\_])__', '__(?=[^_])', $set);
    }
}