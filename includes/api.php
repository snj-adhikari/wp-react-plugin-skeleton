<?php
/**
 * This file contains api endpoint used in the Plugin Skeleton application.
 *
 * @package PluginSkeleton\API
 * @since 1.0.0
 */

/**
 * REST API Proxy to consume gateway service.
 * reason: CORS cannot be enabled on the gateway service API.
 * URL: <domain>/njw-skeleton/api-proxy/<endpoint>.
 * accepts up to 3 nested paths for now. Just add more if you need more.
 *
 * Also create user query endpoint for search user with meta key.
 */
add_action(
	'rest_api_init',
	function () {
		// accept 1 path.
		register_rest_route(
			njw_skeleton_get_config( 'NAMESPACE' ),
			njw_skeleton_get_config( 'PROXY_ROUTE' ) . '/(?P<one>[^/]+)',
			[
				'methods'             => [ 'GET', 'POST', 'PUT', 'DELETE' ],
				'callback'            => 'njw_skeleton_api_proxy',
				'permission_callback' => '__return_true',
			]
		);
		// accept 2 paths.
		register_rest_route(
			njw_skeleton_get_config( 'NAMESPACE' ),
			njw_skeleton_get_config( 'PROXY_ROUTE' ) . '/(?P<one>[^/]+)/(?P<two>[^/]+)',
			[
				'methods'             => [ 'GET', 'POST', 'PUT', 'DELETE' ],
				'callback'            => 'njw_skeleton_api_proxy',
				'permission_callback' => '__return_true',
			]
		);


		register_rest_route(
			am_arelink_get_config( 'NAMESPACE' ),
			am_arelink_get_config( 'NORMAL_ROUTE' ) . '/check',
			[
				'methods'             => 'GET',
				'callback'            => 'njw_normal_route_check',
				'permission_callback' => '__return_true', // Adjust permissions as needed.
			]
		);

	}
);


/**
 * Validates and returns JSON data.
 *
 * This function checks if the provided text is valid JSON and returns it.
 *
 * @param string $text The text to be validated.
 * @param bool   $is_json Whether the text is JSON or not.
 * @return mixed The validated JSON data or an error message.
 */
function njw_skeleton_send_wp_response( $response, $status = 200 ) {
	if ( is_array( $response ) || is_object( $response ) ) {
		$response = wp_json_encode( $response );
	}

	return new WP_REST_Response( $response, $status );
}



/**
 * Handles the normal route check.
 *
 * This function is a placeholder for a normal route check.
 *
 * @param WP_REST_Request $request The request object.
 * @return WP_REST_Response The response object.
 */
function njw_skeleton_normal_route_check( $request ) {
	$method = $request->get_method();
	$body   = $request->get_body();
	$header = $request->get_headers();

	$response = [
		'method' => $method,
		'body'   => $body,
		'header' => $header,
	];

	return njw_skeleton_send_wp_response( $response, 200 );
}




/**
 * Proxies the API request to the Trackonomics API.
 *
 * This function takes a request object and sends it to the Trackonomics API for processing.
 *
 * @param mixed $req The request object to be sent to the API.
 * @return mixed The response from the Trackonomics API.
 * @throws Exception If there is an error with the API request.
 */
function njw_skeleton_api_proxy( $req ) {

	try {
		$method               = $req->get_method();
		$njw_skeleton_options = njw_skeleton_api_config();
		$njw_skeleton_api     = array_key_exists( 'api_gateway_url', $njw_skeleton_options ) ? $njw_skeleton_options['api_gateway_url'] : 'https://services.sit.digital.aremedia.net.au/trackonomics/api';
		$am_tr_access_key     = array_key_exists( 'api_access_key', $njw_skeleton_options ) ? $njw_skeleton_options['api_access_key'] : '898f8bcc906c497d8ed8a224b17ff2d8';
		$headers              = [
			'x-service-access-key: ' . $am_tr_access_key,
			'Content-Type: application/json',
			'Cache-Control: no-cache',
		];

		// build the URL.
		$endpoint = njw_skeleton_gateway_endpoint( $req->get_route() );
		$url      = $njw_skeleton_api . '/' . $endpoint;

		if ( $method === 'GET' || $method === 'DELETE' ) {
			$body = $req->get_query_params();
			$url  = ! empty( $body ) ? $url . '?' . http_build_query( $body ) : $url;

		} else {
			$body = njw_skeleton_json_validate_and_return( $req->get_body(), true );
		}

		$client = curl_init(); //phpcs:ignore

		// set the URL.
		curl_setopt( $client, CURLOPT_URL, $url ); //phpcs:ignore
		// set payload.
		$body = wp_json_encode( $body );
		curl_setopt( $client, CURLOPT_POSTFIELDS, $body ); //phpcs:ignore
		// set headers.
		curl_setopt( $client, CURLOPT_HTTPHEADER, $headers ); //phpcs:ignore
		curl_setopt( $client, CURLOPT_CUSTOMREQUEST, $method ); //phpcs:ignore
		// set so content is returned as a variable.
		curl_setopt( $client, CURLOPT_RETURNTRANSFER, true ); //phpcs:ignore

		// Curl - Version 4.
		curl_setopt( $client, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); //phpcs:ignore

		$response    = curl_exec( $client ); //phpcs:ignore
		$http_status = curl_getinfo( $client, CURLINFO_HTTP_CODE ); //phpcs:ignore

		if ( $http_status !== 200 ) {
			if ( $response ) {
				$err_response = njw_skeleton_json_validate_and_return( $response );
				if ( is_array( $err_response ) ) {
					$err_msg = array_key_exists( 'message', $err_response ) ? $err_response['message'] : 'Sorry, something went wrong. Please try again later.';
					throw new Exception( $err_msg, $http_status );
				} elseif ( is_object( $err_response ) ) {
					$err_msg = $err_response->message;
					throw new Exception( $err_msg, $http_status );
				} else {
					wp_send_json( $err_response, $http_status );
				}
			} else {
				throw new Exception( 'Error in API' );
			}
		}
		// response.
		$result = njw_skeleton_send_wp_response( njw_skeleton_json_validate_and_return( $response ), $http_status );

		// Set headers.
		$result->header( 'Cache-Control', 'no-cache' );

		return $result;

	} catch ( Exception $err ) {
		njw_skeleton_send_wp_response( ['msg' => $err->getMessage()], $err->getCode() );
	}
}
