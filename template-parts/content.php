<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package herschel
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="wrapper">
		<header class="entry-header">
			<?php

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php herschel_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif;
			
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'herschel' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'herschel' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php herschel_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .wrapper -->
</article><!-- #post-## -->
