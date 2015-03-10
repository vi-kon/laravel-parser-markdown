<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Rule\Block\TableRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class TableRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap\Block
 */
class TableBootstrapRenderer extends AbstractRenderer {
    /**
     * Register renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
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
        return '<table class="table">';
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '</table>';
    }

    /**
     * @return string
     */
    public function renderHeaderOpen() {
        return '<thead>';
    }

    /**
     * @return string
     */
    public function renderHeaderClose() {
        return '</thead>';
    }

    /**
     * @return string
     */
    public function renderRowOpen() {
        return '<tr>';
    }

    /**
     * @return string
     */
    public function renderRowClose() {
        return '</tr>';
    }

    /**
     * @return string
     */
    public function renderHeadCollOpen() {
        return '<th>';
    }

    /**
     * @return string
     */
    public function renderHeadCollClose() {
        return '</th>';
    }

    /**
     * @return string
     */
    public function renderCollOpen() {
        return '<td>';
    }

    /**
     * @return string
     */
    public function renderCollClose() {
        return '</td>';
    }
}