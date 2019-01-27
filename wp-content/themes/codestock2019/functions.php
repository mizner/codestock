<?php
/**
 * @package Pyxl
 * @author  Pyxl Inc. <development@pyxl.com>
 * @license GPLv3+
 * @version 3.0.0
 * @dependencies Timber (https://wordpress.org/plugins/timber-library/)
 */

namespace Pyxl\Theme;

use Timber\Timber;

define( __NAMESPACE__ . '\PATH', dirname( __FILE__ ) . '/' );
define( __NAMESPACE__ . '\URI', trailingslashit( get_template_directory_uri() ) );

require_once 'lib/autoload.php';

add_action( 'admin_notices', function () {
	if ( ! class_exists( Timber::class ) ) {
		echo '<div class="error"><p>' . __( '<strong>Warning:</strong> The theme needs plugin <a href=" ' . get_admin_url() . '/plugin-install.php?s=timber&tab=search&type=term" target="_blank"><strong>Timber</strong></a> to function', 'my-theme' ) . '</p></div>';
	}
} );


add_action( 'after_setup_theme', function () {
	if ( ! class_exists( Timber::class ) ) {
		return;
	}
	View::init();
	Setup::init();
	MarkupHelper::init();
	Enqueues::init();
	SocialMenu::init();
	TimberFunctions::init();
	CriticalAssets::init();
} );
