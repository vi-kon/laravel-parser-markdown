<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Single\HeaderAtxRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderSetextRule;

/**
 * Class HeaderAtxMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Single
 */
class HeaderMarkdownRenderer extends AbstractMarkdownRuleRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(HeaderAtxRule::NAME, [$this, 'renderAtxContent'], $this->skin);
        $renderer->registerTokenRenderer(HeaderSetextRule::NAME, [$this, 'renderSetextContent'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderAtxContent(Token $token) {
        $level = $token->get('level', 1);
        $content = $token->get('content', '');

        return "\n" . str_pad('', $level, '#') . ' ' . $content;
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderSetextContent(Token $token) {
        $level = $token->get('level', 1);
        $content = $token->get('content', '');

        $line = str_pad('', max(2, strlen($content)), $level === 1 ? '=' : '-');

        return "\n" . $content . "\n" . $line;
    }
}