<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\CodeAltRule;
use ViKon\ParserMarkdown\Rule\Format\CodeRule;

/**
 * Class CodeMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Format
 */
class CodeMarkdownRenderer extends AbstractMarkdownRuleRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(CodeRule::NAME . CodeRule::OPEN, [$this, 'renderCodeOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeRule::NAME, [$this, 'renderCode'], $this->skin);
        $renderer->registerTokenRenderer(CodeRule::NAME . CodeRule::CLOSE, [$this, 'renderCodeClose'], $this->skin);

        $renderer->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::OPEN, [$this, 'renderCodeAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeAltRule::NAME, [$this, 'renderCodeAlt'], $this->skin);
        $renderer->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::CLOSE, [$this, 'renderCodeAltClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeOpen(Token $token) {
        return '`';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return mixed|null
     */
    public function renderCode(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeClose(Token $token) {
        return '`';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeAltOpen(Token $token) {
        return '``';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return mixed|null
     */
    public function renderCodeAlt(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeAltClose(Token $token) {
        return '``';
    }
}