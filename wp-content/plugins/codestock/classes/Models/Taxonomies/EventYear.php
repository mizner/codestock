<?php

namespace CodeStock\Core\Models\Taxonomies;

use CodeStock\Core\Models\PostTypes\Speakers as ContentType;

class EventYear
{
    const SLUG = 'event_year';

    const SINGULAR = 'Event Year';

    const PLURAL = 'Event Years';

    const POST_TYPES = [ContentType::SLUG];

    public static function init()
    {
        $class = new self;
        add_action('init', [$class, 'register']);
    }

    public function register()
    {
        $labels = [
            'name'          => self::PLURAL,
            'singular_name' => self::SINGULAR,
            'add_new_item'  => 'Add New '.self::SINGULAR,
            'edit_item'     => 'Edit '.self::SINGULAR,
            'view_item'     => 'View '.self::SINGULAR,
            'update_item'   => 'Update '.self::SINGULAR,
            'not_found'     => 'No '.self::PLURAL.' found.',
        ];
        $args   = [
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'menu_position'         => 5,
            'publicly_queryable'    => true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'show_in_rest'          => false,
            'rest_base'             => true,
            // 'rest_controller_class' => '', // Default is 'WP_REST_Terms_Controller'
            // 'show_tagcloud'         => true,
            'show_in_quick_edit'    => true,
            'show_admin_column'     => true,
            // 'meta_box_cb'           => '',
            // 'capabilities'          => [],
            // 'rewrite'               => [],
            // 'query_var'             => '',
            // 'update_count_callback' => '',
        ];

        register_taxonomy(
            self::SLUG,
            self::POST_TYPES,
            $args
        );
    }
}
