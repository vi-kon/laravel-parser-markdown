<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Format\ItalicAltRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class ItalicMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Format
 */
class ItalicMarkdownRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(ItalicRule::NAME . ItalicRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(ItalicRule::NAME . ItalicRule::CLOSE, 'renderClose', $renderer);

        $this->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::OPEN, 'renderAltOpen', $renderer);
        $this->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::CLOSE, 'renderAltClose', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '*';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '*';
    }

    /**
     * @return string
     */
    public function renderAltOpen() {
        return '_';
    }

    /**
     * @return string
     */
    public function renderAltClose() {
        return '_';
    }
}