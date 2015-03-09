<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Format\CodeAltRule;
use ViKon\ParserMarkdown\Rule\Format\CodeRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class CodeBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserBootstrap\Renderer\Bootstrap\Format
 */
class CodeBootstrapRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(CodeRule::NAME . CodeRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(CodeRule::NAME . CodeRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(CodeRule::NAME, 'renderContent', $renderer);

        $this->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(CodeAltRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '<code>';
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
        return '</code>';
    }
}