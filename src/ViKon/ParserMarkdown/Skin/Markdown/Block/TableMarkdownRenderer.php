<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Block;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Block\TableRule;

/**
 * Class TableRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Block
 */
class TableMarkdownRenderer extends AbstractRenderer {
    /**
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(TableRule::NAME . TableRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(TableRule::NAME . TableRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(TableRule::NAME . '_HEADER_OPEN', 'renderHeaderOpen', $renderer);
        $this->registerTokenRenderer(TableRule::NAME . '_HEADER_CLOSE', 'renderHeaderClose', $renderer);
        $this->registerTokenRenderer(TableRule::NAME . '_ROW_OPEN', 'renderRowOpen', $renderer);
        $this->registerTokenRenderer(TableRule::NAME . '_ROW_CLOSE', 'renderRowClose', $renderer);
        $this->registerTokenRenderer(TableRule::NAME . '_HEAD_COLL_OPEN', 'renderHeadCollOpen', $renderer);
        $this->registerTokenRenderer(TableRule::NAME . '_HEAD_COLL_CLOSE', 'renderHeadCollClose', $renderer);
        $this->registerTokenRenderer(TableRule::NAME . '_COLL_OPEN', 'renderCollOpen', $renderer);
        $this->registerTokenRenderer(TableRule::NAME . '_COLL_CLOSE', 'renderCollClose', $renderer);
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

        return "\n" . $content;
    }

    /**
     * @return string
     */
    public function renderRowOpen() {
        return "\n|";
    }

    /**
     * @return string
     */
    public function renderRowClose() {
        return '';
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