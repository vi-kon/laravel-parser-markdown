<?php

namespace ViKon\ParserMarkdown\Renderer\Markdown\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Renderer\Markdown\AbstractMarkdownRuleRenderer;
use ViKon\ParserMarkdown\Rule\Single\ImageInlineRule;
use ViKon\ParserMarkdown\Rule\Single\ImageReferenceRule;

/**
 * Class ImageMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Renderer\Markdown\Single
 */
class ImageMarkdownRenderer extends AbstractMarkdownRuleRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $renderer->registerTokenRenderer(ImageInlineRule::NAME, [$this, 'renderInline'], $this->skin);
        $renderer->registerTokenRenderer(ImageReferenceRule::NAME, [$this, 'renderReference'], $this->skin);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderInline(Token $token) {
        $alt = $token->get('alt', '');
        $url = $token->get('url', '');
        $title = $token->get('title', '');

        if (empty($title)) {
            return "![$alt]($url)";
        }

        return "![$alt]($url \"$title\")";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     * @throws \ViKon\Parser\LexerException
     */
    public function renderReference(Token $token) {
        return $token->get('match', '');
    }
}