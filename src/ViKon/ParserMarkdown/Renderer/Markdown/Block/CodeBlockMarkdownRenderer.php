<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockAltRule;
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
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . '_open', [$this, 'renderCodeBlockOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME, [$this, 'renderCodeBlock'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockRule::NAME . '_close', [$this, 'renderCodeBlockClose'], $this->skin);

        $renderer->registerTokenRenderer(CodeBlockAltRule::NAME . '_open', [$this, 'renderCodeBlockAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockAltRule::NAME, [$this, 'renderCodeBlockAlt'], $this->skin);
        $renderer->registerTokenRenderer(CodeBlockAltRule::NAME . '_close', [$this, 'renderCodeBlockAltClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlockOpen(Token $token) {
        return "\n";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlock(Token $token) {
        return '    ' . $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlockClose(Token $token) {
        return '';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlockAltOpen(Token $token) {
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
    public function renderCodeBlockAlt(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeBlockAltClose(Token $token) {
        return "\n```";
    }
}