<?php

namespace CodeStock\Core\Models\Blocks;

use CodeStock\Core\Models\Blocks\Block;

class Logos extends Block
{
    public static function init()
    {
        $args = [
            'slug' => 'logos',
            'name' => __('Logos', 'codestock'),
            // 'icon' => 'dashicons-welcome-view-site',
            'keywords' => ['logos', 'images'],
            'fields' => [
                [
                    'slug' => 'title',
                    'label' => 'Title',
                    'type' => 'text',
                ],
                [
                    'slug' => 'items',
                    'label' => 'Items',
                    'instructions' => 'Images should be approximately 250(H) x 150(W) px and centered',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'slug'         => 'image',
                            'label'        => 'Image',
                            'type'         => 'image',
                            'preview_size' => 'medium',
                            'library'      => 'all',
                        ],
                    ],
                ],
            ],
        ];

        parent::register($args);
    }
}

