<?php

declare( strict_types=1 );

namespace Garrison_Brewery\Shortcode\Spruce_Beer_Recent_Reviews;

use Garrison_Brewery\Shortcode;

class Model implements Shortcode\Model {
	protected $api_host = "https://api.untappd.com";
	protected $api_client_id = "3B699F2A6042F01F5F198865B533DAE74E4498EF";
	protected $api_client_secret = "6A750CCE8AC023F996133E376E3B58EC5478BCD5";
	protected $api_endpoint = "v4/beer/info";
	protected $beer_id = 110569;

	protected $api_call_url_pattern = "%s/%s/%s?client_id=%s&client_secret=%s";

	public function get_data( array $attributes = [] ): array {
		if ( isset( $attributes['beer_id'] ) && is_numeric( $attributes['beer_id'] ) ) {
			$this->beer_id = $attributes['beer_id'];
		}

		$result = $this->get_cached_result();

		if ( ! $result ) {

			$request_url = sprintf(
				$this->api_call_url_pattern,
				$this->api_host,
				$this->api_endpoint,
				$this->beer_id,
				$this->api_client_id,
				$this->api_client_secret
			);

			$response = wp_remote_get( $request_url );

			if ( is_array( $response ) ) {
				$result = json_decode( $response['body'], true );

				$this->set_cached_result( $result );
			}
		}

		return $result;
	}

	protected function get_cached_result() {
		return get_transient( "garrison_brewery_beer_{$this->beer_id}" );
	}

	protected function set_cached_result( $result ) {
		set_transient( "garrison_brewery_beer_{$this->beer_id}", $result, MINUTE_IN_SECONDS * 5 );
	}
}
