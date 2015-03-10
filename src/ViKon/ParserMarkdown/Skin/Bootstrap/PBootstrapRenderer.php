<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\ParserMarkdown\Rule\PRule;

/**
 * Class PBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap
 */
class PBootstrapRenderer extends AbstractRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
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
        return '<p class="text-justify">';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '</p>';
    }

    /**
     * @return string
     */
    public function renderEol() {
        return '<br/>';
    }
}