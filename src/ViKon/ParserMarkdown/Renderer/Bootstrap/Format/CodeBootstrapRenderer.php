<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Format;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Format\CodeAltRule;
use ViKon\ParserMarkdown\Rule\Format\CodeRule;

/**
 * Class CodeBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserBootstrap\Renderer\Bootstrap\Format
 */
class CodeBootstrapRenderer extends AbstractBootstrapRuleRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(CodeRule::NAME . CodeRule::OPEN, [$this, 'renderCodeOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeRule::NAME, [$this, 'renderCode'], $this->skin);
        $renderer->registerTokenRenderer(CodeRule::NAME . CodeRule::CLOSE, [$this, 'renderCodeClose'], $this->skin);

        $renderer->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::OPEN, [$this, 'renderCodeOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeAltRule::NAME, [$this, 'renderCode'], $this->skin);
        $renderer->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::CLOSE, [$this, 'renderCodeClose'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeOpen(Token $token) {
        return '<code>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return mixed|null
     */
    public function renderCode(Token $token) {
        return htmlspecialchars($token->get('content', ''));
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderCodeClose(Token $token) {
        return '</code>';
    }
}