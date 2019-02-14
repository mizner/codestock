<?php

namespace CodeStock\Core\Models\Blocks;

use const CodeStock\Core\PATH;
use CodeStock\Core\Utils\General as Util;
use Timber\Timber;
use WP_Error;

class Block
{
    const REQUIRED_KEYS = [
        'name',
        'slug',
        'fields',
    ];

    protected static function register($args)
    {
        foreach (self::REQUIRED_KEYS as $key) {
            if (Util::has_key($key, $args)) {
                continue;
            }
            return new WP_Error('broke', __('Arguments "' . $key . '" is required', 'codestock'));
        }
        if (!function_exists('get_field')) {
            // Disable if ACF is not active
            return false;
        }
        self::register_block($args);
        self::register_field_group($args);
    }

    private static function register_field_group($args)
    {
        $args = [
            'key'      => "block/{$args['slug']}",
            'title'    => __($args['name'], 'codestock'),
            'fields'   => self::slug_handler($args['slug'], $args['fields']),
            'location' => [
                [
                    [
                        'param'    => 'block',
                        'operator' => '==',
                        'value'    => "acf/{$args['slug']}",
                    ],
                ],
            ],
            3,
        ];
        acf_add_local_field_group($args);
    }

    private static function slug_handler($prefix, $fields)
    {
        _log($fields);
        $acf_fields = [];
        foreach ($fields as $field) {
            $acf_fields[] = array_merge($field, [
                'key'        => "{$prefix}/{$field['slug']}",
                'name'       => $field['slug'],
                'sub_fields' => Util::has_key('sub_fields', $field)
                    ? self::slug_handler($prefix, $field['sub_fields'])
                    : false,
            ]);
        }
        return $acf_fields;
    }

    private static function register_block($args)
    {
        $defaults = [
            'name'            => $args['slug'],
            'title'           => __($args['name'], 'codestock'),
            'description'     => "The {$args['name']} block",
            'render_callback' => function ($block, $content = '', $is_preview = false) use ($args) {
                $hook = "blocks/{$args['slug']}";
                // var_dump($hook);
                do_action($hook, [
                    'block'      => $block,
                    'register'   => $args,
                    'acf'        => get_fields(),
                    'is_preview' => $is_preview,
                ]);
            },
            'supports'        => [
                // 'mode' => false,
                // 'align' => 'full-width',
            ],
            'category'        => 'layout',
            'icon'            => 'layout', // http://aalmiray.github.io/ikonli/cheat-sheet-dashicons.html
            'mode'            => 'preview',
            'keywords'        => [$args['slug']],
        ];

        acf_register_block(array_merge($defaults, $args));
    }
}