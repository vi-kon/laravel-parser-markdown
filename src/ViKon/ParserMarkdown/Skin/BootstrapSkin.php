<?php

namespace ViKon\ParserMarkdown\Skin;

use ViKon\Parser\Renderer\AbstractSkin;
use ViKon\ParserMarkdown\ConfigTrait;
use ViKon\ParserMarkdown\Skin\Bootstrap\BaseBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Block\CodeBlockBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Block\FencedCodeBlockBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Block\ListBlockBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Block\TableBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Format\CodeBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Format\ItalicBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Format\MathBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Format\StrikethroughBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Format\StrongBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\PBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Single\BrBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Single\EolBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Single\EscapeBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Single\HeaderBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Single\ImageBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Single\LinkBootstrapRenderer;
use ViKon\ParserMarkdown\Skin\Bootstrap\Single\ReferenceBootstrapRenderer;

/**
 * Class BootstrapSkin
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown
 */
class BootstrapSkin extends AbstractSkin {
    use ConfigTrait;

    public function __construct() {
        parent::__construct('bootstrap');

        \Event::listen('vikon.parser.before.parse', [$this, 'normalizeLineBreak']);

        // Base rule
        $this->addRuleRenderer(new BaseBootstrapRenderer());

        // ESCAPE
        $this->addRuleRenderer(new EscapeBootstrapRenderer());

        // BR
        if (!$this->isModeGfm()) {
            $this->addRuleRenderer(new BrBootstrapRenderer());
        }

        // HEADER
        $this->addRuleRenderer(new HeaderBootstrapRenderer());

        // REFERENCE
        $this->addRuleRenderer(new ReferenceBootstrapRenderer());

        // URL
        $this->addRuleRenderer(new LinkBootstrapRenderer());

        // IMAGE
        $this->addRuleRenderer(new ImageBootstrapRenderer());

        // EMPHASIS / ITALIC
        $this->addRuleRenderer(new ItalicBootstrapRenderer());

        // EMPHASIS / STRONG
        $this->addRuleRenderer(new StrongBootstrapRenderer());

        // EMPHASIS / STRIKETHROUGH
        if ($this->isModeGfm()) {
            $this->addRuleRenderer(new StrikethroughBootstrapRenderer());
        }

        // CODE
        $this->addRuleRenderer(new CodeBootstrapRenderer());

        // CODE BLOCK
        $this->addRuleRenderer(new CodeBlockBootstrapRenderer());

        // FENCED CODE BLOCK
        if ($this->isModeGfm()) {
            $this->addRuleRenderer(new FencedCodeBlockBootstrapRenderer());
        }

        // END OF LINE
        $this->addRuleRenderer(new EolBootstrapRenderer());

        // LIST RULE
        $this->addRuleRenderer(new ListBlockBootstrapRenderer());

        // PARAGRAPH RULE
        $this->addRuleRenderer(new PBootstrapRenderer());

        // TABLE
        if ($this->isModeGfm()) {
            $this->addRuleRenderer(new TableBootstrapRenderer());
        }

        // MATH
        $this->addRuleRenderer(new MathBootstrapRenderer());
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