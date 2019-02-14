<?php

namespace Codestock\Theme;

use Timber;
use CodeStock\Theme\Utils;
use const CodeStock\Theme\PATH;
use const CodeStock\Theme\URI;

class View
{
    const TWIG_ROOT = PATH . 'views/';

    const CONDITIONS = [
    ];

    public static function init()
    {
        $class = new self;
        add_action('theme_view_header', [$class, 'header'], 25);
        add_action('theme_view_main', [$class, 'main'], 25);
        add_action('theme_view_footer', [$class, 'footer'], 25);
    }

    public function main($queried_object)
    {
        $info = $this->get_info($queried_object);
        // var_dump($info);
        $info = apply_filters($info->hook, $info);

        do_action('theme_before_main', $info);
        $this->render($info->file, $info);
        do_action('theme_after_main', $info);
    }

    public function header()
    {
        do_action('theme_before_head');
        $this->render('globals/head', []);
        do_action('theme_after_head');

        do_action('theme_before_header');
        $this->render('globals/header/header', []);
        do_action('theme_after_header');
    }

    public function footer()
    {
        do_action('theme_before_footer');
        $this->render('globals/footer/footer', []);
        do_action('theme_after_footer');
    }

    public function render($path, $data = [])
    {
        Timber\Timber::render(self::TWIG_ROOT . "{$path}.twig", (array)$data);
    }

    public function get_type()
    {
        $type = '404'; // Default

        if (is_singular() || is_page()) {
            $type = 'singles';
        }

        if (is_archive() || is_home()) {
            $type = 'archives';
        }

        if (is_search()) {
            $type = 'search';
        }

        return $type;
    }

    public function get_framework($info)
    {
        $framework = 'twig';
        foreach (self::CONDITIONS as $key => $value) {
            if ($key !== $info->path) {
                continue;
            }

            $framework = $value['framework'];
        }
        return $framework;
    }

    public function get_info($queried_object)
    {
        $queried_object = $queried_object ?: get_queried_object();

        $info = (object)[
            'hook'     => '',
            'type'     => $this->get_type(),
            'sub_type' => '',
            'path'     => '',
            'basename' => '',
            'file'     => '',
            'data'     => [],
            'queried'  => $queried_object,
        ];

        switch ($info->type) {
            case 'archives':
                if (is_home()) {
                    $post_type      = get_post_type_object('post');
                    $info->basename = $post_type->rest_base;
                    $info->sub_type = 'post_types';
                    $info->data     = [
                        'posts' => Utils::get_posts(),
                    ];
                }
                elseif (is_post_type_archive()) {
                    $post_type      = get_post_type_object($info->queried->name);
                    $info->basename = $post_type->rest_base;
                    $info->sub_type = 'post_types';
                    $info->data     = [
                        'posts' => Utils::get_posts($post_type->rest_base),
                    ];
                }
                else {
                    $info->basename = $info->queried->taxonomy;
                    $info->sub_type = 'taxonomies';
                }
                $info->path = "{$info->type}/{$info->sub_type}/{$info->basename}";
                break;
            case 'singles':
                $post_type      = get_post_type_object($info->queried->post_type);
                $info->basename = $post_type->rest_base;
                $info->sub_type = $post_type->rest_base;
                $info->path     = "{$info->type}/{$info->sub_type}";
                $info->data     = [
                    'post' => Utils::get_post($post_type->rest_base, $queried_object->ID),
                ];
                break;
            case 'search':
                $info->basename = 'search';
                $info->path     = "{$info->basename}";
                $info->data     = [
                    'search_term' => get_search_query(),
                ];
                break;
            default:
                $info->basename = '404';
                $info->path     .= "{$info->basename}";
                break;
        }
        $info->hook      = "{$info->path}";
        $info->file      = "{$info->path}/{$info->basename}";
        $info->framework = $this->get_framework($info);

        return $info;
    }
}
