<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Single;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Single\HeaderAtxRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderSetextRule;

/**
 * Class HeaderBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap\Single
 */
class HeaderBootstrapRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(HeaderAtxRule::NAME, 'renderContent', $renderer);
        $this->registerTokenRenderer(HeaderSetextRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderContent(Token $token) {
        $level = $token->get('level', 1);
        $content = $token->get('content', '');

        $id = strtolower(preg_replace(['/[^\dA-Za-z ]/', '/ /'], ['', '-'], $content));

        return "<h$level id=\"$id\">$content</h$level>";
    }

}