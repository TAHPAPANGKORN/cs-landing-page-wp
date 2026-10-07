<?php
/**
 * Template Part: CWIE Partners Carousel Slider
 *
 * @package BUU_SE_Landing
 */

$partners_query = new WP_Query(
	array(
		'post_type'      => 'partner',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order title',
		'order'          => 'ASC',
	)
);

// Fallback partners if WP Admin has no partners added yet
$default_partners = array(
	array(
		'name' => 'บริษัท มายออเดอร์ อินเทลลิเจนซ์ จำกัด',
		'logo' => 'data:image/svg+xml;utf8,' . rawurlencode( '<svg width="200" height="100" viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"><rect width="60" height="60" x="70" y="10" rx="10" fill="#111"/><path d="M85 30h30v20H85z" fill="#FFF"/><text x="100" y="85" font-family="sans-serif" font-size="10" font-weight="bold" text-anchor="middle" fill="#333">MY ORDER</text></svg>' ),
	),
	array(
		'name' => 'บริษัท ปตท. จำกัด (มหาชน) ศูนย์ปฏิบัติการชลบุรี',
		'logo' => 'data:image/svg+xml;utf8,' . rawurlencode( '<svg width="200" height="100" viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"><circle cx="70" cy="50" r="22" fill="#E11D48"/><text x="120" y="58" font-family="sans-serif" font-size="28" font-weight="bold" font-style="italic" fill="#003366">ptt</text></svg>' ),
	),
	array(
		'name' => 'บริษัท สยาม เด็นโซ่ แมนูแฟคเจอริ่ง จำกัด',
		'logo' => 'data:image/svg+xml;utf8,' . rawurlencode( '<svg width="200" height="100" viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"><text x="100" y="52" font-family="sans-serif" font-size="26" font-weight="bold" font-style="italic" text-anchor="middle" fill="#B91C1C">DENSO</text><text x="100" y="70" font-family="sans-serif" font-size="9" text-anchor="middle" fill="#666">Crafting the Core</text></svg>' ),
	),
	array(
		'name' => 'สำนักงานกองทุนสนับสนุนการสร้างเสริมสุขภาพ (สสส.)',
		'logo' => 'data:image/svg+xml;utf8,' . rawurlencode( '<svg width="200" height="100" viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"><text x="100" y="48" font-family="sans-serif" font-size="28" font-weight="bold" text-anchor="middle" fill="#15803D">สสส</text><text x="100" y="68" font-family="sans-serif" font-size="8" text-anchor="middle" fill="#666">การสร้างเสริมสุขภาพ</text></svg>' ),
	),
	array(
		'name' => 'เทศบาลเมืองแสนสุข จังหวัดชลบุรี',
		'logo' => 'data:image/svg+xml;utf8,' . rawurlencode( '<svg width="200" height="100" viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"><circle cx="100" cy="45" r="25" fill="none" stroke="#0284C7" stroke-width="4"/><path d="M100 25L100 65M80 45L120 45" stroke="#0284C7" stroke-width="3"/><text x="100" y="82" font-family="sans-serif" font-size="9" text-anchor="middle" fill="#333">เมืองแสนสุข</text></svg>' ),
	),
	array(
		'name' => 'บริษัท มัลติเวิร์ส เอ็กซ์เปิร์ท จำกัด',
		'logo' => 'data:image/svg+xml;utf8,' . rawurlencode( '<svg width="200" height="100" viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"><rect x="70" y="20" width="60" height="60" fill="#000"/><path d="M85 50l15-15 15 15-15 15z" fill="#FFF"/></svg>' ),
	),
);
?>

<section id="partners-carousel" class="partners-section section-padding">
    <div class="container">
        <div class="section-header text-center">
            <span class="partners-badge-header">เครือข่ายองค์กรพันธมิตรและสถานประกอบการ (CWIE PARTNERS)</span>
        </div>

        <div class="partners-slider-wrapper">
            <div class="partners-track">
				<?php if ( $partners_query->have_posts() ) : ?>
					<?php
					// Loop 1 for seamless infinite marquee slider
					while ( $partners_query->have_posts() ) :
						$partners_query->the_post();
						$logo_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '';
						?>
						<?php if ( $logo_url ) : ?>
                            <div class="partner-card-item">
                                <div class="partner-logo-box">
                                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="partner-logo-img" />
                                </div>
                                <div class="partner-name"><?php the_title(); ?></div>
                            </div>
						<?php else : ?>
                            <div class="partner-card-item partner-text-only">
                                <div class="partner-name"><?php the_title(); ?></div>
                            </div>
						<?php endif; ?>
					<?php endwhile; ?>

					<?php
					// Loop 2 for seamless infinite marquee slider
					$partners_query->rewind_posts();
					while ( $partners_query->have_posts() ) :
						$partners_query->the_post();
						$logo_url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '';
						?>
						<?php if ( $logo_url ) : ?>
                            <div class="partner-card-item" aria-hidden="true">
                                <div class="partner-logo-box">
                                    <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="partner-logo-img" />
                                </div>
                                <div class="partner-name"><?php the_title(); ?></div>
                            </div>
						<?php else : ?>
                            <div class="partner-card-item partner-text-only" aria-hidden="true">
                                <div class="partner-name"><?php the_title(); ?></div>
                            </div>
						<?php endif; ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<?php
					$all_fallbacks = array_merge( $default_partners, $default_partners );
					foreach ( $all_fallbacks as $partner ) :
						?>
                        <div class="partner-card-item">
                            <div class="partner-logo-box">
                                <img src="<?php echo esc_url( $partner['logo'] ); ?>" alt="<?php echo esc_attr( $partner['name'] ); ?>" class="partner-logo-img" />
                            </div>
                            <div class="partner-name"><?php echo esc_html( $partner['name'] ); ?></div>
                        </div>
					<?php endforeach; ?>
				<?php endif; ?>
            </div>
        </div>
    </div>
</section>
