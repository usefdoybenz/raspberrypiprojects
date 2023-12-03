<?php
/**
 * Landing page functions
 * Used in front-page.php
 *
 * @package Kahuna
 */

/**
* slider builder
*/
if ( ! function_exists('kahuna_lpslider' ) ):
function kahuna_lpslider() {
	$options = cryout_get_option( array( 'kahuna_lpslider', 'kahuna_lpsliderimage', 'kahuna_lpslidertitle', 'kahuna_lpslidertext', 'kahuna_lpslidershortcode', 'kahuna_lpsliderserious', 'kahuna_lpslidercta1text', 'kahuna_lpslidercta1link', 'kahuna_lpslidercta2text', 'kahuna_lpslidercta2link' ) );
?>
<section class="lp-slider">
<?php
if ( $options['kahuna_lpslider'] )
	switch ( $options['kahuna_lpslider'] ):
		case 1:
			if ( is_string( $options['kahuna_lpsliderimage'] ) ) {
				$image = $options['kahuna_lpsliderimage'];
			}
			else {
				list( $image, ) = wp_get_attachment_image_src( $options['kahuna_lpsliderimage'], 'full' );
			}
			kahuna_lpslider_output( array(
				'image' => $image,
				'title' => $options['kahuna_lpslidertitle'],
				'content' => $options['kahuna_lpslidertext'],
				'lpslidercta1text' => $options['kahuna_lpslidercta1text'],
				'lpslidercta1link' => $options['kahuna_lpslidercta1link'],
				'lpslidercta2text' => $options['kahuna_lpslidercta2text'],
				'lpslidercta2link' => $options['kahuna_lpslidercta2link'],
			) );
		break;
		case 2:
			?> <div class="lp-dynamic-slider"> <?php
			echo do_shortcode( $options['kahuna_lpslidershortcode'] );
			?> </div> <!-- lp-dynamic-slider --> <?php
		break;
		case 3:
			// header image
		break;
		case 4:
			?> <div class="lp-dynamic-slider"> <?php
				if ( ! empty( $options['kahuna_lpsliderserious'] ) ) {
					echo do_shortcode( '[serious-slider id="' . $options['kahuna_lpsliderserious'] . '"]' );
				}
			?> </div> <!-- lp-dynamic-slider --> <?php
		break;

		default:
		break;
	endswitch; ?>
	</section>
	<?php
} //  kahuna_lpslider()
endif;

/**
* slider output
*/
if ( ! function_exists( 'kahuna_lpslider_output' ) ):
function kahuna_lpslider_output( $data ){
extract($data);
if ( empty( $image ) && empty( $title ) && empty( $content ) && empty( $lpslidercta1text ) && empty( $lpslidercta2text ) ) return; ?>

	<div class="lp-staticslider">
		<?php if ( ! empty( $image ) ) { ?>
			<img class="lp-staticslider-image" alt="<?php echo esc_attr( $title ) ?>" src="<?php echo esc_url( $image ); ?>">
		<?php } ?>
		<div class="staticslider-caption">
			<div class="staticslider-caption-inside">
				<?php if ( ! empty( $title ) ) { ?> <h2 class="staticslider-caption-title"><span><?php echo do_shortcode( $title ) ?></span></h2><?php } ?>
				<?php if ( ! empty( $title ) && ! empty( $content ) )	{ ?><span class="staticslider-sep"></span><?php } ?>
				<?php if ( ! empty( $content ) ) { ?> <div class="staticslider-caption-text"><span><?php echo do_shortcode( $content ) ?></span></div><?php } ?>
				<div class="staticslider-caption-buttons">
					<?php if ( ! empty( $lpslidercta1text ) ) { echo '<a class="staticslider-button" href="' . esc_url( $lpslidercta1link ) . '">' . esc_html( $lpslidercta1text ) . '</a>'; } ?>
					<?php if ( ! empty( $lpslidercta2text ) ) { echo '<a class="staticslider-button" href="' . esc_url( $lpslidercta2link ) . '">' . esc_html( $lpslidercta2text ) . '</a>'; } ?>
				</div>
			</div>
		</div>
	</div><!-- .lp-staticslider -->

<?php
} // kahuna_lpslider_output()
endif;


/**
 * blocks builder
 */
if ( ! function_exists( 'kahuna_lpblocks' ) ):
function kahuna_lpblocks( $sid = 1 ) {
	$maintitle = cryout_get_option( 'kahuna_lpblockmaintitle'.$sid );
	$maindesc = cryout_get_option( 'kahuna_lpblockmaindesc'.$sid );
	$pageids = cryout_get_option( apply_filters('kahuna_blocks_ids', array( 'kahuna_lpblockone'.$sid, 'kahuna_lpblocktwo'.$sid, 'kahuna_lpblockthree'.$sid, 'kahuna_lpblockfour'.$sid), $sid ) );
	$icon = cryout_get_option( apply_filters('kahuna_blocks_icons', array( 'kahuna_lpblockoneicon'.$sid, 'kahuna_lpblocktwoicon'.$sid, 'kahuna_lpblockthreeicon'.$sid, 'kahuna_lpblockfouricon'.$sid ), $sid ) );
	$blockscontent = cryout_get_option( 'kahuna_lpblockscontent'.$sid );
	$blocksclick = cryout_get_option( 'kahuna_lpblocksclick'.$sid );
	$blocksreadmore = cryout_get_option( 'kahuna_lpblocksreadmore'.$sid );
	$count = 1;
	$pagecount = count( array_filter( $pageids, function ($v) { return $v > 0; } ) );
	if ( empty( $pagecount ) ) return;
	if ( -1 == $blockscontent ) return;
	?>
	<section id="lp-blocks<?php echo absint( $sid ) ?>" class="lp-blocks lp-blocks<?php echo absint( $sid ) ?> lp-blocks-rows-<?php echo esc_attr( apply_filters('kahuna_blocks_perrow', $pagecount, $sid) ) ?>">
		<?php if(  ! empty( $maintitle ) || ! empty( $maindesc ) ) { ?>
			<header class="lp-section-header">
				<?php if( ! empty( $maintitle ) ) { ?><h3 class="lp-section-title"> <?php echo do_shortcode( $maintitle ) ?></h3><?php } ?>
				<?php if( ! empty( $maindesc ) ) { ?><div class="lp-section-desc"> <?php echo do_shortcode( $maindesc ) ?></div><?php } ?>
			</header>
		<?php } ?>
		<div class="lp-blocks-inside">
			<?php foreach ( $pageids as $key => $pageid ) {
				$pageid = cryout_localize_id( $pageid );
				if ( intval( $pageid ) > 0 ) {
					$page = get_post( $pageid );

					switch ( $blockscontent ) {
						case '0': $text = ''; break;
						case '2': $text = apply_filters( 'the_content', get_post_field( 'post_content', $pageid ) ); break;
						case '1': default: if (has_excerpt( $pageid )) $text = get_the_excerpt( $pageid ); else $text = kahuna_custom_excerpt( apply_filters( 'the_content', get_post_field( 'post_content', $pageid ) ) ); break;
					};

					$iconid = preg_replace('/(\d)$/','icon$1', $key);

					$data[$count] = array(
						'title' => apply_filters('kahuna_block_title', get_the_title( $pageid ), $pageid ),
						'text'	=> $text,
						'icon'	=> ( ( $icon[$iconid] != 'no-icon' ) ? $icon[$iconid] : '' ),
						'link'	=> apply_filters( 'kahuna_block_url', get_permalink( $pageid ), $pageid ),
						'target' => apply_filters( 'kahuna_block_target', '', $pageid ),
						'click'	=> $blocksclick,
						'id' 	=> $count,
						'readmore' => $blocksreadmore,
					);
					kahuna_lpblock_output( $data[$count] );
					$count++;
				}
			} ?>
		</div>
	</section>
<?php
wp_reset_postdata();
} //kahuna_lpblocks()
endif;

/**
 * blocks output
 */
if ( ! function_exists( 'kahuna_lpblock_output' ) ):
function kahuna_lpblock_output( $data ) { ?>
	<?php extract($data) ?>
			<div class="lp-block block<?php echo absint( $id ); ?>">
				<?php if ( $click ) { ?><a href="<?php echo esc_url( $link ); ?>" aria-label="<?php echo esc_attr( $title ); ?>"<?php echo wp_kses( $target, array() ) ?>><?php } ?>
					<?php if ( ! empty ( $icon ) )	{ ?> <i class="blicon-<?php echo esc_attr( $icon ); ?>"></i><?php } ?>
				<?php if ( $click ) { ?></a> <?php } ?>
					<div class="lp-block-content">
						<?php if ( ! empty ( $title ) ) { ?><h4 class="lp-block-title"><?php echo do_shortcode( $title ) ?></h4><?php } ?>
						<?php if ( ! empty ( $text ) ) { ?><div class="lp-block-text"><?php echo do_shortcode( $text ) ?></div><?php } ?>
						<?php if ( ! empty ( $readmore ) ) { ?><a class="lp-block-readmore" href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $target ); ?>> <?php echo do_shortcode( wp_kses_post( $readmore ) ); ?> <em class="screen-reader-text">"<?php echo esc_attr( $title ) ?>"</em> </a><?php } ?>
					</div>
			</div><!-- lp-block -->
	<?php
} // kahuna_lpblock_output()
endif;


/**
 * boxes builder
 */
if ( ! function_exists( 'kahuna_lpboxes' ) ):
function kahuna_lpboxes( $sid = 1 ) {
	$options = cryout_get_option(
				array(
					 'kahuna_lpboxmaintitle' . $sid,
					 'kahuna_lpboxmaindesc' . $sid,
					 'kahuna_lpboxcat' . $sid,
					 'kahuna_lpboxrow' . $sid,
					 'kahuna_lpboxcount' . $sid,
					 'kahuna_lpboxlayout' . $sid,
					 'kahuna_lpboxmargins' . $sid,
					 'kahuna_lpboxanimation' . $sid,
					 'kahuna_lpboxreadmore' . $sid,
					 'kahuna_lpboxlength' . $sid,
				 )
			 );

	if ( ( $options['kahuna_lpboxcount' . $sid] <= 0 ) || ( $options['kahuna_lpboxcat' . $sid] == '-1' ) ) return;

 	$box_counter = 1;
	$animated_class = "";
	if ( $options['kahuna_lpboxanimation' . $sid] == 1 ) $animated_class = 'lp-boxes-animated';
	if ( $options['kahuna_lpboxanimation' . $sid] == 2 ) $animated_class = 'lp-boxes-static';
	if ( $options['kahuna_lpboxanimation' . $sid] == 3 ) $animated_class = 'lp-boxes-animated lp-boxes-animated2';
	if ( $options['kahuna_lpboxanimation' . $sid] == 4 ) $animated_class = 'lp-boxes-static lp-boxes-static2';

	$custom_query = new WP_query();
    if ( ! empty( $options['kahuna_lpboxcat' . $sid] ) ) $cat = $options['kahuna_lpboxcat' . $sid]; else $cat = '';

	$args = apply_filters( 'kahuna_boxes_query_args', array(
		'showposts' => $options['kahuna_lpboxcount' . $sid],
		'cat' => cryout_localize_cat( $cat ),
		'ignore_sticky_posts' => 1,
		'lang' => cryout_localize_code()
	), $options['kahuna_lpboxcat' . $sid], $sid );

    $custom_query->query( $args );

    if ( $custom_query->have_posts() ) : ?>
		<section id="lp-boxes-<?php echo absint( $sid ) ?>" class="lp-boxes lp-boxes-<?php echo absint( $sid ) ?> <?php  echo esc_attr( $animated_class ) ?> lp-boxes-rows-<?php echo absint( $options['kahuna_lpboxrow' . $sid] ); ?>">
			<?php if( $options['kahuna_lpboxmaintitle' . $sid] || $options['kahuna_lpboxmaindesc' . $sid] ) { ?>
				<header class="lp-section-header">
					<?php if ( ! empty( $options['kahuna_lpboxmaintitle' . $sid] ) ) { ?> <h3 class="lp-section-title"> <?php echo do_shortcode( $options['kahuna_lpboxmaintitle' . $sid] ) ?></h3><?php } ?>
					<?php if ( ! empty( $options['kahuna_lpboxmaindesc' . $sid] ) ) { ?><div class="lp-section-desc"> <?php echo do_shortcode( $options['kahuna_lpboxmaindesc' . $sid] ) ?></div><?php } ?>
				</header>
			<?php } ?>
			<div class="<?php if ( $options['kahuna_lpboxlayout' . $sid] == 2 ) { echo 'lp-boxes-inside'; } else { echo 'lp-boxes-outside'; }?>
						<?php if ( $options['kahuna_lpboxmargins' . $sid] == 2 ) { echo 'lp-boxes-margins'; }?>
						<?php if ( $options['kahuna_lpboxmargins' . $sid] == 1 ) { echo 'lp-boxes-padding'; }?>">
    		<?php while ( $custom_query->have_posts() ) :
		            $custom_query->the_post();
					if ( cryout_has_manual_excerpt( $custom_query->post ) ) {
						$excerpt = get_the_excerpt();
					} elseif ( has_excerpt() ) {
						$excerpt = kahuna_custom_excerpt( get_the_excerpt(), $options['kahuna_lpboxlength' . $sid] );
					} else {
						$excerpt = kahuna_custom_excerpt( get_the_content(), $options['kahuna_lpboxlength' . $sid] );
					};
		            $box = array();
		            $box['colno'] = $box_counter++;
		            $box['counter'] = $options['kahuna_lpboxcount' . $sid];
		            $box['title'] = apply_filters( 'kahuna_box_title', get_the_title(), get_the_ID() );
		            $box['content'] = $excerpt;
		            $box['image'] = wp_get_attachment_image( get_post_thumbnail_id( get_the_ID() ), 'kahuna-lpbox-' . $sid );
					$box['link'] = apply_filters( 'kahuna_box_url', get_permalink(), get_the_ID() );
					$box['readmore'] = apply_filters( 'kahuna_box_readmore', $options['kahuna_lpboxreadmore' . $sid], get_the_ID() );
					$box['target'] = apply_filters( 'kahuna_box_target', '', get_the_ID() );

					$box['image'] = apply_filters( 'kahuna_preview_img_src', $box['image']);

            		kahuna_lpbox_output( $box );
        		endwhile; ?>
			</div>
		</section><!-- .lp-boxes -->
<?php endif;
	wp_reset_postdata();
} //  kahuna_lpboxes()
endif;

/**
 * boxes output
 */
if ( ! function_exists( 'kahuna_lpbox_output' ) ):
function kahuna_lpbox_output( $data ) {
	$randomness = array ( 6, 8, 1, 5, 2, 7, 3, 4 );
	extract($data); ?>
			<div class="lp-box box<?php echo absint( $colno ); ?> ">
					<div class="lp-box-image lpbox-rnd<?php echo absint( $randomness[$colno%8] ); ?>">
                        <a class="lp-box-imagelink" tabindex="-1" <?php if( ! empty( $link ) ) { ?> href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $target ); } ?>><span class="screen-reader-text"> <?php echo esc_attr( $title ); ?></span>  </a>
						<?php if( ! empty( $image ) ) { echo wp_kses_post( $image ); } ?>
                        <span class="box-overlay"></span>
					</div>
					<div class="lp-box-content">
                        <?php if ( ! empty( $title ) ) { ?><h4 class="lp-box-title">
							<?php if ( !empty( $readmore ) && !empty( $link ) ) { ?> <a href="<?php echo esc_url( $link ); ?>" <?php echo esc_attr( $target ); ?>><?php } ?>
								<?php echo do_shortcode( $title ); ?>
							<?php if ( !empty( $readmore ) && !empty( $link ) ) { ?> </a> <?php } ?>
						</h4><?php } ?>
						<div class="lp-box-text">
							<?php if ( ! empty( $content ) ) { ?>
								<div class="lp-box-text-inside"> <?php echo do_shortcode( $content ) ?> </div>
							<?php } ?>
    						<?php if( ! empty( $readmore ) ) { ?>
    							<a class="lp-box-readmore" href="<?php if( ! empty( $link ) ) { echo esc_url( $link ); } ?>" <?php echo esc_attr( $target ); ?>> <?php echo do_shortcode( $readmore ) ?> <em class="screen-reader-text">"<?php echo esc_attr( $title ) ?>"</em> </a>
    						<?php } ?>
                        </div>
					</div>
			</div><!-- lp-box -->
	<?php
} // kahuna_lpbox_output()
endif;


/**
 * text area builder
 */
if ( ! function_exists( 'kahuna_lptext' ) ):
function kahuna_lptext( $what = 'one' ) {
	$pageid = cryout_get_option( 'kahuna_lptext' . $what );
	$pageid = cryout_localize_id( $pageid );
	if ( intval( $pageid ) > 0 ) {
		$page = get_post( $pageid );
		$data = array(
			'title' => apply_filters( 'kahuna_text_title', get_the_title( $pageid ), $pageid ),
			'text'	=> apply_filters( 'the_content', get_post_field( 'post_content', $pageid ) ),
			'class' => apply_filters( 'kahuna_text_class', '', $pageid ),
			'id' 	=> $what,
		);
		$data['image'] = wp_get_attachment_image( get_post_thumbnail_id( $pageid ), 'full' );
		kahuna_lptext_output( $data );
	}
} // kahuna_lptext()
endif;

/**
 * text area output
 */
if ( ! function_exists( 'kahuna_lptext_output' ) ):
function kahuna_lptext_output( $data ){ ?>
	<section class="lp-text <?php echo esc_attr( $data['class'] ); ?> <?php echo ( ! empty( $data['image'] ) ) ? ' lp-text-hasimage': '' ?>" id="lp-text-<?php echo esc_attr( $data['id'] ); ?>" >
	<?php if( ! empty( $data['image'] ) ) { ?>
		<div class="lp-text-image"><?php echo wp_kses_post( $data['image'] ) ?></div>
    	<?php } ?>
	<div class="lp-text-inside">
		<?php if( ! empty( $data['title'] ) ) { ?><h3 class="lp-text-title"><?php echo do_shortcode( $data['title'] ) ?></h3><?php } ?>
		<?php if( ! empty( $data['text'] ) ) { ?><div class="lp-text-content"><?php echo do_shortcode( $data['text'] ) ?></div><?php } ?>
	</div>

	</section><!-- #lp-text-<?php echo esc_attr( $data['id'] ); ?> -->
<?php
} // kahuna_lptext_output()
endif;

/**
 * page or posts output, also used when landing page is disabled
 */
if ( ! function_exists( 'kahuna_lpindex' ) ):
function kahuna_lpindex() {

	$kahuna_lpposts = cryout_get_option('kahuna_lpposts');

	switch ($kahuna_lpposts) {

		case 2: // static page

			if ( have_posts() ) :
					?><section id="lp-page"> <div class="lp-page-inside"><?php
					get_template_part( 'content/content', 'page' );
					?></div> </section><!-- #lp-page --><?php
			endif;

		break;

		case 1: // posts

			if ( get_query_var('paged') ) $paged = get_query_var('paged');
			elseif ( get_query_var('page') ) $paged = get_query_var('page');
			else $paged = 1;
			$custom_query = new WP_query( array('posts_per_page'=>get_option('posts_per_page'),'paged'=>$paged) );

			if ( $custom_query->have_posts() ) :  ?>
				<section id="lp-posts"> <div class="lp-posts-inside">
				<div id="content-masonry" class="content-masonry" <?php cryout_schema_microdata( 'blog' ); ?>> <?php
					while ( $custom_query->have_posts() ) : $custom_query->the_post();
						get_template_part( 'content/content', get_post_format() );
					endwhile; ?>
				</div> <!-- content-masonry -->
				</div> </section><!-- #lp-posts -->
				<?php kahuna_pagination();
				wp_reset_postdata();
			//else :
				//get_template_part( 'content/content', 'notfound' );
			endif;

		break;

		case 0: // disabled
		default: break;
	}

} // kahuna_lpindex()
endif;

// FIN
