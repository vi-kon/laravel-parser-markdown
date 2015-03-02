<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\rule\Base as BaseRule;

/**
 * Class Base
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap
 */
class Base extends AbstractBootstrapRuleRenderer {

    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(BaseRule::NAME, [$this, 'renderBase'], $this->skin);
    }

    public function renderBase(Token $token) {
        return $token->get('content', '');
    }
}