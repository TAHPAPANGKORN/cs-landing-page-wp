<?php
/**
 * Template Part: Activity Gallery Section (ภาพบรรยากาศและกิจกรรมนิสิต)
 * Dynamic WP Admin Upload Support (CPT: cs_gallery ONLY)
 *
 * @package BUU_SE_Landing
 */

// 1. Query Dynamic Activity Gallery Posts from WP Admin (CPT: cs_gallery ONLY)
$gallery_query = new WP_Query(
	array(
		'post_type'      => 'cs_gallery',
		'posts_per_page' => 9,
		'post_status'    => 'publish',
	)
);

// 2. Fetch Dynamic Taxonomy Terms for Filter Buttons
$gallery_terms = get_terms(
	array(
		'taxonomy'   => 'gallery_category',
		'hide_empty' => false,
	)
);
?>

<section id="gallery" class="gallery-section section-padding bg-slate">
	<div class="container">
		
		<!-- Section Header -->
		<div class="section-header text-center">
			<span class="section-badge gold"><i class="fas fa-camera"></i> STUDENT LIFE & ACTIVITIES</span>
			<h2 class="section-title">ภาพกิจกรรมของ <span class="dek-cs-text">DEK CS</span></h2>
			<p class="section-subtitle">
				ประมวลภาพกิจกรรมการเรียนการสอน การแข่งขัน Hackathon กิจกรรมนิสิต และการศึกษาดูงานนอกสถานที่
			</p>
		</div>

		<!-- Category Filter Pills -->
		<div class="gallery-filter-wrap text-center">
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

		<!-- Activity Photo Slider Container (1 Row Flex Layout with Navigation Arrows) -->
		<div class="gallery-slider-wrapper">
			<button type="button" class="gallery-slider-arrow prev" id="gallery-slider-prev" aria-label="ภาพกิจกรรมก่อนหน้า">
				<i class="fas fa-chevron-left"></i>
			</button>
			
			<div class="gallery-photo-grid gallery-slider-track" id="gallery-slider-track">
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
					<!-- Fallback Activity Photo Items (Only Activity Photos, No News Posts) -->
					<div class="gallery-card-item" data-category="hackathon">
						<div class="gallery-img-wrapper">
							<a href="<?php echo esc_url( home_url( '/?post_type=cs_gallery' ) ); ?>" class="gallery-card-link">
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
							<a href="<?php echo esc_url( home_url( '/?post_type=cs_gallery' ) ); ?>" class="gallery-card-link">
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
							<a href="<?php echo esc_url( home_url( '/?post_type=cs_gallery' ) ); ?>" class="gallery-card-link">
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
							<a href="<?php echo esc_url( home_url( '/?post_type=cs_gallery' ) ); ?>" class="gallery-card-link">
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
							<a href="<?php echo esc_url( home_url( '/?post_type=cs_gallery' ) ); ?>" class="gallery-card-link">
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
							<a href="<?php echo esc_url( home_url( '/?post_type=cs_gallery' ) ); ?>" class="gallery-card-link">
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

			<button type="button" class="gallery-slider-arrow next" id="gallery-slider-next" aria-label="ภาพกิจกรรมถัดไป">
				<i class="fas fa-chevron-right"></i>
			</button>
		</div>

		<!-- Footer Action Button -->
		<div class="gallery-footer text-center">
			<?php $gallery_archive_url = get_post_type_archive_link( 'cs_gallery' ) ?: home_url( '/?post_type=cs_gallery' ); ?>
			<a href="<?php echo esc_url( $gallery_archive_url ); ?>" class="btn btn-outline-primary btn-lg">
				<span>ดูภาพกิจกรรมทั้งหมด</span>
				<i class="fas fa-arrow-right"></i>
			</a>
		</div>

	</div>
</section>
