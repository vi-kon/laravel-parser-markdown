<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\Escape as EscapeRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;

class Escape extends AbstractBootstrapRuleRender
{
    public function register(Renderer $renderer)
    {
        $renderer->addTokenRenderer(EscapeRule::NAME, array($this, 'renderEscape'), $this->skin);
    }

    public function renderEscape(Token $token)
    {
        return htmlspecialchars($token->get('char'));
    }
}