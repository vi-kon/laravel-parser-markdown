<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Single\EolRule;

/**
 * Class EolMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Single
 */
class EolMarkdownRenderer extends AbstractMarkdownRuleRenderer {
    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(EolRule::NAME, [$this, 'renderEol'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderEol(Token $token) {
        return "\n";
    }
}