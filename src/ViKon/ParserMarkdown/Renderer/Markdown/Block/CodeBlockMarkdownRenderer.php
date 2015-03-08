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
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::OPEN, [$this, 'open'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME, [$this, 'content'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . CodeBlockRule::CLOSE, [$this, 'close'], $this->skin);
    }

    /**
     * @return string
     */
    public function open() {
        return "\n";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function content(Token $token) {
        return '    ' . $token->get('content', '');
    }

    /**
     * @return string
     */
    public function close() {
        return '';
    }
}