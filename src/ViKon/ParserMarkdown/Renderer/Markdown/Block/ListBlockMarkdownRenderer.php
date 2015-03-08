<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\ListBlockRule;

/**
 * Class ListBlockMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Block
 */
class ListBlockMarkdownRenderer extends AbstractMarkdownRuleRenderer {
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