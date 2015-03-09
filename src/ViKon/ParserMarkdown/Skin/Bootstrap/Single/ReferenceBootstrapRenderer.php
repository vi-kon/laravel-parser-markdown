<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Single;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Single\ReferenceRule;

/**
 * Class LinkAtxBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap\Single
 */
class ReferenceBootstrapRenderer extends AbstractRenderer {

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(ReferenceRule::NAME, 'renderContent', $renderer);
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