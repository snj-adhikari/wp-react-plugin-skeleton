<?php
/**
 * Plugin Name: Wp React Plugin Skeleton.
 * Plugin URI: https://github.com/snj-adhikari/wp-react-plugin-skeleton
 * Description: A getting started template for WordPress plugin development using React and typescript.
 * Version: 1.0.0
 * Author: Sanjay Adhikari ( Not Just Web )
 * Author URI: https://notjustweb.com/
 * License: GPL2.
 *
 * @package PluginSkeleton
 */

$plugin_dir_path = plugin_dir_path( __FILE__ );
$plugin_dir_url  = plugin_dir_url( __FILE__ );
$file_path       = __FILE__;

require $plugin_dir_path . 'includes/config.php';

// Register the config.
njw_skeleton_define_constant_with_prefix( 'PLUGIN_DIR_PATH', $plugin_dir_path );
njw_skeleton_define_constant_with_prefix( 'PLUGIN_DIR_URL', $plugin_dir_url );
njw_skeleton_define_constant_with_prefix( 'PLUGIN_FILE_NAME', $plugin_dir_path );

require $plugin_dir_path . 'includes/helpers.php';
require $plugin_dir_path . 'includes/activation.php';
require $plugin_dir_path . 'includes/setting-page.php';
require $plugin_dir_path . 'includes/api.php';
