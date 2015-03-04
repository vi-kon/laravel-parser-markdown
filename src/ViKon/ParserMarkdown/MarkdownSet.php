<?php

namespace ViKon\ParserMarkdown;

use ViKon\Parser\AbstractSet;
use ViKon\ParserMarkdown\Renderer\Bootstrap\BaseBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Format\ItalicBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\HeaderBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\BaseMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Format\ItalicMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\HeaderMarkdownRenderer;
use ViKon\ParserMarkdown\Rule\BaseRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicAltRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderAtxRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderSetextRule;

/**
 * Class MarkdownSet
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown
 */
class MarkdownSet extends AbstractSet {
    public function __construct() {
        \Event::listen('vikon.parser.before.parse', [$this, 'normalizeLineBreak']);

        // Base rule
        $this->setStartRule(new BaseRule($this), self::CATEGORY_NONE);
        $this->addRuleRender(new BaseBootstrapRenderer($this));
        $this->addRuleRender(new BaseMarkdownRenderer($this));

        // Single rules

        // HEADER
        $this->addRule(new HeaderAtxRule($this), self::CATEGORY_SINGLE);
        $this->addRule(new HeaderSetextRule($this), self::CATEGORY_SINGLE);
        $this->addRuleRender(new HeaderBootstrapRenderer($this));
        $this->addRuleRender(new HeaderMarkdownRenderer($this));

        // EMPHASIS / ITALIC
        $this->addRule(new ItalicRule($this), self::CATEGORY_FORMAT);
        $this->addRule(new ItalicAltRule($this), self::CATEGORY_FORMAT);
        $this->addRuleRender(new ItalicBootstrapRenderer($this));
        $this->addRuleRender(new ItalicMarkdownRenderer($this));
    }

    /**
     * Change windows type line break to linux type
     *
     * @param string $text
     */
    public function normalizeLineBreak(&$text) {
        $text = str_replace("\r\n", "\n", $text);
    }
}