<?php

namespace ViKon\ParserMarkdown\Rule\Single;


use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\Token;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;

class ImageReferenceRule extends AbstractSingleRule {
    const NAME = 'IMAGE_REFERENCE';
    const ORDER = 180;

    /**
     * Match
     *
     * ![alt text][image]
     *
     * @param \ViKon\ParserMarkdown\MarkdownSet $set
     */
    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, self::ORDER, '!\\[(?:\\\\.|[^]\\\\])+\\][\\t ]*\\[(?:\\\\.|[^]\\\\])*\\]', $set);
    }

    /**
     * Add token with data:
     * * match     - whole matched content
     * * alt       - alt content for image
     * * reference - reference name or object
     *
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/!\\[((?:\\\\.|[^]\\\\])+)\\][\\t ]*\\[((?:\\\\.|[^]\\\\])*)\\]/', $content, $matches);
        $reference = strtolower(empty($matches[2]) ? $matches[1] : $matches[2]);

        $referenceTokens = $tokenList->getTokensByCallback(function (Token $token) use ($reference) {
            return $token->getName() === ReferenceRule::NAME && $token->get('reference', null) === $reference;
        });

        if (($referenceToken = reset($referenceTokens)) !== false) {
            $referenceToken->set('used', true);
            $reference = $referenceToken;
        }

        $tokenList->addToken($this->name, $position)
            ->set('match', $content)
            ->set('alt', $matches[1])
            ->set('reference', $reference);
    }
}