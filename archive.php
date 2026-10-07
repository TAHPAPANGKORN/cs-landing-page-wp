<?php
/**
 * Archive & News Gallery Template - Matched Homepage UI Design
 *
 * @package BUU_SE_Landing
 */

get_header();

$current_post_type = get_query_var( 'post_type' );
if ( empty( $current_post_type ) && isset( $_GET['post_type'] ) ) {
	$current_post_type = sanitize_text_field( wp_unslash( $_GET['post_type'] ) );
}
$is_gallery = ( 'cs_gallery' === $current_post_type || is_post_type_archive( 'cs_gallery' ) || is_tax( 'gallery_category' ) );

if ( $is_gallery ) {
	$page_title    = 'ภาพบรรยากาศกิจกรรม <span class="dek-cs-text">DEK CS</span>';
	$crumb_title   = 'ภาพกิจกรรม';
	$accent_color  = '#D97706';
	$target_cpt    = 'cs_gallery';
	$gallery_terms = get_terms( array( 'taxonomy' => 'gallery_category', 'hide_empty' => false ) );
} else {
	$page_title   = 'ข่าวสาร & ประชาสัมพันธ์';
	$crumb_title  = 'ข่าวสาร';
	$accent_color = '#003366';
	$target_cpt   = 'post';
	$categories   = get_categories( array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => true ) );
}

// Fetch published posts
$archive_query = new WP_Query(
	array(
		'post_type'      => $target_cpt,
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
                <span class="current"><?php echo esc_html( $crumb_title ); ?></span>
            </nav>

            <!-- Category Section Title Header -->
            <div class="archive-category-header">
                <span class="category-accent-bar" style="background-color: <?php echo esc_attr( $accent_color ); ?>;"></span>
                <h1 class="archive-header-title"><?php echo wp_kses_post( $page_title ); ?></h1>
            </div>

            <!-- Category Filter Pills -->
            <div class="archive-pills-wrap">
                <button class="pill-tab active" data-filter="all">
                    <span class="pill-icon">⊞</span>
                    <span>ทั้งหมด</span>
                </button>
				<?php if ( $is_gallery ) : ?>
					<?php if ( ! empty( $gallery_terms ) && ! is_wp_error( $gallery_terms ) ) : ?>
						<?php foreach ( $gallery_terms as $term ) : ?>
							<button class="pill-tab" data-filter="cat-<?php echo esc_attr( $term->slug ); ?>">
								<span><?php echo esc_html( $term->name ); ?></span>
							</button>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php else : ?>
					<?php foreach ( $categories as $cat ) : ?>
						<button class="pill-tab" data-filter="cat-<?php echo esc_attr( $cat->slug ); ?>">
							<span><?php echo esc_html( $cat->name ); ?></span>
							<span class="pill-count">(<?php echo esc_html( $cat->count ); ?>)</span>
						</button>
					<?php endforeach; ?>
				<?php endif; ?>
            </div>

            <!-- News & Activity Card Grid (Matched Homepage news-card UI) -->
            <div class="<?php echo $is_gallery ? 'gallery-archive-grid' : 'archive-news-grid'; ?>">
				<?php if ( $archive_query->have_posts() ) : ?>
					<?php
					while ( $archive_query->have_posts() ) :
						$archive_query->the_post();
						$post_cats   = $is_gallery ? get_the_terms( get_the_ID(), 'gallery_category' ) : get_the_category();
						$cat_classes = array();
						$cat_name    = $is_gallery ? 'กิจกรรม' : 'ข่าวสาร';
						if ( ! empty( $post_cats ) && ! is_wp_error( $post_cats ) ) {
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
