<?php

namespace ViKon\ParserMarkdown\Skin\Markdown;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\ParserMarkdown\Rule\PRule;

/**
 * Class PMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown
 */
class PMarkdownRenderer extends AbstractRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(PRule::NAME . AbstractBlockRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(PRule::NAME . AbstractBlockRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(PRule::NAME . '_EOL', 'renderEol', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '';
    }

    /**
     * @return string
     */
    public function renderEol() {
        return '';
    }
}