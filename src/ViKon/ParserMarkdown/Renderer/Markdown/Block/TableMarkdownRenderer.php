<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\TableRule;

/**
 * Class TableRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Block
 */
class TableMarkdownRenderer extends AbstractMarkdownRuleRenderer {
    /**
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(TableRule::NAME . TableRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . TableRule::CLOSE, [$this, 'renderClose'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_HEADER_OPEN', [$this, 'renderHeaderOpen'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_HEADER_CLOSE', [$this, 'renderHeaderClose'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_ROW_OPEN', [$this, 'renderRowOpen'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_ROW_CLOSE', [$this, 'renderRowClose'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_HEAD_COLL_OPEN', [$this, 'renderHeadCollOpen'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_HEAD_COLL_CLOSE', [$this, 'renderHeadCollClose'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_COLL_OPEN', [$this, 'renderCollOpen'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_COLL_CLOSE', [$this, 'renderCollClose'], $this->skin);
    }

    /**
     * @return string
     */
    public function renderOpen() {
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
    public function renderHeaderOpen() {
        return '';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderHeaderClose(Token $token) {
        $aligns = $token->get('align', null);

        $content = '|';

        foreach ($aligns as $align) {
            switch ($align) {
                case 'left':
                    $content .= ' :' . str_pad('', 9, '-') . ' |';
                    break;
                case 'right':
                    $content .= ' ' . str_pad('', 9, '-') . ': |';
                    break;
                case 'center':
                    $content .= ' :' . str_pad('', 8, '-') . ': |';
                    break;
                default:
                    $content .= ' ' . str_pad('', 10, '-') . ' |';
                    break;
            }
        }

        return $content . "\n";
    }

    /**
     * @return string
     */
    public function renderRowOpen() {
        return '|';
    }

    /**
     * @return string
     */
    public function renderRowClose() {
        return "\n";
    }

    /**
     * @return string
     */
    public function renderHeadCollOpen() {
        return ' ';
    }

    /**
     * @return string
     */
    public function renderHeadCollClose() {
        return ' |';
    }

    /**
     * @return string
     */
    public function renderCollOpen() {
        return ' ';
    }

    /**
     * @return string
     */
    public function renderCollClose() {
        return ' |';
    }
}