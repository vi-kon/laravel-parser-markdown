<?php

namespace ViKon\ParserMarkdown\Rule\Single;


use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

class ImageInlineRule extends AbstractSingleRule {
    const NAME = 'IMAGE';
    const ORDER = 190;

    /**
     * Match
     *
     * ![alt text](https://path/to/image.jpg "Image Title Text 1")
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '!\\[(?:\\\\.|[^]\\\\])+\\][\\t ]*\\([\\t ]*(?:\\\\.|[^\\)\\\\ ])+[\\t ]*(?:"(?:\\\\.|[^"\\\\])+")?\\)', $set);
    }

    /**
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/!\\[((?:\\\\.|[^]\\\\])+)\\][\\t ]*\\([\\t ]*((?:\\\\.|[^\\)\\\\ ])+)[\\t ]*(?:"((?:\\\\.|[^"\\\\])+)")?\\)/', $content, $matches);

        $title = isset($matches[3]) ? $matches[3] : null;

        $tokenList->addToken($this->name, $position)
            ->set('alt', $matches[1])
            ->set('url', $matches[2])
            ->set('title', $title);
    }
}