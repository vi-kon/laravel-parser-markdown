<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\block;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;

class P extends AbstractBootstrapRuleRender {
    const NAME = 'p';

    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer('p_open', array($this, 'renderPOpen'), $this->skin);
        $renderer->setTokenRenderer('p', array($this, 'renderP'), $this->skin);
        $renderer->setTokenRenderer('p_close', array($this, 'renderPClose'), $this->skin);
    }

    public function renderPOpen(Token $token) {
        return '<p class="text-justify">';
    }

    public function renderP(Token $token) {
        return $token->get('content', '');
    }

    public function renderPClose(Token $token) {
        return '</p>';
    }
}