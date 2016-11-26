<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package hamilton
 * @version 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hamilton_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'hamilton_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function hamilton_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'hamilton_pingback_header' );


/**
 * Add a caption to post thumbnails.
 * 
 * @link http://wordpress.stackexchange.com/questions/138126/how-to-get-the-post-thumbnail-caption
 */
function hamilton_thumbnail_caption( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
    if ( $post = get_post( $post_thumbnail_id ) ) {
        if ( $size = wp_get_attachment_image_src( $post->ID, $size ) )
            $width = $size[1];
        else
            $width = 0;

        $html = img_caption_shortcode(
            array(
                'caption' => trim( "$post->post_excerpt $post->post_content" ),
                'width'   => $width,
            ),
            $html       
        );
    }

    return $html;
}

add_filter( 'post_thumbnail_html', 'hamilton_thumbnail_caption', 10, 5 );


/**
 * Allow &shy; in post titles.
 * 
 * @link http://stackoverflow.com/questions/29253944/wordpress-shy
 */
function hamilton_shy_options($initArray) {
    $initArray['entities'] = 'shy'; 
}
add_filter('tiny_mce_before_init', 'hamilton_shy_options');