<?php

namespace ViKon\ParserMarkdown\Renderer\Bootstrap;

use ViKon\Parser\Renderer\AbstractRuleRenderer;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class AbstractBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Bootstrap
 */
abstract class AbstractBootstrapRuleRenderer extends AbstractRuleRenderer {
    /**
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct($set, 'bootstrap');
    }
}