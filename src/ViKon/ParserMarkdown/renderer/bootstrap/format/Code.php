<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\format;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\rule\format\Code as CodeRule;
use ViKon\ParserMarkdown\rule\format\CodeAlt as CodeAltRule;

/**
 * Class Code
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap\format
 */
class Code extends AbstractBootstrapRuleRenderer {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(CodeRule::NAME . '_open', [$this, 'renderCodeOpen'], $this->skin);
        $renderer->setTokenRenderer(CodeRule::NAME, [$this, 'renderCode'], $this->skin);
        $renderer->setTokenRenderer(CodeRule::NAME . '_close', [$this, 'renderCodeClose'], $this->skin);

        $renderer->setTokenRenderer(CodeAltRule::NAME . '_open', [$this, 'renderCodeOpen'], $this->skin);
        $renderer->setTokenRenderer(CodeAltRule::NAME, [$this, 'renderCode'], $this->skin);
        $renderer->setTokenRenderer(CodeAltRule::NAME . '_close', [$this, 'renderCodeClose'], $this->skin);
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