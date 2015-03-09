<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap\Block;

use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\AbstractBootstrapRuleRenderer;
use ViKon\ParserMarkdown\Rule\Block\TableRule;

/**
 * Class TableRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap\Block
 */
class TableBootstrapRenderer extends AbstractBootstrapRuleRenderer {
    /**
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(TableRule::NAME . TableRule::OPEN, [$this, 'renderOpen'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . TableRule::CLOSE, [$this, 'renderClose'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_ROW_OPEN', [$this, 'renderRowOpen'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_ROW_CLOSE', [$this, 'renderRowClose'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_HEADER_OPEN', [$this, 'renderHeaderOpen'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_HEADER_CLOSE', [$this, 'renderHeaderClose'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_COLL_OPEN', [$this, 'renderCollOpen'], $this->skin);
        $renderer->registerTokenRenderer(TableRule::NAME . '_COLL_CLOSE', [$this, 'renderCollClose'], $this->skin);
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
    public function renderHeaderOpen() {
        return '<th>';
    }

    /**
     * @return string
     */
    public function renderHeaderClose() {
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