<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Block;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;
use ViKon\ParserMarkdown\Rule\Block\FencedCodeBlockRule;

/**
 * Class FencedCodeBlockBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap\Block
 */
class FencedCodeBlockBootstrapRenderer extends AbstractRenderer {
    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(FencedCodeBlockRule::NAME . CodeBlockRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(FencedCodeBlockRule::NAME . CodeBlockRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(FencedCodeBlockRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderOpen(Token $token) {
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
    public function renderContent(Token $token) {
        return htmlspecialchars($token->get('content', ''));
    }

    /**
     * @return string
     */
    public function renderClose() {
        return "</code></pre>";
    }
}