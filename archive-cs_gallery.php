<?php
/**
 * Archive Template for Activity Gallery (CPT: cs_gallery)
 *
 * Displays all student activity photo posts with category filtering pills and clean card layout.
 *
 * @package BUU_SE_Landing
 */

get_header();

// Fetch dynamic gallery taxonomy categories
$gallery_terms = get_terms(
	array(
		'taxonomy'   => 'gallery_category',
		'hide_empty' => false,
	)
);

// Fetch published cs_gallery posts
$gallery_query = new WP_Query(
	array(
		'post_type'      => 'cs_gallery',
		'posts_per_page' => 12,
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
				<span class="current">ภาพกิจกรรม</span>
			</nav>

			<!-- Category Section Title Header -->
			<div class="archive-category-header">
				<span class="category-accent-bar" style="background-color: #D97706;"></span>
				<h1 class="archive-header-title">ภาพบรรยากาศกิจกรรม <span class="dek-cs-text">DEK CS</span></h1>
			</div>

			<!-- Category Filter Pills -->
			<div class="gallery-filter-wrap text-center" style="margin-bottom: 32px;">
				<button type="button" class="gallery-filter-btn active" data-filter="all">ทั้งหมด</button>
				<?php if ( ! empty( $gallery_terms ) && ! is_wp_error( $gallery_terms ) ) : ?>
					<?php foreach ( $gallery_terms as $term ) : ?>
						<button type="button" class="gallery-filter-btn" data-filter="<?php echo esc_attr( $term->slug ); ?>">
							<?php echo esc_html( $term->name ); ?>
						</button>
					<?php endforeach; ?>
				<?php else : ?>
					<button type="button" class="gallery-filter-btn" data-filter="hackathon">Hackathon & AI</button>
					<button type="button" class="gallery-filter-btn" data-filter="workshop">การเรียน & เวิร์กชอป</button>
					<button type="button" class="gallery-filter-btn" data-filter="student-life">กิจกรรมนิสิต & ค่าย</button>
					<button type="button" class="gallery-filter-btn" data-filter="field-trip">ดูงาน & สหกิจศึกษา</button>
				<?php endif; ?>
			</div>

			<!-- Activity Photo Grid (3 Columns Layout) -->
			<div class="gallery-archive-grid">
				<?php if ( $gallery_query->have_posts() ) : ?>
					<?php
					while ( $gallery_query->have_posts() ) :
						$gallery_query->the_post();

						$img_url    = buu_get_post_cover_url( get_the_ID() );
						$post_terms = get_the_terms( get_the_ID(), 'gallery_category' );
						$term_slug  = ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ? $post_terms[0]->slug : 'all';
						$term_name  = ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ? $post_terms[0]->name : 'กิจกรรม';
						?>
						<div class="gallery-card-item" data-category="<?php echo esc_attr( $term_slug ); ?>">
							<div class="gallery-img-wrapper">
								<a href="<?php the_permalink(); ?>" class="gallery-card-link" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
									<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="gallery-img" loading="lazy" />
									<div class="gallery-overlay">
										<span class="gallery-cat-badge"><?php echo esc_html( $term_name ); ?></span>
										<h3 class="gallery-title"><?php the_title(); ?></h3>
										<span class="gallery-date"><i class="far fa-calendar-alt"></i> <?php echo esc_html( get_the_date( 'd F Y' ) ); ?></span>
									</div>
								</a>
							</div>
						</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<!-- Fallback Activity Items when no posts uploaded yet -->
					<div class="gallery-card-item" data-category="hackathon">
						<div class="gallery-img-wrapper">
							<a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>" class="gallery-card-link">
								<img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80" alt="Hackathon & AI" class="gallery-img" loading="lazy" />
								<div class="gallery-overlay">
									<span class="gallery-cat-badge">Hackathon & AI</span>
									<h3 class="gallery-title">โครงการส่งเสริมทักษะการแข่งขัน Hackathon & AI Innovation</h3>
									<span class="gallery-date"><i class="far fa-calendar-alt"></i> มกราคม 2568</span>
								</div>
							</a>
						</div>
					</div>
					<div class="gallery-card-item" data-category="workshop">
						<div class="gallery-img-wrapper">
							<a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>" class="gallery-card-link">
								<img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80" alt="Workshop" class="gallery-img" loading="lazy" />
								<div class="gallery-overlay">
									<span class="gallery-cat-badge">การเรียน & เวิร์กชอป</span>
									<h3 class="gallery-title">กิจกรรม Workshop การพัฒนา Web Application & Modern Frontend</h3>
									<span class="gallery-date"><i class="far fa-calendar-alt"></i> กุมภาพันธ์ 2568</span>
								</div>
							</a>
						</div>
					</div>
					<div class="gallery-card-item" data-category="student-life">
						<div class="gallery-img-wrapper">
							<a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>" class="gallery-card-link">
								<img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=800&q=80" alt="Student Life" class="gallery-img" loading="lazy" />
								<div class="gallery-overlay">
									<span class="gallery-cat-badge">กิจกรรมนิสิต & ค่าย</span>
									<h3 class="gallery-title">กิจกรรมสานสัมพันธ์บายศรีสู่ขวัญและรับน้องใหม่ CS BUU</h3>
									<span class="gallery-date"><i class="far fa-calendar-alt"></i> พฤศจิกายน 2567</span>
								</div>
							</a>
						</div>
					</div>
					<div class="gallery-card-item" data-category="field-trip">
						<div class="gallery-img-wrapper">
							<a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>" class="gallery-card-link">
								<img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?auto=format&fit=crop&w=800&q=80" alt="Field Trip" class="gallery-img" loading="lazy" />
								<div class="gallery-overlay">
									<span class="gallery-cat-badge">ดูงาน & สหกิจศึกษา</span>
									<h3 class="gallery-title">โครงการศึกษาดูงาน ณ บริษัทเทคโนโลยีชั้นนำแห่งประเทศไทย</h3>
									<span class="gallery-date"><i class="far fa-calendar-alt"></i> ธันวาคม 2567</span>
								</div>
							</a>
						</div>
					</div>
					<div class="gallery-card-item" data-category="workshop">
						<div class="gallery-img-wrapper">
							<a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>" class="gallery-card-link">
								<img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=800&q=80" alt="Workshop" class="gallery-img" loading="lazy" />
								<div class="gallery-overlay">
									<span class="gallery-cat-badge">การเรียน & เวิร์กชอป</span>
									<h3 class="gallery-title">การนำเสนอโครงงานวิจัยวิทยาการคอมพิวเตอร์และซอฟต์แวร์อัจฉริยะ</h3>
									<span class="gallery-date"><i class="far fa-calendar-alt"></i> มีนาคม 2568</span>
								</div>
							</a>
						</div>
					</div>
					<div class="gallery-card-item" data-category="student-life">
						<div class="gallery-img-wrapper">
							<a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>" class="gallery-card-link">
								<img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=800&q=80" alt="Student Life" class="gallery-img" loading="lazy" />
								<div class="gallery-overlay">
									<span class="gallery-cat-badge">กิจกรรมนิสิต & ค่าย</span>
									<h3 class="gallery-title">ค่ายอบรมคอมพิวเตอร์และพัฒนาซอฟต์แวร์ให้แก่ชุมชนและโรงเรียน</h3>
									<span class="gallery-date"><i class="far fa-calendar-alt"></i> มกราคม 2568</span>
								</div>
							</a>
						</div>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</div>

<?php
get_footer();
