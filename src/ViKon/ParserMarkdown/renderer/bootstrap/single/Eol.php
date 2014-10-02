<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\rule\single\Eol as EolRule;

class Eol extends AbstractBootstrapRuleRender
{

    public function register(Renderer $renderer)
    {
        $renderer->addTokenRenderer(EolRule::NAME, array($this, 'renderEol'), $this->skin);
    }

    public function renderEol(Token $token)
    {
        return "\n";
    }
}