<?php


namespace ViKon\ParserMarkdown\rule\single;

use ViKon\Parser\rule\AbstractSingleRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class ImageInline
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\single
 */
class ImageInline extends AbstractSingleRule {
    const NAME = 'image_inline';

    /**
     * Create new Link rule
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set rule set instance
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 190, '!\\[(?:\\\\.|[^]\\\\])+\\][\\t ]*\\([\\t ]*(?:\\\\.|[^\\)\\\\ ])+[\\t ]*(?:"(?:\\\\.|[^"\\\\])+")?\\)', $set);
    }

    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/!\\[((?:\\\\.|[^]\\\\])+)\\][\\t ]*\\([\\t ]*((?:\\\\.|[^\\)\\\\ ])+)[\\t ]*(?:"((?:\\\\.|[^"\\\\])+)")?\\)/', $content, $matches);

        $tokenList->addToken($this->name, $position)
            ->set('alt', $matches[1])
            ->set('url', $matches[2])
            ->set('title', isset($matches[3])
                ? $matches[3]
                : null);
    }
}