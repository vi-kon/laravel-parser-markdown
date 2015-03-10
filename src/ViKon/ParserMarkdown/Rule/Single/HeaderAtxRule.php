<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\TokenList;

/**
 * Class Header
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown
 */
class HeaderAtxRule extends AbstractSingleRule {
    const NAME = 'HEADER_ATX';
    const ORDER = 60;

    /**
     *
     * Match:
     *
     * # H1
     * ## H2
     * ### H3
     * #### H4
     * ##### H6
     * ###### H7
     *
     * # H1 #
     *
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\n#{1,6}[^\n]+(?=\n)');
    }

    /**
     * Add token with data:
     * * level   - header level (depend on # count)
     * * content - header content
     *
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     *
     * @return bool
     */
    protected function handleSingleState($content, $position, TokenList $tokenList) {
        $content = trim($content);

        preg_match('/^#{1,6}/', $content, $matches);

        $tokenList->addToken($this->name, $position)
            ->set('level', abs(strlen($matches[0])))
            ->set('content', trim($content, "# \t\n\r\0\x0B"));

        return true;

    }

}