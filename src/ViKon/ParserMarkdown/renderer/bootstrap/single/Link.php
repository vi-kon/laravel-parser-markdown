<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\LinkAutomatic as LinkAutomaticRule;
use ViKon\ParserMarkdown\rule\single\LinkInline as LinkInlineRule;
use ViKon\ParserMarkdown\rule\single\LinkReference as LinkReferenceRule;
use ViKon\ParserMarkdown\rule\single\Reference as ReferenceRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\Parser\TokenList;

class Link extends AbstractBootstrapRuleRender
{
    public function register(Renderer $renderer)
    {
        $renderer->addTokenRenderer(LinkInlineRule::NAME, array($this, 'renderLinkInline'), $this->skin);
        $renderer->addTokenRenderer(LinkReferenceRule::NAME, array($this, 'renderLinkReference'), $this->skin);
        $renderer->addTokenRenderer(LinkAutomaticRule::NAME, array($this, 'renderLinkAutomatic'), $this->skin);
    }

    public function renderLinkInline(Token $token)
    {
        $title = $token->get('title', null) === null
            ? ''
            : ' title="' . $token->get('title') . '"';

        return '<a href="' . $token->get('url') . '"' . $title . '>' . $token->get('label') . '</a>';
    }

    public function renderLinkReference(Token $token, TokenList $tokenList)
    {
        $reference = $token->get('reference');
        if ($reference instanceof Token)
        {
            $referenceToken = $reference;
        }
        else
        {
            if (trim($reference) === '')
            {
                $reference = strtolower(trim($token->get('label')));
            }

            $tokens = $tokenList->getTokensByCallback(function (Token $token) use ($reference)
            {
                return $token->getName() === ReferenceRule::NAME && $token->get('reference', null) === $reference;
            });

            if (($referenceToken = reset($tokens)) === false)
            {
                return $token->get('match', '');
            }

            $referenceToken->set('used', true);
        }

        $title = $referenceToken->get('title', null) === null
            ? ''
            : ' title="' . $referenceToken->get('title') . '"';

        return '<a href="' . $referenceToken->get('url') . '"' . $title . '>' . $token->get('label') . '</a>';
    }

    public function renderLinkAutomatic(Token $token)
    {
        return '<a href="' . $token->get('url') . '">' . htmlspecialchars($token->get('url')) . '</a>';
    }
}