<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap\single;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\single\ImageInline as ImageInlineRule;
use ViKon\ParserMarkdown\rule\single\ImageReference as ImageReferenceRule;
use ViKon\ParserMarkdown\rule\single\Reference as ReferenceRule;

/**
 * Class Image
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap\single
 */
class Image extends AbstractBootstrapRuleRender {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(ImageInlineRule::NAME, [$this, 'renderImage'], $this->skin);
        $renderer->setTokenRenderer(ImageReferenceRule::NAME, [$this, 'renderImageReference'], $this->skin);
    }

    public function renderImage(Token $token) {
        $title = $token->get('title', null) === null
            ? ''
            : ' title="' . $token->get('title') . '"';

        return '<img src="' . $token->get('url') . '"' . $title . ' alt="' . $token->get('alt') . '" />';
    }

    public function renderImageReference(Token $token, TokenList $tokenList) {
        $reference = $token->get('reference');
        if ($reference instanceof Token) {
            $referenceToken = $reference;
        } else {
            if (trim($reference) === '') {
                $reference = strtolower(trim($token->get('label')));
            }

            $tokens = $tokenList->getTokensByCallback(function (Token $token) use ($reference) {
                return $token->getName() === ReferenceRule::NAME && $token->get('reference', null) === $reference;
            });

            if (($referenceToken = reset($tokens)) === false) {
                return $token->get('match', '');
            }

            $referenceToken->set('used', true);
        }

        $title = $referenceToken->get('title', null) === null
            ? ''
            : ' title="' . $referenceToken->get('title') . '"';

        return '<img src="' . $referenceToken->get('url') . '"' . $title . ' alt="' . $token->get('alt') . '" />';
    }
}