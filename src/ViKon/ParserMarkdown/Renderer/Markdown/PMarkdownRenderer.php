<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\PRule;

/**
 * Class PMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown
 */
class PMarkdownRenderer extends AbstractMarkdownRuleRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(PRule::NAME . AbstractBlockRule::OPEN, [$this, 'renderPOpen'], $this->skin);
        $renderer->registerTokenRenderer(PRule::NAME . AbstractBlockRule::CLOSE, [$this, 'renderPClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderPOpen(Token $token) {
        return '';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderPClose(Token $token) {
        return '';
    }
}