<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\Hr as HrRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;

class Hr extends AbstractBootstrapRuleRender {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(HrRule::NAME, array($this, 'renderHr'), $this->skin);
    }

    public function renderHr(Token $token) {
        return '<hr/>';
    }
}