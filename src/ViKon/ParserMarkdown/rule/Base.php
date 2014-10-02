<?php


namespace ViKon\ParserMarkdown\rule;

use ViKon\Parser\lexer\Lexer;
use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\Parser\rule\AbstractRule;
use ViKon\Parser\TokenList;

class Base extends AbstractRule
{
    const NAME = 'base';

    public function __construct(MarkdownSet $set)
    {
        parent::__construct(self::NAME, 0, $set);
    }

    public function prepare(Lexer $lexer)
    {
        $this->acceptedRuleNames = array_merge(
            $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_BLOCK),
            $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_FORMAT),
            $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_SINGLE)
        );

        return $this;
    }

    public function parseToken($content, $position, $state, TokenList $tokenList)
    {
        $tokenList->addToken($this->name, $position)
                  ->set('content', $content);
    }
}