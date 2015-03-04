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
        $renderer->registerTokenRenderer(ItalicRule::NAME . '_open', [$this, 'renderItalicOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicRule::NAME, [$this, 'renderItalic'], $this->skin);
        $renderer->registerTokenRenderer(ItalicRule::NAME . '_close', [$this, 'renderItalicClose'], $this->skin);

        $renderer->registerTokenRenderer(ItalicAltRule::NAME . '_open', [$this, 'renderItalicOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicAltRule::NAME, [$this, 'renderItalic'], $this->skin);
        $renderer->registerTokenRenderer(ItalicAltRule::NAME . '_close', [$this, 'renderItalicClose'], $this->skin);
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
     * @return mixed|null
     */
    public function renderItalic(Token $token) {
        return $token->get('content', '');
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