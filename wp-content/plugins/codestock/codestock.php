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
    // Options Page
    Models\OptionsPages\GlobalOptions::init();
    // Post Types
    // Models\PostTypes\Speakers::init();
    // Taxonomies
    Models\Taxonomies\EventYear::init();
    // Field Groups
    // Models\FieldGroups\Speakers::init();
    Models\FieldGroups\Page::init();
    Models\FieldGroups\GlobalOptions::init();
    // Blocks
    Models\Blocks\Hero::init();
    Models\Blocks\Accordion::init();
    Models\Blocks\Logos::init();

    /**
     * Controllers
     */

    // Post Types
    // Controllers\PostTypes\Speakers::init();
    Controllers\PostTypes\Post::init();
    // Enqueues
    Controllers\Enqueues\Blocks::init();
    // Blocks
    Controllers\Blocks\Hero::init();
    Controllers\Blocks\Accordion::init();
    Controllers\Blocks\Logos::init();
});

