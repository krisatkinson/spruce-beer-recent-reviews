<?php

declare( strict_types=1 );

namespace Garrison_Brewery\Shortcode\Spruce_Beer_Recent_Reviews;

use Garrison_Brewery\Shortcode;

use Twig_Loader_Filesystem;
use Twig_Environment;

class View implements Shortcode\View {
	protected $twig = null;
	protected $twig_loader = null;

	public function render( array $attributes = [], array $data = [] ): string {
		if ( ! $this->twig ) {
			if ( ! $this->twig_loader ) {
				$this->twig_loader = new Twig_Loader_Filesystem( SPRUCE_BEER_RECENT_REVIEWS_PLUGIN_DIRECTORY . '/templates' );
			}

			$this->twig = new Twig_Environment( $this->twig_loader, [] );
		}

		return $this->twig->render( "recent-reviews.twig", [
			'attributes' => $attributes,
			'data'       => $data
		] );
	}
}
