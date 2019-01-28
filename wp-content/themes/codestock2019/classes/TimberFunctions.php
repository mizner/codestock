<?php

namespace CodeStock\Theme;

use CodeStock\Theme\Utils as Util;
use Timber;

class TimberFunctions
{
    public static function init()
    {
        $class = new self;
        add_filter('timber/twig', [$class, 'add_to_twig']);
    }

    public function add_to_twig($twig)
    {
        $actions = [
            [
                'name'   => 'archive_link',
                'action' => [Util::class, 'archive_link'],
            ],
            [
                'name'   => 'svg_inline',
                'action' => [Util::class, 'svg_inline'],
            ],
            [
                'name'   => 'image',
                'action' => [Util::class, 'image'],
            ],
            [
                'name'   => 'site',
                'action' => 'get_bloginfo',
            ],
            [
                'name'   => 'search_form',
                'action' => 'get_search_form',
            ],
            [
                'name'   => 'log',
                'action' => [Util::class, 'log'],
            ],
            [
                'name'   => 'critical',
                'action' => [CriticalAssets::class, 'render'],
            ],
            [
                'name'   => 'title',
                'action' => 'the_title',
            ],
            [
                'name'   => 'the_content',
                'action' => 'the_content',
            ],
        ];

        foreach ($actions as $action) {
            $twig->addFunction(new Timber\Twig_Function($action['name'], $action['action']));
        }

        return $twig;
    }
}