<?php
/**
 * Template Part: Hero Section - Computer Science (CS) BUU
 *
 * @package BUU_SE_Landing
 */

// Fetch latest activity gallery albums from cs_gallery post type
$hero_gallery_query = new WP_Query( array(
    'post_type'      => 'cs_gallery',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
) );

$hero_images = array();
if ( $hero_gallery_query->have_posts() ) {
    while ( $hero_gallery_query->have_posts() ) {
        $hero_gallery_query->the_post();
        if ( has_post_thumbnail() ) {
            $hero_images[] = array(
                'title' => get_the_title(),
                'url'   => get_the_post_thumbnail_url( get_the_ID(), 'large' ),
                'link'  => get_permalink(),
            );
        }
    }
    wp_reset_postdata();
}

// Fallback high quality activity photos if no gallery uploads exist yet
if ( empty( $hero_images ) ) {
    $hero_images = array(
        array(
            'title' => 'บรรยากาศการเรียนการสอน CS BUU',
            'url'   => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1200&q=80',
            'link'  => get_post_type_archive_link( 'cs_gallery' ),
        ),
        array(
            'title' => 'ห้องปฏิบัติการคอมพิวเตอร์และ AI Lab',
            'url'   => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1200&q=80',
            'link'  => get_post_type_archive_link( 'cs_gallery' ),
        ),
        array(
            'title' => 'กิจกรรม Hackathon และนิสิต CS',
            'url'   => 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?auto=format&fit=crop&w=1200&q=80',
            'link'  => get_post_type_archive_link( 'cs_gallery' ),
        ),
        array(
            'title' => 'การนำเสนอผลงานนวัตกรรมซอฟต์แวร์',
            'url'   => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1200&q=80',
            'link'  => get_post_type_archive_link( 'cs_gallery' ),
        ),
    );
}

$gallery_archive_link = get_post_type_archive_link( 'cs_gallery' ) ?: '#gallery';
?>
<section id="hero" class="hero-section hero-cs-100vh">
    <div class="hero-grid-pattern" aria-hidden="true"></div>

    <div class="container hero-container">
        <div class="hero-layout">
            <!-- Hero Content Text Column -->
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="pulse-dot"></span>
                    <span>วิทยาการคอมพิวเตอร์ • CS BUU</span>
                </div>

                <h1 class="hero-title">
                    ขับเคลื่อนนวัตกรรมด้วย <br class="hero-br-desktop" />
                    <span class="hero-title-accent">Computer Science</span> <br class="hero-br-desktop" />
                    คณะวิทยาการสารสนเทศ ม.บูรพา
                </h1>

                <p class="hero-subtitle">
                    มุ่งเน้นทฤษฎีการคำนวณ, ปัญญาประดิษฐ์ (AI) และวิศวกรรมซอฟต์แวร์ ผลิตนักวิทยาศาสตร์คอมพิวเตอร์และนักพัฒนาชั้นนำ พร้อมก้าวสู่สายงานเทคโนโลยีแห่งอนาคต
                </p>

                <div class="hero-actions">
                    <a href="#admission" class="btn btn-gold btn-lg hero-cta-primary">
                        <span>ขั้นตอนการสมัครเรียน</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="#video-showcase" class="btn btn-outline-light btn-lg hero-cta-secondary">
                        <span>Explore More</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 8 16 12 12 16"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    </a>
                </div>

                <!-- Quick Tech Highlights Badges -->
                <div class="hero-tags">
                    <span class="tag-pill">Software & AI Development</span>
                    <span class="tag-pill">Web & Cloud Architecture</span>
                    <span class="tag-pill">CWIE สหกิจศึกษา (Co-op)</span>
                    <span class="tag-pill">CS Innovation & Startup</span>
                </div>
            </div>

            <!-- Hero Visual Showcase Single Fade Slider -->
            <div class="hero-media-shell">
                <div class="hero-single-slider" id="heroAutoSlider">
                    <?php foreach ( $hero_images as $index => $img ) : ?>
                        <div class="hero-slide-item <?php echo 0 === $index ? 'active' : ''; ?>" data-slide-index="<?php echo esc_attr( $index ); ?>">
                            <a href="<?php echo esc_url( $img['link'] ); ?>" class="hero-slide-link">
                                <img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['title'] ); ?>" loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>" />
                                <div class="hero-slide-overlay">
                                    <div class="hero-slide-badge">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                        <span>อัลบั้มภาพกิจกรรม CS BUU</span>
                                    </div>
                                    <h3 class="hero-slide-caption"><?php echo esc_html( $img['title'] ); ?></h3>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                    <!-- Slider Progress Dots -->
                    <div class="hero-slider-dots">
                        <?php foreach ( $hero_images as $index => $img ) : ?>
                            <button class="hero-dot <?php echo 0 === $index ? 'active' : ''; ?>" data-slide-to="<?php echo esc_attr( $index ); ?>" aria-label="Slide <?php echo esc_attr( $index + 1 ); ?>"></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var slider = document.getElementById('heroAutoSlider');
    if (!slider) return;
    
    var slides = slider.querySelectorAll('.hero-slide-item');
    var dots = slider.querySelectorAll('.hero-dot');
    if (slides.length <= 1) return;
    
    var currentIndex = 0;
    var slideInterval;

    function goToSlide(index) {
        slides[currentIndex].classList.remove('active');
        if (dots[currentIndex]) dots[currentIndex].classList.remove('active');
        
        currentIndex = (index + slides.length) % slides.length;
        
        slides[currentIndex].classList.add('active');
        if (dots[currentIndex]) dots[currentIndex].classList.add('active');
    }

    function startAutoSlide() {
        slideInterval = setInterval(function() {
            goToSlide(currentIndex + 1);
        }, 4000);
    }

    dots.forEach(function(dot, idx) {
        dot.addEventListener('click', function() {
            clearInterval(slideInterval);
            goToSlide(idx);
            startAutoSlide();
        });
    });

    startAutoSlide();
});
</script>


