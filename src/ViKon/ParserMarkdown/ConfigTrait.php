<?php

namespace ViKon\ParserMarkdown;

trait ConfigTrait {
    /**
     * Is mode Github Flavored Markdown
     *
     * @return bool
     */
    public function isModeGfm() {
        return strtolower(config('parser-markdown.mode', 'gfm')) === 'gfm';
    }
}