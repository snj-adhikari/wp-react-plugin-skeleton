<?php
/**
 * Plugin Name: React Plugin Skeleton
 * Plugin URI: https://example.com
 * Description: A plugin skeleton for integrating React with WordPress.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * License: GPL2
 */

// Enqueue frontend script
function enqueue_frontend_script() {
	$asset_file = include( plugin_dir_path( __FILE__ ) . 'dist/frontend.asset.php' );
	wp_enqueue_script( 'frontend-script', plugin_dir_url( __FILE__ ) . 'dist/frontend.js', $asset_file['dependencies'], $asset_file['version'], true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_frontend_script' );

// Enqueue admin script
function enqueue_admin_script() {
	$asset_file = include( plugin_dir_path( __FILE__ ) . 'dist/blocks.asset.php' );
	wp_enqueue_script( 'admin-script', plugin_dir_url( __FILE__ ) . 'dist/blocks.js', $asset_file['dependencies'], $asset_file['version'], true );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_script' );

// Enqueue option page script
function enqueue_option_page_script() {
	if ( isset( $_GET['page'] ) && $_GET['page'] === 'react-page' ) {
		$asset_file = include( plugin_dir_path( __FILE__ ) . 'dist/option-page.asset.php' );
		wp_enqueue_script( 'option-page-script', plugin_dir_url( __FILE__ ) . 'dist/option-page.js', $asset_file['dependencies'], $asset_file['version'], true );
	}
}
add_action( 'admin_enqueue_scripts', 'enqueue_option_page_script' );

// Add a new menu page
function add_custom_menu_page() {
	add_menu_page(
		'React Plugin Page',
		'React Plugin Page',
		'manage_options',
		'react-page',
		'custom_page_callback',
		'dashicons-admin-generic',
		6
	);
}
add_action( 'admin_menu', 'add_custom_menu_page' );

// Callback function for the custom menu page
function custom_page_callback() {
	echo '<h1>Custom Page</h1>';
	echo '<div id="react-plugin-page"></div>';
	// Add your custom page content here
}
