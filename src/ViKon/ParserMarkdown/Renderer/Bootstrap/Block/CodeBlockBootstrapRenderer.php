<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;

/**
 * Class CodeBlockRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap\Block
 */
class CodeBlockBootstrapRenderer extends AbstractBootstrapRuleRenderer {
    /**
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::OPEN, [$this, 'renderCodeBlockOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME, [$this, 'renderCodeBlock'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::CLOSE, [$this, 'renderCodeBlockClose'], $this->skin);
    }

    /**
     * @return string
     */
    public function renderCodeBlockOpen() {
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
     * @return string
     */
    public function renderCodeBlockClose() {
        return '</code></pre>';
    }
}