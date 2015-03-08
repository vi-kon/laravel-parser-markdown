<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Single\HeaderAtxRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderSetextRule;

/**
 * Class HeaderAtxBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap\Single
 */
class HeaderBootstrapRenderer extends AbstractBootstrapRuleRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(HeaderAtxRule::NAME, [$this, 'renderContent'], $this->skin);
        $renderer->registerTokenRenderer(HeaderSetextRule::NAME, [$this, 'renderContent'], $this->skin);
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