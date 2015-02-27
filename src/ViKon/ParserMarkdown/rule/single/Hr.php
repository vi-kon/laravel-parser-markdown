<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\ParserMarkdown\MarkdownSet;

class Hr extends AbstractSingleRule {
    const NAME = 'hr';

    /**
     * Create new Hr rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 30, '\n\*{3,}|-{3,}|_{3,}|(?:\* ){3,}|(?:- ){3,}|(?:_ ){3,}', $set);
    }
}