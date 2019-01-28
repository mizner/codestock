<?php

namespace CodeStock\Core\Models\FieldGroups;

use  CodeStock\Core\Models\PostTypes\Speakers as CPT;

class Speakers
{
    public static function init()
    {
        $class = new self;
        add_action('acf/init', [$class, 'register']);
    }

    public function register()
    {
        $location = [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => CPT::SLUG,
                ],
            ],
        ];
        $fields = [
            [
                'name'  => 'position',
                'key'   => 'position',
                'label' => 'Position',
                'type'  => 'text',
            ],
        ];
        $args = [
            'key'                   => 'details',
            'title'                 => 'Details',
            'fields'                => $fields,
            'location'              => $location,
            'menu_order'            => 0,
            'position'              => 'side',
            'style'                 => 'default',
            'label_placement'       => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen'        => '',
            'active'                => 1,
            'description'           => '',
        ];
        acf_add_local_field_group($args);

    }
}