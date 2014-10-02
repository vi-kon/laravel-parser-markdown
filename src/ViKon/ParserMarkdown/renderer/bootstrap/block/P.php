<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\block;

use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\Eol as EolRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\Parser\TokenList;

class P extends AbstractBootstrapRuleRender
{
    const NAME = 'p';

    public function register(Renderer $renderer)
    {
        \Event::listen('vikon.parser.before.render', array($this, 'handleBeforeRender'));

        $renderer->addTokenRenderer('p_open', array($this, 'renderPOpen'), $this->skin);
        $renderer->addTokenRenderer('p', array($this, 'renderP'), $this->skin);
        $renderer->addTokenRenderer('p_close', array($this, 'renderPClose'), $this->skin);
    }

    public function handleBeforeRender(TokenList $tokenList)
    {
        $pOpened         = false;
        $pOpenTokens     = array();
        $pCloseTokens    = array();
        $eolCount        = 0;
        $blockRuleNames  = $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_BLOCK);
        $singleRuleNames = $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_SINGLE);

        $blockRuleNames[] = 'list_block_level';
        $blockRuleNames[] = 'list_block_item';

        foreach ($blockRuleNames as $blockRuleName)
        {
            $pOpenTokens[]  = $blockRuleName . '_close';
            $pCloseTokens[] = $blockRuleName . '_open';
        }

        for ($i = 0; $i < $tokenList->size(); $i++)
        {
            $syntaxTreeArray = $tokenList->getTokens();
            $token           = $syntaxTreeArray[$i];

            if ($token->getName() === EolRule::NAME)
            {
                $eolCount++;
                continue;
            }
            else
            {
                if ($eolCount > 1)
                {
                    if ($pOpened)
                    {
                        $tokenList->insertTokenAt(self::NAME . '_close', $token->getPosition() - $eolCount, $i - $eolCount);
                        $i++;
                    }
                    $tokenList->insertTokenAt(self::NAME . '_open', $token->getPosition(), $i);
                    $pOpened = true;
                    $i++;
                }
                elseif (!$pOpened && $eolCount === 1)
                {
                    $tokenList->insertTokenAt(self::NAME . '_open', $token->getPosition(), $i);
                    $pOpened = true;
                    $i++;
                }
                $eolCount = 0;
            }

            if ($pOpened && in_array($token->getName(), $singleRuleNames))
            {
                $tokenList->insertTokenAt(self::NAME . '_close', $token->getPosition(), $i);
                $pOpened = false;
                $i++;
            }
            elseif (!$pOpened && in_array($token->getName(), $pOpenTokens))
            {
                $tokenList->insertTokenAt(self::NAME . '_open', $token->getPosition(), $i + 1);
                $pOpened = true;
                $i++;
            }
            elseif ($pOpened && in_array($token->getName(), $pCloseTokens))
            {
                $tokenList->insertTokenAt(self::NAME . '_close', $token->getPosition(), $i);
                $pOpened = false;
                $i++;
            }
        }
        if ($pOpened)
        {
            $tokenList->insertTokenAt(self::NAME . '_close', $tokenList->last()
                                                                       ->getPosition(), $tokenList->size() - $eolCount);
        }
    }

    public function renderPOpen(Token $token)
    {
        return '<p>';
    }

    public function renderP(Token $token)
    {
        return $token->get('content', '');
    }

    public function renderPClose(Token $token)
    {
        return '</p>';
    }
}