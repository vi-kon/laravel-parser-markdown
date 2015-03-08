<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\ParserMarkdown\Rule\PRule;

/**
 * Class PBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap
 */
class PBootstrapRenderer extends AbstractBootstrapRuleRenderer {

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
        return '<p class="text-justify">';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '</p>';
    }

    /**
     * @return string
     */
    public function renderEol() {
        return '<br/>';
    }
}