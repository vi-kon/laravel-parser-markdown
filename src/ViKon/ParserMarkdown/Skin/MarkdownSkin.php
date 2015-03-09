<?php

namespace ViKon\ParserMarkdown\Skin;

use ViKon\Parser\Renderer\AbstractSkin;
use ViKon\ParserMarkdown\Skin\Markdown\BaseMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Block\CodeBlockMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Block\FencedCodeBlockMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Block\ListBlockMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Block\TableMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Format\CodeMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Format\ItalicMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Format\MathMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Format\StrikethroughMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Format\StrongMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\PMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Single\BrMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Single\EolMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Single\EscapeMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Single\HeaderMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Single\ImageMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Single\LinkMarkdownRenderer;
use ViKon\ParserMarkdown\Skin\Markdown\Single\ReferenceMarkdownRenderer;

/**
 * Class MarkdownSkin
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown
 */
class MarkdownSkin extends AbstractSkin {

    public function __construct() {
        parent::__construct('markdown');

        \Event::listen('vikon.parser.before.parse', [$this, 'normalizeLineBreak']);

        // Base rule
        $this->addRuleRenderer(new BaseMarkdownRenderer());

        // ESCAPE
        $this->addRuleRenderer(new EscapeMarkdownRenderer());

        // BR
        if (!$this->isModeGfm()) {
            $this->addRuleRenderer(new BrMarkdownRenderer());
        }

        // HEADER
        $this->addRuleRenderer(new HeaderMarkdownRenderer());

        // REFERENCE
        $this->addRuleRenderer(new ReferenceMarkdownRenderer());

        // URL
        $this->addRuleRenderer(new LinkMarkdownRenderer());

        // IMAGE
        $this->addRuleRenderer(new ImageMarkdownRenderer());

        // EMPHASIS / ITALIC
        $this->addRuleRenderer(new ItalicMarkdownRenderer());

        // EMPHASIS / STRONG
        $this->addRuleRenderer(new StrongMarkdownRenderer());

        // EMPHASIS / STRIKETHROUGH
        if ($this->isModeGfm()) {
            $this->addRuleRenderer(new StrikethroughMarkdownRenderer());
        }

        // CODE
        $this->addRuleRenderer(new CodeMarkdownRenderer());

        // CODE BLOCK
        $this->addRuleRenderer(new CodeBlockMarkdownRenderer());

        // FENCED CODE BLOCK
        if ($this->isModeGfm()) {
            $this->addRuleRenderer(new FencedCodeBlockMarkdownRenderer());
        }

        // END OF LINE
        $this->addRuleRenderer(new EolMarkdownRenderer());

        // LIST RULE
        $this->addRuleRenderer(new ListBlockMarkdownRenderer());

        // PARAGRAPH RULE
        $this->addRuleRenderer(new PMarkdownRenderer());

        // TABLE
        if ($this->isModeGfm()) {
            $this->addRuleRenderer(new TableMarkdownRenderer());
        }

        // MATH
        $this->addRuleRenderer(new MathMarkdownRenderer());
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