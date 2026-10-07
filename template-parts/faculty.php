<?php
/**
 * Template Part: Faculty & Staff Section (คณาจารย์ & บุคลากร)
 *
 * Displays CS BUU faculty members queried dynamically from WP Admin CPT cs_faculty
 *
 * @package BUU_SE_Landing
 */

$faculty_query = new WP_Query( array(
	'post_type'      => 'cs_faculty',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );
?>

<section id="faculty" class="faculty-section section-padding bg-slate">
	<div class="container">
		<div class="section-header text-center">
			<span class="section-badge gold">FACULTY & STAFF</span>
			<h2 class="section-title">
				คณาจารย์ผู้เชี่ยวชาญ <span class="dek-cs-text">CS BUU</span>
			</h2>
			<p class="section-subtitle">
				ทีมอาจารย์ผู้ทรงคุณวุฒิ มุ่งเน้นถ่ายทอดทฤษฎีคอมพิวเตอร์ ปัญญาประดิษฐ์ (AI) และประสบการณ์จริงจากอุตสาหกรรมเทคโนโลยี
			</p>
		</div>

		<?php if ( $faculty_query->have_posts() ) : ?>
			<div class="faculty-grid">
				<?php
				while ( $faculty_query->have_posts() ) :
					$faculty_query->the_post();
					$faculty_id    = get_the_ID();
					$position      = get_post_meta( $faculty_id, '_faculty_position', true );
					$email         = get_post_meta( $faculty_id, '_faculty_email', true );
					$expertise     = get_post_meta( $faculty_id, '_faculty_expertise', true );
					$has_thumb     = has_post_thumbnail( $faculty_id );
					$thumb_url     = $has_thumb ? get_the_post_thumbnail_url( $faculty_id, 'medium_large' ) : '';
					$expertise_arr = ! empty( $expertise ) ? array_map( 'trim', explode( ',', $expertise ) ) : array();
					?>
					<div class="faculty-card">
						<div class="faculty-avatar-wrap">
							<?php if ( $has_thumb ) : ?>
								<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="faculty-avatar-img" />
							<?php else : ?>
								<div class="faculty-avatar-placeholder">
									<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
								</div>
							<?php endif; ?>
							
							<?php if ( ! empty( $position ) ) : ?>
								<span class="faculty-badge"><?php echo esc_html( $position ); ?></span>
							<?php endif; ?>
						</div>

						<div class="faculty-card-body">
							<h3 class="faculty-name"><?php the_title(); ?></h3>

							<?php if ( ! empty( $email ) ) : ?>
								<a href="mailto:<?php echo esc_attr( $email ); ?>" class="faculty-email">
									<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
									<span><?php echo esc_html( $email ); ?></span>
								</a>
							<?php endif; ?>

							<?php if ( ! empty( $expertise_arr ) ) : ?>
								<div class="faculty-expertise-list">
									<?php foreach ( $expertise_arr as $exp ) : ?>
										<span class="exp-tag"><?php echo esc_html( $exp ); ?></span>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>

		<div class="faculty-footer-cta text-center" style="margin-top: 3rem;">
			<a href="https://www.informatics.buu.ac.th/?page_id=349" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-lg">
				<span>ดูรายชื่อบุคลากรทั้งหมดของคณะวิทยาการสารสนเทศ</span>
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
			</a>
		</div>
	</div>
</section>
