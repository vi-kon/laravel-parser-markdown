<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\block;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\block\ListBlock as ListBlockRule;

/**
 * Class ListBlock
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap\block
 */
class ListBlock extends AbstractBootstrapRuleRender {
    protected $ordered = [];

    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(ListBlockRule::NAME . '_open', [$this, 'renderListBlockOpen'], $this->skin);
        $renderer->setTokenRenderer(ListBlockRule::NAME . '_level_open', [$this, 'renderListBlockLevelOpen'], $this->skin);
        $renderer->setTokenRenderer(ListBlockRule::NAME . '_item_open', [$this, 'renderListBlockItemOpen'], $this->skin);
        $renderer->setTokenRenderer(ListBlockRule::NAME, [$this, 'renderListBlockItem'], $this->skin);
        $renderer->setTokenRenderer(ListBlockRule::NAME . '_item_close', [$this, 'renderListBlockItemClose'], $this->skin);
        $renderer->setTokenRenderer(ListBlockRule::NAME . '_level_close', [$this, 'renderListBlockLevelClose'], $this->skin);
        $renderer->setTokenRenderer(ListBlockRule::NAME . '_close', [$this, 'renderListBlockClose'], $this->skin);
    }

    public function renderListBlockOpen(Token $token) {
        $this->ordered = [];

        return '';
    }

    public function renderListBlockLevelOpen(Token $token) {
        $this->ordered[] = $token->get('ordered', false);

        return '<' . ($token->get('ordered', false)
            ? 'ol'
            : 'ul') . '>';
    }

    public function renderListBlockItemOpen(Token $token) {
        return '<li>';
    }

    public function renderListBlockItem(Token $token) {
        return $token->get('content', '');
    }

    public function renderListBlockItemClose(Token $token) {
        return '</li>';
    }

    public function renderListBlockLevelClose(Token $token) {
        $ordered = array_pop($this->ordered);

        return '</' . ($ordered
            ? 'ol'
            : 'ul') . '>';
    }

    public function renderListBlockClose(Token $token) {
        return '';
    }
}