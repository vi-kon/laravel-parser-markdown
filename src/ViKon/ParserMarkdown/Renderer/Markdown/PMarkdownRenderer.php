<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Rule\AbstractBlockRule;
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
        $renderer->registerTokenRenderer(PRule::NAME . AbstractBlockRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(PRule::NAME . AbstractBlockRule::CLOSE, [$this, 'renderClose'], $this->skin);
        $renderer->registerTokenRenderer(PRule::NAME . '_EOL', [$this, 'renderEol'], $this->skin);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '';
    }

    /**
     * @return string
     */
    public function renderEol() {
        return '';
    }
}