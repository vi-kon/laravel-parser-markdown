<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Format\ItalicAltRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class ItalicBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserBootstrap\Renderer\Bootstrap\Format
 */
class ItalicBootstrapRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(ItalicRule::NAME . ItalicRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(ItalicRule::NAME . ItalicRule::CLOSE, 'renderClose', $renderer);

        $this->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::CLOSE, 'renderClose', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '<em>';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '</em>';
    }
}