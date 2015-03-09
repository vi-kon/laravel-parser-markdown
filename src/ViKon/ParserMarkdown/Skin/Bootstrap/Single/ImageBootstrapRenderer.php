<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Single;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\Rule\Single\ImageInlineRule;
use ViKon\ParserMarkdown\Rule\Single\ImageReferenceRule;
use ViKon\ParserMarkdown\Rule\Single\ReferenceRule;

/**
 * Class ImageBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap\Single
 */
class ImageBootstrapRenderer extends AbstractRenderer {

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
            return "<img src=\"$url\" alt=\"$alt\" />";
        }

        return "<img src=\"$url\" alt=\"$alt\" title=\"$title\" />";
    }

    /**
     * @param \ViKon\Parser\Token     $token
     * @param \ViKon\Parser\TokenList $tokenList
     *
     * @return string
     * @throws \ViKon\Parser\LexerException
     */
    public function renderReference(Token $token, TokenList $tokenList) {
        $reference = $token->get('reference');
        $alt = $token->get('alt');

        if ($reference instanceof Token) {
            $referenceToken = $reference;
        } else {
            $tokens = $tokenList->getTokensByCallback(function (Token $token) use ($reference) {
                return $token->getName() === ReferenceRule::NAME && $token->get('reference', null) === $reference;
            });
            // Get first token (if not found return full match)
            if (($referenceToken = reset($tokens)) === false) {
                return $token->get('match', '');
            }
            $referenceToken->set('used', true);
        }
        $url = $referenceToken->get('url');
        $title = $referenceToken->get('title', '');

        if (empty($title)) {
            return "<img alt=\"$alt\" src=\"$url\"/>";
        }

        return "<img alt=\"$alt\" src=\"$url\" title=\"$title\" />";
    }
}