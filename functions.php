<?php
/**
 * BUU Software Engineering Landing Theme Functions
 *
 * @package BUU_SE_Landing
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Setup Theme Supports & Navigation Menus
 */
function buu_se_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable title tag support managed by WordPress.
	add_theme_support( 'title-tag' );

	// Enable featured image / post thumbnail support.
	add_theme_support( 'post-thumbnails' );

	// Enable Custom Logo support.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Enable HTML5 markup support.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Register Navigation Menus.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Header Menu', 'buu-se-landing' ),
			'footer'  => __( 'Footer Navigation Menu', 'buu-se-landing' ),
		)
	);
}
add_action( 'after_setup_theme', 'buu_se_setup' );

/**
 * Enqueue Theme Scripts and Stylesheets
 */
function buu_se_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Google Fonts (Prompt, Kanit, Inter)
	wp_enqueue_style(
		'buu-se-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Kanit:wght@400;500;600;700&family=Prompt:wght@300;400;500;600;700;800&display=swap',
		array(),
		null
	);

	// Main Theme Style (style.css)
	wp_enqueue_style(
		'buu-se-main-style',
		get_stylesheet_uri(),
		array(),
		$theme_version
	);

	// Custom Asset Stylesheet
	wp_enqueue_style(
		'buu-se-custom-css',
		get_template_directory_uri() . '/assets/css/main.css',
		array( 'buu-se-main-style' ),
		$theme_version
	);

	// Custom JavaScript File
	wp_enqueue_script(
		'buu-se-custom-js',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		$theme_version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'buu_se_enqueue_assets' );

/**
 * Filter nav menu item classes for modern CSS styling
 */
function buu_se_nav_menu_link_attributes( $atts, $item, $args ) {
	if ( property_exists( $args, 'theme_location' ) && 'primary' === $args->theme_location ) {
		$atts['class'] = isset( $atts['class'] ) ? $atts['class'] . ' nav-link' : 'nav-link';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'buu_se_nav_menu_link_attributes', 10, 3 );
