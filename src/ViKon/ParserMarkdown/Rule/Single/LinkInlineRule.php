<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\TokenList;

/**
 * Class LinkInline
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Single
 */
class LinkInlineRule extends AbstractSingleRule {
    const NAME = 'LINK_INLINE';
    const ORDER = 150;

    /**
     * Match
     *
     * [I'm an inline-style link](https://www.google.com)
     *
     * [I'm an inline-style link with title](https://www.google.com "Google's Homepage")
     *
     * [I'm a relative reference to a repository file](../blob/master/LICENSE)
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\[(?:\\\\.|[^]\\\\])+\][\t ]*\([\t ]*(?:\\\\.|[^\)\\\\ ])+[\t ]*(?:"(?:\\\\.|[^"\\\\])+")?\)');
    }

    /**
     * Add token with data
     * * label - link content
     * * url   - link url address
     * * title - link title (optional)
     *
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/\[((?:\\\\.|[^]\\\\])+)\][\t ]*\([\t ]*((?:\\\\.|[^\)\\\\ ])+)[\t ]*(?:"((?:\\\\.|[^"\\\\])+)")?\)/', $content, $matches);

        $tokenList->addToken($this->name, $position)
            ->set('label', $matches[1])
            ->set('url', $matches[2])
            ->set('title', isset($matches[3])
                ? $matches[3]
                : null);
    }
}