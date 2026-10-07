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

/**
 * Get Post Cover Image URL with Smart Filtering & Min-Resolution Safeguard
 * 1. Post Featured Image (full resolution)
 * 2. Scan Post Content for valid news photos (ignoring emojis, avatars, small icons < 350px)
 * 3. High-Resolution BUU CS Premium SVG Graphic (800x450 HD)
 */
function buu_get_post_cover_url( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	// 1. Check Featured Image (force 'full' size for maximum sharpness)
	if ( has_post_thumbnail( $post_id ) ) {
		$thumb_url = get_the_post_thumbnail_url( $post_id, 'full' );
		if ( ! empty( $thumb_url ) ) {
			return $thumb_url;
		}
	}

	// 2. Scan Post Content for valid news images
	$post = get_post( $post_id );
	if ( $post && ! empty( $post->post_content ) ) {
		if ( preg_match_all( '/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches, PREG_SET_ORDER ) ) {
			$upload_dir = wp_upload_dir();
			$base_url   = isset( $upload_dir['baseurl'] ) ? $upload_dir['baseurl'] : '';
			$base_dir   = isset( $upload_dir['basedir'] ) ? $upload_dir['basedir'] : '';

			foreach ( $matches as $match ) {
				$img_tag = $match[0];
				$img_url = $match[1];

				// Skip emojis, smileys, avatars, icons
				if ( preg_match( '/(emoji|wp-smiley|avatar|gravatar|dashicons|s\.w\.org)/i', $img_tag . $img_url ) ) {
					continue;
				}

				// Strip WP thumbnail dimension suffix (-300x200, -150x150, etc.) to get original uploaded file
				$high_res_url = preg_replace( '/-\d+x\d+(\.[a-zA-Z0-9]+)$/i', '$1', $img_url );
				$target_url   = ! empty( $high_res_url ) ? $high_res_url : $img_url;

				// Local file dimension check (ensure width >= 350px to prevent pixelated icons)
				if ( ! empty( $base_url ) && ! empty( $base_dir ) && false !== strpos( $target_url, $base_url ) ) {
					$file_path = str_replace( $base_url, $base_dir, $target_url );
					if ( file_exists( $file_path ) ) {
						$size_info = @getimagesize( $file_path );
						if ( $size_info && isset( $size_info[0] ) && $size_info[0] < 350 ) {
							// Image is too small (e.g. icon/thumbnail < 350px wide) -> Skip it!
							continue;
						}
					}
				}

				return $target_url;
			}
		}
	}

	// 3. Check for custom default image in Theme Assets (assets/images/default-news.jpg / .png / .webp)
	$theme_dir  = get_template_directory();
	$theme_uri  = get_template_directory_uri();
	$extensions = array( 'jpg', 'jpeg', 'png', 'webp' );

	foreach ( $extensions as $ext ) {
		$custom_default_path = $theme_dir . '/assets/images/default-news.' . $ext;
		if ( file_exists( $custom_default_path ) ) {
			return $theme_uri . '/assets/images/default-news.' . $ext;
		}
	}

	// 4. Fallback to Default BUU CS Premium Graphic (800x450 HD SVG)
	return 'data:image/svg+xml;utf8,' . rawurlencode('
		<svg xmlns="http://www.w3.org/2000/svg" width="800" height="450" viewBox="0 0 800 450">
			<defs>
				<linearGradient id="bg" x1="0%" y1="0%" x2="100%" y2="100%">
					<stop offset="0%" stop-color="#001F3F"/>
					<stop offset="50%" stop-color="#003366"/>
					<stop offset="100%" stop-color="#051329"/>
				</linearGradient>
				<pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
					<path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="1"/>
				</pattern>
			</defs>
			<rect width="100%" height="100%" fill="url(#bg)"/>
			<rect width="100%" height="100%" fill="url(#grid)"/>
			<circle cx="700" cy="80" r="220" fill="rgba(244,180,26,0.08)"/>
			<text x="40" y="380" fill="#F4B41A" font-family="sans-serif" font-size="22" font-weight="bold">INFORMATICS BURAPHA</text>
			<text x="40" y="410" fill="#FFFFFF" font-family="sans-serif" font-size="16" opacity="0.8">Computer Science • BUU</text>
			<g transform="translate(360, 160)" opacity="0.5">
				<rect x="0" y="0" width="80" height="80" rx="16" fill="none" stroke="#FFFFFF" stroke-width="3"/>
				<path d="M 25 30 L 15 40 L 25 50 M 55 30 L 65 40 L 55 50 M 45 25 L 35 55" stroke="#F4B41A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
			</g>
		</svg>
	');
}

