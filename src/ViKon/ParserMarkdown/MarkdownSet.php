<?php

namespace ViKon\ParserMarkdown;

use ViKon\Parser\AbstractSet;

/**
 * Class MarkdownSet
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown
 */
class MarkdownSet extends AbstractSet {
    public function __construct() {
        \Event::listen('vikon.parser.before.parse', [$this, 'normalizeLineBreak']);

    }

    /**
     * Change windows type line break to linux type
     *
     * @param string $text
     */
    public function normalizeLineBreak(&$text) {
        $text = str_replace("\r\n", "\n", $text);
    }
}