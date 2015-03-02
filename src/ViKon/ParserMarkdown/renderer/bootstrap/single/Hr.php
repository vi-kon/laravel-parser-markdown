<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\rule\single\Hr as HrRule;

/**
 * Class Hr
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap\single
 */
class Hr extends AbstractBootstrapRuleRenderer {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(HrRule::NAME, [$this, 'renderHr'], $this->skin);
    }

    public function renderHr(Token $token) {
        return '<hr/>';
    }
}