<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class StrongBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserBootstrap\Renderer\Bootstrap\Format
 */
class StrongBootstrapRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(StrongRule::NAME . StrongRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(StrongRule::NAME . StrongRule::CLOSE, 'renderClose', $renderer);

        $this->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::CLOSE, 'renderClose', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '<strong>';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '</strong>';
    }
}