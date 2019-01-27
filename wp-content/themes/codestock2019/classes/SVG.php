<?php

namespace Pyxl\Theme;

use const Pyxl\Theme\PATH;

/**
 * Class SVG
 * @package Pyxl\Theme
 * @return HTML
 */
class SVG {
	/**
	 * @param $filename
	 *
	 * @return string|void
	 */
	public static function get( $filename ) {
		$filepath = PATH . 'dist/svgs/' . $filename . '.svg';

		if ( ! file_exists( $filepath ) ) {
			return;
		}

		ob_start();

		include $filepath;

		return ob_get_clean();
	}

	public static function render( $filename ) {
		echo self::get( $filename );;
	}
}
