<?php
/**
 * PHPUnit bootstrap file
 *
 * @package WP_React_Skeleton
 */

/**
 * First we need to load the composer autoloader, so we can use WP Mock.
 */
require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap WP_Mock to initialize built-in features.
WP_Mock::bootstrap();

WP_Mock::userFunction(
	'plugin_dir_path',
	[
		'return' => __DIR__ . '/',
	]
);

WP_Mock::userFunction(
	'plugin_dir_url',
	[
		'return' => '/wp-content/plugins/wp-react-plugin-skeleton/',
	]
);

require_once __DIR__ . '/wp-react-plugin-skeleton.php';
