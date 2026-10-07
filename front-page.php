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

// Section 2: Dynamic News & Events (ข่าวสาร WP Posts)
get_template_part( 'template-parts/news' );

// Section 3: Specialization Tracks / Curriculum (หลักสูตร)
get_template_part( 'template-parts/tracks' );

// Section 4: Frequently Asked Questions (FAQ)
get_template_part( 'template-parts/faq' );
?>

<?php
get_footer();
