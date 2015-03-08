<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\Token;
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
        $renderer->registerTokenRenderer(PRule::NAME . AbstractBlockRule::OPEN, [$this, 'renderPOpen'], $this->skin);
        $renderer->registerTokenRenderer(PRule::NAME . AbstractBlockRule::CLOSE, [$this, 'renderPClose'], $this->skin);
        $renderer->registerTokenRenderer(PRule::NAME . '_EOL', [$this, 'renderPEol'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderPOpen(Token $token) {
        return '<p class="text-justify">';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderPClose(Token $token) {
        return '</p>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderPEol(Token $token) {
        return '<br/>';
    }
}