<?php

declare( strict_types=1 );

namespace Garrison_Brewery;

use Exception;

class Shortcode {
	public static function init() {
		$called_class = get_called_class();

		$model_class      = "{$called_class}\\Model";
		$view_class       = "{$called_class}\\View";
		$controller_class = "{$called_class}\\Controller";

		if ( ! class_exists( $model_class ) || ! class_exists( $view_class ) || ! class_exists( $controller_class ) ) {
			throw new Exception( "Model, View or Controller class is not defined in namespace `{$called_class}`" );
		}

		$model = new $model_class;
		$view  = new $view_class;

		return new $controller_class( $model, $view );
	}
}
