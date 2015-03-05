<?php

namespace ViKon\ParserMarkdown;

use ViKon\Parser\AbstractSet;
use ViKon\ParserMarkdown\Renderer\Bootstrap\BaseBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Block\CodeBlockBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Format\CodeBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Format\ItalicBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Format\StrikethroughBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Format\StrongBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\HeaderBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\ImageBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\LinkBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\ReferenceBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\BaseMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Block\CodeBlockMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Format\CodeMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Format\ItalicMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Format\StrikethroughMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Format\StrongMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\HeaderMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\ImageMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\LinkMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\ReferenceMarkdownRenderer;
use ViKon\ParserMarkdown\Rule\BaseRule;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockAltRule;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;
use ViKon\ParserMarkdown\Rule\Format\CodeAltRule;
use ViKon\ParserMarkdown\Rule\Format\CodeRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicAltRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicRule;
use ViKon\ParserMarkdown\Rule\Format\StrikethroughRule;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderAtxRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderSetextRule;
use ViKon\ParserMarkdown\Rule\Single\ImageInlineRule;
use ViKon\ParserMarkdown\Rule\Single\ImageReferenceRule;
use ViKon\ParserMarkdown\Rule\Single\LinkAutomaticRule;
use ViKon\ParserMarkdown\Rule\Single\LinkInlineRule;
use ViKon\ParserMarkdown\Rule\Single\LinkReferenceRule;
use ViKon\ParserMarkdown\Rule\Single\ReferenceRule;

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

        // HEADER
        $this->addRule(new HeaderAtxRule($this), self::CATEGORY_SINGLE);
        $this->addRule(new HeaderSetextRule($this), self::CATEGORY_SINGLE);
        $this->addRuleRender(new HeaderBootstrapRenderer($this));
        $this->addRuleRender(new HeaderMarkdownRenderer($this));

        // REFERENCE
        $this->addRule(new ReferenceRule($this), self::CATEGORY_SINGLE);
        $this->addRuleRender(new ReferenceBootstrapRenderer($this));
        $this->addRuleRender(new ReferenceMarkdownRenderer($this));

        // URL
        $this->addRule(new LinkInlineRule($this), self::CATEGORY_SINGLE);
        $this->addRule(new LinkReferenceRule($this), self::CATEGORY_SINGLE);
        $this->addRuleRender(new LinkBootstrapRenderer($this));
        $this->addRuleRender(new LinkMarkdownRenderer($this));

        // IMAGE
        $this->addRule(new ImageInlineRule($this), self::CATEGORY_SINGLE);
        $this->addRule(new ImageReferenceRule($this), self::CATEGORY_SINGLE);
        $this->addRuleRender(new ImageBootstrapRenderer($this), self::CATEGORY_SINGLE);
        $this->addRuleRender(new ImageMarkdownRenderer($this), self::CATEGORY_SINGLE);

        // EMPHASIS / ITALIC
        $this->addRule(new ItalicRule($this), self::CATEGORY_FORMAT);
        $this->addRule(new ItalicAltRule($this), self::CATEGORY_FORMAT);
        $this->addRuleRender(new ItalicBootstrapRenderer($this));
        $this->addRuleRender(new ItalicMarkdownRenderer($this));

        // EMPHASIS / STRONG
        $this->addRule(new StrongRule($this), self::CATEGORY_FORMAT);
        $this->addRule(new StrongAltRule($this), self::CATEGORY_FORMAT);
        $this->addRuleRender(new StrongBootstrapRenderer($this));
        $this->addRuleRender(new StrongMarkdownRenderer($this));

        // EMPHASIS / STRIKETHROUGH
        $this->addRule(new StrikethroughRule($this), self::CATEGORY_FORMAT);
        $this->addRuleRender(new StrikethroughBootstrapRenderer($this));
        $this->addRuleRender(new StrikethroughMarkdownRenderer($this));

        // CODE
        $this->addRule(new CodeRule($this), self::CATEGORY_FORMAT);
        $this->addRule(new CodeAltRule($this), self::CATEGORY_FORMAT);
        $this->addRuleRender(new CodeBootstrapRenderer($this));
        $this->addRuleRender(new CodeMarkdownRenderer($this));

        // CODE BLOCK
        $this->addRule(new CodeBlockRule($this), self::CATEGORY_BLOCK);
        $this->addRule(new CodeBlockAltRule($this), self::CATEGORY_BLOCK);
        $this->addRuleRender(new CodeBlockBootstrapRenderer($this));
        $this->addRuleRender(new CodeBlockMarkdownRenderer($this));

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