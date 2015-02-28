<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class Br
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\single
 */
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