<?php

namespace CodeStock\Theme;

class Enqueues
{
    public static function init()
    {
        $class = new self;
        add_action('wp_enqueue_scripts', [$class, 'register'], 25);
        add_action('wp_enqueue_scripts', [$class, 'head'], 50);
        add_action('get_footer', [$class, 'footer'], 50);
        add_filter('script_loader_tag', [$class, 'attributes'], 50, 3);
    }

    public function register()
    {

        $js_global = 'dist/scripts/main.js';
        wp_enqueue_script('main|asyncdefer', Utils::env_check($js_global), [], Utils::cache_buster($js_global), false);
        wp_localize_script(
            'main',
            'main',
            [
                'urls' => [
                    'root' => home_url(),
                    'ajax' => admin_url('admin-ajax.php'),
                    'theme' => URI,
                ],
                'ajax_nonce' => wp_create_nonce('ajax_nonce'),
                'post_id' => get_the_ID(),
            ]

        );

        // CSS
        $css_global = 'dist/styles/main.css';
        wp_register_style('main', Utils::env_check($css_global), [], Utils::cache_buster($css_global), 'all');
    }

    public function head()
    {
        wp_enqueue_script('main|asyncdefer');
    }

    public function footer()
    {
        wp_enqueue_style('main');
    }

    public function attributes($html, $handle, $src)
    {

        if (strpos($handle, '|asyncdefer') !== false) {
            return "<script type='text/javascript' async='async' defer='defer' src='{$src}'></script>";
        }
        if (strpos($handle, '|async') !== false) {
            return "<script type='text/javascript' async='async' src='{$src}'></script>";
        }
        if (strpos($handle, '|defer') !== false) {
            return "<script type='text/javascript' defer='defer' src='{$src}'></script>";
        }

        return $html;
    }
}
