<?php
/**
 * Plugin Name: Wp React Plugin Skeleton.
 * Plugin URI: https://github.com/snj-adhikari/wp-react-plugin-skeleton
 * Description: A plugin to get report on keywords and also can replace the keywords with a link.
 * Version: 1.2
 * Author: Sanjay Adhikari ( Not Just Web )
 * Author URI: https://notjustweb.com/
 * License: GPL2.
 *
 * @package wp-react-plugin-skeleton
 */

if ( ! defined( 'WP_REACT_SKELETON_PLUGIN_FILE' ) ) {
	define( 'WP_REACT_SKELETON_PLUGIN_FILE', __FILE__ );
}
if ( ! defined( 'WP_REACT_SKELETON_DIR' ) ) {
	define( 'WP_REACT_SKELETON_DIR', dir( WP_REACT_SKELETON_PLUGIN_FILE ) );
}

/**
 * Enqueues frontend assets for the WP Skeleton React plugin.
 *
 * This function is responsible for enqueueing the necessary CSS and JavaScript files
 * required for the frontend functionality of the WP Skeleton React plugin.
 *
 * @since 1.0.0
 */
function wp_skeleton_enqueue_frontend_assets() {

	$asset_file_path = WP_REACT_SKELETON_DIR . 'dist/frontend.asset.php';
	// Check if the file exists, if not, set default values.
	$asset_file = [
		'dependencies' => [],
		'version'      => '1.0.0',
	];

	if ( file_exists( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	}

	wp_enqueue_script( 'frontend-script', WP_REACT_SKELETON_DIR . 'dist/frontend.js', $asset_file['dependencies'], $asset_file['version'], true );
	wp_enqueue_style( 'frontend-style', WP_REACT_SKELETON_DIR . 'dist/frontend.css', [], $asset_file['version'] );
}
add_action( 'wp_enqueue_scripts', 'wp_skeleton_enqueue_frontend_assets' );

/**
 * Enqueues the necessary admin assets for the WP Skeleton React plugin.
 *
 * This function is responsible for enqueueing the CSS and JavaScript files required for the admin area of the WP Skeleton React plugin.
 * It should be called within the admin_enqueue_scripts action hook.
 *
 * @since 1.0.0
 */
function wp_skeleton_enqueue_admin_assets() {
	$asset_file_path = WP_REACT_SKELETON_DIR . 'dist/blocks.asset.php';
	$asset_file      = [
		'dependencies' => [],
		'version'      => '1.0.0',
	];

	if ( file_exists( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	}
	wp_enqueue_script( 'admin-script', WP_REACT_SKELETON_DIR . 'dist/blocks.js', $asset_file['dependencies'], $asset_file['version'], true );
	wp_enqueue_style( 'admin-style', WP_REACT_SKELETON_DIR . 'dist/block.css', [], $asset_file['version'] );
}
add_action( 'admin_enqueue_scripts', 'wp_skeleton_enqueue_admin_assets' );

/**
 * Enqueues the necessary assets for the WP Skeleton React plugin option page.
 *
 * This function is responsible for enqueueing the CSS and JavaScript files required for the option page of the WP Skeleton React plugin.
 * It should be called within the admin_enqueue_scripts action hook.
 *
 * @since 1.0.0
 */
function wp_skeleton_enqueue_option_page_assets() {
	// phpcs:ignore
	if ( isset( $_GET['page'] ) && $_GET['page'] === 'wp-skeleton-page' ) {
		$asset_file_path = WP_REACT_SKELETON_DIR . 'dist/option-page.asset.php';
		$asset_file      = [
			'dependencies' => [],
			'version'      => '1.0.0',
		];

		if ( file_exists( $asset_file_path ) ) {
			$asset_file = include $asset_file_path;
		}
		wp_enqueue_script( 'option-page-script', WP_REACT_SKELETON_DIR . 'dist/option-page.js', $asset_file['dependencies'], $asset_file['version'], true );
		wp_enqueue_style( 'option-page-style', WP_REACT_SKELETON_DIR . 'dist/option-page.css', [], $asset_file['version'] );
	}
}
add_action( 'admin_enqueue_scripts', 'wp_skeleton_enqueue_option_page_assets' );

/**
 * Adds a custom menu page to the WordPress admin area.
 *
 * This function adds a custom menu page to the WordPress admin area using the add_menu_page function.
 * The custom menu page will be accessible to users with the manage_options capability.
 *
 * @since 1.0.0
 */
function wp_skeleton_add_custom_menu_page() {
	add_menu_page(
		'WP Skeleton React',
		'WP Skeleton React',
		'edit_posts',  // This is the capability so that editor role can access this page.
		'wp-skeleton-page',
		'wp_skeleton_custom_page_callback',
		'dashicons-analytics',
		4
	);
}
add_action( 'admin_menu', 'wp_skeleton_add_custom_menu_page' );

/**
 * Callback function for the custom menu page.
 *
 * This function is the callback function for the custom menu page added by the wp_skeleton_add_custom_menu_page function.
 * It is responsible for displaying the content of the custom menu page.
 *
 * @since 1.0.0
 */
function wp_skeleton_custom_page_callback() {
	echo '<div id="am-plugin-page"></div>';
	// Add your custom page content here.
}
