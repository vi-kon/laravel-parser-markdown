<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
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
        $renderer->registerTokenRenderer(ItalicRule::NAME . '_open', [$this, 'renderItalicOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicRule::NAME, [$this, 'renderItalic'], $this->skin);
        $renderer->registerTokenRenderer(ItalicRule::NAME . '_close', [$this, 'renderItalicClose'], $this->skin);

        $renderer->registerTokenRenderer(ItalicAltRule::NAME . '_open', [$this, 'renderItalicAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicAltRule::NAME, [$this, 'renderItalicAlt'], $this->skin);
        $renderer->registerTokenRenderer(ItalicAltRule::NAME . '_close', [$this, 'renderItalicAltClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderItalicOpen(Token $token) {
        return '*';
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
        return '*';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderItalicAltOpen(Token $token) {
        return '_';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return mixed|null
     */
    public function renderItalicAlt(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderItalicAltClose(Token $token) {
        return '_';
    }
}