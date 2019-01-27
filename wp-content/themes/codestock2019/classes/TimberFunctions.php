<?php

namespace Pyxl\Theme;

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
                'name' => 'svg',
                'action' => [SVG::class, 'render'],
            ],
            [
                'name' => 'image',
                'action' => [Utils::class, 'image'],
            ],
            [
                'name' => 'site',
                'action' => 'get_bloginfo',
            ],
            [
                'name' => 'search_form',
                'action' => 'get_search_form',
            ],
            [
                'name' => 'log',
                'action' => [Utils::class, 'log'],
            ],
            [
                'name' => 'critical',
                'action' => [CriticalAssets::class, 'render'],
            ],
        ];

        foreach ($actions as $action) {
            $twig->addFunction(new Timber\Twig_Function($action['name'], $action['action']));
        }

        return $twig;
    }
}