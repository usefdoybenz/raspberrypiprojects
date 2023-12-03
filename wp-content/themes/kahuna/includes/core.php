<?php
/**
 * Core theme functions
 *
 * @package Kahuna
 */


 /**
  * Calculates the correct content_width value depending on site with and configured layout
  */
if ( ! function_exists( 'kahuna_content_width' ) ) :
function kahuna_content_width() {
	global $content_width;
	$deviation = 0.80;

	$options = cryout_get_option( array(
		'kahuna_sitelayout', 'kahuna_landingpage', 'kahuna_magazinelayout', 'kahuna_sitewidth', 'kahuna_primarysidebar', 'kahuna_secondarysidebar',
   ) );

	$content_width = 0.98 * (int)$options['kahuna_sitewidth'];

	switch( $options['kahuna_sitelayout'] ) {
		case '2cSl': case '3cSl': case '3cSr': case '3cSs': $content_width -= (int)$options['kahuna_primarysidebar']; // primary sidebar
		case '2cSr': case '3cSl': case '3cSr': case '3cSs': $content_width -= (int)$options['kahuna_secondarysidebar']; break; // secondary sidebar
	}

	if ( is_front_page() && $options['kahuna_landingpage'] ) {
		// landing page could be a special case;
		$width = ceil( (int)$content_width / apply_filters('kahuna_lppostslayout_filter', (int)$options['kahuna_magazinelayout']) );
		$content_width = ceil($width);
		return;
	}

	if ( is_archive() ) {
		switch ( $options['kahuna_magazinelayout'] ):
			case 2: $content_width = floor($content_width*0.98/2); break; // magazine-two
			case 3: $content_width = floor($content_width*0.96/3); break; // magazine-three
		endswitch;
	};

	$content_width = floor($content_width*$deviation);

} // kahuna_content_width()
endif;

 /**
  * Calculates the correct featured image width depending on site with and configured layout
  * Used by kahuna_setup()
  */
if ( ! function_exists( 'kahuna_featured_width' ) ) :
function kahuna_featured_width() {

	$options = cryout_get_option( array(
		'kahuna_sitelayout', 'kahuna_landingpage', 'kahuna_magazinelayout', 'kahuna_sitewidth', 'kahuna_primarysidebar', 'kahuna_secondarysidebar',
		'kahuna_lplayout',
	) );
	
	// layout needs to be filtered thorougly
	$options['theme_sitelayout'] = cryout_get_layout( 'theme_sitelayout' );

	$width = (int)$options['kahuna_sitewidth'];

	$deviation = 0.02 * $width; // content to sidebar(s) margin

	if ( in_array( $options['kahuna_sitelayout'], array( '2cSl', '3cSl', '3cSr', '3cSs' ) ) ) {	// primary sidebar
		$width -= (int)$options['kahuna_primarysidebar'] + $deviation;
	};
	if ( in_array( $options['kahuna_sitelayout'], array( '2cSr', '3cSl', '3cSr', '3cSs' ) ) ) {	// secondary sidebar
		$width -= (int)$options['kahuna_secondarysidebar'] + $deviation;
	};

	if ( is_front_page() && $options['kahuna_landingpage'] ) {
		// landing page is a special case
		$width = ceil( (int)$options['kahuna_sitewidth'] / apply_filters('kahuna_lppostslayout_filter', (int)$options['kahuna_magazinelayout'] ) );
		return ceil($width);
	}

	if ( ! is_singular() ) {
		switch ( $options['kahuna_magazinelayout'] ):
			case 2: $width = ceil($width*0.94/2); break; // magazine-two
			case 3: $width = ceil($width*0.88/3); break; // magazine-three
		endswitch;
	};

	return ceil($width);
	// also used on images registration

} // kahuna_featured_width()
endif;


 /**
  * Check if a header image is being used
  * Returns the URL of the image or FALSE
  */
if ( ! function_exists( 'kahuna_header_image_url' ) ) :
function kahuna_header_image_url() {
	$headerlimits = cryout_get_option( 'kahuna_headerlimits' );
	if ($headerlimits) $limit = 0.75; else $limit = 0;

	$kahuna_fheader = apply_filters( 'kahuna_header_image', cryout_get_option( 'kahuna_fheader' ) );
	$kahuna_headerh = floor( cryout_get_option( 'kahuna_headerheight' ) * $limit );
	$kahuna_headerw = floor( cryout_get_option( 'kahuna_sitewidth' ) * $limit );

	// Check if this is a post or page, if it has a thumbnail, and if it's a big one
	$post_id = false; 
	global $post;
	if ( !empty( $post->ID ) ) $post_id = $post->ID;
	
	// Check if static frontpage (but not landing page)
	if ( is_front_page() && ! is_home() && ! cryout_is_landingpage() ) {
		$front_id = get_option( 'page_on_front' );
		if ( !empty( $front_id ) ) $post_id = $front_id;
	}
	// Check if blog page
	if ( cryout_on_blog() ) {
		$blog_id = get_option( 'page_for_posts' );
		if ( !empty( $blog_id ) ) $post_id = $blog_id;
	}
	
	// WooCommerce gets separate handling for its non-page sections
	$woo = false;
	$woo_featured_in_header = apply_filters( 'kahuna_featured_header_in_wc', true );
	if ( $woo_featured_in_header && function_exists ( "is_woocommerce" ) && is_woocommerce() && ! is_singular() ) {
		$shop_id = wc_get_page_id( 'shop' ); // myaccount, edit_address, shop, cart, checkout, pay, view_order, terms
		if ( !empty( $shop_id ) ) {
			$post_id = $shop_id;
			$woo = true;
		}
	}

	// default to general header image 
	$header_image = FALSE;
	if ( get_header_image() != '' ) { $header_image = get_header_image(); }
	
	if ( ( is_singular() || $woo || cryout_on_blog() ) && has_post_thumbnail( $post_id ) && $kahuna_fheader &&
		( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'kahuna-header' ) )
		 ) :
			if ( ( absint($image[1]) >= $kahuna_headerw ) && ( absint($image[2]) >= $kahuna_headerh ) ) {
				// 'header' image is large enough
				$header_image = $image[0];
			} else {
				// 'header' image too small, try 'full' image instead
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
				if ( ( absint($image[1]) >= $kahuna_headerw ) && ( absint($image[2]) >= $kahuna_headerh ) ) {
					// 'full' image is large enough
					$header_image = $image[0];
				}
				// else: even 'full' image is too small, don't return an image
			}
	endif;

	return apply_filters( 'kahuna_header_image_url', $header_image );
} //kahuna_header_image_url()
endif;

/**
 * Header image handler
 * Both as normal img and background image
 */
add_action ( 'cryout_headerimage_hook', 'kahuna_header_image', 99 );
if ( ! function_exists( 'kahuna_header_image' ) ) :
function kahuna_header_image() {
	if ( cryout_on_landingpage() && cryout_get_option('kahuna_lpslider') != 3) return; // if on landing page and static slider not set to header image, exit.
	$header_image = kahuna_header_image_url();
	if ( is_front_page() && function_exists( 'the_custom_header_markup' ) && has_header_video() ) {
		the_custom_header_markup();
	} elseif ( ! empty( $header_image ) ) { ?>
			<div class="header-image" <?php cryout_echo_bgimage( esc_url( $header_image ) ) ?>></div>
			<img class="header-image" alt="<?php if ( is_single() ) the_title_attribute(); elseif ( is_archive() ) echo esc_attr( get_the_archive_title() ); else echo esc_attr( get_bloginfo( 'name' ) ) ?>" src="<?php echo esc_url( $header_image ) ?>" />
			<?php cryout_header_widget_hook(); ?>
	<?php }
} // kahuna_header_image()
endif;

if ( ! function_exists( 'kahuna_header_title_check' ) ) :
function kahuna_header_title_check() {
    $options = cryout_get_option( array( 'kahuna_headertitles_posts', 'kahuna_headertitles_pages', 'kahuna_headertitles_archives', 'kahuna_headertitles_home' ) );

	// woocommerce should never use header titles
	if (function_exists('is_woocommerce') && is_woocommerce()) return false;

	// theme's landing page
	if ( cryout_on_landingpage() && $options['kahuna_headertitles_home'] ) return true;

	// blog section
	if ( is_home() && $options['kahuna_headertitles_home'] ) return true;

	// other instances
	if ( ( is_single() && $options['kahuna_headertitles_posts'] ) ||
    ( is_page() && $options['kahuna_headertitles_pages'] && ! cryout_on_landingpage() ) ||
    ( ( is_archive() || is_search() || is_404() ) && $options['kahuna_headertitles_archives'] ) ||
    ( ( is_home() ) && $options['kahuna_headertitles_home'] ) ) {
        return true;
    }
	return false;
} //kahuna_header_title_check
endif;

/**
 * Header Title and meta
 */
add_action ( 'cryout_headerimage_hook', 'kahuna_header_title', 100 );
if ( ! function_exists( 'kahuna_header_title' ) ) :
function kahuna_header_title() {
    if ( kahuna_header_title_check() ) : ?>
    <div id="header-page-title">
        <div id="header-page-title-inside">
            <?php
			if ( is_front_page() ) {
				echo '<h2 class="entry-title" ' . cryout_schema_microdata('entry-title', 0) . '>' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</h2><p class="byline">' . esc_attr( get_bloginfo( 'description', 'display' ) ) . '</p>';
			} elseif ( is_singular() )  {
                the_title( '<h1 class="entry-title" ' . cryout_schema_microdata('entry-title', 0) . '>', '</h1>' );
            } else {
                    echo '<h1 class="entry-title" ' . cryout_schema_microdata('entry-title', 0) . '>';
					if ( is_home() ) {
						single_post_title();
					}
					if ( is_archive() ) {
                        echo get_the_archive_title();
                    }
                    if ( is_search() ) {
                        printf( __( 'Search Results for: %s', 'kahuna' ), '<strong>' . get_search_query() . '</strong>' );
                    }
                    if ( is_404() ) {
                        _e( 'Not Found', 'kahuna' );
                    }
                    echo '</h1>';
            } ?>
            <?php cryout_breadcrumbs_hook();?>
        </div>
    </div> <?php endif;
} // kahuna_header_title()
endif;


/**
 * Adds title and description to header
 * Used in header.php
*/
if ( ! function_exists( 'kahuna_title_and_description' ) ) :
function kahuna_title_and_description() {

	$options = cryout_get_option( array( 'kahuna_logoupload', 'kahuna_siteheader' ) );

	if ( in_array( $options['kahuna_siteheader'], array( 'logo', 'both' ) ) ) {
		kahuna_logo_helper( $options['kahuna_logoupload'] );
	}
	if ( in_array( $options['kahuna_siteheader'], array( 'title', 'both', 'logo', 'empty' ) ) ) {
		$heading_tag = ( is_front_page() || ( is_home() && ! kahuna_header_title_check() ) ) ? 'h1' : 'div';
		echo '<div id="site-text">';
		echo '<' . $heading_tag . cryout_schema_microdata( 'site-title', 0 ) . ' id="site-title">';
		echo '<span> <a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a> </span>';
		echo '</' . $heading_tag . '>';
		echo '<span id="site-description" ' . cryout_schema_microdata( 'site-description', 0 ) . ' >' . esc_attr( get_bloginfo( 'description' ) ). '</span>';
		echo '</div>';
	}
} // kahuna_title_and_description()
endif;
add_action ( 'cryout_branding_hook', 'kahuna_title_and_description' );

function kahuna_logo_helper( $kahuna_logo ) {
	if ( function_exists( 'the_custom_logo' ) ) {
		// WP 4.5+
		$wp_logo = str_replace( 'class="custom-logo-link"', 'id="logo" class="custom-logo-link" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '"', get_custom_logo() );
		if ( ! empty( $wp_logo ) ) echo '<div class="identity">' . $wp_logo . '</div>';
	} else {
		// older WP
		if ( ! empty( $kahuna_logo ) ) {
			$img = wp_get_attachment_image_src( $kahuna_logo, 'full' );
			echo '<div class="identity"><a id="logo" href="' . esc_url( home_url( '/' ) ) . '" ><img title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" src="' . esc_url( $img[0] ) . '" /></a></div>';
		}
	}
} // kahuna_logo_helper()

// cryout_schema_publisher() located in cryout/prototypes.php
add_action( 'cryout_after_inner_hook', 'cryout_schema_publisher' );
add_action( 'cryout_singular_after_inner_hook', 'cryout_schema_publisher' );

// cryout_schema_main() located in cryout/prototypes.php
add_action( 'cryout_after_inner_hook', 'cryout_schema_main' );
add_action( 'cryout_singular_after_inner_hook', 'cryout_schema_main' );

// cryout_skiplink() located in cryout/prototypes.php
add_action( 'wp_body_open', 'cryout_skiplink', 2 );
/**
 * Back to top button
*/
function kahuna_back_top() {
	echo '<button id="toTop" aria-label="' . __('Back to Top', 'kahuna') . '"><i class="icon-back2top"></i> </button>';
} // kahuna_back_top()
add_action( 'cryout_master_footerbottom_hook', 'kahuna_back_top' );


/**
 * Creates pagination for blog pages.
 */
if ( ! function_exists( 'kahuna_pagination' ) ) :
function kahuna_pagination( $pages = '', $range = 2, $prefix ='' ) {
	$pagination = cryout_get_option( 'kahuna_pagination' );
	if ( $pagination && function_exists( 'the_posts_pagination' ) ):
		the_posts_pagination( array(
			'prev_text' => '<i class="icon-pagination-left"></i>',
			'next_text' => '<i class="icon-pagination-right"></i>',
			'mid_size' => $range
		) );
	else:
		//posts_nav_link();
		kahuna_content_nav( 'nav-old-below' );
	endif;

} // kahuna_pagination()
endif;

/**
 * Prev/Next page links
 */
if ( ! function_exists( 'kahuna_nextpage_links' ) ) :
function kahuna_nextpage_links( $defaults ) {
	$args = array(
		'link_before'      => '<em>',
		'link_after'       => '</em>',
	);
	$r = wp_parse_args( $args, $defaults );
	return $r;
} // kahuna_nextpage_links()
endif;
add_filter( 'wp_link_pages_args', 'kahuna_nextpage_links' );

/**
 * Fixed prev/next post links
 */
if ( ! function_exists( 'kahuna_fixed_nav_links' ) ) :
function kahuna_fixed_nav_links( $wrap = TRUE ) { ?>
	<?php if ( ! is_single() ) return; ?>
	<?php if ( FALSE !== $wrap) { ?> <nav id="nav-fixed"> <?php } ?>
		<div class="nav-previous"><?php previous_post_link( '%link', '<i class="icon-fixed-nav"></i>', true );  previous_post_link( '%link', '<span>%title</span>', true );  ?></div>
		<div class="nav-next"><?php next_post_link( '%link', '<i class="icon-fixed-nav"></i>', true ); next_post_link( '%link', '<span>%title</span>', true );  ?></div>
	<?php if ( FALSE !== $wrap) { ?> </nav> <?php } ?>
<?php
} // kahuna_fixed_nav_links()
endif;
if ( 2 == cryout_get_option( 'kahuna_singlenav' ) ) add_action('cryout_main_hook', 'kahuna_fixed_nav_links', 15 );

/**
 * Footer Hook
 */
add_action( 'cryout_master_footer_hook', 'kahuna_master_footer' );
function kahuna_master_footer() {
	$the_theme = wp_get_theme();
	do_action( 'cryout_footer_hook' );
	echo '<div style="display:block;float:right;clear: right;">' . __( "Powered by", "kahuna" ) .
		'<a target="_blank" href="' . esc_html( $the_theme->get( 'ThemeURI' ) ) . '" title="';
	echo 'Kahuna WordPress Theme by ' . 'Cryout Creations"> ' . 'Kahuna' .'</a> &amp; <a target="_blank" href="' . "http://wordpress.org/";
	echo '" title="' . esc_attr__( "Semantic Personal Publishing Platform", "kahuna") . '"> ' . sprintf( " %s", "WordPress" ) . '</a>.</div>';
}

add_action( 'cryout_master_footer_hook', 'kahuna_copyright' );
function kahuna_copyright() {
    echo '<div id="site-copyright">' . do_shortcode( cryout_get_option( 'kahuna_copyright' ) ). '</div>';
}

/*
 * Sidebar handler
*/
if ( ! function_exists( 'kahuna_get_sidebar' ) ) :
function kahuna_get_sidebar() {

	$layout = cryout_get_layout();

	switch( $layout ) {
		case '2cSl':
			get_sidebar( 'left' );
		break;

		case '2cSr':
			get_sidebar( 'right' );
		break;

		case '3cSl' : case '3cSr' : case '3cSs' :
			get_sidebar( 'left' );
			get_sidebar( 'right' );
		break;

		default:
		break;
	}
} // kahuna_get_sidebar()
endif;

/*
 * General layout class
 */
if ( ! function_exists( 'kahuna_get_layout_class' ) ) :
function kahuna_get_layout_class( $echo = true ) {

	$layout = cryout_get_layout();

	/*  If not, return the general layout */
	switch( $layout ) {
		case '2cSl': $class = "two-columns-left"; break;
		case '2cSr': $class = "two-columns-right"; break;
		case '3cSl': $class = "three-columns-left"; break;
		case '3cSr' : $class = "three-columns-right"; break;
		case '3cSs' : $class = "three-columns-sided"; break;
		case '1c':
		default: $class = "one-column"; break;
	}
	// allow the generated layout class to be filtered
	$output = esc_attr( apply_filters( 'kahuna_general_layout_class', $class, $layout ) );

	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
} // kahuna_get_layout_class()
endif;

/**
* Checks the browser agent string for mobile ids and adds "mobile" class to body if true
*/
add_filter( 'body_class', 'cryout_mobile_body_class');


/**
* Creates breadcrumbs with page sublevels and category sublevels.
* Hooked in master hook
*/
if ( ! function_exists( 'kahuna_breadcrumbs' ) ) :
function kahuna_breadcrumbs() {
	cryout_breadcrumbs(
		'<i class="icon-bread-arrow"></i>',						// $separator
		'<i class="icon-bread-home"></i>', 						// $home
		1,														// $showCurrent
		'<span class="current">', 								// $before
		'</span>', 												// $after
		'<div id="breadcrumbs-container" class="cryout %1$s"><div id="breadcrumbs-container-inside"><div id="breadcrumbs"> <nav id="breadcrumbs-nav" %2$s>', // $wrapper_pre
		'</nav></div></div></div><!-- breadcrumbs -->', 		// $wrapper_post
		kahuna_get_layout_class(false),								// $layout_class
		__( 'Home', 'kahuna' ),									// $text_home
		__( 'Archive for category "%s"', 'kahuna' ),					// $text_archive
		__( 'Search results for "%s"', 'kahuna' ), 					// $text_search
		__( 'Posts tagged', 'kahuna' ), 						// $text_tag
		__( 'Articles posted by', 'kahuna' ), 					// $text_author
		__( 'Not Found', 'kahuna' ),							// $text_404
		__( 'Post format', 'kahuna' ),							// $text_format
		__( 'Page', 'kahuna' )									// $text_page
	);
} // kahuna_breadcrumbs()
endif;


/**
 * Adds searchboxes to the appropriate menu location
 * Hooked in master hook
 */
if ( ! function_exists( 'cryout_search_menu' ) ) :
function cryout_search_menu( $items, $args ) {
$options = cryout_get_option( array( 'kahuna_searchboxmain', 'kahuna_searchboxfooter' ) );
	if( $args->theme_location == 'primary' && $options['kahuna_searchboxmain'] ) {
		$container_class = 'menu-main-search';
		$items .= "<li class='" . $container_class . " menu-search-animated'>
		<button aria-label=" . __('Search', 'kahuna') . "><i class='icon-search'></i></button> " . get_search_form( false ) . "
		<i class='icon-cancel'></i> </li>";
	}
	if( $args->theme_location == 'footer' && $options['kahuna_searchboxfooter'] ) {
		$container_class = 'menu-footer-search';
		$items .= "<li class='" . $container_class . "'>" . get_search_form( false ) . "</li>";
	}
	return $items;
} // cryout_search_mainmenu()
endif;

/* cryout_schema_microdata() moved to framework in 0.9.9/0.5.6 */

/**
 * Normalizes tags widget font when needed
 */
if ( TRUE === cryout_get_option( 'kahuna_normalizetags' ) ) add_filter( 'wp_generate_tag_cloud', 'cryout_normalizetags' );


/**
* Master hook to bypass customizer options
*/
if ( ! function_exists( 'kahuna_master_hook' ) ) :
function kahuna_master_hook() {
	$kahuna_interim_options = cryout_get_option( array(
		'kahuna_breadcrumbs',
		'kahuna_searchboxmain',
		'kahuna_searchboxfooter',
		'kahuna_comlabels')
	);
	if ( $kahuna_interim_options['kahuna_breadcrumbs'] )  add_action( 'cryout_breadcrumbs_hook', 'kahuna_breadcrumbs' );
	if ( $kahuna_interim_options['kahuna_searchboxmain'] || $kahuna_interim_options['kahuna_searchboxfooter'] ) add_filter( 'wp_nav_menu_items', 'cryout_search_menu', 10, 2);

	if ( $kahuna_interim_options['kahuna_comlabels'] == 1 ) {
		add_filter( 'comment_form_default_fields', 'kahuna_comments_form' );
		add_filter( 'comment_form_field_comment', 'kahuna_comments_form_textarea' );
	}

	if ( cryout_get_option( 'kahuna_socials_header' ) ) 		add_action( 'cryout_header_socials_hook', 'kahuna_socials_menu_header', 30 );
	if ( cryout_get_option( 'kahuna_socials_footer' ) ) 		add_action( 'cryout_master_footerbottom_hook', 'kahuna_socials_menu_footer', 17 );
	if ( cryout_get_option( 'kahuna_socials_left_sidebar' ) ) 	add_action( 'cryout_before_primary_widgets_hook', 'kahuna_socials_menu_left', 5 );
	if ( cryout_get_option( 'kahuna_socials_right_sidebar' ) ) 	add_action( 'cryout_before_secondary_widgets_hook', 'kahuna_socials_menu_right', 5 );
};
endif;
add_action( 'wp', 'kahuna_master_hook' );


// Boxes image size
function kahuna_lpbox_width( $options = array() ) {

	if ( $options['kahuna_lpboxlayout1'] == 1 ) {
		$totalwidth = 1920;
	} else {
		$totalwidth = $options['kahuna_sitewidth'];
	}
	$options['kahuna_lpboxwidth1'] = intval ( $totalwidth / $options['kahuna_lpboxrow1'] );

	if ( $options['kahuna_lpboxlayout2'] == 1 ) {
		$totalwidth = 1920;
	} else {
		$totalwidth = $options['kahuna_sitewidth'];
	}
	$options['kahuna_lpboxwidth2'] = intval ( $totalwidth / $options['kahuna_lpboxrow2'] );

	return $options;
} // kahuna_lpbox_width()

// Used for the landing page blocks auto excerpts
function kahuna_custom_excerpt( $text = '', $length = 35, $more = '...' ) {
	$raw_excerpt = $text;

	//handle the <!--more--> and <!--nextpage--> tags
	$moretag = false;
	if (strpos( $text, '<!--nextpage-->' )) $explodemore = explode('<!--nextpage-->', $text);
	if (strpos( $text, '<!--more-->' )) $explodemore = explode('<!--more-->', $text);
	if (!empty($explodemore[1])) {
		// tag was found
		$text = $explodemore[0];
		$moretag = true;
	}

	if ( '' != $text ) {
		$text = strip_shortcodes( $text );

		$text = str_replace(']]>', ']]&gt;', $text);

		// Filters the number of words in an excerpt. Default 35.
		$excerpt_length = apply_filters( 'kahuna_custom_excerpt_length', $length );

		if ($excerpt_length == 0) return '';

		// Filters the string in the "more" link displayed after a trimmed excerpt.
		$excerpt_more = apply_filters( 'kahuna_custom_excerpt_more', $more );
		if (!$moretag) {
			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
		}
	}
	return apply_filters( 'kahuna_custom_excerpt', $text, $raw_excerpt );
} // kahuna_custom_excerpt()

// ajax load more button alternative hook
add_action( 'template_redirect', 'cryout_ajax_init' );

/* FIN */
