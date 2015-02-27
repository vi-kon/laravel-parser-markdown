<?php


namespace ViKon\ParserMarkdown\rule\block;

use ViKon\Parser\rule\AbstractRule;
use ViKon\Parser\TokenList;
use ViKon\ParserMarkdown\MarkdownSet;
use ViKon\ParserMarkdown\rule\single\Eol as EolRule;

class P extends AbstractRule {
    const NAME = 'p';

    public function __construct(MarkdownSet $set) {
        parent::__construct(self::NAME, 230, $set);
    }

    public function finalize(TokenList $tokenList) {
        $pOpened = false;
        $pOpenTokens = [];
        $pCloseTokens = [];
        $eolCount = 0;
        $blockRuleNames = $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_BLOCK);
        $singleRuleNames = $this->set->getRuleNamesByCategory(MarkdownSet::CATEGORY_SINGLE);

        foreach ($blockRuleNames as $blockRuleName) {
            $pOpenTokens[] = $blockRuleName . '_close';
            $pCloseTokens[] = $blockRuleName . '_open';
            $pCloseTokens[] = $blockRuleName . '_close';
        }
        $pCloseTokens[] = 'list_block_level_open';
        $pCloseTokens[] = 'list_block_level_close';
        $pCloseTokens[] = 'list_block_item_open';
        $pCloseTokens[] = 'list_block_item_close';

        for ($i = 0; $i < $tokenList->size(); $i++) {
            $token = $tokenList->getTokenAt($i);

            if ($token->getName() === EolRule::NAME) {
                $eolCount++;
                continue;
            } else {
                if ($eolCount > 1) {
                    if ($pOpened) {
                        $tokenList->insertTokenAt(self::NAME . '_close', $token->getPosition() - $eolCount, $i - $eolCount);
                        $i++;
                    }
                    $tokenList->insertTokenAt(self::NAME . '_open', $token->getPosition(), $i);
                    $pOpened = true;
                    $i++;
                } elseif (!$pOpened && $eolCount === 1) {
                    $tokenList->insertTokenAt(self::NAME . '_open', $token->getPosition(), $i);
                    $pOpened = true;
                    $i++;
                }
                $eolCount = 0;
            }

            if ($pOpened && in_array($token->getName(), $singleRuleNames)) {
                $tokenList->insertTokenAt(self::NAME . '_close', $token->getPosition(), $i);
                $pOpened = false;
                $i++;
            } elseif (!$pOpened && in_array($token->getName(), $pOpenTokens)) {
                ;
                $tokenList->insertTokenAt(self::NAME . '_open', $token->getPosition(), $i + 1);
                $pOpened = true;
                $i++;
            } elseif ($pOpened && in_array($token->getName(), $pCloseTokens)) {
                $tokenList->insertTokenAt(self::NAME . '_close', $token->getPosition(), $i);
                $pOpened = false;
                $i++;
            }
        }
        if ($pOpened) {
            $tokenList->insertTokenAt(self::NAME . '_close', $tokenList->last()
                ->getPosition(), $tokenList->size() - $eolCount);
        }

        for ($i = 0; $i < $tokenList->size() - 1; $i++) {
            if (
                $tokenList->getTokenAt($i)
                    ->getName() === self::NAME . '_open'
                &&
                $tokenList->getTokenAt($i + 1)
                    ->getName() === self::NAME . '_close'
            ) {
                $tokenList->removeTokenAt($i);
                $tokenList->removeTokenAt($i);
            }
        }
    }
}