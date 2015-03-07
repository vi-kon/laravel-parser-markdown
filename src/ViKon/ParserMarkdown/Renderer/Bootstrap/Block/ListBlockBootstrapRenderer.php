<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\ListBlockRule;

/**
 * Class ListBlockBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap\Block
 */
class ListBlockBootstrapRenderer extends AbstractBootstrapRuleRenderer {
    protected $ordered;

    /**
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(ListBlockRule::NAME . ListBlockRule::OPEN, [$this, 'renderListBlockOpen'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_LEVEL_OPEN', [$this, 'renderListBlockLevelOpen'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_ITEM_OPEN', [$this, 'renderListBlockItemOpen'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME, [$this, 'renderListBlockItem'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_ITEM_CLOSE', [$this, 'renderListBlockItemClose'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_LEVEL_CLOSE', [$this, 'renderListBlockLevelClose'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . ListBlockRule::CLOSE, [$this, 'renderListBlockClose'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_ITEM_EOL', [$this, 'renderListBlockItemEol'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderListBlockOpen(Token $token) {
        $this->ordered = [];

        return '';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderListBlockLevelOpen(Token $token) {
        $this->ordered[] = $token->get('ordered', false);

        return '<' . ($token->get('ordered', false)
            ? 'ol'
            : 'ul') . '>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderListBlockItemOpen(Token $token) {
        return '<li>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return mixed|null
     */
    public function renderListBlockItem(Token $token) {
        return $token->get('content', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderListBlockItemClose(Token $token) {
        return '</li>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderListBlockLevelClose(Token $token) {
        $ordered = array_pop($this->ordered);

        return '</' . ($ordered
            ? 'ol'
            : 'ul') . '>';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderListBlockClose(Token $token) {
        return '';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderListBlockItemEol(Token $token) {
        return '';
    }
}