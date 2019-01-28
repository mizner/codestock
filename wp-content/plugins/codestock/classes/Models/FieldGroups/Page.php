<?php

namespace CodeStock\Core\Models\FieldGroups;

class Page
{
    public static function init()
    {
        $class = new self;
        add_action('acf/init', [$class, 'register']);
        add_filter('body_class', [$class, 'body_class']);
    }

    public function body_class($classes)
    {
        if (is_page()) {
            $acf = get_fields();
            // TODO: investigate why regular post meta functions are apparently inaccessible here
            if (!$acf){
                return $classes;
                // All of this is gross.
            }
            foreach ($acf as $key => $value) {
                $classes[] = "header_{$value}";
                // I seriously can't believe I had to do that. Something is really screwy here.
            }
        }

        return $classes;
    }

    public function register()
    {
        $location = [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'page',
                ],
            ],
        ];
        $fields   = [
            [
                'name'          => 'header_transparency ',
                'key'           => 'header_transparency ',
                'label'         => 'Header Transparency',
                'type'          => 'button_group',
                'choices'       => [
                    'normal'      => 'Normal',
                    'transparent' => 'Transparent',
                ],
                'default_value' => [
                    'normal',
                ],
            ],
        ];
        $args     = [
            'key'                   => 'misc',
            'title'                 => 'Misc',
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