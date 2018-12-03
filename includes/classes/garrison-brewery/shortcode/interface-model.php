<?php

declare( strict_types=1 );

namespace Garrison_Brewery\Shortcode;

interface Model {
	public function get_data( array $attributes = [] ): array;
}