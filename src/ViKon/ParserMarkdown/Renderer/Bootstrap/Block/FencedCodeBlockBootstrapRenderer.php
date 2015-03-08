<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;
use ViKon\ParserMarkdown\Rule\Block\FencedCodeBlockRule;

/**
 * Class FencedCodeBlockBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap\Block
 */
class FencedCodeBlockBootstrapRenderer extends AbstractBootstrapRuleRenderer {
    /**
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(FencedCodeBlockRule::NAME . CodeBlockRule::OPEN, [$this, 'open'], $this->skin);
        $renderer->registerTokenRenderer(FencedCodeBlockRule::NAME, [$this, 'content'], $this->skin);
        $renderer->registerTokenRenderer(FencedCodeBlockRule::NAME . CodeBlockRule::CLOSE, [$this, 'close'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function open(Token $token) {
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
    public function content(Token $token) {
        return htmlspecialchars($token->get('content', ''));
    }

    /**
     * @return string
     */
    public function close() {
        return "</code></pre>";
    }
}