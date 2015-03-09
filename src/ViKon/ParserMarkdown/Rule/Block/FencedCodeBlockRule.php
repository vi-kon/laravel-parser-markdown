<?php

namespace ViKon\ParserMarkdown\Rule\Block;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\TokenList;

/**
 * Class FencedCodeBlockRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Block
 */
class FencedCodeBlockRule extends AbstractBlockRule {
    const NAME = 'FENCED_CODE_BLOCK';
    const ORDER = 35;

    /**
     * Match
     *
     * ```javascript
     * var s = "JavaScript syntax highlighting";
     * alert(s);
     * ```
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\n```(?:[^\n]*)?', '\n```(?=\n)');
    }

    /**
     * @param \ViKon\Parser\Lexer\Lexer $lexer
     *
     * @return $this
     */
    public function prepare(Lexer $lexer) {
        return $this;
    }

    /**
     * Handle lexers entry state
     *
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleEntryState($content, $position, TokenList $tokenList) {
        $lang = trim($content, " `\t\n\r\0\x0B");
        $tokenList->addToken($this->name . self::OPEN, $position)
            ->set('lang', $lang);
    }

    /**
     * Handle lexers unmatched state
     *
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleUnmatchedState($content, $position, TokenList $tokenList) {
        if (!empty($content)) {
            $this->parseContent($content, $tokenList);
        }
    }
}