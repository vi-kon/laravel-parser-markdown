<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\Parser\rule\AbstractFormatRule;

class Strong extends AbstractFormatRule
{
    const NAME = 'strong';

    /**
     * Create new Strong rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set)
    {
        parent::__construct(self::NAME, 70, '\*\*(?=[^ ][^\n]*\*\*[^\*])', '\*\*[^\*]', $set);
    }
}