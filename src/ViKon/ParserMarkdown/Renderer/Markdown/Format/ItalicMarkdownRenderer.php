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
        $renderer->registerTokenRenderer(ItalicRule::NAME . ItalicRule::OPEN, [$this, 'renderItalicOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicRule::NAME . ItalicRule::CLOSE, [$this, 'renderItalicClose'], $this->skin);

        $renderer->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::OPEN, [$this, 'renderItalicAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(ItalicAltRule::NAME . ItalicAltRule::CLOSE, [$this, 'renderItalicAltClose'], $this->skin);
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
     * @return string
     */
    public function renderItalicAltClose(Token $token) {
        return '_';
    }
}