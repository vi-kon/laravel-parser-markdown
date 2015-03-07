<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
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
        $renderer->registerTokenRenderer(ItalicRule::NAME . ItalicRule::OPEN, [$this, 'renderItalicOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicRule::NAME . ItalicRule::CLOSE, [$this, 'renderItalicClose'], $this->skin);

        $renderer->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::OPEN, [$this, 'renderItalicOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::CLOSE, [$this, 'renderItalicClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderItalicOpen(Token $token) {
        return '<em>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderItalicClose(Token $token) {
        return '</em>';
    }
}