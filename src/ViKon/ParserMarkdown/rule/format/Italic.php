<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\Parser\rule\AbstractFormatRule;
use ViKon\ParserMarkdown\MarkdownSet;

class Italic extends AbstractFormatRule {
    const NAME = 'italic';

    /**
     * Create new Italic rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 100, '\*(?=(?:\\\\.|[^\n*\\\\])*\*)', '\*', $set);
    }
}