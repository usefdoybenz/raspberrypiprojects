<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Kahuna
 */

get_header(); ?>
<div id="container" class="<?php kahuna_get_layout_class(); ?>">
	<main id="main" class="main">
		<?php cryout_before_content_hook(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); cryout_schema_microdata( 'article' );?>>
				<div class="schema-image">
					<?php cryout_featured_hook(); ?>
				</div>

				<div class="article-inner">
					<header>
						<div class="entry-meta beforetitle-meta">
							<?php cryout_post_title_hook(); ?>
						</div><!-- .entry-meta -->
						<?php if ( FALSE == cryout_get_option( 'kahuna_headertitles_posts' ) ) {
							the_title( '<h1 class="entry-title singular-title" ' . cryout_schema_microdata('entry-title', 0) . '>', '</h1>' );
						} ?>

						<div class="entry-meta aftertitle-meta">
							<?php cryout_post_meta_hook(); ?>
						</div><!-- .entry-meta -->

					</header>

					<?php cryout_singular_before_inner_hook();  ?>

					<div class="entry-content" <?php cryout_schema_microdata('entry-content'); ?>>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'kahuna' ), 'after' => '</span></div>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta entry-utility">
						<?php cryout_post_utility_hook(); ?>
					</footer><!-- .entry-utility -->

				</div><!-- .article-inner -->
				<?php cryout_singular_after_inner_hook();  ?>
			</article><!-- #post-## -->

			<?php if ( get_the_author_meta( 'description' ) ) {
					// If a user has filled out their description, show a bio on their entries
					get_template_part( 'content/user-bio' );
			} ?>

			<?php if ( 1 == cryout_get_option ('kahuna_singlenav') ) { ?>
				<nav id="nav-below" class="navigation">
					<?php kahuna_fixed_nav_links( FALSE ); ?>
				</nav><!-- #nav-below -->
			<?php } ?>

			<?php cryout_singular_before_comments_hook();  ?>
			<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php cryout_after_content_hook(); ?>
	</main><!-- #main -->

	<?php kahuna_get_sidebar(); ?>
</div><!-- #container -->

<?php get_footer();
