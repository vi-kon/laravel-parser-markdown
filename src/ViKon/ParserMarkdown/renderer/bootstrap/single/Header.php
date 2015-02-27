<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\HeaderAtx as HeaderAtxRule;
use ViKon\ParserMarkdown\rule\single\HeaderSetext as HeaderSetextRule;

class Header extends AbstractBootstrapRuleRender {

    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(HeaderAtxRule::NAME, [$this, 'renderHeader'], $this->skin);
        $renderer->setTokenRenderer(HeaderSetextRule::NAME, [$this, 'renderHeader'], $this->skin);
    }

    public function renderHeader(Token $token) {
        $level = $token->get('level', 1);
        $content = $token->get('content', '');
        $id = strtolower(preg_replace(['/[^\dA-Za-z ]/', '/ /'], ['', '-'], $content));

        return '<h' . $level . ' id="' . $id . '">' . htmlspecialchars($content) . '</h' . $level . '>';
    }
}