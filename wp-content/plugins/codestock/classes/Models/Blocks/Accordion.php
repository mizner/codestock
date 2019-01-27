<?php

namespace CodeStock\Core\Models\Blocks;

use CodeStock\Core\Models\Blocks\Block;
use CodeStock\Core\Controllers\Blocks\Hero as Controller;

class Accordion extends Block
{
    public static function init()
    {
        $args = [
            'slug' => 'accordion',
            'name' => __('Accordion', 'codestock'),
            // 'icon' => 'dashicons-welcome-view-site',
            'keywords' => ['faq', 'accordion'],
            'fields' => [
                [
                    'slug' => 'title',
                    'label' => 'Title',
                    'type' => 'text',
                ],
                [
                    'slug' => 'items',
                    'label' => 'Items',
                    'type' => 'repeater',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'slug' => 'title',
                            'label' => 'Title',
                            'type' => 'text',
                        ],
                        [
                            'slug' => 'description',
                            'label' => 'Description',
                            'type'         => 'wysiwyg',
                            'toolbar'      => 'basic',
                            'media_upload' => 0,
                            'delay'        => 1,
                        ],
                    ],
                ],
            ],
        ];

        parent::register($args);
    }
}

