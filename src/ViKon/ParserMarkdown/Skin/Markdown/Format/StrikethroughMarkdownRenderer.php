<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Format\StrikethroughRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class StrikethroughMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Format
 */
class StrikethroughMarkdownRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(StrikethroughRule::NAME . StrikethroughRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(StrikethroughRule::NAME . StrikethroughRule::CLOSE, 'renderClose', $renderer);

    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '~~';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '~~';
    }
}