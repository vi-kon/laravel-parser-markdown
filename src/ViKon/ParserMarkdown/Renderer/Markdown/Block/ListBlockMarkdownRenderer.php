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
        return '';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderListBlockItemOpen(Token $token) {
        if ($token->get('forceParagraph', false)) {
            return "\n\n*   ";
        }

        return "\n*   ";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
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
        return '';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderListBlockLevelClose(Token $token) {
        return '';
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
        return "\n    ";
    }
}