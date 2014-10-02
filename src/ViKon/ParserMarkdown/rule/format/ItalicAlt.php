<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\Parser\AbstractSet;
use ViKon\Parser\rule\AbstractFormatRule;

class ItalicAlt extends AbstractFormatRule
{
    const NAME = 'italic_alt';

    public function __construct(AbstractSet $set)
    {
        parent::__construct(self::NAME, 80, '_(?=[^ ][^\n]*_)', '_', $set);
    }
}