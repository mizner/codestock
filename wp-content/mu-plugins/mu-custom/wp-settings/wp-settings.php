<?php
/**
 * Plugin Name: CodeStock WordPress Settings
 * Description: Security upgrades and custom settings
 * Version: 1.0.0
 * Author: CodeStock Inc.
 * Author URI: http://codestock.com
 * License: GPL3+
 */

namespace CodeStock\WPSettings;

defined('WPINC') || die;

define(__NAMESPACE__.'\PATH', plugin_dir_path(__FILE__));

require_once 'lib/autoload.php';

add_action('plugins_loaded', function () {

    Security\WPHead::init();
    Security\Assets::init();
    Security\FileEditor::init();
    Security\Login::init();

    PluginCompatibility\Yoast::init();

    Assets\jQuery::init();
    Assets\Emoji::init();

    DashboardWidgets\Removals::init();
    DashboardWidgets\Additions::init();

    // AdminMenu\MenuPages\Removals::init();
    // AdminMenu\MenuPages\Additions::init();
    // AdminMenu\Redirects::init();

    AdminBar\Removals::init();
    AdminBar\Additions::init();

    Taxonomies\Removals::init();
});
