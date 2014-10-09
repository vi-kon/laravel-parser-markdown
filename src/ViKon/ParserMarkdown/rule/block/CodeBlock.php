<?php


namespace ViKon\ParserMarkdown\rule\block;

use ViKon\Parser\lexer\Lexer;
use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\Parser\rule\AbstractBlockRule;
use ViKon\Parser\TokenList;

class CodeBlock extends AbstractBlockRule
{
    const NAME = 'code_block';

    public function __construct(MarkdownSet $set)
    {
        parent::__construct(self::NAME, 40, '\n(?: {4}|\t)', '\n', $set);
    }

    public function embedInto($parentRuleNameName, Lexer $lexer)
    {
        parent::embedInto($parentRuleNameName, $lexer);
        $lexer->addSimplePattern('(?:\n[ \t]*)*\n(?: {4}|\t)', $this->name);
    }

    public function parseToken($content, $position, $state, TokenList $tokenList)
    {
        switch ($state)
        {
            case Lexer::STATE_MATCHED:
                $token = $tokenList->addToken($this->name, $position);
                $token->set('content', str_repeat("\n", substr_count($content, "\n")));
                break;

            default:
                parent::parseToken($content, $position, $state, $tokenList);
                break;
        }
    }

    public function prepare(Lexer $lexer)
    {
        return $this;
    }
}