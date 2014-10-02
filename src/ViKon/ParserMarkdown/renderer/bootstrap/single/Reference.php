<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\Reference as ReferenceRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;

class Reference extends AbstractBootstrapRuleRender
{

    public function register(Renderer $renderer)
    {
        $renderer->setTokenRenderer(ReferenceRule::NAME, array($this, 'renderReference'), $this->skin);
    }

    public function renderReference(Token $token)
    {
        if ($token->get('used', false))
        {
            return '';
        }

        return $token->get('match');
    }
}