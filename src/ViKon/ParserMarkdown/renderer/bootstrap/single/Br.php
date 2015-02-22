<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\Br as BrRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;

class Br extends AbstractBootstrapRuleRender {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(BrRule::NAME, array($this, 'renderBr'), $this->skin);
    }

    public function renderBr(Token $token) {
        return '<br/>';
    }
}