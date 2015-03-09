<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Single\ImageInlineRule;
use ViKon\ParserMarkdown\Rule\Single\ImageReferenceRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class ImageMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Single
 */
class ImageMarkdownRenderer extends AbstractRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(ImageInlineRule::NAME, 'renderInline', $renderer);
        $this->registerTokenRenderer(ImageReferenceRule::NAME, 'renderReference', $renderer);
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