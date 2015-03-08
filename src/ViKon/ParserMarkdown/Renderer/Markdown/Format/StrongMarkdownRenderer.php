<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;

/**
 * Class StrongMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Format
 */
class StrongMarkdownRenderer extends AbstractMarkdownRuleRenderer {

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

        $renderer->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::OPEN, [$this, 'renderAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::CLOSE, [$this, 'renderAltClose'], $this->skin);
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