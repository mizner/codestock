<?php

namespace CodeStock\Core\Models\OptionsPages;


class GlobalOptions
{
    const SLUG = 'global_options';

    public static function init()
    {
        $class = new self;
        add_action('acf/init', [$class, 'register']);
    }

    public function register()
    {
        acf_add_options_page([
            'page_title' => 'Global Fields',
            'menu_title' => 'Global Fields',
            'menu_slug'  => self::SLUG,
            'capability' => 'edit_posts',
            'redirect'   => false,
        ]);
    }
}