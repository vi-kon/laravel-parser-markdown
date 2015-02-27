<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\Escape as EscapeRule;

class Escape extends AbstractBootstrapRuleRender {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(EscapeRule::NAME, [$this, 'renderEscape'], $this->skin);
    }

    public function renderEscape(Token $token) {
        return htmlspecialchars($token->get('char'));
    }
}