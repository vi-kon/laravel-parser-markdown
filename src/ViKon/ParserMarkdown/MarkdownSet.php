<?php

namespace ViKon\ParserMarkdown;

use ViKon\Parser\AbstractSet;
use ViKon\ParserMarkdown\Renderer\Bootstrap\BaseBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Block\CodeBlockBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Block\FencedCodeBlockBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Block\ListBlockBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Block\TableBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Format\CodeBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Format\ItalicBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Format\StrikethroughBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Format\StrongBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\PBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\EolBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\HeaderBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\ImageBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\LinkBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Bootstrap\Single\ReferenceBootstrapRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\BaseMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Block\CodeBlockMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Block\FencedCodeBlockMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Block\ListBlockMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Block\TableMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Format\CodeMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Format\ItalicMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Format\StrikethroughMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Format\StrongMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\PMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\EolMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\HeaderMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\ImageMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\LinkMarkdownRenderer;
use ViKon\ParserMarkdown\Renderer\Markdown\Single\ReferenceMarkdownRenderer;
use ViKon\ParserMarkdown\Rule\BaseRule;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;
use ViKon\ParserMarkdown\Rule\Block\FencedCodeBlockRule;
use ViKon\ParserMarkdown\Rule\Block\ListBlockRule;
use ViKon\ParserMarkdown\Rule\Block\TableRule;
use ViKon\ParserMarkdown\Rule\Format\CodeAltRule;
use ViKon\ParserMarkdown\Rule\Format\CodeRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicAltRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicRule;
use ViKon\ParserMarkdown\Rule\Format\StrikethroughRule;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;
use ViKon\ParserMarkdown\Rule\PRule;
use ViKon\ParserMarkdown\Rule\Single\EolRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderAtxRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderSetextRule;
use ViKon\ParserMarkdown\Rule\Single\ImageInlineRule;
use ViKon\ParserMarkdown\Rule\Single\ImageReferenceRule;
use ViKon\ParserMarkdown\Rule\Single\LinkAutoRule;
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
        $this->addRuleRenderer(new BaseBootstrapRenderer($this));
        $this->addRuleRenderer(new BaseMarkdownRenderer($this));

        // HEADER
        $this->addRule(new HeaderAtxRule($this), self::CATEGORY_SINGLE);
        $this->addRule(new HeaderSetextRule($this), self::CATEGORY_SINGLE);
        $this->addRuleRenderer(new HeaderBootstrapRenderer($this));
        $this->addRuleRenderer(new HeaderMarkdownRenderer($this));

        // REFERENCE
        $this->addRule(new ReferenceRule($this), self::CATEGORY_SINGLE);
        $this->addRuleRenderer(new ReferenceBootstrapRenderer($this));
        $this->addRuleRenderer(new ReferenceMarkdownRenderer($this));

        // URL
        $this->addRule(new LinkInlineRule($this), self::CATEGORY_FORMAT);
        $this->addRule(new LinkReferenceRule($this), self::CATEGORY_FORMAT);
        if ($this->isModeGfm()) {
            $this->addRule(new LinkAutoRule($this), self::CATEGORY_FORMAT);
        }
        $this->addRuleRenderer(new LinkBootstrapRenderer($this));
        $this->addRuleRenderer(new LinkMarkdownRenderer($this));

        // IMAGE
        $this->addRule(new ImageInlineRule($this), self::CATEGORY_SINGLE);
        $this->addRule(new ImageReferenceRule($this), self::CATEGORY_SINGLE);
        $this->addRuleRenderer(new ImageBootstrapRenderer($this));
        $this->addRuleRenderer(new ImageMarkdownRenderer($this));

        // EMPHASIS / ITALIC
        $this->addRule(new ItalicRule($this), self::CATEGORY_FORMAT);
        $this->addRule(new ItalicAltRule($this), self::CATEGORY_FORMAT);
        $this->addRuleRenderer(new ItalicBootstrapRenderer($this));
        $this->addRuleRenderer(new ItalicMarkdownRenderer($this));

        // EMPHASIS / STRONG
        $this->addRule(new StrongRule($this), self::CATEGORY_FORMAT);
        $this->addRule(new StrongAltRule($this), self::CATEGORY_FORMAT);
        $this->addRuleRenderer(new StrongBootstrapRenderer($this));
        $this->addRuleRenderer(new StrongMarkdownRenderer($this));

        // EMPHASIS / STRIKETHROUGH
        if ($this->isModeGfm()) {
            $this->addRule(new StrikethroughRule($this), self::CATEGORY_FORMAT);
            $this->addRuleRenderer(new StrikethroughBootstrapRenderer($this));
            $this->addRuleRenderer(new StrikethroughMarkdownRenderer($this));
        }

        // CODE
        $this->addRule(new CodeRule($this), self::CATEGORY_FORMAT);
        $this->addRule(new CodeAltRule($this), self::CATEGORY_FORMAT);
        $this->addRuleRenderer(new CodeBootstrapRenderer($this));
        $this->addRuleRenderer(new CodeMarkdownRenderer($this));

        // CODE BLOCK
        $this->addRule(new CodeBlockRule($this), self::CATEGORY_BLOCK);
        $this->addRuleRenderer(new CodeBlockBootstrapRenderer($this));
        $this->addRuleRenderer(new CodeBlockMarkdownRenderer($this));

        // FENCED CODE BLOCK
        if ($this->isModeGfm()) {
            $this->addRule(new FencedCodeBlockRule($this), self::CATEGORY_BLOCK);
            $this->addRuleRenderer(new FencedCodeBlockBootstrapRenderer($this));
            $this->addRuleRenderer(new FencedCodeBlockMarkdownRenderer($this));
        }

        // END OF LINE
        $this->addRule(new EolRule($this), self::CATEGORY_SINGLE);
        $this->addRuleRenderer(new EolBootstrapRenderer($this));
        $this->addRuleRenderer(new EolMarkdownRenderer($this));

        // LIST RULE
        $this->addRule(new ListBlockRule($this), self::CATEGORY_BLOCK);
        $this->addRuleRenderer(new ListBlockBootstrapRenderer($this));
        $this->addRuleRenderer(new ListBlockMarkdownRenderer($this));

        // PARAGRAPH RULE
        $this->addRule(new PRule($this, [], [
            'LIST_BLOCK_LEVEL_OPEN',
            'LIST_BLOCK_LEVEL_CLOSE',
            'LIST_BLOCK_ITEM_OPEN',
            'LIST_BLOCK_ITEM_CLOSE',
        ]), self::CATEGORY_NONE);
        $this->addRuleRenderer(new PBootstrapRenderer($this));
        $this->addRuleRenderer(new PMarkdownRenderer($this));

        // TABLE
        if ($this->isModeGfm()) {
            $this->addRule(new TableRule($this), self::CATEGORY_BLOCK);
            $this->addRuleRenderer(new TableBootstrapRenderer($this));
            $this->addRuleRenderer(new TableMarkdownRenderer($this));
        }
    }

    /**
     * Change windows type line break to linux type
     *
     * @param string $text
     */
    public function normalizeLineBreak(&$text) {
        $text = str_replace("\r\n", "\n", $text);
    }

    /**
     * Is mode Github Flavored Markdown
     *
     * @return bool
     */
    public function isModeGfm() {
        return strtolower(config('parser-markdown.mode', 'gfm')) === 'gfm';
    }
}