<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\TokenList;

/**
 * Class EscapeRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Single
 */
class EscapeRule extends AbstractSingleRule {
    const NAME = 'ESCAPE';
    const ORDER = 10;

    /**
     * Match
     * \\
     * \`
     * \*
     * \_
     * \{
     * \}
     * \[
     * \]
     * \(
     * \)
     * \#
     * \+
     * \-
     * \.
     * \!
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\\\\\\\\|\\\\`|\\\\\*|\\\\\_|\\\\\{|\\\\\}|\\\\\[|\\\\\]|\\\\\(|\\\\\)|\\\\\#|\\\\\+|\\\\\-|\\\\\.|\\\\\!');
    }

    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/(\\\\\\\\|\\\\`|\\\\\*|\\\\\_|\\\\\{|\\\\\}|\\\\\[|\\\\\]|\\\\\(|\\\\\)|\\\\\#|\\\\\+|\\\\\-|\\\\\.|\\\\\!)/', $content, $matches);
        $tokenList->addToken($this->name, $position)
            ->set('char', $matches[1][1]);
    }
}