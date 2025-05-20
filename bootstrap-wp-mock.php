<?php
/**
 * PHPUnit bootstrap mock file
 *
 * @package NJW_Skeleton
 */

use Mockery;

WP_Mock::userFunction(
	'plugin_dir_path',
	[
		'return' => __DIR__ . '/',
	]
);

WP_Mock::userFunction(
	'get_site_url',
	[
		'return' => 'http://www.njwskeleton.com.au',
	]
);


// Mock the wp_create_nonce function.
WP_Mock::userFunction(
	'wp_create_nonce',
	[
		'return' => 'mock_nonce', // Replace with the value you want the function to return.
	]
);

// Mock wp_parse_url to accept any kind of host, path, query, or scheme.
WP_Mock::userFunction(
	'wp_parse_url',
	[
		'args'   => [ Mockery::any(), Mockery::any() ],
		'return' => [
			'scheme' => 'https',
			'host'   => 'www.elle.com',
			'path'   => '/',
			'query'  => '',
		],
	]
);

WP_Mock::userFunction(
	'plugin_dir_url',
	[
		'return' => '/wp-content/plugins/njw-skeleton-wp-react-plugin/',
	]
);

WP_Mock::userFunction( 'get_option', [ 'return' => 'mocked_option_value' ] );

WP_Mock::userFunction(
	'wp_localize_script',
	[
		'return' => true,
	]
);


WP_Mock::userFunction(
	'register_activation_hook',
	[
		'return' => true,
	]
);

// Mock add_shortcode function.
WP_Mock::userFunction(
	'add_shortcode',
	[
		'args'   => [ Mockery::any(), Mockery::any() ],
		'return' => true,
	]
);

// Mock the wp_generate_password function.
WP_Mock::userFunction(
	'wp_generate_password',
	[
		'return' => 'mock_password', // Replace with the value you want the function to return.
	]
);

// Mock the is_user_logged_in function.
WP_Mock::userFunction(
	'is_user_logged_in',
	[
		'return' => true,
	]
);


// Mock the get_post_type function.
WP_Mock::userFunction(
	'get_post_type',
	[
		'return' => 'post', // Replace with the value you want the function to return.
	]
);


// Mock shortcode_atts function.
WP_Mock::userFunction(
	'shortcode_atts',
	[
		'args'   => [ Mockery::type( 'array' ), Mockery::type( 'array' ) ],
		'return' => function ( $pairs, $atts ) {
			// Merge user-defined attributes with defaults.
			return array_merge( $pairs, $atts );
		},
	]
);


/**
 * Mock the get_post_types function for testing purposes.
 */
WP_Mock::userFunction(
	'get_post_types',
	[
		'return' => [
			'post'    => 'Post',
			'page'    => 'Page',
			'product' => 'Product',
			'recipe'  => 'Recipe',
		],
	]
);

