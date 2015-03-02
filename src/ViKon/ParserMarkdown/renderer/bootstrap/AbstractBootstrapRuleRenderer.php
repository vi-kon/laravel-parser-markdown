<?php


namespace ViKon\ParserMarkdown\renderer\bootstrap;

use ViKon\Parser\AbstractSet;
use ViKon\Parser\renderer\AbstractRuleRenderer;

/**
 * Class AbstractBootstrapRuleRender
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\renderer\bootstrap
 */
abstract class AbstractBootstrapRuleRenderer extends AbstractRuleRenderer {
    public function __construct(AbstractSet $set) {
        parent::__construct($set, 'bootstrap');
    }
}