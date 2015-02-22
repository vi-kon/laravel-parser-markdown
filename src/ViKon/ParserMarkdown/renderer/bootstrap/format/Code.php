<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\format;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\format\Code as CodeRule;
use ViKon\ParserMarkdown\rule\format\CodeAlt as CodeAltRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;

class Code extends AbstractBootstrapRuleRender {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(CodeRule::NAME . '_open', array($this, 'renderCodeOpen'), $this->skin);
        $renderer->setTokenRenderer(CodeRule::NAME, array($this, 'renderCode'), $this->skin);
        $renderer->setTokenRenderer(CodeRule::NAME . '_close', array($this, 'renderCodeClose'), $this->skin);

        $renderer->setTokenRenderer(CodeAltRule::NAME . '_open', array($this, 'renderCodeOpen'), $this->skin);
        $renderer->setTokenRenderer(CodeAltRule::NAME, array($this, 'renderCode'), $this->skin);
        $renderer->setTokenRenderer(CodeAltRule::NAME . '_close', array($this, 'renderCodeClose'), $this->skin);
    }

    public function renderCodeOpen(Token $token) {
        return '<code>';
    }

    public function renderCode(Token $token) {
        return htmlspecialchars(trim($token->get('content', '')));
    }

    public function renderCodeClose(Token $token) {
        return '</code>';
    }
}