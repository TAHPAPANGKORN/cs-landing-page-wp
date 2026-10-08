<?php
/**
 * Single Activity Post Template (CPT: cs_gallery)
 *
 * Displays individual activity gallery posts with dedicated "ภาพบรรยากาศกิจกรรม" branding,
 * breadcrumbs, featured image, content, and navigation links.
 *
 * @package BUU_SE_Landing
 */

get_header();
?>

<div class="single-page-wrapper bg-slate section-padding">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();

			$post_terms = get_the_terms( get_the_ID(), 'gallery_category' );
			$term_name  = ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) ? $post_terms[0]->name : 'กิจกรรมนิสิต';
			$cover_url  = buu_get_post_cover_url( get_the_ID() );
			?>
			<div class="single-post-layout-container">
				<!-- Breadcrumbs Navigation -->
				<nav class="post-breadcrumbs" aria-label="Breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">หน้าแรก</a>
					<span class="sep">&gt;</span>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'cs_gallery' ) ?: home_url( '/?post_type=cs_gallery' ) ); ?>">ภาพกิจกรรม</a>
					<?php if ( ! empty( $term_name ) ) : ?>
						<span class="sep">&gt;</span>
						<span class="current"><?php echo esc_html( $term_name ); ?></span>
					<?php endif; ?>
				</nav>

				<!-- Category Section Title Header for Activity Gallery -->
				<div class="post-category-header">
					<span class="category-accent-bar" style="background-color: var(--accent-gold, #F4B41A);"></span>
					<h2 class="category-header-title">ภาพกิจกรรมของ <span class="dek-cs-text">DEK CS</span></h2>
				</div>

				<!-- Main Activity Post Card Container -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-card-frame' ); ?>>
					<!-- Activity Category Badge -->
					<div class="activity-meta-badge-wrap" style="margin-bottom: 12px;">
						<span class="gallery-cat-badge" style="background: rgba(244, 180, 26, 0.15); color: #F4B41A; font-weight: 600; padding: 6px 14px; border-radius: 20px; display: inline-block; font-size: 0.875rem;">
							<i class="fas fa-tag"></i> <?php echo esc_html( $term_name ); ?>
						</span>
					</div>

					<!-- Post Title -->
					<h1 class="card-post-title"><?php the_title(); ?></h1>

					<!-- Post Date Metadata -->
					<div class="card-post-date">
						<i class="far fa-calendar-alt"></i>
						<span><?php echo esc_html( get_the_date( 'd F Y' ) ); ?></span>
					</div>

					<!-- Featured Image / Cover Media -->
					<?php if ( ! empty( $cover_url ) ) : ?>
						<div class="card-post-media" style="margin: 24px 0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.08); position: relative;">
							<img src="<?php echo esc_url( $cover_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="card-post-img" style="width: 100%; height: auto; display: block; max-height: 520px; object-fit: cover; cursor: zoom-in;" />
							<span class="lightbox-hint-badge" style="position: absolute; bottom: 12px; right: 12px; background: rgba(0, 31, 63, 0.75); color: #fff; padding: 6px 12px; border-radius: 20px; font-size: 0.8rem; backdrop-filter: blur(4px); pointer-events: none;"><i class="fas fa-search-plus"></i> คลิกเพื่อดูรูปขนาดใหญ่</span>
						</div>
					<?php endif; ?>

					<!-- Activity Article Paragraph Content -->
					<div class="card-post-content article-body">
						<?php the_content(); ?>
					</div>

					<!-- Post Tags Footer if any -->
					<?php if ( has_tag() ) : ?>
						<div class="post-tags-container">
							<span class="tags-title">แท็ก:</span>
							<div class="tags-list">
								<?php the_tags( '<span class="post-tag">', '</span><span class="post-tag">', '</span>' ); ?>
							</div>
						</div>
					<?php endif; ?>
				</article>

				<!-- Next & Previous Navigation Links for Activities -->
				<nav class="card-post-nav" aria-label="Activity Post Navigation" style="display: flex; justify-content: space-between; align-items: center; margin-top: 24px;">
					<div class="nav-prev">
						<?php previous_post_link( '%link', '← กิจกรรมก่อนหน้า' ); ?>
					</div>
					<div class="nav-next">
						<?php next_post_link( '%link', 'กิจกรรมถัดไป →' ); ?>
					</div>
				</nav>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php
get_footer();
