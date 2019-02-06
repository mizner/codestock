<?php

namespace CodeStock\WPSettings\AdminBar;

use CodeStock\WPSettings\Utils\SVG;

class Additions
{

    private static $instance;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function init()
    {
        add_action('admin_bar_menu', [self::instance(), 'add'], -1);
    }

    public function add($wp_admin_bar)
    {

    }
}