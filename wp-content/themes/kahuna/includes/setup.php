<?php
/*
 * Theme setup functions. Theme initialization, add_theme_support(), widgets, navigation
 *
 * @package Kahuna
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
add_action( 'after_setup_theme', 'kahuna_content_width' ); // mostly for dashboard
add_action( 'template_redirect', 'kahuna_content_width' );

/** Tell WordPress to run kahuna_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'kahuna_setup' );


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function kahuna_setup() {

	add_filter( 'kahuna_theme_options_array', 'kahuna_lpbox_width' );

	$options = cryout_get_option();

	// This theme styles the visual editor with editor-style.css to match the theme style.
	if ($options['kahuna_editorstyles']) add_editor_style( 'resources/styles/editor-style.css' );

	// Support title tag since WP 4.1
	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add HTML5 support
	add_theme_support( 'html5', array( 'script', 'style', 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Add post formats
	add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'audio', 'video' ) );

	// Make theme available for translation
	load_theme_textdomain( 'kahuna', get_template_directory() . '/cryout/languages' );
	load_theme_textdomain( 'kahuna', get_template_directory() . '/languages' );
	load_textdomain( 'cryout', '' );

	// This theme allows users to set a custom backgrounds
	add_theme_support( 'custom-background' );

	// This theme supports WordPress 4.5 logos
	add_theme_support( 'custom-logo', array( 'height' => (int) $options['kahuna_headerheight'], 'width' => 240, 'flex-height' => true, 'flex-width'  => true ) );
	add_filter( 'get_custom_logo', 'cryout_filter_wp_logo_img' );

	// This theme uses wp_nav_menu() in 3 locations.
	register_nav_menus( array(
		'primary'	=> __( 'Primary Navigation', 'kahuna' ),
		'sidebar'	=> __( 'Left Sidebar', 'kahuna' ),
		'footer'	=> __( 'Footer Navigation', 'kahuna' ),
		'socials'	=> __( 'Social Icons', 'kahuna' ),
	) );

	$fheight = $options['kahuna_fheight'];
	$falign = (bool)$options['kahuna_falign'];
	if (false===$falign) {
		$fheight = 0;
	} else {
		$falign = explode( ' ', $options['kahuna_falign'] );
		if (!is_array($falign) ) $falign = array( 'center', 'center' ); //failsafe
	}

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(
		// default Post Thumbnail dimensions
		apply_filters( 'kahuna_thumbnail_image_width', kahuna_featured_width() ),
		apply_filters( 'kahuna_thumbnail_image_height', $options['kahuna_fheight'] ),
		false
	);
	// Custom image size for use with post thumbnails
	add_image_size( 'kahuna-featured',
		apply_filters( 'kahuna_featured_image_width', kahuna_featured_width() ),
		apply_filters( 'kahuna_featured_image_height', $fheight ),
		$falign
	);

	// Additional responsive image sizes
	add_image_size( 'kahuna-featured-lp',
		apply_filters( 'kahuna_featured_image_lp_width', ceil( $options['kahuna_sitewidth'] / apply_filters( 'kahuna_lppostslayout_filter', $options['kahuna_magazinelayout'] ) ) ),
		apply_filters( 'kahuna_featured_image_lp_height', $options['kahuna_fheight'] ),
		$falign
	);
	add_image_size( 'kahuna-featured-half',
		apply_filters( 'kahuna_featured_image_half_width', 800 ),
		apply_filters( 'kahuna_featured_image_falf_height', $options['kahuna_fheight'] ),
		$falign
	);
	add_image_size( 'kahuna-featured-third',
		apply_filters( 'kahuna_featured_image_third_width', 512 ),
		apply_filters( 'kahuna_featured_image_third_height', $options['kahuna_fheight'] ),
		$falign
	);

	// Boxes image sizes
	add_image_size( 'kahuna-lpbox-1', $options['kahuna_lpboxwidth1'], $options['kahuna_lpboxheight1'], true );
	add_image_size( 'kahuna-lpbox-2', $options['kahuna_lpboxwidth2'], $options['kahuna_lpboxheight2'], true );

	// Add support for flexible headers
	add_theme_support( 'custom-header', array(
		'flex-height' 	=> true,
		'height'		=> (int) $options['kahuna_headerheight'],
		'flex-width'	=> true,
		'width'			=> 1920,
		'default-image'	=> get_template_directory_uri() . '/resources/images/headers/lunch.jpg',
		'video'         => true,
	));

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'lunch' => array(
			'url' => '%s/resources/images/headers/lunch.jpg',
			'thumbnail_url' => '%s/resources/images/headers/lunch.jpg',
			'description' => __( 'lunch', 'kahuna' )
		),
		'cactus' => array(
			'url' => '%s/resources/images/headers/cactus.jpg',
			'thumbnail_url' => '%s/resources/images/headers/cactus.jpg',
			'description' => __( 'cactus', 'kahuna' )
		),
		'intersection' => array(
			'url' => '%s/resources/images/headers/intersection.jpg',
			'thumbnail_url' => '%s/resources/images/headers/intersection.jpg',
			'description' => __( 'intersection', 'kahuna' )
		),
		'creative' => array(
			'url' => '%s/resources/images/headers/creative.jpg',
			'thumbnail_url' => '%s/resources/images/headers/creative.jpg',
			'description' => __( 'creative', 'kahuna' )
		),
	) );

	// Gutenberg
	// add_theme_support( 'wp-block-styles' ); // apply default block styles
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'Accent #1', 'kahuna' ),
			'slug' => 'accent-1',
			'color' => $options['kahuna_accent1'],
		),
		array(
			'name' => __( 'Accent #2', 'kahuna' ),
			'slug' => 'accent-2',
			'color' => $options['kahuna_accent2'],
		),
		array(
			'name' => __( 'Content Headings', 'kahuna' ),
			'slug' => 'headings',
			'color' => $options['kahuna_headingstext'],
		),
 		array(
			'name' => __( 'Site Text', 'kahuna' ),
			'slug' => 'sitetext',
			'color' => $options['kahuna_sitetext'],
		),
		array(
			'name' => __( 'Content Background', 'kahuna' ),
			'slug' => 'sitebg',
			'color' => $options['kahuna_contentbackground'],
		),
 	) );
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'small', 'cryout' ),
			'shortName' => __( 'S', 'cryout' ),
			'size' => intval( intval( $options['kahuna_fgeneralsize'] ) / 1.6 ),
			'slug' => 'small'
		),
		array(
			'name' => __( 'normal', 'cryout' ),
			'shortName' => __( 'M', 'cryout' ),
			'size' => intval( intval( $options['kahuna_fgeneralsize'] ) * 1.0 ),
			'slug' => 'normal'
		),
		array(
			'name' => __( 'large', 'cryout' ),
			'shortName' => __( 'L', 'cryout' ),
			'size' => intval( intval( $options['kahuna_fgeneralsize'] ) * 1.6 ),
			'slug' => 'large'
		),
		array(
			'name' => __( 'larger', 'cryout' ),
			'shortName' => __( 'XL', 'cryout' ),
			'size' => intval( intval( $options['kahuna_fgeneralsize'] ) * 2.56 ),
			'slug' => 'larger'
		)
	) );

	// WooCommerce compatibility
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

} // kahuna_setup()

function kahuna_gutenberg_editor_styles() {
	$editorstyles = cryout_get_option('kahuna_editorstyles');
	if ( ! $editorstyles ) return;
	wp_enqueue_style( 'kahuna-gutenberg-editor-styles', get_theme_file_uri( '/resources/styles/gutenberg-editor.css' ), false, _CRYOUT_THEME_VERSION, 'all' );
	wp_add_inline_style( 'kahuna-gutenberg-editor-styles', preg_replace( "/[\n\r\t\s]+/", " ", kahuna_editor_styles() ) );
}
add_action( 'enqueue_block_editor_assets', 'kahuna_gutenberg_editor_styles' );

/*
 * Have two textdomains work with translation systems.
 * https://gist.github.com/justintadlock/7a605c29ae26c80878d0
 */
function kahuna_override_load_textdomain( $override, $domain ) {
	// Check if the domain is our framework domain.
	if ( 'cryout' === $domain ) {
		global $l10n;
		// If the theme's textdomain is loaded, assign the theme's translations
		// to the framework's textdomain.
		if ( isset( $l10n[ 'kahuna' ] ) )
			$l10n[ $domain ] = $l10n[ 'kahuna' ];
		// Always override.  We only want the theme to handle translations.
		$override = true;
	}
	return $override;
}
add_filter( 'override_load_textdomain', 'kahuna_override_load_textdomain', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function kahuna_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'kahuna_page_menu_args' );

/**
 * Custom menu fallback, using wp_page_menu()
 * Created to make the fallback menu have the same HTML structure as the default
 */
function kahuna_default_menu() {
    wp_page_menu($args = array(
		'menu_class'	=> '',
		'before' 		=> '<ul id="prime_nav">',
		'after' 		=> '</ul>'
	));
}

/** Main menu */
function kahuna_main_menu() { ?>
	<?php
	wp_nav_menu( array(
		'container'		=> '',
		'menu_id'		=> 'prime_nav',
		'menu_class'	=> '',
		'theme_location'=> 'primary',
		'link_before'	=> '<span>',
		'link_after'	=> '</span>',
		'items_wrap'	=> '<div><ul id="%s" class="%s">%s</ul></div>',
		'fallback_cb' 	=> 'kahuna_default_menu'

	) );
} // kahuna_main_menu()
add_action ( 'cryout_access_hook', 'kahuna_main_menu' );

/** Mobile menu */
function kahuna_mobile_menu() {
	wp_nav_menu( array(
		'container'		=> '',
		'menu_id'		=> 'mobile-nav',
		'menu_class'	=> '',
		'theme_location'=> 'primary',
		'link_before'	=> '<span>',
		'link_after'	=> '</span>',
		'items_wrap'	=> '<div><ul id="%s" class="%s">%s</ul></div>'
	) );
} // kahuna_mobile_menu()
add_action ( 'cryout_mobilemenu_hook', 'kahuna_mobile_menu' );

/** Left sidebar menu */
function kahuna_sidebar_menu() {
	if ( has_nav_menu( 'sidebar' ) )
		wp_nav_menu( array(
			'container'			=> 'nav',
			'container_class'	=> 'sidebarmenu widget-container',
			'theme_location'	=> 'sidebar',
			'depth'				=> 1
		) );
} // kahuna_sidebar_menu()
add_action ( 'cryout_before_primary_widgets_hook', 'kahuna_sidebar_menu' , 10 );

/** Footer menu */
function kahuna_footer_menu() {
	if ( has_nav_menu( 'footer' ) )
		wp_nav_menu( array(
			'container' 		=> 'nav',
			'container_class'	=> 'footermenu',
			'theme_location'	=> 'footer',
			'after'				=> '<span class="sep">-</span>',
			'depth'				=> 1
		) );
} // kahuna_footer_menu()
add_action ( 'cryout_master_footerbottom_hook', 'kahuna_footer_menu' , 10 );

/** SOCIALS MENU */
function kahuna_socials_menu( $location ) {
	if ( has_nav_menu( 'socials' ) )
		echo strip_tags(
			wp_nav_menu( array(
				'container' => 'nav',
				'container_class' => 'socials',
				'container_id' => $location,
				'theme_location' => 'socials',
				'link_before' => '<span>',
				'link_after' => '</span>',
				'depth' => 0,
				'items_wrap' => '%3$s',
				'walker' => new Cryout_Social_Menu_Walker(),
				'echo' => false,
			) ),
		'<a><div><span><nav>'
		);
} //kahuna_socials_menu()
function kahuna_socials_menu_header() { kahuna_socials_menu( 'sheader' ); }
function kahuna_socials_menu_footer() { kahuna_socials_menu( 'sfooter' ); }
function kahuna_socials_menu_left()   { kahuna_socials_menu( 'sleft' );   }
function kahuna_socials_menu_right()  { kahuna_socials_menu( 'sright' );  }

/* Socials hooks moved to master hook in core.php */

/**
 * Register widgetized areas defined by theme options.
 */
function cryout_widgets_init() {
	$areas = cryout_get_theme_structure( 'widget-areas' );
	if ( ! empty( $areas ) ):
		foreach ( $areas as $aid => $area ):
			register_sidebar( array(
				'name' 			=> $area['name'],
				'id' 			=> $aid,
				'description' 	=> ( isset( $area['description'] ) ? $area['description'] : '' ),
				'before_widget' => $area['before_widget'],
				'after_widget' 	=> $area['after_widget'],
				'before_title' 	=> $area['before_title'],
				'after_title' 	=> $area['after_title'],
			) );
		endforeach;
	endif;
} // cryout_widgets_init()
add_action( 'widgets_init', 'cryout_widgets_init' );

/**
 * Creates different class names for footer widgets depending on their number.
 * This way they can fit the footer area.
 */
function kahuna_footer_colophon_class() {
	$opts = cryout_get_option( array( 'kahuna_footercols', 'kahuna_footeralign' ) );
	$class = '';
	switch ( $opts['kahuna_footercols'] ) {
		case '0': 	$class = 'all';		break;
		case '1':	$class = 'one';		break;
		case '2':	$class = 'two';		break;
		case '3':	$class = 'three';	break;
		case '4':	$class = 'four';	break;
	}
	if ( !empty($class) ) echo 'class="footer-' . esc_attr( $class ) . ' ' . ( $opts['kahuna_footeralign'] ? 'footer-center' : '' ) . '"';
} // kahuna_footer_colophon_class()

/**
 * Set up widget areas
 */
function kahuna_widget_header() {
	$headerimage_on_lp = cryout_get_option( 'kahuna_lpslider' );
	if ( is_active_sidebar( 'widget-area-header' ) && ( !cryout_on_landingpage() || ( cryout_on_landingpage() && ($headerimage_on_lp == 3) ) ) ) { ?>
		<aside id="header-widget-area" <?php cryout_schema_microdata( 'sidebar' ); ?>>
			<?php dynamic_sidebar( 'widget-area-header' ); ?>
		</aside><?php
	}
} // kahuna_widget_header()

function kahuna_widget_before() {
	if ( is_active_sidebar( 'content-widget-area-before' ) ) { ?>
		<aside class="content-widget content-widget-before" <?php cryout_schema_microdata( 'sidebar' ); ?>>
			<?php dynamic_sidebar( 'content-widget-area-before' ); ?>
		</aside><!--content-widget--><?php
	}
} //kahuna_widget_before()

function kahuna_widget_after() {
	if ( is_active_sidebar( 'content-widget-area-after' ) ) { ?>
		<aside class="content-widget content-widget-after" <?php cryout_schema_microdata( 'sidebar' ); ?>>
			<?php dynamic_sidebar( 'content-widget-area-after' ); ?>
		</aside><!--content-widget--><?php
	}
} //kahuna_widget_after()

add_action( 'cryout_header_widget_hook',  'kahuna_widget_header' );
add_action( 'cryout_before_content_hook', 'kahuna_widget_before' );
add_action( 'cryout_after_content_hook',  'kahuna_widget_after' );

/* FIN */
