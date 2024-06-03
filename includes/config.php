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

njw_skeleton_define_constant_with_prefix( 'NAMESPACE', 'am-tr' ); // Prefix starts with `NJW_SKELETON_'.
njw_skeleton_define_constant_with_prefix( 'ROUTE', 'api-proxy' ); // Prefix starts with `NJW_SKELETON_' .
njw_skeleton_define_constant_with_prefix( 'SETTINGS_NAME', 'am-trx-settings' ); // Prefix starts with `NJW_SKELETON_' .



/**
 * Retrieves the configuration settings for Trackonomics.
 *
 * @param  string $constant_name The name of the constant.
 * @return string The configuration settings for Trackonomics.
 */
function njw_skeleton_get_config( $constant_name ) {
	return constant( 'NJW_SKELETON_' . $constant_name );
}
