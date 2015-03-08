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
        $renderer->registerTokenRenderer(ListBlockRule::NAME . ListBlockRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . ListBlockRule::CLOSE, [$this, 'renderClose'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_LEVEL_OPEN', [$this, 'renderLevelOpen'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_LEVEL_CLOSE', [$this, 'renderLevelClose'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_ITEM_OPEN', [$this, 'renderItemOpen'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_ITEM_CLOSE', [$this, 'renderItemClose'], $this->skin);
        $renderer->registerTokenRenderer(ListBlockRule::NAME . '_ITEM_EOL', [$this, 'renderItemEol'], $this->skin);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        $this->ordered = [];

        return '';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderLevelOpen(Token $token) {
        $this->ordered[] = $token->get('ordered', false);

        return '<' . ($token->get('ordered', false)
            ? 'ol'
            : 'ul') . '>';
    }

    /**
     * @return string
     */
    public function renderItemOpen() {
        return '<li>';
    }

    /**
     * @return string
     */
    public function renderItemClose() {
        return '</li>';
    }

    /**
     * @return string
     */
    public function renderLevelClose() {
        $ordered = array_pop($this->ordered);

        return '</' . ($ordered
            ? 'ol'
            : 'ul') . '>';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '';
    }

    /**
     * @return string
     */
    public function renderItemEol() {
        return '';
    }
}