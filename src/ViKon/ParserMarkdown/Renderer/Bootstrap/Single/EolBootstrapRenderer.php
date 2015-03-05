<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Single\EolRule;

/**
 * Class EolBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap\Single
 */
class EolBootstrapRenderer extends AbstractBootstrapRuleRenderer {
    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(EolRule::NAME, [$this, 'renderEol'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderEol(Token $token) {
        return '';
    }
}