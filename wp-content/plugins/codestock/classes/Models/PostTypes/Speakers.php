<?php

namespace CodeStock\Core\Models\PostTypes;

class Speakers
{

    const SLUG = 'speakers';

    const SINGULAR = 'Speaker';

    const PLURAL = 'Speakers';

    const ICON = 'dashicons-welcome-widgets-menus';

    public static function init()
    {
        $class = new self;
        add_action('init', [$class, 'register'], 10);
    }

    public function register()
    {
        $labels = [
            'name'               => self::PLURAL,
            'single_name'        => self::SINGULAR,
            'add_new_item'       => 'Add New ' . self::SINGULAR,
            'edit_item'          => 'Edit ' . self::SINGULAR,
            'new_item'           => 'New ' . self::SINGULAR,
            'all_items'          => 'All ' . self::PLURAL,
            'view_item'          => 'View ' . self::SINGULAR,
            'search_items'       => 'Search ' . self::PLURAL,
            'not_found'          => 'No ' . strtolower(self::PLURAL) . ' found',
            'not_found_in_trash' => 'No ' . strtolower(self::PLURAL) . ' found in the Trash',
            'parent_item_colon'  => '',
            'menu_name'          => self::PLURAL,
        ];
        $args = [
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'hierarchical'          => false,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_nav_menus'     => true,
            'show_in_admin_bar'     => true,
            'show_in_rest'          => true,
            // 'rest_base'             => true,
            // 'rest_controller_class' => true, // Default: 'WP_REST_Posts_Controller'
            'menu_position'         => 5,
            'menu_icon'             => self::ICON,
            'capability_type'       => 'post',
            'capabilities'          => [],
            'map_meta_cap'          => true,
            'has_archive'           => true,
            'rewrite'         => [
                'slug' => strtolower(self::PLURAL),
                // 'with_front' => true,
            ],
            'supports'        => [
                'editor',
                'author',
                'title',
                'revisions',
                'thumbnail',
                'excerpt',
                'custom-fields',
            ],

        ];

        register_post_type(self::SLUG, $args);
    }
}