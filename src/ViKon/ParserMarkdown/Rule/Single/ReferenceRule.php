<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class ReferenceRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Single
 */
class ReferenceRule extends AbstractSingleRule {
    const NAME = 'REFERENCE';
    const ORDER = 210;

    /**
     * Match
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '\n[ \t]*\[(?:\\\\.|[^]\\\\])*\]:[ \t]*[^ \t\n]+[ \t]*\n?[ \t]*(?:"(?:\\\\.|[^"\\\\])+"|\'(?:\\\\.|[^\'\\\\])+\'|\((?:\\\\.|[^\(\\\\])+\))?(?=\n)', $set);
    }

    /**
     * Add token with data
     * * match     - whole matched content
     * * reference - reference identifier
     * * url       - reference url
     * * title     - reference title
     * * used      - indicates if reference is used by link or image
     *
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/\[((?:\\\\.|[^]\\\\])*)\]:[ \t]*([^ \t\n]+)[ \t]*\n?[ \t]*(?:["\'\(]((?:\\\\.|[^"\\\\])+)["\'\)])?/', $content, $matches);

        $tokenList->addToken($this->name, $position)
            ->set('match', $content)
            ->set('reference', strtolower($matches[1]))
            ->set('url', $matches[2])
            ->set('title', isset($matches[3]) ? $matches[3] : null)
            ->set('used', false);
    }
}