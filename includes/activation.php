<?php
/**
 * This file contains Activation used in the Plugin Skeleton application.
 *
 * @package PluginSkeleton\Activation
 * @since 1.0.0
 */

/**
 * Enqueues frontend assets for the WP Skeleton React plugin.
 *
 * This function is responsible for enqueueing the necessary CSS and JavaScript files
 * required for the frontend functionality of the WP Skeleton React plugin.
 *
 * @since 1.0.0
 */
function njw_skeleton_enqueue_frontend_assets() {

	$asset_file = njw_skeleton_load_asset_file( njw_skeleton_get_config( 'PLUGIN_DIR_PATH' ) . 'dist/frontend.asset.php' );

	wp_enqueue_script( 'NJW-frontend-script', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/frontend.js', $asset_file['dependencies'], $asset_file['version'], true );
	wp_enqueue_style( 'NJW-frontend-style', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/frontend.css', [], $asset_file['version'] );
}
add_action( 'wp_enqueue_scripts', 'njw_skeleton_enqueue_frontend_assets' ); // Anything that is not part of block and need to run on frontend.

/**
 * Enqueues the necessary admin assets for the WP Skeleton React plugin.
 *
 * This function is responsible for enqueueing the CSS and JavaScript files required for the admin area of the WP Skeleton React plugin.
 * It should be called within the admin_enqueue_scripts action hook.
 *
 * @since 1.0.0
 */
function njw_skeleton_enqueue_block_assets() {
	$asset_file = njw_skeleton_load_asset_file( njw_skeleton_get_config( 'PLUGIN_DIR_PATH' ) . 'dist/blocks.asset.php' );
	wp_enqueue_script( 'NJW-block-script', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/blocks.js', $asset_file['dependencies'], $asset_file['version'], true );
	wp_enqueue_style( 'NJW-block-style', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/blocks.css', [], $asset_file['version'] );
}
add_action( 'admin_enqueue_scripts', 'njw_skeleton_enqueue_block_assets' ); // It will be used in the admin area.
add_action( 'wp_enqueue_scripts', 'njw_skeleton_enqueue_block_assets' ); // It will be used in the frontend area.

/**
 * Enqueues the necessary assets for the WP Skeleton React plugin option page.
 *
 * This function is responsible for enqueueing the CSS and JavaScript files required for the option page of the WP Skeleton React plugin.
 * It should be called within the admin_enqueue_scripts action hook.
 *
 * @since 1.0.0
 */
function njw_skeleton_enqueue_admin_page_assets() {
	// phpcs:ignore
	if ( isset( $_GET['page'] ) && $_GET['page'] === 'wp-skeleton-page' ) {
		$asset_file = njw_skeleton_load_asset_file( njw_skeleton_get_config( 'PLUGIN_DIR_PATH' ) . 'dist/cms.asset.php');
		wp_enqueue_script( 'NJW-admin-script', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/cms.js', $asset_file['dependencies'], $asset_file['version'], true );
		wp_enqueue_style( 'NJW-admin-style', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/cms.css', [], $asset_file['version'] );
	}
}
add_action( 'admin_enqueue_scripts', 'njw_skeleton_enqueue_admin_page_assets' );

/**
 * Enqueues the necessary assets for the WP Skeleton React plugin option page.
 *
 * This function is responsible for enqueueing the CSS and JavaScript files required for the option page of the WP Skeleton React plugin.
 * It should be called within the admin_enqueue_scripts action hook.
 *
 * @since 1.0.0
 */
function njw_skeleton_enqueue_option_page_assets() {
	// phpcs:ignore
	if ( isset( $_GET['page'] ) && $_GET['page'] === 'njw_skeleton' ) {
		$asset_file = njw_skeleton_load_asset_file( njw_skeleton_get_config( 'PLUGIN_DIR_PATH' ) . 'dist/option-page.asset.php');
		
		wp_enqueue_script( 'NJW-option-page-script', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/NJW-option-page.js', $asset_file['dependencies'], $asset_file['version'], true );
		wp_enqueue_style( 'NJW-option-page-style', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/NJW-option-page.css', [], $asset_file['version'] );
	}
}
add_action( 'admin_enqueue_scripts', 'njw_skeleton_enqueue_option_page_assets' );



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
	echo '<div id="njw-skeleton-react-plugin-page"></div>';
	// Add your custom page content here.
}
