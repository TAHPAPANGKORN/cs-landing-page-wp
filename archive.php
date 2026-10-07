<?php
/**
 * Archive & News Gallery Template - Matched Homepage UI Design
 *
 * @package BUU_SE_Landing
 */

get_header();

// Fetch categories with post counts
$categories = get_categories(
	array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true,
	)
);

// Fetch all published posts
$archive_query = new WP_Query(
	array(
		'post_type'      => 'post',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
	)
);
?>

<div class="archive-page-wrapper bg-slate section-padding">
    <div class="container">
        <div class="archive-layout-container">
            <!-- Breadcrumbs Navigation -->
            <nav class="archive-breadcrumbs" aria-label="Breadcrumb">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">หน้าแรก</a>
                <span class="sep">&gt;</span>
                <span class="current">ข่าวสาร</span>
            </nav>

            <!-- Category Section Title Header -->
            <div class="archive-category-header">
                <span class="category-accent-bar"></span>
                <h1 class="archive-header-title">ข่าวสาร & กิจกรรม</h1>
            </div>

            <!-- Category Filter Pills -->
            <div class="archive-pills-wrap">
                <button class="pill-tab active" data-filter="all">
                    <span class="pill-icon">⊞</span>
                    <span>ทั้งหมด</span>
                </button>
				<?php foreach ( $categories as $cat ) : ?>
                    <button class="pill-tab" data-filter="cat-<?php echo esc_attr( $cat->slug ); ?>">
                        <span><?php echo esc_html( $cat->name ); ?></span>
                        <span class="pill-count">(<?php echo esc_html( $cat->count ); ?>)</span>
                    </button>
				<?php endforeach; ?>
            </div>

            <!-- News & Activity Card Grid (Matched Homepage news-card UI) -->
            <div class="archive-news-grid">
				<?php if ( $archive_query->have_posts() ) : ?>
					<?php
					while ( $archive_query->have_posts() ) :
						$archive_query->the_post();
						$post_cats   = get_the_category();
						$cat_classes = array();
						$cat_name    = 'ข่าวสาร';
						if ( ! empty( $post_cats ) ) {
							$cat_name = $post_cats[0]->name;
							foreach ( $post_cats as $c ) {
								$cat_classes[] = 'cat-' . $c->slug;
							}
						}
						$cover_url = buu_get_post_cover_url( get_the_ID() );
						?>
                        <article id="post-<?php the_ID(); ?>" class="news-card archive-news-card <?php echo esc_attr( implode( ' ', $cat_classes ) ); ?>">
                            <div class="news-media">
                                <a href="<?php the_permalink(); ?>" class="news-media-link">
                                    <img src="<?php echo esc_url( $cover_url ); ?>" class="news-img" alt="<?php echo esc_attr( get_the_title() ); ?>" />
                                </a>
                                <span class="news-category-badge"><?php echo esc_html( $cat_name ); ?></span>
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
                    <p class="no-posts-found">ไม่พบข่าวสารในระบบ</p>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
