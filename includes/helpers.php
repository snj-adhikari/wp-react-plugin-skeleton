<?php
/**
 * This file contains helper functions used in the NJW Skeleton application.
 *
 * @package PluginSkeleton\Helpers
 * @since 1.0.0
 */

/**
 *  Method named njw_skeleton_json_validate_and_return.
 *
 * @param  string $text --> passed the json text.
 * @return string | array -> based on passed text.
 */
function njw_skeleton_json_validate_and_return( $text ) {
	// decode the JSON data.
	$result = json_decode( $text );

	// switch and check possible JSON errors.
	switch ( json_last_error() ) {
		case JSON_ERROR_NONE:
			$error = ''; // JSON is valid // No error has occurred.
			break;
		case JSON_ERROR_DEPTH:
			$error = 'The maximum stack depth has been exceeded.';
			break;
		case JSON_ERROR_STATE_MISMATCH:
			$error = 'Invalid or malformed JSON.';
			break;
		case JSON_ERROR_CTRL_CHAR:
			$error = 'Control character error, possibly incorrectly encoded.';
			break;
		case JSON_ERROR_SYNTAX:
			$error = 'Syntax error, malformed JSON.';
			break;
		// PHP >= 5.3.3.
		case JSON_ERROR_UTF8:
			$error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
			break;
		// PHP >= 5.5.0.
		case JSON_ERROR_RECURSION:
			$error = 'One or more recursive references in the value to be encoded.';
			break;
		// PHP >= 5.5.0.
		case JSON_ERROR_INF_OR_NAN:
			$error = 'One or more NAN or INF values in the value to be encoded.';
			break;
		case JSON_ERROR_UNSUPPORTED_TYPE:
			$error = 'A value of a type that cannot be encoded was given.';
			break;
		default:
			$error = 'Unknown JSON error occured.';
			break;
	}

	if ( $error !== '' ) {
		// return text as it is :D , since it's not a valid js.
		return $text;
	}

	// everything is OK.
	return $result;
}


/**
 * Method njw_skeleton_api_config
 *
 * @devnote : Plugin setting page will overwrite the setting present on option page.
 *
 * @return string | array -> based on passed text.
 */
function njw_skeleton_api_config() {
	$default_option = [
		'API_PROXY_URL'  => get_site_url() . '/wp-json/' . njw_skeleton_get_config( 'NAMESPACE' ) . '/' . njw_skeleton_get_config( 'ROUTE' ) . '/',
		'API_ACCESS_KEY' => '',
	];

	$am_tr_options = get_option( njw_skeleton_get_config( 'SETTINGS_NAME' ) ); // get the data from the plugin setting page.

	$return_option = ! empty( $am_tr_options ) && is_array( $am_tr_options ) ? $am_tr_options : $default_option;

	return ! empty( $return_option ) && is_array( $return_option ) ? $return_option : $default_option;
}


/**
 * Logs a custom message.
 *
 * @param string $message The message to be logged.
 * @return void
 */
function njw_skeleton_log( $message ) {
	if ( WP_DEBUG === true ) {
		if ( is_array( $message ) || is_object( $message ) ) {
			// phpcs:ignore
			error_log( print_r( $message, true ) );
		} else {
			// phpcs:ignore
			error_log( $message );
		}
	}
}


/**
 * Load an asset file or return the default configuration.
 *
 * @param string $file_path Path to the asset file.
 * @return array Asset file configuration.
 */
function njw_skeleton_load_asset_file( $file_path ) {
	$default_asset_file = njw_skeleton_get_default_asset_file();

	if ( file_exists( $file_path ) ) {
		return include $file_path;
	}

	return $default_asset_file;
}


/**
 * Get the default asset file configuration.
 *
 * @return array Default asset file configuration.
 */
function njw_skeleton_get_default_asset_file() {
	return [
		'dependencies' => [],
		'version'      => AM_AREDEALS_ASSET_VERSION,
	];
}


/**
 * Get the gateway endpoint from the proxy url.
 * the endpoint should be everything after /aremedia-trial-team/api-proxy/.
 * eg: if URL is https://beautyheaven.com.au/wp-json/aremedia-trial-team/api-proxy/trials/23, then endpoint will be "/trials/23".
 *
 * @param string $proxy_url The URL of the proxy.
 * @return string The endpoint of the proxy URL.
 */
function njw_skeleton_gateway_endpoint( $proxy_url ) {
	$path     = '/' . njw_skeleton_get_config( 'NAMESPACE' ) . '/' . njw_skeleton_get_config( 'PROXY_ROUTE' ) . '/';
	$endpoint = strstr( $proxy_url, $path );
	return str_replace( $path, '', $endpoint );
}



/**
 * Get the value of a configuration constant for proxy from cms
 *
 * @param string $script_name The name of the script.
 */
function njw_skeleton_expose_js_variable( $script_name ) {
	// Localize the script with new data.
	$api_config = njw_skeleton_api_config();

	wp_localize_script(
		$script_name,
		'njwSkeletonConfig',
		[
			'pluginRoute'   => njw_skeleton_get_config( 'NAMESPACE' ) . '/' . am_arelink_get_config( 'NORMAL_ROUTE' ),
			'amAlProxyUrl'  => $api_config['API_PROXY_URL'],
			'nonce'         => wp_create_nonce( 'wp_rest' ),
			'postType'      => get_post_type(),
		]
	);
}