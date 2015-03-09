<?php

namespace ViKon\ParserMarkdown\Renderer;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\ParserMarkdown\Rule\PRule;

/**
 * Class AbstractPMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer
 */
abstract class AbstractPMarkdownRenderer extends AbstractRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(PRule::NAME . AbstractBlockRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(PRule::NAME . AbstractBlockRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(PRule::NAME . '_EOL', 'renderEol', $renderer);
    }

    /**
     * @return string
     */
    abstract public function renderOpen();


    /**
     * @return string
     */
    abstract public function renderClose();

    /**
     * @return string
     */
    abstract public function renderEol();
}