<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;

/**
 * Class StrongBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserBootstrap\Renderer\Bootstrap\Format
 */
class StrongBootstrapRenderer extends AbstractBootstrapRuleRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(StrongRule::NAME . StrongRule::OPEN, [$this, 'renderStrongOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrongRule::NAME, [$this, 'renderStrong'], $this->skin);
        $renderer->registerTokenRenderer(StrongRule::NAME . StrongRule::CLOSE, [$this, 'renderStrongClose'], $this->skin);

        $renderer->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::OPEN, [$this, 'renderStrongOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrongAltRule::NAME, [$this, 'renderStrong'], $this->skin);
        $renderer->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::CLOSE, [$this, 'renderStrongClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongOpen(Token $token) {
        return '<strong>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return mixed|null
     */
    public function renderStrong(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongClose(Token $token) {
        return '</strong>';
    }
}