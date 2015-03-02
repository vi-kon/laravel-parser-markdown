<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\format;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\rule\format\Italic as ItalicRule;
use ViKon\ParserMarkdown\rule\format\ItalicAlt as ItalicAltRule;

/**
 * Class Italic
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap\format
 */
class Italic extends AbstractBootstrapRuleRenderer {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(ItalicRule::NAME . '_open', [$this, 'renderItalicOpen'], $this->skin);
        $renderer->setTokenRenderer(ItalicRule::NAME, [$this, 'renderItalic'], $this->skin);
        $renderer->setTokenRenderer(ItalicRule::NAME . '_close', [$this, 'renderItalicClose'], $this->skin);

        $renderer->setTokenRenderer(ItalicAltRule::NAME . '_open', [$this, 'renderItalicOpen'], $this->skin);
        $renderer->setTokenRenderer(ItalicAltRule::NAME, [$this, 'renderItalic'], $this->skin);
        $renderer->setTokenRenderer(ItalicAltRule::NAME . '_close', [$this, 'renderItalicClose'], $this->skin);
    }

    public function renderItalicOpen(Token $token) {
        return '<em>';
    }

    public function renderItalic(Token $token) {
        return $token->get('content', '');
    }

    public function renderItalicClose(Token $token) {
        return '</em>';
    }
}