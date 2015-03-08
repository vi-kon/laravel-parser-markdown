<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class LinkAutoRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Single
 */
class LinkAutoRule extends AbstractSingleRule {
    const NAME = 'LINK_AUTO';
    const ORDER = 155;

    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '(?:https?://)?[\da-z\.-]+\.[a-z\.]{2,6}(?:[/\w \.-]*)*/?', $set);
    }

    protected function handleSingleState($content, $position, TokenList $tokenList) {
        $tokenList->addToken($this->name, $position)
            ->set('url', $content);
    }


}