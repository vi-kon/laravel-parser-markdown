<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Single\EolRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class EolMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Single
 */
class EolMarkdownRenderer extends AbstractRenderer {
    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(EolRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @return string
     */
    public function renderContent() {
        return "\n";
    }
}