<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\Parser\rule\AbstractFormatRule;

class Italic extends AbstractFormatRule
{
    const NAME = 'italic';

    /**
     * Create new Italic rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set)
    {
        parent::__construct(self::NAME, 100, '\*(?=(?:\\\\.|[^\n*\\\\])*\*)', '\*', $set);
    }
}