<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Single;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Single\BrRule;

class BrMarkdownRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(BrRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @return string
     */
    public function renderContent() {
        return "  \n";
    }
}