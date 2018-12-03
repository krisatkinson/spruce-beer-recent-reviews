<?php

declare( strict_types=1 );

class Garrison_Brewery {
	public static function run() {
		static::enqueue_bootstrap_css();

		\Garrison_Brewery\Shortcode\Spruce_Beer_Recent_Reviews::init();
	}

	public static function enqueue_bootstrap_css() {
		add_action( 'wp_enqueue_scripts', function () {
			wp_enqueue_style( 'garrison-brewery--bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
		} );
	}
}