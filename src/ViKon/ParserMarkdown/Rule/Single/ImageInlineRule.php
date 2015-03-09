<?php

namespace ViKon\ParserMarkdown\Rule\Single;


use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\TokenList;

class ImageInlineRule extends AbstractSingleRule {
    const NAME = 'IMAGE';
    const ORDER = 190;

    /**
     * Match
     *
     * ![alt text](https://path/to/image.jpg "Image Title Text 1")
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '!\\[(?:\\\\.|[^]\\\\])+\\][\\t ]*\\([\\t ]*(?:\\\\.|[^\\)\\\\ ])+[\\t ]*(?:"(?:\\\\.|[^"\\\\])+")?\\)');
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