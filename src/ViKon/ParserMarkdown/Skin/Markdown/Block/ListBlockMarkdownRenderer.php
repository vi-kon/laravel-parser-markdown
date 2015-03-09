<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Block;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Block\ListBlockRule;

/**
 * Class ListBlockMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Block
 */
class ListBlockMarkdownRenderer extends AbstractRenderer {
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
     * @return string
     */
    public function renderLevelOpen() {
        return '';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderItemOpen(Token $token) {
        if ($token->get('forceParagraph', false)) {
            return "\n\n*   ";
        }

        return "\n*   ";
    }

    /**
     * @return string
     */
    public function renderItemClose() {
        return '';
    }

    /**
     * @return string
     */
    public function renderLevelClose() {
        return '';
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
        return "\n    ";
    }
}