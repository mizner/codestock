<?php

namespace CodeStock\Core\Models\Blocks;

use CodeStock\Core\Models\Blocks\Block;
use CodeStock\Core\Controllers\Blocks\Hero as Controller;

class Hero extends Block
{
    public static function init()
    {
        $args = [
            'slug' => 'hero',
            'name' => __('Hero', 'codestock'),
            // 'icon' => 'dashicons-welcome-view-site',
            'keywords' => ['hero', 'slider'],
            'fields' => [
                [
                    'slug' => 'title',
                    'label' => 'Title',
                    'type' => 'text',
                ],
                [
                    'slug' => 'description',
                    'label' => 'Description',
                    'type' => 'wysiwyg',
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ],
                [
                    'slug' => 'image',
                    'label' => 'Image',
                    'type' => 'image',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ],
                [
                    'slug' => 'link',
                    'label' => 'Link',
                    'type' => 'link',
                ],
                [
                    'slug' => 'link_secondary',
                    'label' => 'Link (secondary)',
                    'type' => 'link',
                ],
            ],
        ];

        parent::register($args);
    }
}