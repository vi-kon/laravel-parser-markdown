<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\block;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\rule\block\CodeBlock as CodeBlockRule;

/**
 * Class CodeBlock
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap\block
 */
class CodeBlock extends AbstractBootstrapRuleRenderer {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(CodeBlockRule::NAME . '_open', [$this, 'renderCodeBlockOpen'], $this->skin);
        $renderer->setTokenRenderer(CodeBlockRule::NAME, [$this, 'renderCodeBlock'], $this->skin);
        $renderer->setTokenRenderer(CodeBlockRule::NAME . '_close', [$this, 'renderCodeBlockClose'], $this->skin);
    }

    public function renderCodeBlockOpen(Token $token) {
        return '<pre><code>';
    }

    public function renderCodeBlock(Token $token) {
        return htmlspecialchars($token->get('content', ''));
    }

    public function renderCodeBlockClose(Token $token) {
        return '</pre></code>';
    }
}