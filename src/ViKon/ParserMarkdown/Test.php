<?php

namespace ViKon\ParserMarkdown;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Parser;
use ViKon\Parser\Renderer\Renderer;

class Test {
    public function run() {
        $parser = new Parser();
        $lexer = new Lexer();
        $renderer = new Renderer();

        $markdownSet = new MarkdownSet();
        $markdownSet->init($parser, $lexer, $renderer);

        $contents = "\n" . file_get_contents(__DIR__ . '/../../sample/syntax.md') . "\n";

//        echo '<pre>';
//        var_dump($parser->parse($contents));
//        echo '</pre>';
//        echo '<hr/>';

        echo $parser->render("\n" . $contents . "\n", 'bootstrap');
        echo '<hr/>';
        echo '<pre>';
        echo htmlspecialchars($parser->render("\n" . $contents . "\n", 'markdown'));
        echo '</pre>';
    }
}