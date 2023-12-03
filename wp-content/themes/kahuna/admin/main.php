<?php
/**
 * Admin theme page
 *
 * @package Kahuna
 */

// Theme particulars
require_once( get_template_directory() . "/admin/defaults.php" );
require_once( get_template_directory() . "/admin/options.php" );
require_once( get_template_directory() . "/includes/tgmpa.php" );

// Custom CSS Styles for customizer
require_once( get_template_directory() . "/includes/custom-styles.php" );

// load up theme options
$cryout_theme_settings = apply_filters( 'kahuna_theme_structure_array', $kahuna_big );
$cryout_theme_options = kahuna_get_theme_options();
$cryout_theme_defaults = kahuna_get_option_defaults();

// Get the theme options and make sure defaults are used if no values are set
//if ( ! function_exists( 'kahuna_get_theme_options' ) ):
function kahuna_get_theme_options() {
	$options = wp_parse_args(
		get_option( 'kahuna_settings', array() ),
		kahuna_get_option_defaults()
	);
	$options = cryout_maybe_migrate_options( $options );
	return apply_filters( 'kahuna_theme_options_array', $options );
} // kahuna_get_theme_options()
//endif;

//if ( ! function_exists( 'kahuna_get_theme_structure' ) ):
function kahuna_get_theme_structure() {
	global $kahuna_big;
	return apply_filters( 'kahuna_theme_structure_array', $kahuna_big );
} // kahuna_get_theme_structure()
//endif;

// backwards compatibility filter for some values that changed format
// this needs to be applied to the options array using WordPress' 'option_{$option}' filter
function kahuna_options_back_compat( $options ){
	if (!empty($options[_CRYOUT_THEME_PREFIX . '_lineheight'])) 		$options[_CRYOUT_THEME_PREFIX . '_lineheight']			= floatval( $options[_CRYOUT_THEME_PREFIX . '_lineheight'] );
	if (!empty($options[_CRYOUT_THEME_PREFIX . '_paragraphspace'])) 	$options[_CRYOUT_THEME_PREFIX . '_paragraphspace'] 		= floatval( $options[_CRYOUT_THEME_PREFIX . '_paragraphspace'] );
	if (!empty($options[_CRYOUT_THEME_PREFIX . '_parindent'])) 			$options[_CRYOUT_THEME_PREFIX . '_parindent'] 			= floatval( $options[_CRYOUT_THEME_PREFIX . '_parindent'] );
	if (!empty($options[_CRYOUT_THEME_PREFIX . '_responsivelimit']))	$options[_CRYOUT_THEME_PREFIX . '_responsivelimit'] 	= intval( $options[_CRYOUT_THEME_PREFIX . '_responsivelimit'] );
	return $options;
} //
add_filter( 'option_kahuna_settings', 'kahuna_options_back_compat' );

// Hooks/Filters
add_action( 'admin_menu', 'kahuna_add_page_fn' );

// Add admin scripts
function kahuna_admin_scripts( $hook ) {
	global $kahuna_page;
	if( $kahuna_page != $hook ) {
        	return;
	}

	wp_enqueue_style( 'wp-jquery-ui-dialog' );
	wp_enqueue_style( 'kahuna-admin-style', esc_url( get_template_directory_uri() . '/admin/css/admin.css' ), NULL, _CRYOUT_THEME_VERSION );
	wp_enqueue_script( 'kahuna-admin-js', esc_url( get_template_directory_uri() . '/admin/js/admin.js' ), array('jquery-ui-dialog'), _CRYOUT_THEME_VERSION );
	$js_admin_options = array(
		'reset_confirmation' => esc_html( __( 'Reset Kahuna Settings to Defaults?', 'kahuna' ) ),
	);
	wp_localize_script( 'kahuna-admin-js', 'cryout_admin_settings', $js_admin_options );
}

// Create admin subpages
function kahuna_add_page_fn() {
	global $kahuna_page;
	$kahuna_page = add_theme_page( __( 'Kahuna Theme', 'kahuna' ), __( 'Kahuna Theme', 'kahuna' ), 'edit_theme_options', 'about-kahuna-theme', 'kahuna_page_fn' );
	add_action( 'admin_enqueue_scripts', 'kahuna_admin_scripts' );
} // kahuna_add_page_fn()

// Display the admin options page

function kahuna_page_fn() {

	if (!current_user_can('edit_theme_options'))  {
		wp_die( __( 'Sorry, but you do not have sufficient permissions to access this page.', 'kahuna') );
	}

?>

<div class="wrap" id="main-page"><!-- Admin wrap page -->
	<div id="lefty">
	<?php
	// Reset settings to defaults if the reset button has been pressed
	if ( isset( $_POST['cryout_reset_defaults'] ) ) {
		delete_option( 'kahuna_settings' ); ?>
		<div class="updated fade">
			<p><?php _e('Kahuna settings have been reset successfully.', 'kahuna') ?></p>
		</div> <?php
	} ?>

		<div id="admin_header">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/admin/images/logo-about-top.png' ) ?>" />
			<span class="version">
				<?php echo wp_kses_post( apply_filters( 'cryout_admin_version', sprintf( __( 'Kahuna Theme v%1$s by %2$s', 'kahuna' ),
					_CRYOUT_THEME_VERSION,
					'<a href="https://www.cryoutcreations.eu" target="_blank">Cryout Creations</a>'
				) ) ); ?><br>
				<?php do_action( 'cryout_admin_version' ); ?>
			</span>
		</div>

		<div id="admin_links">
			<a href="https://www.cryoutcreations.eu/wordpress-themes/kahuna" target="_blank"><?php _e( 'Kahuna Homepage', 'kahuna' ) ?></a>
			<a href="https://www.cryoutcreations.eu/forums/f/wordpress/kahuna" target="_blank"><?php _e( 'Theme Support', 'kahuna' ) ?></a>
			<a class="blue-button" href="https://www.cryoutcreations.eu/wordpress-themes/kahuna#cryout-comparison-section" target="_blank"><?php _e( 'Upgrade to Plus', 'kahuna' ) ?></a>
		</div>


		<div id="description">
			<?php
				$theme = wp_get_theme();
				echo wp_kses_post( apply_filters( 'cryout_theme_description', esc_html( $theme->get( 'Description' ) ) ) );
			?>
		</div>

		<div id="customizer-container">
			<a class="button" href="customize.php" id="customizer"> <?php _e( 'Customize', 'kahuna' ); ?> </a>
			<form action="" method="post" id="defaults" id="defaults">
				<input type="hidden" name="cryout_reset_defaults" value="true" />
				<input type="submit" class="button" id="cryout_reset_defaults" value="<?php _e( 'Reset to Defaults', 'kahuna' ); ?>" />
			</form>
		</div>

	</div><!--lefty -->


	<div id="righty">
		<div id="cryout-donate" class="postbox donate">

			<h3 class="hndle"><?php _e( 'Upgrade to Plus', 'kahuna' ); ?></h3>
			<div class="inside">
				<p><?php printf( __('Find out what features you\'re missing out on and how the Plus version of %1$s can improve your site.', 'kahuna'), cryout_sanitize_tnl( _CRYOUT_THEME_NAME ) )  ?></p>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/admin/images/features.png' ) ?>" />
				<a class="button" href="https://www.cryoutcreations.eu/wordpress-themes/kahuna" target="_blank" style="display: block;"><?php _e( 'Upgrade to Plus', 'kahuna' ); ?></a>

			</div><!-- inside -->

		</div><!-- donate -->


	</div><!--  righty -->
</div><!--  wrap -->

<?php
} // kahuna_page_fn()
