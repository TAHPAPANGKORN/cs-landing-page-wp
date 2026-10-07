<?php
/**
 * Template Name: Software Engineering Landing Page
 *
 * Front Page template for Computer Science / Software Engineering Program
 *
 * @package BUU_SE_Landing
 */

get_header();
?>

<?php
// Section 1: Hero Banner
get_template_part( 'template-parts/hero' );

// Section 1.5: Discover CS BUU Video Showcase
get_template_part( 'template-parts/video' );

// Section 1.8: CWIE Partners Carousel Slider
get_template_part( 'template-parts/partners' );

// Section 2: TCAS Admission Section (การรับสมัคร)
get_template_part( 'template-parts/admission' );

// Section 2.5: Specialization Tracks / Curriculum (หลักสูตร)
get_template_part( 'template-parts/tracks' );

// Section 2.8: Tools, Languages & Tech Stack (เครื่องมือ ภาษา และเนื้อหาที่เราจะได้เรียน)
get_template_part( 'template-parts/tech-stack' );

// Section 3: Dynamic News & Events (ข่าวสาร WP Posts)
get_template_part( 'template-parts/news' );

// Section 3.5: Activity Photo Gallery (ภาพบรรยากาศและกิจกรรมนิสิต)
get_template_part( 'template-parts/gallery' );

// Section 4: Frequently Asked Questions (FAQ)
get_template_part( 'template-parts/faq' );


?>

<?php
get_footer();
