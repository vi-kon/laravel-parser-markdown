<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\format;

use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\format\Italic as ItalicRule;
use ViKon\ParserMarkdown\rule\format\ItalicAlt as ItalicAltRule;
use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;

class Italic extends AbstractBootstrapRuleRender
{
    public function register(Renderer $renderer)
    {
        $renderer->addTokenRenderer(ItalicRule::NAME . '_open', array($this, 'renderItalicOpen'), $this->skin);
        $renderer->addTokenRenderer(ItalicRule::NAME, array($this, 'renderItalic'), $this->skin);
        $renderer->addTokenRenderer(ItalicRule::NAME . '_close', array($this, 'renderItalicClose'), $this->skin);

        $renderer->addTokenRenderer(ItalicAltRule::NAME . '_open', array($this, 'renderItalicOpen'), $this->skin);
        $renderer->addTokenRenderer(ItalicAltRule::NAME, array($this, 'renderItalic'), $this->skin);
        $renderer->addTokenRenderer(ItalicAltRule::NAME . '_close', array($this, 'renderItalicClose'), $this->skin);
    }

    public function renderItalicOpen(Token $token)
    {
        return '<em>';
    }

    public function renderItalic(Token $token)
    {
        return $token->get('content', '');
    }

    public function renderItalicClose(Token $token)
    {
        return '</em>';
    }
}