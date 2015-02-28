<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class EmailAutomatic
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\single
 */
class EmailAutomatic extends AbstractSingleRule {
    const NAME = 'email_automatic';

    /**
     * Create new Link rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 120, '<[\\d!#$%&\'*+/=?_`a-z{|}~^-]++(?:\\.[\\d!#$%&\'*+/=?_`a-z{|}~^-]+)*@(?:[\\da-z-]++\\.)+[a-z]{2,6}>', $set);
    }

    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/<([\\d!#$%&\'*+\\/=?_`a-z{|}~^-]++(?:\\.[\\d!#$%&\'*+\\/=?_`a-z{|}~^-]+)*@(?:[\\da-z-]++\\.)+[a-z]{2,6})>/', $content, $matches);

        $tokenList->addToken($this->name, $position)
            ->set('url', $matches[1]);
    }
}