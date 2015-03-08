<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;
use ViKon\ParserMarkdown\Rule\Block\FencedCodeBlockRule;

/**
 * Class FencedCodeBlockMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Block
 */
class FencedCodeBlockMarkdownRenderer extends AbstractMarkdownRuleRenderer {
    /**
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(FencedCodeBlockRule::NAME . CodeBlockRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(FencedCodeBlockRule::NAME, [$this, 'renderContent'], $this->skin);
        $renderer->registerTokenRenderer(FencedCodeBlockRule::NAME . CodeBlockRule::CLOSE, [$this, 'renderClose'], $this->skin);
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