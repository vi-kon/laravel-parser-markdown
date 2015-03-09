<?php

namespace ViKon\ParserMarkdown\Skin\Bootstrap\Format;

use ViKon\Parser\Renderer\AbstractRenderer;
use ViKon\Parser\Renderer\Renderer;
use ViKon\Parser\Rule\AbstractBlockRule;
use ViKon\Parser\Token;
use ViKon\ParserMarkdown\Rule\Format\MathRule;

/**
 * Class MathBootstrapRenderer
 *
 * @author  Kovács Vince <vincekovacs@hotmail.com>
 *
 * @package ViKon\ParserMarkdown\Skin\Bootstrap\Format
 */
class MathBootstrapRenderer extends AbstractRenderer {
    public function register(Renderer $renderer) {
        $this->registerTokenRenderer(MathRule::NAME . AbstractBlockRule::OPEN, 'renderOpen', $renderer);
        $this->registerTokenRenderer(MathRule::NAME . AbstractBlockRule::CLOSE, 'renderClose', $renderer);
        $this->registerTokenRenderer(MathRule::NAME, 'renderContent', $renderer);
    }

    /**
     * @return string
     */
    public function renderOpen() {
        return '<img style="vertical-align:middle;" ';
    }

    /**
     * @param \ViKon\Parser\Token $token
     *
     * @return string
     */
    public function renderContent(Token $token) {
        // Mathematics expression
        $eq = urlencode($token->get('expression', ''));
        // Background color
        $bc = config('parser-markdown.rule.math.background');
        // Foreground color (text color)
        $fc = config('parser-markdown.rule.math.font.color');
        // Image type
        $im = config('parser-markdown.rule.math.image');
        // Font size
        $fs = config('parser-markdown.rule.math.font.size');
        // Font type
        $ff = config('parser-markdown.rule.math.font.type');
        // Image path
        $img = public_path(config('parser-markdown.rule.math.path') . '/' . md5($eq) . '.' . $im);
        if (!file_exists($img)) {
            $url = 'http://www.sciweavers.org/tex2img.php?eq=' . $eq . '&bc=' . $bc . '&fc=' . $fc . '&im=' . $im .
                '&fs=' . $fs . '&ff=' . $ff . '&edit=0';
            file_put_contents($img, file_get_contents($url));
        }
        $size = getimagesize($img);

        return 'src="/images/math/' . md5($eq) . '.' . $im . '" alt="' . $token->get('content', '') . '" ' . $size[3];
    }

    /**
     * @return string
     */
    public function renderClose() {
        return '" align="center" border="0" />';
    }
}