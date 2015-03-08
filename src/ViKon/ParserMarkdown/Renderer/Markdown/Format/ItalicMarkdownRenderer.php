<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\ItalicAltRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicRule;

/**
 * Class ItalicMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Format
 */
class ItalicMarkdownRenderer extends AbstractMarkdownRuleRenderer {

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

        $renderer->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::OPEN, [$this, 'renderAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::CLOSE, [$this, 'renderAltClose'], $this->skin);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '*';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '*';
    }

    /**
     * @return string
     */
    public function renderAltOpen() {
        return '_';
    }

    /**
     * @return string
     */
    public function renderAltClose() {
        return '_';
    }
}