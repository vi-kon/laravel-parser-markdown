<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\TokenList;

/**
 * Class HeaderSetextRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Single
 */
class HeaderSetextRule extends AbstractSingleRule {
    const NAME = 'HEADER_SETEXT';
    const ORDER = 70;

    /**
     * Match
     *
     * Alt-H1
     * ======
     *
     * Alt-H2
     *
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\n[^\n]*\n[=-]{2,}(?=\n)');
    }


    /**
     * Add token with data:
     * * level   - header level (depend on # count)
     * * content - header
     *
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     *
     * @return bool
     */
    protected function handleSingleState($content, $position, TokenList $tokenList) {
        list(, $content, $level) = explode("\n", $content);
        $content = trim($content);
        $level = $level[0] === '=' ? 1 : 2;
        $tokenList->addToken($this->name, $position)
            ->set('level', $level)
            ->set('content', $content);

        return true;
    }

}