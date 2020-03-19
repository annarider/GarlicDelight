<?php
/**
 * Custom amendments for the theme.
 *
 * @package   FoodiePro
 * @copyright Copyright (c) 2020, Feast Design Co.
 * @license   GPL-2.0+
 * @since     1.0.1
 */

defined( 'WPINC' ) || die;

require_once trailingslashit( get_template_directory() ) . 'lib/init.php';

define( 'CHILD_THEME_NAME', 'Foodie Pro Theme' );
define( 'CHILD_THEME_VERSION', '4.4.0' );
define( 'CHILD_THEME_URL', 'https://feastdesignco.com/product/foodie-pro/' );
define( 'CHILD_THEME_DEVELOPER', 'Feast Design Co.' );
define( 'FEAST_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );
define( 'FEAST_THEME_URI', trailingslashit( get_stylesheet_directory_uri() ) );

add_theme_support( 'genesis-responsive-viewport' );

add_theme_support( 'html5' );

add_theme_support(
	'genesis-accessibility',
	array(
		'headings',
		'search-form',
		'skip-links',
	)
);

add_theme_support( 'custom-header', array(
	'width'           => 320,
	'flex-width'	  => true,
	'height'          => 100,
	'flex-height'	  => true,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );
// Remove Genesis custom logo added in Genesis 3.1
remove_action( 'after_setup_theme', 'genesis_output_custom_logo', 11 );

add_theme_support( 'custom-background' );
add_theme_support( 'genesis-after-entry-widget-area' );
add_theme_support( 'genesis-footer-widgets', 4 );

remove_action( 'wp_head', 'genesis_custom_header_style');
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

unregister_sidebar( 'header-right' );

genesis_register_sidebar( array(
	'id'			=> 'before-header',
	'name'			=> __( 'Before Header: Newsletter', 'foodiepro' ),
	'description'	=> __( 'This is for the "Genesis: eNews Extended" widget.', 'foodiepro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-top',
	'name'			=> __( 'Homepage: Top', 'foodiepro' ),
	'description'	=> __( 'This is the homepage top section, designed for the "Foodie Pro - Featured Posts" widget with full-width setting and 1 post.', 'foodiepro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle',
	'name'			=> __( 'Homepage: Middle', 'foodiepro' ),
	'description'	=> __( 'This is the homepage middle section, designed for the "Genesis: eNews Extended" widget.', 'foodiepro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-bottom',
	'name'			=> __( 'Homepage: Bottom', 'foodiepro' ),
	'description'	=> __( 'This is the homepage bottom section, designed for the "Foodie Pro - Featured Posts" widget with as many posts displayed in any configuration you like.', 'foodiepro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'recipe-index-search',
	'name'			=> __( 'Recipe Index: Search', 'foodiepro' ),
	'description'	=> __( 'This is the recipe index search area, designed for the Categories, Archive, and Search widgets.', 'foodiepro' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'recipe-index-featured-posts',
	'name'			=> __( 'Recipe Index: Featured Posts', 'foodiepro' ),
	'description'	=> __( 'This is the recipe index posts area, designed for the "Foodie Pro - Featured Posts" widgets.', 'foodiepro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'nav-social-menu',
	'name'        => __( 'Navigation Menu: Social Icons', 'foodiepro' ),
	'description' => __( 'This area is for the "Simple Social Icons" widget, and appears in the top navigation area.', 'foodiepro' ),
) );

require_once FEAST_THEME_DIR . 'lib/helpers.php';
require_once FEAST_THEME_DIR . 'lib/customize/init.php';

if ( is_admin() ) {
	require_once FEAST_THEME_DIR . 'lib/admin/functions.php';
}

add_action( 'after_setup_theme', 'feast_content_width', 0 );
/**
 * Set the content width and allow it to be filtered directly.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function feast_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'feast_content_width', 720 );
}

add_action( 'after_setup_theme', 'foodie_pro_load_textdomain' );
/**
 * Loads the child theme textdomain.
 *
 * @since  2.1.0
 * @return void
 */
function foodie_pro_load_textdomain() {
	load_child_theme_textdomain( 'foodiepro', FEAST_THEME_DIR . 'languages' );
}

add_action( 'init', 'feast_register_image_sizes', 5 );
/**
 * Register custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function feast_register_image_sizes() {
	add_image_size( 'horizontal-thumbnail', 720, 450, true );
	add_image_size( 'horizontal-thumbnail-small', 360, 225, true );
	add_image_size( 'vertical-thumbnail', 720, 900, true );
	add_image_size( 'vertical-thumbnail-small', 360, 450, true );
	add_image_size( 'square-thumbnail', 360, 361, true );
}

add_action( 'widgets_init', 'foodie_pro_register_widgets', 11 );
/**
 * Unregister the default Genesis Featured Posts widget and register all of
 * our custom Foodie Pro widgets.
 *
 * @since  2.0.0
 */
function foodie_pro_register_widgets() {
	require_once FEAST_THEME_DIR . 'lib/widgets/featured-posts/widget.php';

	unregister_widget( 'Genesis_Featured_Post' );
	register_widget( 'Foodie_Pro_Featured_Posts' );
}

add_action( 'wp_enqueue_scripts', 'foodie_pro_enqueue_js' );
/**
 * Load all required JavaScript for the Foodie theme.
 *
 * @since   1.0.1
 * @return  void
 */
function foodie_pro_enqueue_js() {
	wp_enqueue_script(
		'foodie-pro-general',
		FEAST_THEME_URI . 'js/general.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);
}

add_filter( 'body_class', 'foodie_pro_add_body_class' );
/**
 * Add the theme name class to the body element.
 *
 * @since  1.0.0
 * @param  array $classes Current body classes.
 * @return array $classes Modified body classes.
 */
function foodie_pro_add_body_class( $classes ) {
	$classes[] = 'foodie-pro';
	return $classes;
}

add_action( 'genesis_before', 'foodie_pro_before_header' );
/**
 * Load an ad section before .site-inner.
 *
 * @since  1.0.0
 * @return void
 */
function foodie_pro_before_header() {
	genesis_widget_area( 'before-header', array(
		'before' => '<div id="before-header" class="before-header">',
		'after'  => '</div> <!-- end .before-header -->',
	) );
}

add_filter( 'wp_nav_menu_items', 'foodie_pro_primary_nav_menu_social', 10, 2 );
/**
 * Append a social widget area to the primary menu.
 *
 * @since  3.0.0
 * @param  string $menu The current menu output.
 * @param  array  $args The args used for displaying the current menu.
 * @return string $menu The modified menu output.
 */
function foodie_pro_primary_nav_menu_social( $menu, $args ) {
	if ( 'primary' !== $args->theme_location || ! is_active_sidebar( 'nav-social-menu' ) ) {
		return $menu;
	}

	ob_start();
	genesis_widget_area( 'nav-social-menu' );
	$widget_area = ob_get_clean();

	$menu .= sprintf( '<li id="foodie-social" class="foodie-social menu-item">%s</li>',
		$widget_area
	);

	return $menu;
}

add_filter( 'wp_nav_menu_items', 'foodie_pro_primary_nav_menu_search', 12, 2 );
/**
 * Append a search box to the primary menu.
 *
 * @since  3.0.0
 * @param  string $menu The current menu output.
 * @param  array  $args The args used for displaying the current menu.
 * @return string $menu The modified menu output.
 */
function foodie_pro_primary_nav_menu_search( $menu, $args ) {
	if ( 'primary' !== $args->theme_location || genesis_get_option( 'nav_extras' ) ) {
		return $menu;
	}

	$menu .= sprintf( '<li id="foodie-search" class="foodie-search menu-item">%s</li>',
		get_search_form ( false )
	);

	return $menu;
}

add_filter( 'genesis_search_text', 'foodie_pro_search_text' );
/**
 * Customize search form input box text.
 *
 * @since  3.0.0
 * @return string Modified Shay Bocks credits.
 */
function foodie_pro_search_text() {
	return esc_html__( 'Search', 'foodiepro' );
}

add_filter( 'excerpt_more', 'foodie_pro_read_more_link' );
add_filter( 'get_the_content_more_link', 'foodie_pro_read_more_link' );
add_filter( 'the_content_more_link', 'foodie_pro_read_more_link' );
/**
 * Modify the Genesis read more link.
 *
 * @since  1.0.0
 * @return string Modified read more text.
 */
function foodie_pro_read_more_link() {
	return sprintf( '...</p><p><a class="more-link" href="%s">%s</a></p>',
		get_permalink(),
		esc_html__( 'Read More', 'foodiepro' )
	);
}

add_filter( 'genesis_comment_form_args', 'foodie_pro_comment_form_args' );
/**
 * Modify the speak your mind text.
 *
 * @since  1.0.0
 * @param  array $args the default comment reply text.
 * @return array $args the modified comment reply text.
 */
function foodie_pro_comment_form_args( $args ) {
	$args['title_reply'] = esc_html__( 'Comments', 'foodiepro' );
	return $args;
}

// Add post navigation.
add_action( 'genesis_after_entry_content', 'genesis_prev_next_post_nav', 5 );

// Modify the author says text in comments.
add_filter( 'comment_author_says_text', '__return_empty_string' );

add_filter( 'genesis_seo_title', 'feast_filter_genesis_seo_site_title', 10, 2 );
/**
 * Replace genesis_seo_title to display normal header image at whatever dimensions user uploaded at
 * See: https://feastdesignco.com/rethinking-the-header/
 *
 * @since  3.1.5
 * @access public
 * @param  string $creds Default credits.
 * @return string Modified Feast credits.
 */
function feast_filter_genesis_seo_site_title( $title, $inside ){
	$child_inside = sprintf( '<a href="%s" title="%s" ><img src="%s" title="%s" alt="%s"  data-pin-nopin="true" /></a>',
				trailingslashit( home_url() ),
				esc_attr( get_bloginfo( 'name' ) ),
				get_header_image(),
				esc_attr( get_bloginfo( 'name' ) ),
				esc_attr( get_bloginfo( 'name' ) )
			);
	if( get_header_image() == '' ) { // overwrite $child_inside if no header image specified
		$child_inside = sprintf( '<a href="%s">%s</a>',
					trailingslashit( home_url() ),
					esc_attr( get_bloginfo( 'name' ) )
				);
	}
	$title = str_replace( $inside, $child_inside, $title );
	return $title;
}

remove_action( 'genesis_footer', 'genesis_do_footer' );
add_filter( 'feast_filter_footer_output', 'do_shortcode', 20 );
add_action('genesis_footer','feast_footer_creds_text', 12);
/**
 * Customize the footer text via Customize > Theme Settings > Footer
 * changed from filter on genesis_footer_creds_text to action on genesis_footer in 4.2.0 for Genesis 3.1.0+
 *
 * @since  3.2.0
 * @access public
 * @param  string $creds Default credits.
 * @return string Modified Feast credits.
 */
function feast_footer_creds_text ( ) {
	$footeroutput =  sprintf( 'Copyright &copy; %u %s on the <a href="%s" target="_blank" rel="nofollow noopener">%s</a><br/>%s',
				  date( 'Y' ),
				  get_bloginfo( 'name' ),
				  CHILD_THEME_URL,
				  CHILD_THEME_NAME,
				  '' // additional custom footer text here
				 );

	$customeroverride = wp_kses_post( genesis_get_option( 'footer_text' ) );
	// check for generic Genesis footer text (default from first time install)
	if(!strpos("buffer".strtolower($customeroverride),"studiopress") && !strpos("buffer".strtolower($customeroverride),"genesis")  && $customeroverride!=''){
		// if customer has specified custom text, override child theme default
		$footeroutput = $customeroverride;
	}

	// considered using genesis_footer_output but that's used in different Genesis setup
	$footeroutput = apply_filters( 'feast_filter_footer_output', "<p>".$footeroutput."</p>");

	echo $footeroutput;

}

add_filter( 'genesis_site_title_wrap', 'custom_edit_header_h1' );
/**
 * Change site-wide site-header wrapper to div per Casey Markee
 *
 * @since  4.3.0
 * @access public
 * @param  string $wrap Default credits.
 * @return string output div on all pages.
 */
function custom_edit_header_h1( $wrap ) {
	return 'div';
}
