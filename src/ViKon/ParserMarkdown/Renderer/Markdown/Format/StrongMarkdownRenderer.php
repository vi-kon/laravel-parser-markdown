<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;

/**
 * Class StrongMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Format
 */
class StrongMarkdownRenderer extends AbstractMarkdownRuleRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(StrongRule::NAME . StrongRule::OPEN, [$this, 'renderStrongOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrongRule::NAME . StrongRule::CLOSE, [$this, 'renderStrongClose'], $this->skin);

        $renderer->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::OPEN, [$this, 'renderStrongAltOpen'], $this->skin);
        $renderer->registerTokenRenderer(StrongAltRule::NAME . StrongAltRule::CLOSE, [$this, 'renderStrongAltClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongOpen(Token $token) {
        return '**';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongClose(Token $token) {
        return '**';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongAltOpen(Token $token) {
        return '__';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderStrongAltClose(Token $token) {
        return '__';
    }
}