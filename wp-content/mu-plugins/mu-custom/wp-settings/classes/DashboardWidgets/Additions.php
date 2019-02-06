<?php

namespace CodeStock\WPSettings\DashboardWidgets;

use CodeStock\WPSettings\Utils\PluginLists;

class Additions
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
        add_action('wp_dashboard_setup', [self::instance(), 'additions']);
    }

    public function additions()
    {
        // Context Options [normal, side, column3, column4]
        $widgets = [
            [
                'widget_id'   => 'codestock_plugins',
                'widget_name' => 'Plugins Information',
                'callback'    => [self::instance(), 'plugins'],
                'screen'      => 'dashboard',
                'context'     => 'normal',
                'priority'    => 'high',
            ],
            [
                'widget_id'   => 'codestock_server_info',
                'widget_name' => 'Server Information',
                'callback'    => [self::instance(), 'server'],
                'screen'      => 'dashboard',
                'context'     => 'side',
                'priority'    => 'high',
            ],
            [
                'widget_id'   => 'codestock_acf_fields',
                'widget_name' => 'List of ACF Fields',
                'callback'    => [self::instance(), 'fields'],
                'screen'      => 'dashboard',
                'context'     => 'column3',
                'priority'    => 'high',
            ],
        ];
        foreach ($widgets as $widget) {
            add_meta_box(
                $widget['widget_id'],
                $widget['widget_name'],
                $widget['callback'],
                $widget['screen'],
                $widget['context'],
                $widget['priority']
            );
        }
    }

    public function fields()
    {
        $field_types = acf_get_field_types();
        foreach ($field_types as $type) {
            echo "<span><strong>$type->label</strong>: <pre style='display: inline'>{$type->name}</pre></p>";
        }
    }

    public function plugins()
    {
        $installed_plugins = PluginLists::installed();
        $active_plugins    = PluginLists::active();
        ?>
        <ul>
            <?php
            foreach ($installed_plugins as $plugin_slug => $plugin_details) :
                if (in_array($plugin_slug, $active_plugins)) :
                    ?>
                    <p><span><?php echo esc_html__($plugin_details['Name']); ?></span></p>
                <?php
                endif;
            endforeach;
            ?>
        </ul>
        <?php
    }

    public function server()
    {
        global $wpdb;
        ?>
        <ul>
            <li>
                <p><strong>PHP: </strong><?php echo esc_html(phpversion()); ?></p>
            </li>
            <li>
                <p><strong>MySQL: </strong><?php echo esc_html($wpdb->db_version()); ?></p>
            </li>
        </ul>
        <?php
    }
}
