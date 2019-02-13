<?php

namespace CodeStock\Core\Models\FieldGroups;

use CodeStock\Core\Models\OptionsPages\GlobalOptions as OptionPage;

class GlobalOptions
{
    public static function init()
    {
        $class = new self;
        add_action('acf/init', [$class, 'social']);
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
}

