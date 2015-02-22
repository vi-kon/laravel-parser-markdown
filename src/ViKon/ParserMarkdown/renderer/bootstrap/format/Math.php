<?php
/**
 * Created by PhpStorm.
 * User: van Gogh
 * Date: 2014.11.17.
 * Time: 18:25
 */

namespace ViKon\ParserMarkdown\renderer\bootstrap\format;

use ViKon\Parser\renderer\Renderer;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\renderer\bootstrap\AbstractBootstrapRuleRender;
use ViKon\ParserMarkdown\rule\format\Math as MathRule;

class Math extends AbstractBootstrapRuleRender {
    public function register(Renderer $renderer) {
        $renderer->setTokenRenderer(MathRule::NAME . '_open', [$this, 'renderMathOpen'], $this->skin);
        $renderer->setTokenRenderer(MathRule::NAME, [$this, 'renderMath'], $this->skin);
        $renderer->setTokenRenderer(MathRule::NAME . '_close', [$this, 'renderMathClose'], $this->skin);
    }

    public function renderMathOpen(Token $token) {
        return '<img style="vertical-align:middle;" ';
    }

    public function renderMath(Token $token) {
        // Mathematics expression
        $eq = urlencode($token->get('content', ''));
        // Background color
        $bc = config('parser-markdown::rule.math.background');
        // Foreground color (text color)
        $fc = config('parser-markdown::rule.math.font.color');
        // Image type
        $im = config('parser-markdown::rule.math.image');
        // Font size
        $fs = config('parser-markdown::rule.math.font.size');
        // Font type
        $ff = config('parser-markdown::rule.math.font.type');

        $img = public_path('images/math/' . md5($eq) . '.' . $im);
        if (!file_exists($img)) {
            $url = 'http://www.sciweavers.org/tex2img.php?eq=' . $eq . '&bc=' . $bc . '&fc=' . $fc . '&im=' . $im .
                '&fs=' . $fs . '&ff=' . $ff . '&edit=0';
            file_put_contents($img, file_get_contents($url));
        }

        $size = getimagesize($img);

        return 'src="/images/math/' . md5($eq) . '.' . $im . '" alt="' . $token->get('content', '') . '" ' . $size[3];
    }

    public function renderMathClose(Token $token) {
        return '" align="center" border="0" />';
    }
}