<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\ItalicAltRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicRule;

/**
 * Class ItalicBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserBootstrap\Renderer\Bootstrap\Format
 */
class ItalicBootstrapRenderer extends AbstractBootstrapRuleRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(ItalicRule::NAME . ItalicRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicRule::NAME . ItalicRule::CLOSE, [$this, 'renderClose'], $this->skin);

        $renderer->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::CLOSE, [$this, 'renderClose'], $this->skin);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '<em>';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '</em>';
    }
}