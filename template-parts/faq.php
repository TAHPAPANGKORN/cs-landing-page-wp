<?php
/**
 * Template Part: Frequently Asked Questions (FAQ) Section
 * Dynamic WP Admin Management Support (CPT: cs_faq)
 *
 * @package BUU_SE_Landing
 */

$faq_query = new WP_Query(
	array(
		'post_type'      => 'cs_faq',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
	)
);
?>
<section id="faq" class="faq-section section-padding bg-slate">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">คำถามที่พบบ่อย</span>
            <h2 class="section-title">FAQ คำถามที่ถามบ่อยเกี่ยวกับหลักสูตร</h2>
            <p class="section-subtitle">
                รวบรวมข้อสงสัยเกี่ยวกับการเรียน การรับสมัคร และโอกาสทางอาชีพของคณะวิทยาการสารสนเทศ
            </p>
        </div>

        <div class="faq-accordion-wrap">
			<?php if ( $faq_query->have_posts() ) : ?>
				<?php
				$faq_count = 0;
				while ( $faq_query->have_posts() ) :
					$faq_query->the_post();
					$faq_count++;
					$is_first = ( 1 === $faq_count );
					?>
                    <div class="faq-item <?php echo $is_first ? 'active' : ''; ?>">
                        <button class="faq-question" aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>">
                            <span><?php the_title(); ?></span>
                            <span class="faq-icon">+</span>
                        </button>
                        <div class="faq-answer">
                            <div class="article-body">
								<?php the_content(); ?>
                            </div>
                        </div>
                    </div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
                <!-- Fallback FAQ Item 1 -->
                <div class="faq-item active">
                    <button class="faq-question" aria-expanded="true">
                        <span>คุณสมบัติและเกณฑ์การรับสมัครเข้าศึกษาเป็นอย่างไร?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            เปิดรับนักเรียนระดับชั้น ม.6, ปวช. หรือเทียบเท่าที่มีความสนใจด้านเทคโนโลยีและการเขียนโปรแกรม โดยในรอบ TCAS 1 (Portfolio) จะพิจารณาผลงาน โครงงาน หรือรางวัลการแข่งขัน ส่วนรอบ TCAS 3 (Admission) จะพิจารณาคะแนนสอบกลาง TGAT/TPAT3 และ A-Level ตามเกณฑ์ที่มหาวิทยาลัยกำหนด
                        </p>
                    </div>
                </div>

                <!-- Fallback FAQ Item 2 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span>ค่าธรรมเนียมการศึกษาต่อภาคการศึกษาเท่าไหร่?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            ค่าธรรมเนียมการศึกษาเป็นแบบเหมาจ่ายตามประกาศของมหาวิทยาลัยบูรพา โดยเฉลี่ยประมาณ 18,000 - 24,000 บาทต่อภาคการศึกษา (ขึ้นอยู่กับประเภทหลักสูตรปกติหรือโครงการพิเศษ) และมีทุนการศึกษาสำหรับนิสิตเรียนดีและนิสิตขาดแคลนทุนทรัพย์
                        </p>
                    </div>
                </div>

                <!-- Fallback FAQ Item 3 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span>มีโอกาสฝึกงานหรือทำสหกิจศึกษากับบริษัท Tech ชั้นนำหรือไม่?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            มีแน่นอน นิสิตชั้นปีที่ 4 ทุกคนจะได้เข้าร่วมโครงการสหกิจศึกษา (Co-operative Education) ปฏิบัติงานจริงเต็มเวลา 1 ภาคการศึกษากับบริษัทพันธมิตร เช่น KBTG, Agoda, LINE Thailand, Shopee, SCB TechX และหน่วยงานในเขตนวัตกรรม EEC
                        </p>
                    </div>
                </div>

                <!-- Fallback FAQ Item 4 -->
                <div class="faq-item">
                    <button class="faq-question" aria-expanded="false">
                        <span>หลักสูตรใช้เวลาเรียนกี่ปี และจบแล้วได้รับคุณวุฒิปริญญาอะไร?</span>
                        <span class="faq-icon">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            หลักสูตร 4 ปีการศึกษา (สามารถเรียนจบได้ใน 3.5 ปีหากวางแผนรายวิชาตามเกณฑ์) เมื่อสำเร็จการศึกษาจะได้รับคุณวุฒิ วิทยาศาสตรบัณฑิต (วท.บ.) / Bachelor of Science (B.Sc.) คณะวิทยาการสารสนเทศ มหาวิทยาลัยบูรพา
                        </p>
                    </div>
                </div>
			<?php endif; ?>
        </div>
    </div>
</section>
