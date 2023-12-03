<?php

/**
 * Defaults
 */
function sour_defaults( $defaults = array() ) {

	$sour_defaults = array(

		"kahuna_lpsliderimage"		=> esc_url( get_stylesheet_directory_uri() . '/resources/images/slider/sour.jpg' ),
		"kahuna_menuheight"			=> 85,
		"kahuna_headerheight"		=> 450,

		"kahuna_fheight"			=> 350,

		"kahuna_overlayopacity"		=> 80,
		"kahuna_overlaybackground"	=> "#f2af29",

		"kahuna_sitebackground" 	=> "#f2af29",
		"kahuna_sitetext" 			=> "#576b6a",
		"kahuna_headingstext"		=> "#006c67",
		"kahuna_contentbackground"	=> "#ffffff",
		"kahuna_accent1" 			=> "#fa824c",
		"kahuna_accent2" 			=> "#4e8b09",
		"kahuna_menubackground"		=> "#FFFFFF",
		"kahuna_menutext" 			=> "#576b6a",
		"kahuna_submenutext" 		=> "#576b6a",

		"kahuna_footerbackground" 	=> "#00352f",
		"kahuna_footertext" 		=> "#FFFFFF",

		// "kahuna_fgeneral" 	=> '',
		"kahuna_fgeneralgoogle" 	=> 'Baloo Tamma 2: 400,300,700',
		"kahuna_fgeneralsize" 		=> '17px',
		"kahuna_fgeneralweight" 	=> '400',

		"kahuna_fsitetitle" 		=> 'inherit',
		// "kahuna_fsitetitle"		=> '',
		"kahuna_fsitetitlesize" 	=> '130%',
		"kahuna_fsitetitleweight"	=> '700',

		"kahuna_fmenu" 				=> 'inherit',
		// "kahuna_fmenugoogle"		=> '',
		"kahuna_fmenusize" 			=> '100%',
		"kahuna_fmenuweight"		=> '400',

		"kahuna_ftitles" 			=> 'inherit',
		//"kahuna_ftitlesgoogle"	=> '',
		"kahuna_ftitlessize" 		=> '250%',
		"kahuna_ftitlesweight"		=> '400',

		"kahuna_metatitles" 		=> 'inherit',
		// "kahuna_metatitlesgoogle"=> '',
		"kahuna_metatitlessize" 	=> '100%',
		"kahuna_metatitlesweight"	=> '400',

		"kahuna_fheadings" 			=> 'inherit',
		// "kahuna_fheadingsgoogle"	=> '',
		"kahuna_fheadingssize" 		=> '120%',
		"kahuna_fheadingsweight"	=> '400',

		"kahuna_fwtitle" 			=> 'inherit',
		// "kahuna_fwtitlegoogle"	=> '',
		"kahuna_fwtitlesize" 		=> '120%',
		"kahuna_fwtitleweight"		=> '400',

		"kahuna_fwcontent" 			=> 'inherit',
		// "kahuna_fwcontentgoogle"	=> '',
		"kahuna_fwcontentsize" 		=> '100%',
		"kahuna_fwcontentweight"	=> '400',

		"kahuna_excerptlength"		=> 35,
		"kahuna_excerptcont"		=> __( 'Read more', 'sour' ),

	); // sour_defaults array

	$result = array_merge( $defaults, $sour_defaults );

	return $result;

} // sour_defaults()
add_filter( 'kahuna_option_defaults_array', 'sour_defaults' );

// needed? for the .org preview
function sour_filter_defaults(){
	add_filter( 'kahuna_option_defaults_array', 'sour_defaults' );
} // sour_filter_defaults()
add_action( 'customize_register', 'sour_filter_defaults' );


/**
 * Handle theme labels in customize panels
 */
function sour_about_theme_name( $initial ) {
	return __( 'About Sour', 'sour' );
} // sour_about_theme_name()
add_filter( 'cryout_about_theme_name', 'sour_about_theme_name' );

function sour_about_theme_plus_desc( $initial ) {
	$theme = wp_get_theme();
	// translators: %1$s is the name of the child theme, %2$s is the name of the parent theme
	return '<h3>' . sprintf( esc_html__( '%1$s is a child theme of %2$s', 'sour' ), esc_html( $theme->get( 'Name' ) ), ucwords( esc_html( $theme->get( 'Template' ) ) ) ) . '</h3>' . $initial;
} // sour_about_theme_plus_desc()
add_filter( 'cryout_about_theme_plus_desc', 'sour_about_theme_plus_desc' );

function sour_about_theme_slug_swap( $initial ){
	return str_replace( array( 'kahuna', 'Kahuna' ), array( 'sour', 'Sour' ), $initial );
} // sour_about_theme_slug_swap()
add_filter( 'cryout_about_theme_review_link', 'sour_about_theme_slug_swap' );
add_filter( 'cryout_about_theme_manage_link', 'sour_about_theme_slug_swap' );

// FIN
