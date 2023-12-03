<?php
/**
 * Master generated style function
 *
 * @package Sour
 */

/**
 * Add body classes to identify the child theme
 */
function sour_body_classes( $classes ) {
	$classes[] = strtolower( wp_get_theme() ) . '-child';
	return $classes;
}
add_filter( 'body_class', 'sour_body_classes', 15 );

/**
 * Dynamic styles for the frontend
 */
function sour_custom_styling() {
    $options = cryout_get_option();
    extract($options);

    ob_start(); ?>

    /* Sour custom style */

	.post-thumbnail-container .featured-image-link {
		background-color: rgba(<?php echo  esc_html( cryout_hex2rgb( $kahuna_accent1) ); ?>, <?php echo esc_html( $kahuna_overlayopacity/100 ); ?>);
	}

	.post-thumbnail-container .featured-image-link:hover {
		background-color: rgba(<?php echo  esc_html( cryout_hex2rgb( $kahuna_accent1) ); ?>, 1);
	}

	.continue-reading-link::before {
		background: linear-gradient(to top, rgba(<?php echo  esc_html( cryout_hex2rgb( $kahuna_overlaybackground) ); ?>, .1), rgba(<?php echo  esc_html( cryout_hex2rgb( $kahuna_overlaybackground) ); ?>, 1) );
	}

	.commentlist .reply a {
		color: <?php echo esc_html($kahuna_accent2) ?>;
	}

	.lp-boxes-static .lp-box-image .box-overlay {
		background: linear-gradient(to right, <?php echo esc_html($kahuna_overlaybackground) ?> 50%, <?php echo esc_html($kahuna_accent1) ?> 50%);
	}

	.lp-box-title a,
	.lp-box-title a:hover {
		color: <?php echo esc_html($kahuna_accent1) ?>;
	}

	.entry-meta span,
	.entry-meta a,
	.entry-utility span,
	.entry-utility a,
	.entry-meta time,
	.entry-meta .icon-metas::before {
			color: <?php echo esc_html($kahuna_accent1) ?>;
		}

	.entry-meta span.entry-sticky {
		background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ); ?>;
	}

	.lp-box-readmore {
		color: <?php echo esc_html( $kahuna_accent1 ) ?>;
	}

	.lp-boxes-animated .lp-box::before {
		background-color: rgba(<?php echo  esc_html( cryout_hex2rgb( $kahuna_overlaybackground) ); ?>, 0.4);
	}


    /* end Sour custom style */
    <?php
    return preg_replace( '/((background-)?color:\s*?)[;}]/i', '', ob_get_clean() );

} // sour_custom_styling()


/**
 * Load custom styles
 */
function sour_custom_styles( $style = '' ) {

	return $style . sour_custom_styling();

} // sour_custom_styles()
// this filer is applied in sour_setup()


/* FIN */
