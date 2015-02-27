<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\Br as BrRule;

class Br extends AbstractBootstrapRuleRender {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(BrRule::NAME, [$this, 'renderBr'], $this->skin);
    }

    public function renderBr(Token $token) {
        return '<br/>';
    }
}