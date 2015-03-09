<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Block;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;
use ViKon\ParserMarkdown\Rule\Block\FencedCodeBlockRule;

/**
 * Class FencedCodeBlockMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Block
 */
class FencedCodeBlockMarkdownRenderer extends AbstractRenderer {
    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(FencedCodeBlockRule::NAME . CodeBlockRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(FencedCodeBlockRule::NAME, 'renderContent', $renderer);
        $this->registerTokenRenderer(FencedCodeBlockRule::NAME . CodeBlockRule::CLOSE, 'renderClose', $renderer);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderOpen(Token $token) {
        $lang = $token->get('lang', '');

        if (!empty($lang)) {
            return "\n```$lang";
        }

        return "\n```";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderContent(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @return string
     */
    public function renderClose() {
        return "\n```";
    }
}