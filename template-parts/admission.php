<?php
/**
 * Template Part: TCAS Admission Section (Data synced with official BUU CS TCAS requirements)
 *
 * @package BUU_SE_Landing
 */

$mytcas_url = 'https://course.mytcas.com/programs/10190110220101A';

$tcas_rounds = array(
	array(
		'id'             => 'tcas-portfolio',
		'tcas_code'      => 'TCAS 1',
		'title'          => 'Portfolio',
		'status'         => 'เปิดรับสมัคร',
		'subtitle'       => 'พิจารณาคุณสมบัติและแฟ้มสะสมผลงาน (Portfolio)',
		'time_period'    => 'ช่วงเวลา: ตามประกาศรับสมัครรอบ Portfolio ของมหาวิทยาลัย',
		'full_title'     => 'TCAS 1 • Portfolio',
		'description'    => 'ผู้สมัครเข้าศึกษาหลักสูตรวิทยาศาสตรบัณฑิต สาขาวิชาวิทยาการคอมพิวเตอร์ มีผลการเรียนเฉลี่ยตามเกณฑ์ที่กำหนดในรอบการรับสมัคร TCAS',
		'math_credits'   => '10',
		'eng_credits'    => '7',
		'gpax_min'       => '2.50',
		'exam_subjects'  => 'แฟ้มสะสมผลงาน (Portfolio) — รอบนี้ไม่กำหนดคะแนนวิชาสอบกลางส่วนเพิ่มเติม',
		'conditions'     => array(
			'ผ่านการเรียนกลุ่มสาระการเรียนรู้ทางคณิตศาสตร์ ไม่ต่ำกว่า 10 หน่วยกิต',
			'ผ่านการเรียนกลุ่มสาระการเรียนรู้ทางภาษาต่างประเทศ ไม่ต่ำกว่า 7 หน่วยกิต',
			'มีความรู้พื้นฐานทางคณิตศาสตร์และด้านภาษาอังกฤษเป็นอย่างดี ซื่อสัตย์ ขยัน อดทน กระตือรือร้น ใฝ่หาความรู้ให้ทันสมัยอยู่เสมอ',
			'มีตรรกะในการวิเคราะห์แก้ปัญหา อย่างเป็นลำดับขั้นตอน',
			'ยื่นแฟ้มสะสมผลงาน (Portfolio) ตามเกณฑ์ที่คณะกำหนด',
		),
		'qualifications' => array(
			array( 'text' => 'รับผู้สมัครที่มาจากโรงเรียนหลักสูตรแกนกลาง (ม.6)', 'is_allowed' => true ),
			array( 'text' => 'มีตรรกะในการวิเคราะห์แก้ปัญหาอย่างเป็นลำดับขั้นตอน', 'is_allowed' => true ),
			array( 'text' => 'มีความรู้พื้นฐานทางคณิตศาสตร์และภาษาอังกฤษเป็นอย่างดี', 'is_allowed' => true ),
		),
		'is_active'      => true,
	),
	array(
		'id'             => 'tcas-quota',
		'tcas_code'      => 'TCAS 2',
		'title'          => 'Quota',
		'status'         => 'ปิดรับสมัคร',
		'subtitle'       => 'โควตาภาคตะวันออก 12 จังหวัด (TGAT ≥ 60, TPAT3 ≥ 30)',
		'time_period'    => 'ช่วงเวลา: ตามประกาศรับสมัครรอบ Quota ของมหาวิทยาลัย',
		'full_title'     => 'TCAS 2 • Quota',
		'description'    => 'ผู้สมัครเข้าศึกษาหลักสูตรวิทยาศาสตรบัณฑิต สาขาวิชาวิทยาการคอมพิวเตอร์ ในเขตพื้นที่โควตา 12 จังหวัดภาคตะวันออก',
		'math_credits'   => '10',
		'eng_credits'    => '7',
		'gpax_min'       => '2.75',
		'exam_subjects'  => 'ค่าคะแนนวิชา TGAT ต้องได้ไม่ต่ำกว่า 60 คะแนน | ค่าคะแนนวิชา TPAT3 ต้องได้ไม่ต่ำกว่า 30 คะแนน',
		'conditions'     => array(
			'ผ่านการเรียนกลุ่มสาระการเรียนรู้ทางคณิตศาสตร์ ไม่ต่ำกว่า 10 หน่วยกิต',
			'ผ่านการเรียนกลุ่มสาระการเรียนรู้ทางภาษาต่างประเทศ ไม่ต่ำกว่า 7 หน่วยกิต',
			'ค่าคะแนนวิชา TGAT ต้องได้ไม่ต่ำกว่า 60 คะแนน',
			'ค่าคะแนนวิชา TPAT3 ต้องได้ไม่ต่ำกว่า 30 คะแนน',
			'มีความรู้พื้นฐานทางคณิตศาสตร์และด้านภาษาอังกฤษเป็นอย่างดี ซื่อสัตย์ ขยัน อดทน กระตือรือร้น ใฝ่หาความรู้ให้ทันสมัยอยู่เสมอ',
		),
		'qualifications' => array(
			array( 'text' => 'รับผู้สมัครจากโรงเรียน 12 จังหวัดภาคตะวันออก (ม.6)', 'is_allowed' => true ),
			array( 'text' => 'คะแนน TGAT ต้องไม่ต่ำกว่า 60 คะแนน', 'is_allowed' => true ),
			array( 'text' => 'คะแนน TPAT3 ต้องไม่ต่ำกว่า 30 คะแนน', 'is_allowed' => true ),
		),
		'is_active'      => false,
	),
	array(
		'id'             => 'tcas-admission',
		'tcas_code'      => 'TCAS 3',
		'title'          => 'Admission',
		'status'         => 'ปิดรับสมัคร',
		'subtitle'       => 'รับทั่วประเทศ (TGAT ≥ 55, TPAT3 ≥ 40, คณิต 12 หน่วยกิต)',
		'time_period'    => 'ช่วงเวลา: ระบบ mytcas.com 6-12 พ.ค. 69',
		'full_title'     => 'TCAS 3 • Admission',
		'description'    => 'ผู้สมัครเข้าศึกษาหลักสูตรวิทยาศาสตรบัณฑิต สาขาวิชาวิทยาการคอมพิวเตอร์ รอบ Admission ผ่านระบบกลาง myTCAS',
		'math_credits'   => '12',
		'eng_credits'    => '9',
		'gpax_min'       => '2.50',
		'exam_subjects'  => 'ค่าคะแนนวิชา TGAT ต้องได้ไม่ต่ำกว่า 55 คะแนน | ค่าคะแนนวิชา TPAT3 ต้องได้ไม่ต่ำกว่า 40 คะแนน',
		'conditions'     => array(
			'ผ่านการเรียนกลุ่มสาระการเรียนรู้ทางคณิตศาสตร์ ไม่ต่ำกว่า 12 หน่วยกิต',
			'ผ่านการเรียนกลุ่มสาระการเรียนรู้ทางภาษาต่างประเทศ ไม่ต่ำกว่า 9 หน่วยกิต',
			'ค่าคะแนนวิชา TGAT ต้องได้ไม่ต่ำกว่า 55 คะแนน',
			'ค่าคะแนนวิชา TPAT3 ต้องได้ไม่ต่ำกว่า 40 คะแนน',
			'มีความรู้พื้นฐานทางคณิตศาสตร์และด้านภาษาอังกฤษเป็นอย่างดี ซื่อสัตย์ ขยัน อดทน กระตือรือร้น ใฝ่หาความรู้ให้ทันสมัยอยู่เสมอ มีตรรกะในการวิเคราะห์แก้ปัญหา อย่างเป็นลำดับขั้นตอน',
		),
		'qualifications' => array(
			array( 'text' => 'รับผู้สมัครสำเร็จการศึกษาชั้น ม.6 ทั่วประเทศ', 'is_allowed' => true ),
			array( 'text' => 'คะแนน TGAT ต้องไม่ต่ำกว่า 55 คะแนน', 'is_allowed' => true ),
			array( 'text' => 'คะแนน TPAT3 ต้องไม่ต่ำกว่า 40 คะแนน', 'is_allowed' => true ),
		),
		'is_active'      => false,
	),
);
?>

<section class="admission-section section-padding" id="admission">
	<div class="container container-admission">
		<!-- Main Header matching reference -->
		<div class="admission-header text-center">
			<h2 class="admission-main-title">
				พร้อมที่จะมาเป็นครอบครัว <span class="brand-yellow-highlight">CS BUU</span> หรือยัง?
			</h2>
			<p class="admission-subtitle">
				เตรียมตัวให้พร้อม! ส่องเส้นทางการสมัครและรอบการคัดเลือกล่าสุด (TCAS)
			</p>
		</div>

		<!-- Top Row: 3 TCAS Round Cards Grid -->
		<div class="tcas-cards-grid" role="tablist">
			<?php foreach ( $tcas_rounds as $round ) : ?>
				<button 
					type="button"
					class="tcas-select-card <?php echo $round['is_active'] ? 'active' : ''; ?>"
					id="tab-<?php echo esc_attr( $round['id'] ); ?>"
					data-target="<?php echo esc_attr( $round['id'] ); ?>"
					role="tab"
					aria-selected="<?php echo $round['is_active'] ? 'true' : 'false'; ?>"
					aria-controls="panel-<?php echo esc_attr( $round['id'] ); ?>">
					
					<div class="tcas-card-topbar">
						<span class="tcas-code-pill"><?php echo esc_html( $round['tcas_code'] ); ?></span>
						<span class="tcas-status-pill"><?php echo esc_html( $round['status'] ); ?></span>
					</div>

					<h3 class="tcas-card-title"><?php echo esc_html( $round['title'] ); ?></h3>
					<p class="tcas-card-sub"><?php echo esc_html( $round['subtitle'] ); ?></p>
					<div class="tcas-card-time"><?php echo esc_html( $round['time_period'] ); ?></div>
				</button>
			<?php endforeach; ?>
		</div>

		<!-- Middle Section: Selected Round Detail Card -->
		<div class="tcas-detail-wrapper">
			<?php foreach ( $tcas_rounds as $round ) : ?>
				<div 
					class="tcas-detail-card <?php echo $round['is_active'] ? 'active' : ''; ?>"
					id="panel-<?php echo esc_attr( $round['id'] ); ?>"
					role="tabpanel"
					aria-labelledby="tab-<?php echo esc_attr( $round['id'] ); ?>">

					<!-- Header inside detail card -->
					<div class="detail-card-header">
						<div class="detail-header-left">
							<span class="detail-label-gold">รายละเอียดรอบที่เลือก</span>
							<h3 class="detail-title-main"><?php echo esc_html( $round['full_title'] ); ?></h3>
							<p class="detail-desc-text"><?php echo esc_html( $round['description'] ); ?></p>
						</div>
						<div class="detail-header-right">
							<a href="<?php echo esc_url( $mytcas_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-mytcas-link">
								<i class="fas fa-external-link-alt"></i> ดูข้อมูล myTCAS
							</a>
						</div>
					</div>

					<!-- Minimum Credits Boxes Grid (2 Cards) -->
					<div class="credits-boxes-grid">
						<div class="credit-box-item">
							<div class="credit-box-subject">คณิตศาสตร์</div>
							<div class="credit-box-number"><?php echo esc_html( $round['math_credits'] ); ?></div>
							<div class="credit-box-unit">หน่วยกิตขั้นต่ำ</div>
						</div>
						<div class="credit-box-item">
							<div class="credit-box-subject">ภาษาต่างประเทศ</div>
							<div class="credit-box-number"><?php echo esc_html( $round['eng_credits'] ); ?></div>
							<div class="credit-box-unit">หน่วยกิตขั้นต่ำ</div>
						</div>
					</div>

					<!-- 2 Columns Grid: Exam Subjects vs Specific Conditions -->
					<div class="criteria-two-cols">
						<!-- Left Box: Exam Subjects -->
						<div class="criteria-box-left">
							<h4 class="criteria-box-title">วิชาที่ใช้คะแนน</h4>
							<p class="criteria-box-desc"><?php echo esc_html( $round['exam_subjects'] ); ?></p>
						</div>

						<!-- Right Box: Specific Conditions -->
						<div class="criteria-box-right">
							<h4 class="criteria-box-title">เงื่อนไขเฉพาะรอบ</h4>
							<ul class="conditions-chevron-list">
								<?php foreach ( $round['conditions'] as $cond ) : ?>
									<li>
										<span class="chevron-gold">&#8250;</span>
										<span class="cond-text"><?php echo esc_html( $cond ); ?></span>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>

				</div>
			<?php endforeach; ?>
		</div>

		<!-- Bottom Card: Qualifications Grid -->
		<div class="tcas-qualifications-card">
			<h3 class="qualifications-title">คุณสมบัติที่ควรมี</h3>
			<div class="qualifications-pills-grid">
				<?php 
				$active_round = reset( $tcas_rounds );
				foreach ( $active_round['qualifications'] as $qual ) : 
				?>
					<div class="qual-pill-item">
						<span class="qual-pill-icon gold-dot">&#9679;</span>
						<span class="qual-pill-text"><?php echo esc_html( $qual['text'] ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

	</div>
</section>
