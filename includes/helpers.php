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
