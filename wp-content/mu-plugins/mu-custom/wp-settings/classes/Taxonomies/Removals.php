<?php

namespace CodeStock\WPSettings\Taxonomies;

class Removals
{

    private static $instance;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public static function init()
    {
        add_filter('wp_terms_checklist_args', [self::instance(), 'normalizeMetaboxTermOrder'], 10, 2);
    }

    public function normalizeMetaboxTermOrder($args, $post_id)
    {
        if (isset($args['taxonomy'])) {
            $args['checked_ontop'] = false;
        }
        return $args;
    }

}