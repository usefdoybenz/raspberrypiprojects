<?php

/**
 * Replace parent theme admin page with child theme page to use appropriate theme labelling
 */
function sour_replace_admin_page() {
	remove_action( 'admin_menu', 'kahuna_add_page_fn' );
} // sour_replace_admin_page()
add_action( 'init', 'sour_replace_admin_page', 11 );

function sour_add_page_fn() {
	global $kahuna_page;
	$kahuna_page = add_theme_page( __( 'Sour Theme', 'sour' ), __( 'Sour Theme', 'sour' ), 'edit_theme_options', 'about-sour-theme', 'kahuna_page_fn' );
	add_action( 'admin_enqueue_scripts', 'kahuna_admin_scripts' );
} // sour_add_page_fn()
add_action( 'admin_menu', 'sour_add_page_fn' );

/**
 * Add child theme version to admin page
 */
function sour_admin_version_output( $parent ) {
	$theme = wp_get_theme();
	$name = $theme->get( 'Name' );
	$version = $theme->get( 'Version' );

	// translators: %1$s is the child theme name; %2$s is the child theme version; %3$s is the parent theme name
	return sprintf( __( '<em>%1$s v%2$s</em> &ndash; a child theme of %3$s', 'sour' ), $theme, $version, $parent );
} // sour_admin_version_output()
// this filter is applied in sour_setup()

/**
 * Extend description to reference the use of the child theme
 */
function sour_custom_description( $description ) {
	// Child theme
	$theme = wp_get_theme();
	$template = esc_html( $theme->get( 'Template' ) );
	$name = esc_html( $theme->get( 'Name' ) );

	// Parent theme
	$template_theme = wp_get_theme( $template );
	$template_desc = $template_theme->get( 'Description');

	// translators: %1$s is the name of the child theme; %2$s is the name of the parent theme
	$output = '<h3>' . sprintf( esc_html__( '%1$s is a child theme of %2$s', 'sour' ), $name,  ucfirst( $template ) ) . '</h3>';

	return  $output . $description . '<br><br><hr><br><em>' . $template_desc . '</em>';
} // sour_custom_description()
// this filter is added in sour_setup()


// FIN
