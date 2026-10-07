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

	// FontAwesome 6 Icons CDN
	wp_enqueue_style(
		'font-awesome-6',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
		array(),
		'6.5.1'
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

/**
 * Register Custom Post Type: CWIE Partners (องค์กรพันธมิตร)
 */
function buu_register_partners_cpt() {
	$labels = array(
		'name'               => 'องค์กรพันธมิตร',
		'singular_name'      => 'องค์กรพันธมิตร',
		'add_new'            => 'เพิ่มพันธมิตรใหม่',
		'add_new_item'       => 'เพิ่มองค์กรพันธมิตรใหม่',
		'edit_item'          => 'แก้ไของค์กรพันธมิตร',
		'new_item'           => 'องค์กรพันธมิตรใหม่',
		'all_items'          => 'องค์กรพันธมิตรทั้งหมด',
		'view_item'          => 'ดูองค์กรพันธมิตร',
		'search_items'       => 'ค้นหาองค์กรพันธมิตร',
		'not_found'          => 'ไม่พบองค์กรพันธมิตร',
		'not_found_in_trash' => 'ไม่พบในถังขยะ',
		'menu_name'          => 'องค์กรพันธมิตร',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => false,
		'menu_icon'          => 'dashicons-building',
		'supports'           => array( 'title', 'thumbnail' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'partner', $args );
}
add_action( 'init', 'buu_register_partners_cpt' );



/**
 * Register Custom Post Type: Activity Gallery (ภาพกิจกรรม)
 */
function buu_register_gallery_cpt() {
	$labels = array(
		'name'               => 'ภาพกิจกรรม',
		'singular_name'      => 'ภาพกิจกรรม',
		'add_new'            => 'เพิ่มภาพกิจกรรมใหม่',
		'add_new_item'       => 'เพิ่มภาพกิจกรรมใหม่',
		'edit_item'          => 'แก้ไขภาพกิจกรรม',
		'new_item'           => 'ภาพกิจกรรมใหม่',
		'all_items'          => 'ภาพกิจกรรมทั้งหมด',
		'view_item'          => 'ดูภาพกิจกรรม',
		'search_items'       => 'ค้นหาภาพกิจกรรม',
		'not_found'          => 'ไม่พบภาพกิจกรรม',
		'not_found_in_trash' => 'ไม่พบในถังขยะ',
		'menu_name'          => 'ภาพกิจกรรม',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'gallery', 'with_front' => false ),
		'capability_type'    => 'post',
		'has_archive'        => 'gallery',
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-format-gallery',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'cs_gallery', $args );

	// Register Custom Taxonomy for Gallery Categories
	$tax_labels = array(
		'name'              => 'หมวดหมู่กิจกรรม',
		'singular_name'     => 'หมวดหมู่กิจกรรม',
		'search_items'      => 'ค้นหาหมวดหมู่',
		'all_items'         => 'หมวดหมู่ทั้งหมด',
		'edit_item'         => 'แก้ไขหมวดหมู่',
		'update_item'       => 'อัปเดตหมวดหมู่',
		'add_new_item'      => 'เพิ่มหมวดหมู่ใหม่',
		'new_item_name'     => 'ชื่อหมวดหมู่ใหม่',
		'menu_name'         => 'หมวดหมู่กิจกรรม',
	);

	register_taxonomy(
		'gallery_category',
		array( 'cs_gallery' ),
		array(
			'hierarchical'      => true,
			'labels'            => $tax_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'gallery-category', 'with_front' => false ),
			'show_in_rest'      => true,
		)
	);
}
add_action( 'init', 'buu_register_gallery_cpt' );

/**
 * Register Custom Post Type: FAQ (คำถามที่พบบ่อย)
 */
function buu_register_faq_cpt() {
	$labels = array(
		'name'               => 'คำถามที่พบบ่อย (FAQ)',
		'singular_name'      => 'คำถาม FAQ',
		'add_new'            => 'เพิ่มคำถามใหม่',
		'add_new_item'       => 'เพิ่มคำถาม FAQ ใหม่',
		'edit_item'          => 'แก้ไขคำถาม FAQ',
		'new_item'           => 'คำถาม FAQ ใหม่',
		'all_items'          => 'คำถาม FAQ ทั้งหมด',
		'view_item'          => 'ดูคำถาม FAQ',
		'search_items'       => 'ค้นหาคำถาม FAQ',
		'not_found'          => 'ไม่พบคำถาม FAQ',
		'not_found_in_trash' => 'ไม่พบในถังขยะ',
		'menu_name'          => 'คำถามที่พบบ่อย (FAQ)',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-editor-help',
		'supports'           => array( 'title', 'editor', 'page-attributes' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'cs_faq', $args );
}
add_action( 'init', 'buu_register_faq_cpt' );

/**
 * Auto Seed Demo FAQ Posts if Database is empty
 */
function buu_seed_demo_faq_posts() {
	if ( ! post_type_exists( 'cs_faq' ) ) {
		return;
	}

	$counts = wp_count_posts( 'cs_faq' );
	if ( isset( $counts->publish ) && (int) $counts->publish > 0 ) {
		return;
	}

	$demo_faqs = array(
		array(
			'question' => 'คุณสมบัติและเกณฑ์การรับสมัครเข้าศึกษาเป็นอย่างไร?',
			'answer'   => 'เปิดรับนักเรียนระดับชั้น ม.6, ปวช. หรือเทียบเท่าที่มีความสนใจด้านเทคโนโลยีและการเขียนโปรแกรม โดยในรอบ TCAS 1 (Portfolio) จะพิจารณาผลงาน โครงงาน หรือรางวัลการแข่งขัน ส่วนรอบ TCAS 3 (Admission) จะพิจารณาคะแนนสอบกลาง TGAT/TPAT3 และ A-Level ตามเกณฑ์ที่มหาวิทยาลัยกำหนด',
			'order'    => 1,
		),
		array(
			'question' => 'ค่าธรรมเนียมการศึกษาต่อภาคการศึกษาเท่าไหร่?',
			'answer'   => 'ค่าธรรมเนียมการศึกษาเป็นแบบเหมาจ่ายตามประกาศของมหาวิทยาลัยบูรพา โดยเฉลี่ยประมาณ 18,000 - 24,000 บาทต่อภาคการศึกษา (ขึ้นอยู่กับประเภทหลักสูตรปกติหรือโครงการพิเศษ) และมีทุนการศึกษาสำหรับนิสิตเรียนดีและนิสิตขาดแคลนทุนทรัพย์',
			'order'    => 2,
		),
		array(
			'question' => 'มีโอกาสฝึกงานหรือทำสหกิจศึกษากับบริษัท Tech ชั้นนำหรือไม่?',
			'answer'   => 'มีแน่นอน นิสิตชั้นปีที่ 4 ทุกคนจะได้เข้าร่วมโครงการสหกิจศึกษา (Co-operative Education) ปฏิบัติงานจริงเต็มเวลา 1 ภาคการศึกษากับบริษัทพันธมิตร เช่น KBTG, Agoda, LINE Thailand, Shopee, SCB TechX และหน่วยงานในเขตนวัตกรรม EEC',
			'order'    => 3,
		),
		array(
			'question' => 'หลักสูตรใช้เวลาเรียนกี่ปี และจบแล้วได้รับคุณวุฒิปริญญาอะไร?',
			'answer'   => 'หลักสูตร 4 ปีการศึกษา (สามารถเรียนจบได้ใน 3.5 ปีหากวางแผนรายวิชาตามเกณฑ์) เมื่อสำเร็จการศึกษาจะได้รับคุณวุฒิ วิทยาศาสตรบัณฑิต (วท.บ.) / Bachelor of Science (B.Sc.) คณะวิทยาการสารสนเทศ มหาวิทยาลัยบูรพา',
			'order'    => 4,
		),
	);

	foreach ( $demo_faqs as $item ) {
		wp_insert_post(
			array(
				'post_title'   => $item['question'],
				'post_content' => $item['answer'],
				'post_status'  => 'publish',
				'post_type'    => 'cs_faq',
				'menu_order'   => $item['order'],
			)
		);
	}
}
add_action( 'init', 'buu_seed_demo_faq_posts', 20 );

/**
 * Automatically flush rewrite rules once to register CPT permalinks in WordPress DB
 */
function buu_ensure_gallery_rewrite_rules() {
	if ( ! get_option( 'buu_cs_gallery_rewrite_flushed_v3' ) ) {
		buu_register_gallery_cpt();
		flush_rewrite_rules( false );
		update_option( 'buu_cs_gallery_rewrite_flushed_v3', true );
	}
}
add_action( 'init', 'buu_ensure_gallery_rewrite_rules', 99 );
add_action( 'after_switch_theme', 'buu_ensure_gallery_rewrite_rules' );


/**
 * Auto Seed Demo Activity Gallery Posts if Database is empty
 */
function buu_seed_demo_gallery_posts() {
	if ( ! post_type_exists( 'cs_gallery' ) ) {
		return;
	}

	$counts = wp_count_posts( 'cs_gallery' );
	if ( isset( $counts->publish ) && (int) $counts->publish > 0 ) {
		return;
	}

	// Define demo activity data
	$demo_activities = array(
		array(
			'title'    => 'โครงการส่งเสริมทักษะการแข่งขัน Hackathon & AI Innovation 2025',
			'content'  => 'ประมวลภาพกิจกรรมการแข่งขัน Hackathon ด้านการพัฒนาซอฟต์แวร์และปัญญาประดิษฐ์ (AI Innovation) สำหรับนิสิตภาควิชาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยบูรพา นิสิตได้แสดงศักยภาพในการแก้ไขปัญหาด้วยเทคโนโลยีสมัยใหม่และสร้างสรรค์นวัตกรรมดิจิทัล',
			'category' => 'Hackathon & AI',
		),
		array(
			'title'    => 'กิจกรรม Workshop การพัฒนา Web Application & Modern Frontend',
			'content'  => 'ภาพบรรยากาศโครงการอบรมเชิงปฏิบัติการ Workshop Modern Web Development เรียนรู้เทคโนโลยี React, Next.js และ CSS Design System โดยวิทยากรผู้เชี่ยวชาญจากบริษัท Tech ชั้นนำ',
			'category' => 'การเรียน & เวิร์กชอป',
		),
		array(
			'title'    => 'กิจกรรมสานสัมพันธ์บายศรีสู่ขวัญและรับน้องใหม่ CS BUU 2025',
			'content'  => 'ภาพบรรยากาศความประทับใจในกิจกรรมต้อนรับนิสิตใหม่ บายศรีสู่ขวัญ และกิจกรรมสานสัมพันธ์ระหว่างรุ่นพี่รุ่นน้อง CS BUU เพื่อสร้างความอบอุ่นและความผูกพันในรั้วมหาวิทยาลัย',
			'category' => 'กิจกรรมนิสิต & ค่าย',
		),
		array(
			'title'    => 'โครงการศึกษาดูงาน ณ บริษัทเทคโนโลยีชั้นนำแห่งประเทศไทย',
			'content'  => 'ภาพการนำนิสิตเข้าศึกษาดูงานกระบวนการทำงานจริงในอุตสาหกรรมซอฟต์แวร์ การบริหารจัดการโครงการ Cloud Infrastructure และระบบความปลอดภัยไซเบอร์ ณ บริษัทเทคโนโลยีชั้นนำในเขตนวัตกรรม EEC',
			'category' => 'ดูงาน & สหกิจศึกษา',
		),
		array(
			'title'    => 'การนำเสนอโครงงานวิจัยวิทยาการคอมพิวเตอร์และซอฟต์แวร์อัจฉริยะ',
			'content'  => 'การจัดแสดงผลงาน Senior Project และวิจัยนวัตกรรมซอฟต์แวร์อัจฉริยะของนิสิตชั้นปีที่ 4 เพื่อนำเสนอต่อคณะกรรมการและตัวแทนองค์กรภาคอุตสาหกรรมซอฟต์แวร์',
			'category' => 'การเรียน & เวิร์กชอป',
		),
		array(
			'title'    => 'ค่ายอบรมคอมพิวเตอร์และพัฒนาซอฟต์แวร์ให้แก่ชุมชนและโรงเรียน',
			'content'  => 'นิสิตจิตอาสา CS BUU ร่วมจัดค่ายถ่ายทอดความรู้ทักษะการเขียนโปรแกรมและการใช้งานคอมพิวเตอร์เบื้องต้นให้แก่เยาวชนและโรงเรียนในพื้นที่จังหวัดชลบุรี',
			'category' => 'กิจกรรมนิสิต & ค่าย',
		),
	);

	foreach ( $demo_activities as $item ) {
		$post_id = wp_insert_post(
			array(
				'post_title'   => $item['title'],
				'post_content' => $item['content'],
				'post_status'  => 'publish',
				'post_type'    => 'cs_gallery',
			)
		);

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			wp_set_object_terms( $post_id, $item['category'], 'gallery_category' );
		}
	}

	flush_rewrite_rules();
}
add_action( 'init', 'buu_seed_demo_gallery_posts', 20 );

/**
 * Register Custom Post Type: Faculty & Lecturers (คณาจารย์ & บุคลากร)
 */
function buu_register_faculty_cpt() {
	$labels = array(
		'name'               => 'คณาจารย์ & บุคลากร',
		'singular_name'      => 'อาจารย์/บุคลากร',
		'add_new'            => 'เพิ่มอาจารย์ใหม่',
		'add_new_item'       => 'เพิ่มอาจารย์/บุคลากรใหม่',
		'edit_item'          => 'แก้ไขข้อมูลอาจารย์/บุคลากร',
		'new_item'           => 'อาจารย์/บุคลากรใหม่',
		'all_items'          => 'คณาจารย์ & บุคลากรทั้งหมด',
		'view_item'          => 'ดูข้อมูลอาจารย์/บุคลากร',
		'search_items'       => 'ค้นหาอาจารย์/บุคลากร',
		'not_found'          => 'ไม่พบข้อมูลอาจารย์',
		'not_found_in_trash' => 'ไม่พบในถังขยะ',
		'menu_name'          => 'คณาจารย์ & บุคลากร',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'has_archive'        => false,
		'menu_icon'          => 'dashicons-welcome-learn-more',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'show_in_rest'       => true,
		'hierarchical'       => false,
	);

	register_post_type( 'cs_faculty', $args );
}
add_action( 'init', 'buu_register_faculty_cpt' );

/**
 * Add Meta Box for Faculty Details (Position, Email, Expertise)
 */
function buu_add_faculty_metaboxes() {
	add_meta_box(
		'cs_faculty_details_mb',
		'ข้อมูลตำแหน่งและความเชี่ยวชาญอาจารย์ (Faculty Info)',
		'buu_render_faculty_metabox',
		'cs_faculty',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'buu_add_faculty_metaboxes' );

function buu_render_faculty_metabox( $post ) {
	wp_nonce_field( 'buu_save_faculty_meta', 'buu_faculty_meta_nonce' );
	$position  = get_post_meta( $post->ID, '_faculty_position', true );
	$email     = get_post_meta( $post->ID, '_faculty_email', true );
	$expertise = get_post_meta( $post->ID, '_faculty_expertise', true );
	?>
	<p>
		<label for="faculty_position"><strong>ตำแหน่งทางวิชาการ / บริหาร:</strong></label><br />
		<input type="text" id="faculty_position" name="faculty_position" value="<?php echo esc_attr( $position ); ?>" style="width:100%;" placeholder="เช่น ประธานหลักสูตร, คณบดี, อาจารย์ประจำสาขา" />
	</p>
	<p>
		<label for="faculty_email"><strong>อีเมลติดต่อ (Email):</strong></label><br />
		<input type="email" id="faculty_email" name="faculty_email" value="<?php echo esc_attr( $email ); ?>" style="width:100%;" placeholder="เช่น email@buu.ac.th" />
	</p>
	<p>
		<label for="faculty_expertise"><strong>สาขาความเชี่ยวชาญ (ใส่คั่นด้วยเครื่องหมายจุลภาค ,):</strong></label><br />
		<input type="text" id="faculty_expertise" name="faculty_expertise" value="<?php echo esc_attr( $expertise ); ?>" style="width:100%;" placeholder="เช่น Artificial Intelligence, Machine Learning, Data Science" />
	</p>
	<p class="description">
		* หมายเหตุ: คุณสามารถเปลี่ยนลำดับการแสดงผลของอาจารย์ได้ทางกล่อง <strong>"คุณลักษณะของหน้า (Page Attributes)" -> ลำดับ (Order)</strong> ทางขวามือ (ตัวเลขอันดับน้อยกว่าจะขึ้นก่อน)
	</p>
	<?php
}

function buu_save_faculty_meta( $post_id ) {
	if ( ! isset( $_POST['buu_faculty_meta_nonce'] ) || ! wp_verify_nonce( $_POST['buu_faculty_meta_nonce'], 'buu_save_faculty_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['faculty_position'] ) ) {
		update_post_meta( $post_id, '_faculty_position', sanitize_text_field( $_POST['faculty_position'] ) );
	}
	if ( isset( $_POST['faculty_email'] ) ) {
		update_post_meta( $post_id, '_faculty_email', sanitize_email( $_POST['faculty_email'] ) );
	}
	if ( isset( $_POST['faculty_expertise'] ) ) {
		update_post_meta( $post_id, '_faculty_expertise', sanitize_text_field( $_POST['faculty_expertise'] ) );
	}
}
add_action( 'save_post_cs_faculty', 'buu_save_faculty_meta' );

/**
 * Auto Seed Demo CS BUU Faculty Members if database is empty
 */
function buu_seed_demo_faculty_posts() {
	if ( ! post_type_exists( 'cs_faculty' ) ) {
		return;
	}

	$counts = wp_count_posts( 'cs_faculty' );
	if ( isset( $counts->publish ) && (int) $counts->publish > 0 ) {
		return;
	}

	$demo_faculty = array(
		array(
			'title'     => 'ดร.วรัณรัชญ์ วิริยะวิทย์',
			'position'  => 'ประธานหลักสูตรวิทยาการคอมพิวเตอร์',
			'email'     => 'warunrat@buu.ac.th',
			'expertise' => 'Artificial Intelligence, Machine Learning, Data Science',
			'order'     => 1,
		),
		array(
			'title'     => 'ผศ.ภูสิต กุลเกษม',
			'position'  => 'คณบดีคณะวิทยาการสารสนเทศ & อาจารย์',
			'email'     => 'poosit@buu.ac.th',
			'expertise' => 'Computer Architecture, Parallel Computing, High-Performance Systems',
			'order'     => 2,
		),
		array(
			'title'     => 'ผศ.ดร.พิเชษ วะยะลุน',
			'position'  => 'อาจารย์ประจำสาขาวิชาวิทยาการคอมพิวเตอร์',
			'email'     => 'pichet@buu.ac.th',
			'expertise' => 'Machine Learning, IoT & Embedded Systems, Medical Image Processing',
			'order'     => 3,
		),
		array(
			'title'     => 'ผศ.วรวิทย์ วีระพันธุ์',
			'position'  => 'อาจารย์ประจำสาขาวิชาวิทยาการคอมพิวเตอร์',
			'email'     => 'worawit@buu.ac.th',
			'expertise' => 'Software Engineering, Artificial Intelligence, Data Mining',
			'order'     => 4,
		),
		array(
			'title'     => 'ผศ.เบญจภรณ์ จันทรกองกุล',
			'position'  => 'อาจารย์ประจำสาขาวิชาวิทยาการคอมพิวเตอร์',
			'email'     => 'benjaporn@buu.ac.th',
			'expertise' => 'Management Information Systems, Decision Support, Bioinformatics',
			'order'     => 5,
		),
		array(
			'title'     => 'ผศ.จรรยา อ้นปันส์',
			'position'  => 'อาจารย์ประจำสาขาวิชาวิทยาการคอมพิวเตอร์',
			'email'     => 'janya@buu.ac.th',
			'expertise' => 'Software Engineering, Database Systems, Web Application Development',
			'order'     => 6,
		),
	);

	foreach ( $demo_faculty as $member ) {
		$post_id = wp_insert_post(
			array(
				'post_title'  => $member['title'],
				'post_status' => 'publish',
				'post_type'   => 'cs_faculty',
				'menu_order'  => $member['order'],
			)
		);

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_faculty_position', $member['position'] );
			update_post_meta( $post_id, '_faculty_email', $member['email'] );
			update_post_meta( $post_id, '_faculty_expertise', $member['expertise'] );
		}
	}
}
add_action( 'init', 'buu_seed_demo_faculty_posts', 20 );

/**
 * Filter document title to "วิทยาการคอมพิวเตอร์ BUU | คณะวิทยาการสารสนเทศ มหาวิทยาลัยบูรพา"
 */
function buu_cs_custom_document_title( $title ) {
	if ( is_front_page() || is_home() ) {
		return 'วิทยาการคอมพิวเตอร์ BUU | คณะวิทยาการสารสนเทศ มหาวิทยาลัยบูรพา';
	}
	return $title;
}
add_filter( 'pre_get_document_title', 'buu_cs_custom_document_title', 999 );

function buu_cs_custom_blogname( $name ) {
	return 'วิทยาการคอมพิวเตอร์ BUU';
}
add_filter( 'option_blogname', 'buu_cs_custom_blogname' );








