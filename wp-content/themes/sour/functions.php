<?php
/****************************
*
* Sour v1.0.0 - A Kahuna Child Theme
* (c) 2023 Cryout Creations
* www.cryoutcreations.eu
*
*****************************/

/**
 * Load additional theme files
 */
require_once( get_stylesheet_directory() . '/includes/admin.php' );
require_once( get_stylesheet_directory() . '/includes/options.php' );
require_once( get_stylesheet_directory() . '/includes/notices.php' );
require_once( get_stylesheet_directory() . "/includes/custom-styles.php" );

/**
 * Enqueue parent styling
 */
function sour_child_styling(){
	wp_enqueue_style( 'kahuna-main', get_template_directory_uri() . '/style.css', array(), _CRYOUT_THEME_VERSION );  // restore correct parent stylesheet
	wp_enqueue_style( 'sour', get_stylesheet_directory_uri() . '/style.css', array( 'kahuna-main' ), _CRYOUT_THEME_VERSION  ); 		// enqueue child stylesheet
}
add_action( 'wp_enqueue_scripts', 'sour_child_styling' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function sour_setup() {

	// Add support for flexible headers
	add_theme_support( 'custom-header', array(
		'default-image'	=> get_stylesheet_directory_uri() . '/resources/images/headers/sour.jpg',
	));

	// Default custom headers packaged with the theme.
	register_default_headers( array(
		'sour' => array(
			'url' => '%2$s/resources/images/headers/sour.jpg',
			'thumbnail_url' => '%2$s/resources/images/headers/sour.jpg',
			'description' => __( 'Sour', 'sour' )
		),
	) );

	// Filters
	add_filter( 'kahuna_custom_styles', 'sour_custom_styles' );
	add_filter( 'cryout_theme_description', 'sour_custom_description' );
	add_filter( 'cryout_admin_version', 'sour_admin_version_output' );

	// Initialize first time notice
	new Cryout_Notice( array(
		'slug' => 'sour',
		'strings' => array(
			// translators: %1 is theme name, %2 is next string
			1 => esc_html__( 'It appears that you might have already configured %1$s. For best results it is recommended to %2$s upon child theme activation.', 'sour' ),
			2 => esc_html__( 'reset the theme settings', 'sour' ),
			3 => esc_html__( 'If you have already reset the options it is safe to dismiss this message.', 'sour' ),
			4 => esc_html__( 'Do not display again', 'sour' ),
		),
	) );

} // sour_setup()
add_action( 'after_setup_theme', 'sour_setup' );


/* FIN */
