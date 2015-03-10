<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Block\ListBlockRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class ListBlockBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap\Block
 */
class ListBlockBootstrapRenderer extends AbstractRenderer {
    protected $ordered;

    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(ListBlockRule::NAME . ListBlockRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(ListBlockRule::NAME . ListBlockRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(ListBlockRule::NAME . '_LEVEL_OPEN', 'renderLevelOpen', $renderer);
        $this->registerTokenRenderer(ListBlockRule::NAME . '_LEVEL_CLOSE', 'renderLevelClose', $renderer);
        $this->registerTokenRenderer(ListBlockRule::NAME . '_ITEM_OPEN', 'renderItemOpen', $renderer);
        $this->registerTokenRenderer(ListBlockRule::NAME . '_ITEM_CLOSE', 'renderItemClose', $renderer);
        $this->registerTokenRenderer(ListBlockRule::NAME . '_ITEM_EOL', 'renderItemEol', $renderer);
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