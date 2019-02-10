<?php

namespace CodeStock\Theme;

class Setup
{
    public static function init()
    {
        $class = new self;
        add_action('init', [$class, 'general']);
        add_action('init', [$class, 'registerMenus']);
        add_action('init', [$class, 'registerSidebars']);
        add_filter('body_class', [$class, 'body_class']);
    }

    public function body_class($classes)
    {
        global $post;
        if (isset($post)) {
            $classes[] = $post->post_type . '-' . $post->post_name;
        }
        return $classes;
    }

    /**
     * General.
     */
    public function general()
    {
        add_theme_support('align-wide');

        add_theme_support('title-tag');

        add_theme_support('automatic-feed-links');

        add_theme_support('post-thumbnails');

        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        );
    }

    /**
     * Menus
     */
    public function registerMenus()
    {
        register_nav_menus([
            'menu_primary' => __('Primary Menu', 'codestock-theme'),
            'menu_secondary' => __('Secondary Menu', 'codestock-theme'),
            // 'menu_footer'    => __('Footer Menu', 'codestock-theme'),
            'menu_social'  => __('Social Menu', 'codestock-theme'),
        ]);
    }

    /**
     * Register Sidebars.
     */
    public function registerSidebars()
    {
        register_sidebar([
            'name'          => esc_html__('Sidebar', 'codestock-theme'),
            'id'            => 'sidebar',
            'description'   => esc_html__('Add widgets here.', 'codestock-theme'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ]);
    }
}