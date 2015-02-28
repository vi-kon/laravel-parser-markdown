<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class Eol
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\single
 */
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