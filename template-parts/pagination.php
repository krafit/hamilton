<?php
/**
 * A template partial to output pagination for the Twenty Twenty default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package meitner
 */

/**
 * Translators:
 * This text contains HTML to allow the text to be shorter on small screens.
 * The text inside the span with the class nav-short will be hidden on small screens.
 */

$posts_pagination = get_the_posts_pagination(
	array(
		'mid_size'  => 1,
		'prev_text' => '←',
		'next_text' => '→',
	)
);

if ( $posts_pagination ) { ?>

	<div class="wrapper pagination-wrapper">

		<hr class="styled-separator pagination-separator is-style-wide" aria-hidden="true" />

		<?php echo $posts_pagination; ?>

	</div><!-- .wrapper -->

	<?php
}
