<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\ParserMarkdown\MarkdownSet;

class Br extends AbstractSingleRule {
    const NAME = 'br';

    /**
     * Create new Br rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 20, '  \n', $set);
    }
}