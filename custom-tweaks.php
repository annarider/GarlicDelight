<?php
/*
 * Plugin Name: Custom Tweaks
 * Version: 0.1
 * Plugin URI: https://garlicdelight.com
 * Description: My custom functions and site tweaks saved into a plugin, instead of living in the child theme.
 * Author: Anna Rider
 * Author URI: https://garlicdelight.com
 * Requires at least: 4.0
 * Tested up to: 5.0
 *
 * Text Domain: custom-tweaks
 * Domain Path:
 *
 * @package WordPress
 * @author Anna Rider
 * @since 0.1.0
 */

/* 20171017 - AL
Enqueue Ionicons https://studiopress.blog/made-with-love-footer/
Heart & other icons
*/
add_action( 'wp_enqueue_scripts', 'sp_enqueue_material_design_icons' );
function sp_enqueue_material_design_icons() {

    wp_enqueue_style( 'material_design', '//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css', array(), CHILD_THEME_VERSION );

}

/* 20171019 - AL
WPRM Jump to & Print codes
*/
function wprm_auto_add_snippets( $content ) {
 if ( is_singular( 'post' ) ) { // Only output on single posts, not in the archive.
 $print_shortcode = 'wprm-recipe-print';
 $jump_shortcode = 'wprm-recipe-jump';

 $snippets = '<div class="wprm-recipe-snippets">[' . $print_shortcode .'] [' . $jump_shortcode . ']</div>';
 $content = do_shortcode( $snippets ) . $content;
 }
 return $content;
}
add_filter( 'the_content', 'wprm_auto_add_snippets', 20 );

/* 20190305 - AL
Allow PSD to upload files to WordPress media library
*/
function my_mime_types($mime_types){
    $mime_types['psd'] = 'image/vnd.adobe.photoshop';
    return $mime_types;
}
add_filter('upload_mimes', 'my_mime_types', 1, 1);


/**
 * 20190508 AR: Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * from https://github.com/billerickson/EA-Genesis-Child/blob/3a45215fb497d087d11e32f4d9a2e5761544642c/functions.php#L88
 * Fix Genesis - Yoast schema conflict problem:
 * https://www.billerickson.net/yoast-schema-with-genesis/
 */

/*
function ea_child_theme_setup() {
	define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );

    // Includes
    include_once( get_stylesheet_directory() . '/inc/disable-genesis-schema.php' );
}
add_action( 'genesis_setup', 'ea_child_theme_setup', 15 );
*/

/**
 * Disable Genesis Schema
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
 */

add_action( 'init', 'be_disable_genesis_schema' );
/**
 * Disable Genesis Schema
 * @author Bill Erickson
 * @see https://www.billerickson.net/yoast-schema-with-genesis/
 */
function be_disable_genesis_schema() {

	$elements = array(
		'head',
		'body',
		'site-header',
		'site-title',
		'site-description',
		'breadcrumb',
		'breadcrumb-link-wrap',
		'breadcrumb-link-wrap-meta',
		'breadcrumb-link',
		'breadcrumb-link-text-wrap',
		'search-form',
		'search-form-meta',
		'search-form-input',
		'nav-primary',
		'nav-secondary',
		'nav-header',
		'nav-link-wrap',
		'nav-link',
		'entry',
		'entry-image',
		'entry-image-widget',
		'entry-image-grid-loop',
		'entry-author',
		'entry-author-link',
		'entry-author-name',
		'entry-time',
		'entry-modified-time',
		'entry-title',
		'entry-content',
		'comment',
		'comment-author',
		'comment-author-link',
		'comment-time',
		'comment-time-link',
		'comment-content',
		'author-box',
		'sidebar-primary',
		'sidebar-secondary',
		'site-footer',
	);

	foreach( $elements as $element ) {
		add_filter( 'genesis_attr_' . $element, 'be_remove_schema_attributes', 20 );
	}
}

/**
 * Remove schema attributes
 *
 */
function be_remove_schema_attributes( $attr ) {
	unset( $attr['itemprop'], $attr['itemtype'], $attr['itemscope'] );
	return $attr;
}

/**
 * Save some Genesis schema
 * @see https://billerickson.net
 *
 */
function be_save_some_genesis_schema( $elements ) {
	$save = array(
		'site-header',
		'site-title',
		'site-description',
		'nav-primary',
		'nav-secondary',
		'nav-header',
		'nav-link-wrap',
		'nav-link',
		'sidebar-primary',
		'sidebar-secondary',
		'site-footer',
	);
	return array_diff( $elements, $save );
}
add_filter( 'be_remove_schema_elements', 'be_save_some_genesis_schema' );
