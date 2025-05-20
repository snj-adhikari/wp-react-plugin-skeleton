<?php
/**
 * This file contains config functions used in the NJW Plugin Skeleton application.
 *
 * @package PluginSkeleton\Config
 * @since 1.0.0
 */

/**
 *
 * Method named njw_skeleton_define_constant_with_prefix --> This is a nicer way to define a constant with a prefix so it doesn't collide with other constants.
 * --> Starts with prefix 'NJW_SKELETON_'
 *
 * @param  string $constant_name The name of the constant.
 * @param  mixed  $value         The value of the constant.
 * @return void
 */
function njw_skeleton_define_constant_with_prefix( $constant_name, $value ) {
	$constant_name_prefix = 'NJW_SKELETON_';
	$new_constant_name    = $constant_name_prefix . $constant_name;
	if ( ! defined( $new_constant_name ) ) {
		define( $new_constant_name, $value );
	}
}


njw_skeleton_define_constant_with_prefix( 'NAMESPACE', 'njw-plugin' ); // Prefix starts with `NJW_SKELETON_'. --> the base namespace would be <site_url>/wp-json/am-aredeals.
njw_skeleton_define_constant_with_prefix( 'PROXY_ROUTE', 'api-proxy' ); // Prefix starts with `NJW_SKELETON_' . --> the actual proxy that connects to the gateway service would be <site_url>/wp-json/am-aredeals/api-proxy.
njw_skeleton_define_constant_with_prefix( 'NORMAL_ROUTE', 'v1' ); // Prefix starts with `NJW_SKELETON_' . --> the actual proxy that connects to the gateway service would be <site_url>/wp-json/am-aredeals/api-proxy.
njw_skeleton_define_constant_with_prefix( 'SETTINGS_NAME', 'njw-settings' ); // Prefix starts with `NJW_SKELETON_'



/**
 * Retrieves the configuration settings for Trackonomics.
 *
 * @param  string $constant_name The name of the constant.
 * @return string The configuration settings for Trackonomics.
 */
function njw_skeleton_get_config( $constant_name ) {
	return constant( 'NJW_SKELETON_' . $constant_name );
}
