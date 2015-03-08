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
        $renderer->registerTokenRenderer(CodeRule::NAME . CodeRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeRule::NAME . CodeRule::CLOSE, [$this, 'renderClose'], $this->skin);
        $renderer->registerTokenRenderer(CodeRule::NAME, [$this, 'renderContent'], $this->skin);

        $renderer->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::OPEN, [$this, 'renderAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::CLOSE, [$this, 'renderAltClose'], $this->skin);
        $renderer->registerTokenRenderer(CodeAltRule::NAME, [$this, 'renderContent'], $this->skin);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '`';
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
        return '`';
    }

    /**
     * @return string
     */
    public function renderAltOpen() {
        return '``';
    }

    /**
     * @return string
     */
    public function renderAltClose() {
        return '``';
    }
}