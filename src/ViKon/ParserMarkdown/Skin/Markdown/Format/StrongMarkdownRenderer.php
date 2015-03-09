<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class StrongMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Format
 */
class StrongMarkdownRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(StrongRule::NAME . StrongRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(StrongRule::NAME . StrongRule::CLOSE, 'renderClose', $renderer);

        $this->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::OPEN, 'renderAltOpen', $renderer);
        $this->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::CLOSE, 'renderAltClose', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '**';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '**';
    }

    /**
     * @return string
     */
    public function renderAltOpen() {
        return '__';
    }

    /**
     * @return string
     */
    public function renderAltClose() {
        return '__';
    }
}