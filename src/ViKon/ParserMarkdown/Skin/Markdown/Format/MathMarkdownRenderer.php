<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Format;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Format\MathRule;

/**
 * Class MathMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Format
 */
class MathMarkdownRenderer extends AbstractRenderer {
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(MathRule::NAME . AbstractBlockRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(MathRule::NAME . AbstractBlockRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(MathRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '@[';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderContent(Token $token) {
        return $token->get('expression', '');
    }

    /**
     * @return string
     */
    public function renderClose() {
        return ']';
    }
}