<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\block;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRenderer;

/**
 * Class P
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap\block
 */
class P extends AbstractBootstrapRuleRenderer {
    const NAME = 'p';

    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer('p_open', [$this, 'renderPOpen'], $this->skin);
        $renderer->setTokenRenderer('p', [$this, 'renderP'], $this->skin);
        $renderer->setTokenRenderer('p_close', [$this, 'renderPClose'], $this->skin);
    }

    public function renderPOpen(Token $token) {
        return '<p class="text-justify">';
    }

    public function renderP(Token $token) {
        return $token->get('content', '');
    }

    public function renderPClose(Token $token) {
        return '</p>';
    }
}