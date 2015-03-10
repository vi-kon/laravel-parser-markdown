<?php

namespace ViKon\ParserMarkdown\Rule\Single;

use ViKon\Parser\Rule\AbstractSingleRule;
use ViKon\Parser\Token;
use ViKon\Parser\TokenList;

/**
 * Class LinkReference
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Rule\Single
 */
class LinkReferenceRule extends AbstractSingleRule {
    const NAME = 'LINK_REFERENCE';
    const ORDER = 160;

    /**
     * Match
     *
     * [I'm a reference-style link][Arbitrary case-insensitive reference text]
     *
     * [You can use numbers for reference-style link definitions][1]
     *
     * [link text itself]
     */
    public function __construct() {
        parent::__construct(self::NAME, self::ORDER, '\\[(?:\\\\.|[^]\\\\])+\\](?: ?\\[(?:\\\\.|[^]\\\\])+\\])?');
    }

    /**
     * Add token with data
     * * match     - whole matched content
     * * label     - link content
     * * reference - reference name or object
     *
     * @param string                  $content
     * @param int                     $position
     * @param \ViKon\Parser\TokenList $tokenList
     */
    protected function handleSingleState($content, $position, TokenList $tokenList) {
        preg_match('/\\[((?:\\\\.|[^]\\\\])+)\\](?: ?\\[((?:\\\\.|[^]\\\\])+)\\])?/', $content, $matches);

        $reference = strtolower(empty($matches[2]) ? $matches[1] : $matches[2]);

        // List all reference token which match url reference part
        $referenceTokens = $tokenList->getTokensByCallback(function (Token $token) use ($reference) {
            return $token->getName() === ReferenceRule::NAME && $token->get('reference', null) === $reference;
        });

        // Get first matching reference token
        if (($referenceToken = reset($referenceTokens)) !== false) {
            $referenceToken->set('used', true);
            $reference = $referenceToken;
        }

        $tokenList->addToken($this->name, $position)
            ->set('match', $content)
            ->set('label', $matches[1])
            ->set('reference', $reference);
    }
}