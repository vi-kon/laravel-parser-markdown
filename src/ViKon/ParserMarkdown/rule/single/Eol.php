<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\Parser\rule\AbstractSingleRule;

class Eol extends AbstractSingleRule {
    const NAME = 'eol';

    /**
     * Create new EOL rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     *
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 220, '(?:^[ \t]*)?\n', $set);
    }
}