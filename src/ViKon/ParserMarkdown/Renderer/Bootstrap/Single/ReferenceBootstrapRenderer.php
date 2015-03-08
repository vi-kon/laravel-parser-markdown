<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Single\ReferenceRule;

/**
 * Class LinkAtxBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap\Single
 */
class ReferenceBootstrapRenderer extends AbstractBootstrapRuleRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(ReferenceRule::NAME, [$this, 'renderContent'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderContent(Token $token) {
        if ($token->get('used', false)) {
            return '';
        }

        return $token->get('match') . "\n";
    }
}