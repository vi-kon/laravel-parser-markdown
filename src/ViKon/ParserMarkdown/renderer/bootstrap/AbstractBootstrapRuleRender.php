<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap;

use ViKon\Parser\AbstractSet;
use ViKon\Parser\renderer\AbstractRuleRenderer;

abstract class AbstractBootstrapRuleRender extends AbstractRuleRenderer {
    public function __construct(AbstractSet $set) {
        parent::__construct($set, 'bootstrap');
    }
}