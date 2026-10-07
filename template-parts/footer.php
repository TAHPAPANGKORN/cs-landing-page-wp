<?php
/**
 * Template Part: Site Footer
 *
 * @package BUU_SE_Landing
 */

?>
<footer class="site-footer" id="site-footer">
    <div class="container">
        <div class="footer-top-grid">
            <!-- Footer Col 1: Brand & Bio -->
            <div class="footer-col brand-col">
                <div class="footer-logo">
                    <div class="logo-badge">
                        <span class="logo-code">CS</span>
                    </div>
                    <div class="logo-text">
                        <span class="logo-title">Computer Science</span>
                        <span class="logo-sub">INFORMATICS BURAPHA</span>
                    </div>
                </div>
                <p class="footer-bio">
                    สาขาวิชาวิทยาการคอมพิวเตอร์ คณะวิทยาการสารสนเทศ มหาวิทยาลัยบูรพา <br/>
                    169 ถนนลงหาดบางแสน ต.แสนสุข อ.เมือง จ.ชลบุรี 20131
                </p>
                <div class="social-links">
                    <a href="https://www.facebook.com/informaticsbuu" target="_blank" rel="noopener noreferrer" aria-label="Facebook Page">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://www.informatics.buu.ac.th/" target="_blank" rel="noopener noreferrer" aria-label="Faculty Website">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                    </a>
                    <a href="https://www.youtube.com/channel/UCI0YkQlBZS5vqDtgIW3Mo9w" target="_blank" rel="noopener noreferrer" aria-label="YouTube Channel">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Footer Col 2: Navigation Links -->
            <div class="footer-col">
                <h4 class="footer-title">เมนูหลัก</h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">หน้าแรก</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#admission' ) ); ?>">การรับสมัคร TCAS</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#tracks' ) ); ?>">หลักสูตรและแขนงวิชา</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#news' ) ); ?>">ข่าวสารและกิจกรรม</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>">ภาพกิจกรรม</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>">คำถามที่พบบ่อย (FAQ)</a></li>
                </ul>
            </div>

            <!-- Footer Col 3: Contact Info -->
            <div class="footer-col">
                <h4 class="footer-title">ติดต่อเรา</h4>
                <ul class="footer-contact">
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span><strong>โทรศัพท์:</strong>+66 (0)38-103096</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <span><strong>อีเมล:</strong> pr@informatics.buu.ac.th</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"></path><path d="M9 8h1"></path><path d="M9 12h1"></path><path d="M9 16h1"></path><path d="M14 8h1"></path><path d="M14 12h1"></path><path d="M14 16h1"></path><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path></svg>
                        <span><strong>สถานที่ตั้ง:</strong> อาคารคณะวิทยาการสารสนเทศ</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom Copyright -->
        <div class="footer-bottom">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Computer Science, Faculty of Informatics, Burapha University. All Rights Reserved.</p>
        </div>
    </div>
</footer>
