<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Single\EolRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class EolBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap\Single
 */
class EolBootstrapRenderer extends AbstractRenderer {
    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(EolRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @return string
     */
    public function renderContent() {
        return ' ';
    }
}