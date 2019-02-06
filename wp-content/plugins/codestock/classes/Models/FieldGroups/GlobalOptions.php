<?php

namespace CodeStock\Core\Models\FieldGroups;

use CodeStock\Core\Models\OptionsPages\GlobalOptions as OptionPage;

class GlobalOptions
{
    public static function init()
    {
        $class = new self;
        add_action('acf/init', [$class, 'social']);
        add_action('acf/init', [$class, 'footer']);
    }

    public function social()
    {
        $prefix = OptionPage::SLUG;

        $location = [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => OptionPage::SLUG,
                ],
            ],
        ];

        $fields = [
            [
                'key'   => $prefix . '_facebook',
                'name'  => 'facebook',
                'label' => 'Facebook',
                'type'  => 'link',
            ],
            [
                'key'   => "{$prefix}_twitter",
                'name'  => 'twitter',
                'label' => 'Twitter',
                'type'  => 'link',
            ],
            [
                'key'   => "{$prefix}_linkedin",
                'name'  => 'linkedin',
                'label' => 'Linkedin',
                'type'  => 'link',
            ],
            [
                'key'   => "{$prefix}_email",
                'name'  => 'email',
                'label' => 'Email',
                'type'  => 'email',
            ],
            [
                'key'   => "{$prefix}_phone",
                'name'  => 'phone',
                'label' => 'Phone',
                'type'  => 'link',
            ],
        ];
        acf_add_local_field_group([
            'key'             => "{$prefix}_social",
            'title'           => 'Social',
            'label_placement' => 'left',
            'fields'          => $fields,
            'location'        => $location,
        ]);
    }

    public function footer()
    {
        $prefix = OptionPage::SLUG;

        $location = [
            [
                [
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => OptionPage::SLUG,
                ],
            ],
        ];

        $fields = [
            [
                'label' => 'Title',
                'key'   => "{$prefix}_title",
                'name'  => 'title',
                'type'  => 'text',
            ],
            [
                'label'        => 'Description',
                'key'          => "{$prefix}_description",
                'name'         => 'description',
                'type'         => 'wysiwyg',
                'toolbar'      => 'basic',
                'media_upload' => 0,
                'delay'        => 1,
            ],
            [
                'label' => 'Link (primary)',
                'key'   => "{$prefix}_link_primary",
                'name'  => 'link_primary',
                'type'  => 'link',
            ],
            [
                'label' => 'Link (secondary)',
                'key'   => "{$prefix}_link_secondary",
                'name'  => 'link_secondary',
                'type'  => 'link',
            ],
        ];
        acf_add_local_field_group([
            'key'             => "{$prefix}_footer",
            'title'           => 'Footer',
            'fields'          => $fields,
            'location'        => $location,
            'label_placement' => 'left',
        ]);
    }
}

