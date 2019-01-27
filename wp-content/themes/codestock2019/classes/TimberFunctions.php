<?php

namespace Pyxl\Theme;

use Timber;

class TimberFunctions {
	public static function init() {
		$class = new self;
		add_filter( 'timber/twig', array( $class, 'add_to_twig' ) );
	}

	public function add_to_twig( $twig ) {
		$twig->addFunction( new Timber\Twig_Function( 'svg', [ SVG::class, 'render' ] ) );
		$twig->addFunction( new Timber\Twig_Function( 'site', 'get_bloginfo' ) );
		$twig->addFunction( new Timber\Twig_Function( 'search_form', 'get_search_form' ) );
		$twig->addFunction( new Timber\Twig_Function( 'log', [ Utils::class, 'log' ] ) );
		$twig->addFunction( new Timber\Twig_Function( 'critical', [ CriticalAssets::class, 'render' ] ) );

		return $twig;
	}
}