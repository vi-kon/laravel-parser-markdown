<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;

/**
 * Class CodeBlockRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Block
 */
class CodeBlockMarkdownRenderer extends AbstractMarkdownRuleRenderer {
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME, [$this, 'renderContent'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::CLOSE, [$this, 'renderClose'], $this->skin);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return "\n";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderContent(Token $token) {
        return '    ' . $token->get('content', '');
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '';
    }
}