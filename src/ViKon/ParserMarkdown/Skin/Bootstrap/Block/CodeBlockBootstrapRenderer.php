<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Block;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;

/**
 * Class CodeBlockRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap\Block
 */
class CodeBlockBootstrapRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(CodeBlockRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '<pre><code>';
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
        return '</code></pre>';
    }
}