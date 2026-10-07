<?php
/**
 * Template Part: News & Events Section (Dynamic WP Posts)
 *
 * @package BUU_SE_Landing
 */

$news_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
	)
);
?>

<section id="news" class="news-section section-padding">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">ข่าวสาร & กิจกรรม</span>
            <h2 class="section-title">ข่าวที่เกี่ยวข้องกับสาขาวิชา</h2>
            <p class="section-subtitle">
                ติดตามข่าวสารการรับสมัคร กิจกรรมนิสิต และความเคลื่อนไหวทางด้านเทคโนโลยีของ คณะวิทยาการสารสนเทศ
            </p>
        </div>

        <div class="news-grid">
            <?php if ( $news_query->have_posts() ) : ?>
                <?php
				while ( $news_query->have_posts() ) :
					$news_query->the_post();
					?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'news-card' ); ?>>
                        <div class="news-media">
                            <a href="<?php the_permalink(); ?>" class="news-media-link">
                                <img src="<?php echo esc_url( buu_get_post_cover_url( get_the_ID() ) ); ?>" class="news-img" alt="<?php echo esc_attr( get_the_title() ); ?>" />
                            </a>
                            <span class="news-category-badge">
                                <?php
								$categories = get_the_category();
								if ( ! empty( $categories ) ) {
									echo esc_html( $categories[0]->name );
								} else {
									echo esc_html__( 'ข่าวประชาสัมพันธ์', 'buu-se-landing' );
								}
								?>
                            </span>
                        </div>
                        <div class="news-content">
                            <div class="news-date">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <span><?php echo esc_html( get_the_date( 'd F Y' ) ); ?></span>
                            </div>
                            <h3 class="news-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="news-excerpt">
                                <?php echo esc_html( wp_trim_words( get_the_excerpt(), 18, '...' ) ); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="news-readmore">
                                <span>อ่านเพิ่มเติม</span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <!-- Fallback News Items when no WP Posts exist yet -->
                <article class="news-card">
                    <div class="news-media">
                        <div class="news-img-placeholder bg-gradient-1">
                            <span class="placeholder-icon">🚀</span>
                        </div>
                        <span class="news-category-badge">TCAS 68</span>
                    </div>
                    <div class="news-content">
                        <div class="news-date">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span>05 ตุลาคม 2026</span>
                        </div>
                        <h3 class="news-title">
                            <a href="#admission">เปิดรับสมัครนิสิตใหม่ TCAS68 รอบ 1 Portfolio คณะวิทยาการสารสนเทศ</a>
                        </h3>
                        <div class="news-excerpt">
                            ขอเชิญชวนนักเรียนระดับชั้นมัธยมศึกษาปีที่ 6 ยื่นผลงานด้านคอมพิวเตอร์และเทคโนโลยี เข้าร่วมการคัดเลือก...
                        </div>
                        <a href="#admission" class="news-readmore">
                            <span>อ่านรายละเอียด</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </article>

                <article class="news-card">
                    <div class="news-media">
                        <div class="news-img-placeholder bg-gradient-2">
                            <span class="placeholder-icon">🤝</span>
                        </div>
                        <span class="news-category-badge">ความร่วมมือ</span>
                    </div>
                    <div class="news-content">
                        <div class="news-date">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span>28 กันยายน 2026</span>
                        </div>
                        <h3 class="news-title">
                            <a href="#careers">ขยายความร่วมมือ MOU สหกิจศึกษากับบริษัท Tech ชั้นนำในเขตนวัตกรรม EEC</a>
                        </h3>
                        <div class="news-excerpt">
                            คณะวิทยาการสารสนเทศ มหาวิทยาลัยบูรพา ลงนามบันทึกความเข้าใจร่วมกับบริษัทเทคโนโลยีชั้นนำ...
                        </div>
                        <a href="#careers" class="news-readmore">
                            <span>อ่านรายละเอียด</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </article>

                <article class="news-card">
                    <div class="news-media">
                        <div class="news-img-placeholder bg-gradient-3">
                            <span class="placeholder-icon">🏆</span>
                        </div>
                        <span class="news-category-badge">รางวัลนิสิต</span>
                    </div>
                    <div class="news-content">
                        <div class="news-date">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span>15 กันยายน 2026</span>
                        </div>
                        <h3 class="news-title">
                            <a href="#tracks">นิสิตได้รับรางวัลชนะเลิศการแข่งขัน Hackathon ระดับประเทศ</a>
                        </h3>
                        <div class="news-excerpt">
                            ขอแสดงความยินดีกับทีมนิสิตที่คว้าชัยชนะในการแข่งขันพัฒนาโซลูชันระบบซอฟต์แวร์ด้วยปัญญาประดิษฐ์...
                        </div>
                        <a href="#tracks" class="news-readmore">
                            <span>อ่านรายละเอียด</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </article>
            <?php endif; ?>
        </div>

        <!-- View All News CTA Button -->
        <div class="news-footer text-center">
            <?php
            $posts_page_id   = get_option( 'page_for_posts' );
            $news_archive_url = ( ! empty( $posts_page_id ) && '0' !== (string) $posts_page_id ) ? get_permalink( $posts_page_id ) : home_url( '/?post_type=post' );
            ?>
            <a href="<?php echo esc_url( $news_archive_url ); ?>" class="btn btn-outline-primary btn-lg">
                <span>ดูข่าวสารทั้งหมด</span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</section>
