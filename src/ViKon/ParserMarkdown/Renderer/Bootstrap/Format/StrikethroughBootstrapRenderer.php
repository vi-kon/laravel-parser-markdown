<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\StrikethroughRule;

/**
 * Class StrikethroughBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserBootstrap\Renderer\Bootstrap\Format
 */
class StrikethroughBootstrapRenderer extends AbstractBootstrapRuleRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(StrikethroughRule::NAME . StrikethroughRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrikethroughRule::NAME . StrikethroughRule::CLOSE, [$this, 'renderClose'], $this->skin);
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