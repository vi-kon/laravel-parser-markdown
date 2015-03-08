<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;

/**
 * Class StrongBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserBootstrap\Renderer\Bootstrap\Format
 */
class StrongBootstrapRenderer extends AbstractBootstrapRuleRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(StrongRule::NAME . StrongRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrongRule::NAME . StrongRule::CLOSE, [$this, 'renderClose'], $this->skin);

        $renderer->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::CLOSE, [$this, 'renderClose'], $this->skin);
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