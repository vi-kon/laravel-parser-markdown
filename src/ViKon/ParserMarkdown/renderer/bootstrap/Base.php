<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\rule\Base as BaseRule;

class Base extends AbstractBootstrapRuleRender {

    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(BaseRule::NAME, [$this, 'renderBase'], $this->skin);
    }

    public function renderBase(Token $token) {
        return $token->get('content', '');
    }
}