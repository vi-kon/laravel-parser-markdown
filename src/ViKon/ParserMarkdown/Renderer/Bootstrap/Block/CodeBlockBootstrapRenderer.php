<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockAltRule;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;

/**
 * Class CodeBlockRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap\Block
 */
class CodeBlockBootstrapRenderer extends AbstractBootstrapRuleRenderer {
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::OPEN, [$this, 'renderCodeBlockOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME, [$this, 'renderCodeBlock'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::CLOSE, [$this, 'renderCodeBlockClose'], $this->skin);

        $renderer->registerTokenRenderer(CodeBlockAltRule::NAME . CodeBlockRule::OPEN, [$this, 'renderCodeBlockAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockAltRule::NAME, [$this, 'renderCodeBlockAlt'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockAltRule::NAME . CodeBlockRule::CLOSE, [$this, 'renderCodeBlockAltClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlockOpen(Token $token) {
        return '<pre><code>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlock(Token $token) {
        return htmlspecialchars($token->get('content', ''));
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlockClose(Token $token) {
        return '</pre></code>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlockAltOpen(Token $token) {
        $lang = $token->get('lang', '');

        if (!empty($lang)) {
            return "<pre><code class=\"$lang\">";
        }

        return "<pre><code>";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlockAlt(Token $token) {
        return htmlspecialchars($token->get('content', ''));
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlockAltClose(Token $token) {
        return "</pre></code>";
    }
}