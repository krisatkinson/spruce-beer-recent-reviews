<?php
/**
 * @since             1.0.0
 * @package           spruce-beer-recent-reviews
 *
 * @wordpress-plugin
 * Plugin Name:       Spruce Beer Recent Reviews
 * Plugin URI:        spruce-beer-recent-reviews
 * Version:           1.0.0
 * Requires PHP:      7.2.10
 * Text Domain:       spruce-beer-recent-reviews
 */

require_once __DIR__ . '/includes/autoload.php';

define( 'SPRUCE_BEER_RECENT_REVIEWS_PLUGIN_DIRECTORY', __DIR__ );

if ( class_exists( 'Garrison_Brewery' ) ) {
	try {
		Garrison_Brewery::run();
	} catch ( \Exception $e ) {
		wp_die( $e->getMessage() );
	}
} else {
	wp_die( 'Class `Garrison_Brewery` does not exist' );
}
