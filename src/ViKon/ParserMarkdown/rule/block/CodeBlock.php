<?php


namespace ViKon\ParserMarkdown\rule\block;

use ViKon\Parser\lexer\Lexer;
use ViKon\Parser\rule\AbstractBlockRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class CodeBlock
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\rule\block
 */
class CodeBlock extends AbstractBlockRule {
    const NAME = 'code_block';

    /**
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 40, '\n(?: {4}|\t)', '\n', $set);
    }

    public function embedInto($parentRuleNameName, Lexer $lexer) {
        parent::embedInto($parentRuleNameName, $lexer);
        $lexer->addSimplePattern('(?:\n[ \t]*)*\n(?: {4}|\t)', $this->name);

        return $this;
    }

    public function parseToken($content, $position, $state, TokenList $tokenList) {
        switch ($state) {
            case Lexer::STATE_MATCHED:
                $token = $tokenList->addToken($this->name, $position);
                $token->set('content', str_repeat("\n", substr_count($content, "\n")));
                break;

            default:
                parent::parseToken($content, $position, $state, $tokenList);
                break;
        }
    }

    public function prepare(Lexer $lexer) {
        return $this;
    }
}