<?php

declare( strict_types=1 );

namespace Garrison_Brewery\Shortcode;

interface View {
	public function render( array $attributes = [], array $data = [] ): string;
}