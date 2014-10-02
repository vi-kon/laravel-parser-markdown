<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\HeaderAtx as HeaderAtxRule;
use ViKon\ParserMarkdown\rule\single\HeaderSetext as HeaderSetextRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;

class Header extends AbstractBootstrapRuleRender
{

    public function register(Renderer $renderer)
    {
        $renderer->addTokenRenderer(HeaderAtxRule::NAME, array($this, 'renderHeader'), $this->skin);
        $renderer->addTokenRenderer(HeaderSetextRule::NAME, array($this, 'renderHeader'), $this->skin);
    }

    public function renderHeader(Token $token)
    {
        $level   = $token->get('level', 1);
        $content = $token->get('content', '');

        return '<h' . $level . '>' . htmlspecialchars($content) . '</h' . $level . '>';
    }
}