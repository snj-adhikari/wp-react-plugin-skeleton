<?php
/**
 * This file contains setting page used in the NJW Skeleton application.
 *
 * @package Aremedia\Trackonomics\SettingPage
 * @since 1.0.0
 */

add_action( 'admin_menu', 'njw_skeleton__add_admin_menu' );
add_action( 'admin_init', 'njw_skeleton__settings_init' );


/**
 * Adds the admin menu for the NJW Skeleton settings page.
 *
 * This function is responsible for adding the NJW Skeleton settings page to the WordPress admin menu.
 * It is called during the `admin_menu` action hook.
 *
 * @since 1.0.0
 */
function njw_skeleton__add_admin_menu() {
	add_options_page( 'NJW Skeleton', 'NJW Skeleton', 'manage_options', 'njw_skeleton', 'njw_skeleton__options_page' );
}


/**
 * Initializes the settings for the NJW Skeleton plugin.
 *
 * This function is responsible for initializing the settings for the NJW Skeleton plugin.
 * It is called during the plugin's initialization process.
 *
 * @since 1.0.0
 */
function njw_skeleton__settings_init() {

	register_setting( 'NJW_SK_Plugin_page', 'njw_skeleton__settings' );
	register_setting( 'NJW_SK_Plugin_page', 'njw_skeleton__api-settings' );


	add_settings_section(
		'NJW_SK_Plugin_page_section',
		__( 'NJW Skeleton - Settings ', 'njw-skeleton' ),
		'njw_skeleton__settings_section_callback',
		'NJW_SK_Plugin_page',
	);
}

/**
 * Callback function for the settings section in the njw_skeleton plugin.
 *
 * This function is responsible for rendering the settings section on the settings page.
 * It is called when the settings page is being displayed.
 *
 * @since 1.0.0
 */
function njw_skeleton__settings_section_callback() {
	njw_skeleton_options_settings_field();
}

/**
 * Renders the options settings field for the NJW Skeleton plugin.
 *
 * This function is responsible for rendering the options settings field in the plugin's settings page.
 * It can be used to display and manage various options related to the plugin's functionality.
 *
 * @since 1.0.0
 */
function njw_skeleton_options_settings_field() {

	$config_value = njw_skeleton_api_config();

	$api_config_constant_name = [
		'API_PROXY_URL' => 'API Proxy URl',
	];

	?>
	<div class="njw-skeleton-config">
		<?php foreach ( $api_config_constant_name as $constant => $constant_label ) : ?>
			<?php
				$setting_name = njw_skeleton_api_config( 'SETTINGS_NAME' );
				$current_name = $setting_name . '[' . $constant . ']';
			?>
			<div class="njw-skeleton-field <?php echo esc_attr( $constant ); ?>">
				<label><?php echo esc_html( $constant_label ); ?> </label> &nbsp; &nbsp;
				<input type="text" name="<?php echo esc_attr( $current_name ); ?>" value="<?php echo esc_attr( $config_value[ $constant ] ); ?>"/>
			</div>
			<br/>
			<br/>
		<?php endforeach; ?>
	</div>
	<?php
}


/**
 * Renders the options page for the NJW Skeleton plugin.
 *
 * This function is responsible for rendering the settings page for the plugin.
 * It is called when the user navigates to the options page in the WordPress admin area.
 *
 * @since 1.0.0
 */
function njw_skeleton__options_page() {
	?>
		<div class="njw-skeleton-setting-page">
			<form action='options.php' method='post'>

				<?php
				settings_fields( 'NJW_SK_Plugin_page' );
				do_settings_sections( 'NJW_SK_Plugin_page' );
				submit_button();
				?>

			</form>
		</div>
		<?php
}


