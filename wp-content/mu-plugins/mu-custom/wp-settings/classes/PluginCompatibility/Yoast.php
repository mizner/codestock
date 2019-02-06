<?php

namespace CodeStock\WPSettings\PluginCompatibility;

class Yoast
{
    public static function init()
    {
        
        if (!in_array(
            'wordpress-seo/wordpress-seo.php',
            apply_filters('active_plugins', get_option('active_plugins'))
        )) {
            return;
        }

        $plugin = new self;
        add_action('add_meta_boxes', [$plugin, 'run'], 99);
    }

    public function run()
    {
        add_filter('wpseo_metabox_priority', [$this, 'yoastToBottom'], 99);
    }

    public function yoastToBottom($priority)
    {
        return 'low';
    }
}