<?php
/**
 * PHPUnit bootstrap file
 *
 * @package NJW_Skeleton
 */

/**
 * First we need to load the composer autoloader, so we can use WP Mock.
 */
require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap WP_Mock to initialize built-in features.
WP_Mock::bootstrap();

/**
 * Load the bootstrap global mock function.
 */
require_once __DIR__ . '/bootstrap-wp-mock.php';


/**
 * Load the plugin files.
 */
require_once __DIR__ . '/njw-skeleton-react-plugin.php';