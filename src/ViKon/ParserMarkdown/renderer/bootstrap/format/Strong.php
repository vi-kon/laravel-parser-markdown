<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\format;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\format\Strong as StrongRule;
use ViKon\ParserMarkdown\rule\format\StrongAlt as StrongAltRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;

class Strong extends AbstractBootstrapRuleRender {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(StrongRule::NAME . '_open', array($this, 'renderStrongOpen'), $this->skin);
        $renderer->setTokenRenderer(StrongRule::NAME, array($this, 'renderStrong'), $this->skin);
        $renderer->setTokenRenderer(StrongRule::NAME . '_close', array($this, 'renderStrongClose'), $this->skin);

        $renderer->setTokenRenderer(StrongAltRule::NAME . '_open', array($this, 'renderStrongOpen'), $this->skin);
        $renderer->setTokenRenderer(StrongAltRule::NAME, array($this, 'renderStrong'), $this->skin);
        $renderer->setTokenRenderer(StrongAltRule::NAME . '_close', array($this, 'renderStrongClose'), $this->skin);
    }

    public function renderStrongOpen(Token $token) {
        return '<strong>';
    }

    public function renderStrong(Token $token) {
        return $token->get('content', '');
    }

    public function renderStrongClose(Token $token) {
        return '</strong>';
    }
}