<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\Parser\TokenList;

class HeaderSetext extends AbstractSingleRule
{
    const NAME = 'header_setext';

    /**
     * Create new Header SeText rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set)
    {
        parent::__construct(self::NAME, 70, '^[^\n]*\n[=-]{2,}$', $set);
    }

    protected function handleSingleState($content, $position, TokenList $tokenList)
    {
        list($content, $level) = explode("\n", $content);
        $content = trim($content);

        $tokenList->addToken($this->name, $position)
                  ->set('level', $level[0] === '='
                      ? 1
                      : 2)
                  ->set('content', trim($content, "-= \t"));

        return true;
    }
}