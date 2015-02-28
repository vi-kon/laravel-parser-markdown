<?php


namespace ViKon\ParserMarkdown\rule\format;

use ViKon\Parser\rule\AbstractFormatRule;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class Strong
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\format
 */
class Strong extends AbstractFormatRule {
    const NAME = 'strong';

    /**
     * Create new Strong rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 80, '\*\*(?=(?:\\\\.|[^\n*\\\\])*\*\*)', '\*\*(?=[^\*])', $set);
    }
}