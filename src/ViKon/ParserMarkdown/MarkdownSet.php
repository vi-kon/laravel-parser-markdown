<?php

namespace ViKon\ParserMarkdown;

use ViKon\Parser\AbstractSet;
use ViKon\ParserMarkdown\renderer\bootstrap\Base as BaseBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\block\CodeBlock as CodeBlockBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\block\ListBlock as ListBlockBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\block\P as PBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\format\Code as CodeBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\format\Italic as ItalicBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\format\Math as MathBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\format\Strong as StrongBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\single\Br as BrBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\single\Email as EmailBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\single\Eol as EolBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\single\Escape as EscapeBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\single\Header as HeaderBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\single\Hr as HrBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\single\Image as ImageBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\single\Link as LinkBootstrapRenderer;
use ViKon\ParserMarkdown\renderer\bootstrap\single\Reference as ReferenceBootstrapRenderer;
use ViKon\ParserMarkdown\rule\Base;
use ViKon\ParserMarkdown\rule\block\CodeBlock;
use ViKon\ParserMarkdown\rule\block\ListBlock;
use ViKon\ParserMarkdown\rule\block\P;
use ViKon\ParserMarkdown\rule\format\Code;
use ViKon\ParserMarkdown\rule\format\CodeAlt;
use ViKon\ParserMarkdown\rule\format\Italic;
use ViKon\ParserMarkdown\rule\format\ItalicAlt;
use ViKon\ParserMarkdown\rule\format\Math;
use ViKon\ParserMarkdown\rule\format\Strong;
use ViKon\ParserMarkdown\rule\format\StrongAlt;
use ViKon\ParserMarkdown\rule\single\Br;
use ViKon\ParserMarkdown\rule\single\EmailAutomatic;
use ViKon\ParserMarkdown\rule\single\Eol;
use ViKon\ParserMarkdown\rule\single\Escape;
use ViKon\ParserMarkdown\rule\single\HeaderAtx;
use ViKon\ParserMarkdown\rule\single\HeaderSetext;
use ViKon\ParserMarkdown\rule\single\Hr;
use ViKon\ParserMarkdown\rule\single\ImageInline;
use ViKon\ParserMarkdown\rule\single\ImageReference;
use ViKon\ParserMarkdown\rule\single\LinkAutomatic;
use ViKon\ParserMarkdown\rule\single\LinkInline;
use ViKon\ParserMarkdown\rule\single\LinkReference;
use ViKon\ParserMarkdown\rule\single\Reference;

class MarkdownSet extends AbstractSet
{
    public function __construct()
    {
        \Event::listen('vikon.parser.before.parse', [$this, 'normalizeLineBreak']);

        $this->setStartRule(new Base($this), self::CATEGORY_NONE);

        $this->addRule(new CodeBlock($this), self::CATEGORY_BLOCK);
        $this->addRule(new ListBlock($this), self::CATEGORY_BLOCK);
        $this->addRule(new P($this), self::CATEGORY_NONE);

        $this->addRule(new Code($this), self::CATEGORY_FORMAT);
        $this->addRule(new CodeAlt($this), self::CATEGORY_FORMAT);
        $this->addRule(new Strong($this), self::CATEGORY_FORMAT);
        $this->addRule(new StrongAlt($this), self::CATEGORY_FORMAT);
        $this->addRule(new Italic($this), self::CATEGORY_FORMAT);
        $this->addRule(new ItalicAlt($this), self::CATEGORY_FORMAT);

        $this->addRule(new Br($this), self::CATEGORY_SINGLE);
        $this->addRule(new EmailAutomatic($this), self::CATEGORY_SINGLE);
        $this->addRule(new Eol($this), self::CATEGORY_SINGLE);
        $this->addRule(new HeaderAtx($this), self::CATEGORY_SINGLE);
        $this->addRule(new HeaderSetext($this), self::CATEGORY_SINGLE);
        $this->addRule(new Hr($this), self::CATEGORY_SINGLE);
        $this->addRule(new Reference($this), self::CATEGORY_SINGLE);

        $this->addRule(new Escape($this), self::CATEGORY_FORMAT);
        $this->addRule(new ImageInline($this), self::CATEGORY_FORMAT);
        $this->addRule(new ImageReference($this), self::CATEGORY_FORMAT);
        $this->addRule(new LinkAutomatic($this), self::CATEGORY_FORMAT);
        $this->addRule(new LinkInline($this), self::CATEGORY_FORMAT);
        $this->addRule(new LinkReference($this), self::CATEGORY_FORMAT);

        $this->addRuleRender(new BaseBootstrapRenderer($this));

        $this->addRuleRender(new CodeBlockBootstrapRenderer($this));
        $this->addRuleRender(new ListBlockBootstrapRenderer($this));
        $this->addRuleRender(new PBootstrapRenderer($this));

        $this->addRuleRender(new CodeBootstrapRenderer($this));
        $this->addRuleRender(new ItalicBootstrapRenderer($this));
        $this->addRuleRender(new StrongBootstrapRenderer($this));

        $this->addRuleRender(new BrBootstrapRenderer($this));
        $this->addRuleRender(new EmailBootstrapRenderer($this));
        $this->addRuleRender(new EolBootstrapRenderer($this));
        $this->addRuleRender(new EscapeBootstrapRenderer($this));
        $this->addRuleRender(new HeaderBootstrapRenderer($this));
        $this->addRuleRender(new HrBootstrapRenderer($this));
        $this->addRuleRender(new ImageBootstrapRenderer($this));
        $this->addRuleRender(new LinkBootstrapRenderer($this));
        $this->addRuleRender(new ReferenceBootstrapRenderer($this));

        if (config('parser-markdown::extra-rules'))
        {
            $this->addRule(new Math($this), self::CATEGORY_FORMAT);
            $this->addRuleRender(new MathBootstrapRenderer($this));
        }
    }

    public function normalizeLineBreak(&$text)
    {
        $text = str_replace("\r\n", "\n", $text);
    }
}