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
function wp_skeleton_enqueue_frontend_assets() {

	$asset_file_path = njw_skeleton_get_config( 'PLUGIN_DIR_PATH' ) . 'dist/frontend.asset.php';
	// Check if the file exists, if not, set default values.
	$asset_file = [
		'dependencies' => [],
		'version'      => '1.0.0',
	];

	if ( file_exists( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	}

	wp_enqueue_script( 'frontend-script', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/frontend.js', $asset_file['dependencies'], $asset_file['version'], true );
	wp_enqueue_style( 'frontend-style', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/frontend.css', [], $asset_file['version'] );
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
	$asset_file_path = njw_skeleton_get_config( 'PLUGIN_DIR_PATH' ) . 'dist/blocks.asset.php';
	$asset_file      = [
		'dependencies' => [],
		'version'      => '1.0.0',
	];

	if ( file_exists( $asset_file_path ) ) {
		$asset_file = include $asset_file_path;
	}
	wp_enqueue_script( 'admin-script', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/blocks.js', $asset_file['dependencies'], $asset_file['version'], true );
	wp_enqueue_style( 'admin-style', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/blocks.css', [], $asset_file['version'] );
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
function wp_skeleton_enqueue_cms_page_assets() {
	// phpcs:ignore
	if ( isset( $_GET['page'] ) && $_GET['page'] === 'wp-skeleton-page' ) {
		$asset_file_path = njw_skeleton_get_config( 'PLUGIN_DIR_PATH' ) . 'dist/cms.asset.php';
		$asset_file      = [
			'dependencies' => [],
			'version'      => '1.0.0',
		];

		if ( file_exists( $asset_file_path ) ) {
			$asset_file = include $asset_file_path;
		}
		wp_enqueue_script( 'cms-script', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/cms.js', $asset_file['dependencies'], $asset_file['version'], true );
		wp_enqueue_style( 'cms-style', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/cms.css', [], $asset_file['version'] );
	}
}
add_action( 'admin_enqueue_scripts', 'wp_skeleton_enqueue_cms_page_assets' );

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
	if ( isset( $_GET['page'] ) && $_GET['page'] === 'njw_skeleton' ) {
		$asset_file_path = njw_skeleton_get_config( 'PLUGIN_DIR_PATH' ) . 'dist/option-page.asset.php';
		$asset_file      = [
			'dependencies' => [],
			'version'      => '1.0.0',
		];

		if ( file_exists( $asset_file_path ) ) {
			$asset_file = include $asset_file_path;
		}
		wp_enqueue_script( 'option-page-script', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/option-page.js', $asset_file['dependencies'], $asset_file['version'], true );
		wp_enqueue_style( 'option-page-style', njw_skeleton_get_config( 'PLUGIN_DIR_URL' ) . 'dist/option-page.css', [], $asset_file['version'] );
	}
}
add_action( 'admin_enqueue_scripts', 'wp_skeleton_enqueue_option_page_assets' );

/**
 * Enqueue editor script.
 */
function njw_skeleton_editor_script() {
	$asset_file = include njw_skeleton_api_config( 'PLUGIN_DIR_PATH' ) . 'dist/editor.asset.php';
	wp_enqueue_script( 'njw-skeleton-editor-script', njw_skeleton_api_config( 'PLUGIN_DIR_URL' ) . 'dist/editor.js', $asset_file['dependencies'], $asset_file['version'], true );
}
add_action( 'enqueue_block_editor_assets', 'njw_skeleton_editor_script' );

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
	echo '<div id="skeleton-react-plugin-page"></div>';
	// Add your custom page content here.
}
