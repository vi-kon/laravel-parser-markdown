<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown;

use ViKon\Parser\Renderer\AbstractRuleRenderer;
use ViKon\ParserMarkdown\MarkdownSet;

/**
 * Class AbstractMarkdownRuleRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown
 */
abstract class AbstractMarkdownRuleRenderer extends AbstractRuleRenderer {
    /**
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct($set, 'markdown');
    }
}