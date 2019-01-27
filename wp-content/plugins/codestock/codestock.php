<?php
/**
 * Plugin Name: CodeStock Core
 * Description:
 * Version: 1.0
 * Author: Mizner (mike@mizner.io)
 * Author URI: https://codestock.org
 * License: GPLv3+
 */

namespace CodeStock\Core;

defined('WPINC') || die;

define(__NAMESPACE__ . '\PATH', plugin_dir_path(__FILE__));
define(__NAMESPACE__ . '\URI', plugin_dir_url(__FILE__));

require_once 'lib/autoload.php';

add_action('plugins_loaded', function () {

    /**
     * Models
     */
    Models\Blocks\Hero::init();
    Models\Blocks\Accordion::init();
    /**
     * Controllers
     */
    Controllers\Blocks\Hero::init();
    Controllers\Blocks\Accordion::init();
    // Enqueues
    Controllers\Enqueues\Blocks::init();
});

