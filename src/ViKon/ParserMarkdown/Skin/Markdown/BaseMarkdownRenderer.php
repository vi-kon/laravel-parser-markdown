<?php

namespace ViKon\ParserMarkdown\Skin\Markdown;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\BaseRule;

/**
 * Class BaseMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown
 */
class BaseMarkdownRenderer extends AbstractRenderer {
    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(BaseRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderContent(Token $token) {
        return '<span style="color: #CC0000;">' . $token->get('content', '') . '</span>';
    }
}