<?php

$vendor_autoload = __DIR__ . '/vendor/autoload.php';

if ( file_exists( $vendor_autoload ) ) {
	require_once $vendor_autoload;
}

spl_autoload_register( function ( $class_name ) {
	$autoload_directory = dirname( __FILE__ ) . '/classes';
	$ds                 = DIRECTORY_SEPARATOR;

	$class_file = preg_replace( "/[^a-z0-9\\_]+/", $ds, strtolower( $class_name ) );
	$class_file = preg_replace( "/[\\_]/", "-", $class_file );

	$class_path_info = pathinfo( $class_file );

	$directory_parts = [
		$autoload_directory,
	];

	if ( isset( $class_path_info['dirname'] ) && $class_path_info['dirname'] && '.' !== $class_path_info['dirname'] ) {
		$directory_parts[] = $class_path_info['dirname'];
	}

	$filename = implode( $ds, $directory_parts );

	$class_filename     = "{$filename}{$ds}class-{$class_path_info['basename']}.php";
	$interface_filename = "{$filename}{$ds}interface-{$class_path_info['basename']}.php";

	if ( file_exists( $class_filename ) ) {
		require_once $class_filename;
	} elseif ( file_exists( $interface_filename ) ) {
		require_once $interface_filename;
	}

	return;
} );
