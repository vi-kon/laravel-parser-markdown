<?php

namespace ViKon\ParserMarkdown;

use ViKon\Parser\Rule\AbstractRuleSet;
use ViKon\ParserMarkdown\Rule\BaseRule;
use ViKon\ParserMarkdown\Rule\Block\CodeBlockRule;
use ViKon\ParserMarkdown\Rule\Block\FencedCodeBlockRule;
use ViKon\ParserMarkdown\Rule\Block\ListBlockRule;
use ViKon\ParserMarkdown\Rule\Block\TableRule;
use ViKon\ParserMarkdown\Rule\Format\CodeAltRule;
use ViKon\ParserMarkdown\Rule\Format\CodeRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicAltRule;
use ViKon\ParserMarkdown\Rule\Format\ItalicRule;
use ViKon\ParserMarkdown\Rule\Format\MathRule;
use ViKon\ParserMarkdown\Rule\Format\StrikethroughRule;
use ViKon\ParserMarkdown\Rule\Format\StrongAltRule;
use ViKon\ParserMarkdown\Rule\Format\StrongRule;
use ViKon\ParserMarkdown\Rule\PRule;
use ViKon\ParserMarkdown\Rule\Single\EolRule;
use ViKon\ParserMarkdown\Rule\Single\EscapeRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderAtxRule;
use ViKon\ParserMarkdown\Rule\Single\HeaderSetextRule;
use ViKon\ParserMarkdown\Rule\Single\ImageInlineRule;
use ViKon\ParserMarkdown\Rule\Single\ImageReferenceRule;
use ViKon\ParserMarkdown\Rule\Single\LinkAutoRule;
use ViKon\ParserMarkdown\Rule\Single\LinkInlineRule;
use ViKon\ParserMarkdown\Rule\Single\LinkReferenceRule;
use ViKon\ParserMarkdown\Rule\Single\ReferenceRule;

/**
 * Class MarkdownRuleSet
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown
 */
class MarkdownRuleSet extends AbstractRuleSet {
    use ConfigTrait;

    /**
     *
     */
    public function __construct() {
        \Event::listen('vikon.parser.before.parse', [$this, 'normalizeLineBreak']);

        // Base rule
        $this->setStartRule(new BaseRule(), self::CATEGORY_NONE);

        // ESCAPE
        $this->addRule(new EscapeRule(), self::CATEGORY_FORMAT);

        // HEADER
        $this->addRule(new HeaderAtxRule(), self::CATEGORY_SINGLE);
        $this->addRule(new HeaderSetextRule(), self::CATEGORY_SINGLE);

        // REFERENCE
        $this->addRule(new ReferenceRule(), self::CATEGORY_SINGLE);

        // URL
        $this->addRule(new LinkInlineRule(), self::CATEGORY_FORMAT);
        $this->addRule(new LinkReferenceRule(), self::CATEGORY_FORMAT);
        if ($this->isModeGfm()) {
            $this->addRule(new LinkAutoRule(), self::CATEGORY_FORMAT);
        }

        // IMAGE
        $this->addRule(new ImageInlineRule(), self::CATEGORY_FORMAT);
        $this->addRule(new ImageReferenceRule(), self::CATEGORY_FORMAT);

        // EMPHASIS / ITALIC
        $this->addRule(new ItalicRule(), self::CATEGORY_FORMAT);
        $this->addRule(new ItalicAltRule(), self::CATEGORY_FORMAT);

        // EMPHASIS / STRONG
        $this->addRule(new StrongRule(), self::CATEGORY_FORMAT);
        $this->addRule(new StrongAltRule(), self::CATEGORY_FORMAT);

        // EMPHASIS / STRIKETHROUGH
        if ($this->isModeGfm()) {
            $this->addRule(new StrikethroughRule(), self::CATEGORY_FORMAT);
        }

        // CODE
        $this->addRule(new CodeRule(), self::CATEGORY_FORMAT);
        $this->addRule(new CodeAltRule(), self::CATEGORY_FORMAT);

        // CODE BLOCK
        $this->addRule(new CodeBlockRule(), self::CATEGORY_BLOCK);

        // FENCED CODE BLOCK
        if ($this->isModeGfm()) {
            $this->addRule(new FencedCodeBlockRule(), self::CATEGORY_BLOCK);
        }

        // END OF LINE
        $this->addRule(new EolRule(), self::CATEGORY_SINGLE);

        // LIST RULE
        $this->addRule(new ListBlockRule(), self::CATEGORY_BLOCK);

        // PARAGRAPH RULE
        $this->addRule(new PRule([], [
            'LIST_BLOCK_LEVEL_OPEN',
            'LIST_BLOCK_LEVEL_CLOSE',
            'LIST_BLOCK_ITEM_OPEN',
            'LIST_BLOCK_ITEM_CLOSE',
        ]), self::CATEGORY_NONE);

        // TABLE
        if ($this->isModeGfm()) {
            $this->addRule(new TableRule(), self::CATEGORY_BLOCK);
        }

        // MATH
        $this->addRule(new MathRule(), self::CATEGORY_FORMAT);
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