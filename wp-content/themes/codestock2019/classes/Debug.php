<?php

namespace CodeStock\Theme;

class Debug
{
    public static function init()
    {
        if (!DEBUG) {
            return;
        }
        $class = new self;
        add_action('theme_view_main', [$class, 'show_queried'], 1);
    }

    public function show_queried()
    {
        var_dump(get_queried_object());
    }
}