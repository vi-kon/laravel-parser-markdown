<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\rule\single\EmailAutomatic as EmailAutomaticRule;

/**
 * Class Email
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap\single
 */
class Email extends AbstractBootstrapRuleRenderer {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(EmailAutomaticRule::NAME, [$this, 'renderEmailAutomatic'], $this->skin);
    }

    public function renderEmailAutomatic(Token $token) {
        return '<a href="' . \HTML::email('mailto:' . $token->get('url')) . '">' . \HTML::email($token->get('url')) . '</a>';
    }
}