<?php

namespace ViKon\ParserMarkdown\Skin\Markdown\Single;

use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Single\LinkAutoRule;
use ViKon\ParserMarkdown\Rule\Single\LinkInlineRule;
use ViKon\ParserMarkdown\Rule\Single\LinkReferenceRule;
use ViKon\Parser\Renderer\AbstractRenderer;

/**
 * Class LinkMarkdownRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Markdown\Single
 */
class LinkMarkdownRenderer extends AbstractRenderer {

    /**
     * Register Renderer
     *
     * @param \ViKon\Parser\Renderer\Renderer $renderer
     *
     * @return mixed
     */
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(LinkInlineRule::NAME, 'renderInline', $renderer);
        $this->registerTokenRenderer(LinkReferenceRule::NAME, 'renderReference', $renderer);
        $this->registerTokenRenderer(LinkAutoRule::NAME, 'renderAuto', $renderer);
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderAuto(Token $token) {
        return $token->get('url', '');
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderInline(Token $token) {
        $label = $token->get('label', '');
        $url = $token->get('url', '');
        $title = $token->get('title', '');

        if (empty($title)) {
            return "[$label]($url)";
        }

        return "[$label]($url \"$title\")";
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderReference(Token $token) {
        return $token->get('match', '');
    }
}