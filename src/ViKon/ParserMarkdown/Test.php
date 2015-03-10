<?php

namespace ViKon\ParserMarkdown;

use ViKon\Parser\Lexer\Lexer;
use ViKon\Parser\Parser;
use ViKon\Parser\Renderer\Renderer;
use ViKon\ParserMarkdown\Skin\BootstrapSkin;
use ViKon\ParserMarkdown\Skin\MarkdownSkin;

class Test {
    public function run() {
        $parser = new Parser();
        $lexer = new Lexer();
        $renderer = new Renderer();

        // Initialize parser with markdown rules
        $ruleSet = new MarkdownRuleSet();
        $ruleSet->init($parser, $lexer);

        // Set bootstrap renderer
        $bootstrapSkin = new BootstrapSkin();
        $bootstrapSkin->init($parser, $renderer);

        // Set markdown renderer
        $markdownSkin = new MarkdownSkin();
        $markdownSkin->init($parser, $renderer);

        $contents = "\n" . file_get_contents(__DIR__ . '/../../sample/markdown.md') . "\n";

        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '    <meta charset="utf-8">';
        echo '    <title>Parser markdown test</title>';
        echo '</head>';
        echo '<body>';

//        echo '<pre>';
//        var_dump($parser->parse($contents));
//        echo '</pre>';
//        echo '<hr/>';


//        echo $parser->parse($contents);
//        echo '<hr/>';

//        echo $parser->render($contents, 'bootstrap');
//        echo '<hr/>';
//        echo '<pre>';
//        echo $parser->render($contents, 'markdown');
//        echo '</pre>';

        echo '</body>';

    }
}