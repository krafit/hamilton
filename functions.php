<?php
/**
 * meitner functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package meitner
 * @version 1.0
 */

if ( ! function_exists( 'meitner_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function meitner_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on meitner, use a find and replace
	 * to change 'meitner' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'meitner', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'meitner' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'meitner_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/**
	* Add support for Gutenberg.
	*
	* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
	*/
	add_theme_support( 'gutenberg', [

		// Theme supports wide images, galleries and videos.
		'wide-images' => true,

		// Make specific theme colors available in the editor.
		'colors' => array(
			'#ff338b', // primary_light
			'#ff006e', // primary
			'#cc0058', // primary_dark
			'#5999fb', // secondary_light
			'#277afa', // secondary
			'#055fe9', // secondary_dark
		),

	] );
	
	/**
	* Enqueue editor styles for Gutenberg
	*/

	function theme_slug_editor_styles() {
		wp_enqueue_style( 'theme-slug-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css' );
	}
	add_action( 'enqueue_block_editor_assets', 'theme_slug_editor_styles' );
	 
}
endif;
add_action( 'after_setup_theme', 'meitner_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function meitner_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'meitner_content_width', 640 );
}
add_action( 'after_setup_theme', 'meitner_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function meitner_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'meitner' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'meitner' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'meitner_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function meitner_scripts() {

	// Check for SCRIPT_DEBUG
	$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Permanent+Marker' );

	wp_enqueue_style( 'meitner-style', get_template_directory_uri() . '/style' . $suffix . '.css' );

	wp_enqueue_script( 'meitner-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $suffix . '.js', array(), '20161001', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'meitner_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';