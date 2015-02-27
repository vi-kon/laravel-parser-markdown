<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\Reference as ReferenceRule;

class Reference extends AbstractBootstrapRuleRender {

    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(ReferenceRule::NAME, [$this, 'renderReference'], $this->skin);
    }

    public function renderReference(Token $token) {
        if ($token->get('used', false)) {
            return '';
        }

        return $token->get('match');
    }
}