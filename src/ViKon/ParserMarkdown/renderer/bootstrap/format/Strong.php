<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\format;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\rule\format\Strong as StrongRule;
use ViKon\ParserMarkdown\rule\format\StrongAlt as StrongAltRule;

/**
 * Class Strong
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap\format
 */
class Strong extends AbstractBootstrapRuleRenderer {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(StrongRule::NAME . '_open', [$this, 'renderStrongOpen'], $this->skin);
        $renderer->setTokenRenderer(StrongRule::NAME, [$this, 'renderStrong'], $this->skin);
        $renderer->setTokenRenderer(StrongRule::NAME . '_close', [$this, 'renderStrongClose'], $this->skin);

        $renderer->setTokenRenderer(StrongAltRule::NAME . '_open', [$this, 'renderStrongOpen'], $this->skin);
        $renderer->setTokenRenderer(StrongAltRule::NAME, [$this, 'renderStrong'], $this->skin);
        $renderer->setTokenRenderer(StrongAltRule::NAME . '_close', [$this, 'renderStrongClose'], $this->skin);
    }

    public function renderStrongOpen(Token $token) {
        return '<strong>';
    }

    public function renderStrong(Token $token) {
        return $token->get('content', '');
    }

    public function renderStrongClose(Token $token) {
        return '</strong>';
    }
}