<?php

declare( strict_types=1 );

namespace Garrison_Brewery\Shortcode;

class Controller {
	protected $name = null;

	protected $model = null;
	protected $view = null;

	public function __construct( Model $model, View $view ) {
		$this->model = $model;
		$this->view  = $view;

		$this->register_shortcode();
	}

	protected function register_shortcode() {
		if ( ! $this->name ) {
			$called_class = get_called_class();

			$class_name_parts = explode( "\\", $called_class );
			$this->name       = strtolower( preg_replace( "/[^a-z0-9]+/i", "_", $class_name_parts[ count( $class_name_parts ) - 2 ] ) );
		}

		add_shortcode( $this->name, [ $this, 'render_shortcode' ] );
	}

	public function render_shortcode( $attributes = [], string $content = '' ): string {
		if ( ! is_array( $attributes ) ) {
			$attributes = [];
		}

		$data = $this->model->get_data( $attributes );

		return $this->view->render( $attributes, $data );
	}
}
