<?php

namespace ViKon\ParserMarkdown\Rule\Block;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class CodeBlockAltRule
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Block
 */
class CodeBlockAltRule extends AbstractBlockRule {
    const NAME = 'code_block_alt';
    const ORDER = 35;

    /**
     * Match
     *
     * ```javascript
     * var s = "JavaScript syntax highlighting";
     * alert(s);
     * ```
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '\n```(?:[^\n]*)?', '\n```(?=\n)', $set);
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
     * @param \ViKon\Parser\Lexer\Lexer $lexer
     *
     * @return $this
     */
    public function prepare(Lexer $lexer) {
        return $this;
    }
}