<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

class Reference extends AbstractSingleRule {
    const NAME = 'reference';

    /**
     * Create new Reference rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 210, '\\n[ \t]*\\[(?:\\\\.|[^]\\\\])*\\]:[ \\t]*[^ \\t\\n]+[ \\t]*\\n?[ \\t]*(?:"(?:\\\\.|[^"\\\\])+"|\'(?:\\\\.|[^\'\\\\])+\'|\\((?:\\\\.|[^\\(\\\\])+\\))?(?=\\n)', $set);
    }

    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/\\[((?:\\\\.|[^]\\\\])*)\\]:[ \\t]*([^ \\t\\n]+)[ \\t]*\\n?[ \\t]*(?:["\'\\(]((?:\\\\.|[^"\\\\])+)["\'\\)])?/', $content, $matches);

        $tokenList->addToken($this->name, $position)
            ->set('match', $matches[0])
            ->set('reference', strtolower(trim($matches[1])))
            ->set('url', $matches[2])
            ->set('title', isset($matches[3])
                ? $matches[3]
                : null);
    }
}