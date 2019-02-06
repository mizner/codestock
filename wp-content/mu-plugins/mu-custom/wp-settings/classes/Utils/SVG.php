<?php

namespace CodeStock\WPSettings\Utils;

use const CodeStock\WPSettings\PATH;

/**
 * Class SVG
 * @package CodeStock\Theme
 * @return HTML
 */
class SVG
{
    /**
     * @param $filename
     * @return string|void
     */
    public static function get($filename)
    {
        $filepath = PATH . '/svg/' . $filename . '.svg';

        if (!file_exists($filepath)) {
            return;
        }

        ob_start();

        include $filepath;

        return ob_get_clean();
    }
}
