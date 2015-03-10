<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Format\CodeAltRule;
use ViKon\ParserMarkdown\Rule\Format\CodeRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class CodeMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Format
 */
class CodeMarkdownRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(CodeRule::NAME . CodeRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(CodeRule::NAME . CodeRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(CodeRule::NAME, 'renderContent', $renderer);

        $this->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::OPEN, 'renderAltOpen', $renderer);
        $this->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::CLOSE, 'renderAltClose', $renderer);
        $this->registerTokenRenderer(CodeAltRule::NAME, 'renderContent', $renderer);
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