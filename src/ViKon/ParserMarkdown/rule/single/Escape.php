<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\Parser\TokenList;

class Escape extends AbstractSingleRule {
    const NAME = 'escape';

    /**
     * Create new Br rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 10, '\\\\\\\\|\\\\`|\\\\\*|\\\\\_|\\\\\{|\\\\\}|\\\\\[|\\\\\]|\\\\\(|\\\\\)|\\\\\#|\\\\\+|\\\\\-|\\\\\.|\\\\\!', $set);
    }

    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/(\\\\\\\\|\\\\`|\\\\\*|\\\\\_|\\\\\{|\\\\\}|\\\\\[|\\\\\]|\\\\\(|\\\\\)|\\\\\#|\\\\\+|\\\\\-|\\\\\.|\\\\\!)/', $content, $matches);

        $tokenList->addToken($this->name, $position)
            ->set('char', $matches[1][1]);
    }
}