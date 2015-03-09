<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Format\StrikethroughRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class StrikethroughBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserBootstrap\Renderer\Bootstrap\Format
 */
class StrikethroughBootstrapRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(StrikethroughRule::NAME . StrikethroughRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(StrikethroughRule::NAME . StrikethroughRule::CLOSE, 'renderClose', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '<s>';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '</s>';
    }
}