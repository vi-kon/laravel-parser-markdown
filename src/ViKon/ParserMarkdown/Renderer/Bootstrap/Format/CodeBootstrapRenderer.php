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
        $renderer->registerTokenRenderer(CodeRule::NAME . CodeRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeRule::NAME . CodeRule::CLOSE, [$this, 'renderClose'], $this->skin);
        $renderer->registerTokenRenderer(CodeRule::NAME, [$this, 'renderContent'], $this->skin);

        $renderer->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(CodeAltRule::NAME . CodeAltRule::CLOSE, [$this, 'renderClose'], $this->skin);
        $renderer->registerTokenRenderer(CodeAltRule::NAME, [$this, 'renderContent'], $this->skin);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '<code>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderContent(Token $token) {
        return htmlspecialchars($token->get('content', ''));
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '</code>';
    }
}