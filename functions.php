<?php
/**
 * Drunk Education functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Drunk_Education
 */

if ( ! function_exists( 'drunk_education_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function drunk_education_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Drunk Education, use a find and replace
		 * to change 'drunk-education' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'drunk-education', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'drunk-education' ),
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
		add_theme_support( 'custom-background', apply_filters( 'drunk_education_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'drunk_education_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function drunk_education_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'drunk_education_content_width', 640 );
}
add_action( 'after_setup_theme', 'drunk_education_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function drunk_education_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'drunk-education' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'drunk-education' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'drunk_education_widgets_init' );

/**
 * Shortcodes and user editor adjustments
 */

// Content box with border
function border_box( $atts , $content = null ) {

	// Strip blank paragraph breaks
	$find = array('<p></p>', '<br />');
	$replace = array('');	
	$content_cleaned = str_replace($find, $replace, $content);

	// Return custom embed code
	return '<div class="border-page">' . do_shortcode($content_cleaned) . '</div>';

}

add_shortcode( 'border-box', 'border_box' );

// Content layout with more than one column
function column_box( $atts , $content = null ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'columns' => '1'
		),
		$atts,
		'column-box'
	);

	if ( $atts['columns'] == 1) {
		$class = '';
	} else {
		$class = 'container-full';
	}

	// Strip blank paragraph breaks
	$find = array('<p></p>','<br />');
	$replace = array('');	
	$content_cleaned = str_replace($find, $replace, $content);

	// Return custom embed code
	return '<div class="' . $class . '">' . do_shortcode($content_cleaned) . '</div>';

}

add_shortcode( 'column-box', 'column_box' );

// Change excerpt length
function wpdocs_custom_excerpt_length( $length ) {
    return 100;
}

add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// Change excerpt read more text
function custom_excerpt_more( $more ) {
	return '...';
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );


// Display most recent post
function recent_posts_shortcode( $atts , $content = null ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'posts' => '5',
		),
		$atts,
		'recent-posts'
	);

	// Query
	$the_query = new WP_Query( array ( 'posts_per_page' => $atts['posts'] ) );
	
	// Posts
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$output .= '<div class="recent-posts-summary">';
		$output .= '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . ' on ' . get_the_time("F d, Y") . '</a></h3>' . get_the_excerpt();
		$output .= '</div>';
	endwhile;
	
	// Reset post data
	wp_reset_postdata();
	
	// Return code
	return $output;

}

add_shortcode( 'recent-posts', 'recent_posts_shortcode' );

// Content layout with more than one column
function twitter_sc( $atts , $content = null ) {

	// Return custom embed code
	return '<a class="twitter-timeline" href="https://twitter.com/DrunkEducate" data-height="500" data-chrome="noheader"></a> 
	<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';

}

add_shortcode( 'twitter', 'twitter_sc' );

function mailchimp_sc( $atts , $content = null ) {

	// Return custom embed code
	return '<div id="mc_embed_signup"><form id="mc-embedded-subscribe-form" class="validate" action="//drunktedtalks.us14.list-manage.com/subscribe/post?u=08810a1b890a65f85f62da9e1&amp;id=69c2ae0046" method="post" name="mc-embedded-subscribe-form" novalidate="" target="_blank">
			<div id="mc_embed_signup_scroll">
			<div class="mc-field-group"><input id="mce-EMAIL" class="required email" name="EMAIL" type="email" value="" placeholder="name@email.com" /></div>
			<div id="mce-responses" class="clear"></div>
			<div style="position: absolute; left: -5000px;" aria-hidden="true"><input tabindex="-1" name="b_08810a1b890a65f85f62da9e1_69c2ae0046" type="text" value="" /></div>
			<input id="mc-embedded-subscribe" class="button" name="subscribe" type="submit" value="Subscribe" />
			</div></form></div>';

}

add_shortcode( 'mailchimp', 'mailchimp_sc' );

/**
 * Enqueue scripts and styles.
 */
function drunk_education_scripts() {
	wp_enqueue_style( 'drunk-education-style', get_stylesheet_uri() );

	wp_enqueue_script( 'drunk-education-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'drunk-education-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'drunk_education_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
