<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\Parser\AbstractSet;
use ViKon\Parser\rule\AbstractFormatRule;

class StrongAlt extends AbstractFormatRule
{
    const NAME = 'strong_alt';

    public function __construct(AbstractSet $set)
    {
        parent::__construct(self::NAME, 90, '__(?:\\.|[^\n\\_])__', '__(?=[^_])', $set);
    }
}