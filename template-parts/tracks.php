<?php
/**
 * Template Part: Curriculum Tracks Section
 *
 * @package BUU_SE_Landing
 */

?>
<section id="tracks" class="tracks-section section-padding bg-slate">
    <div class="container">
        <div class="section-header text-center">
            <span class="section-badge">เส้นทางความเชี่ยวชาญ</span>
            <h2 class="section-title">4 แผนการเรียนเจาะลึก (Specialization Tracks)</h2>
            <p class="section-subtitle">
                ออกแบบหลักสูตรให้สอดคล้องกับความต้องการของตลาดงานเทคโนโลยี ปรับแต่งทิศทางความเชี่ยวชาญตามความสนใจ
            </p>
        </div>

        <div class="tracks-grid">
            <!-- Track 1: Full-Stack Engineering -->
            <div class="track-card active">
                <div class="track-badge">Popular</div>
                <div class="track-icon">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
                </div>
                <h3 class="track-title">Full-Stack Web & Mobile Development</h3>
                <p class="track-desc">
                    เน้นการพัฒนาแอปพลิเคชันเว็บและมือถือตั้งแต่ Frontend ยัน Backend ด้วยเฟรมเวิร์กสมัยใหม่ ประสิทธิภาพสูง
                </p>
                <div class="track-skills">
                    <span class="skill-tag">TypeScript</span>
                    <span class="skill-tag">React / Next.js</span>
                    <span class="skill-tag">Node.js / Go</span>
                    <span class="skill-tag">React Native</span>
                    <span class="skill-tag">PostgreSQL</span>
                </div>
                <ul class="track-highlights-list">
                    <li>ออกแบบ RESTful API & GraphQL Services</li>
                    <li>รองรับการสเกลผู้ใช้งานระดับ Microservices</li>
                    <li>เน้น UI/UX Design System Integration</li>
                </ul>
            </div>

            <!-- Track 2: DevOps & Cloud Infrastructure -->
            <div class="track-card">
                <div class="track-badge">In Demand</div>
                <div class="track-icon">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path></svg>
                </div>
                <h3 class="track-title">DevOps & Cloud Engineering</h3>
                <p class="track-desc">
                    เชี่ยวชาญการบริหารจัดการโครงสร้างพื้นฐานคลาวด์ กระบวนการ CI/CD Automation และระบบความปลอดภัย Infrastructure
                </p>
                <div class="track-skills">
                    <span class="skill-tag">Docker</span>
                    <span class="skill-tag">Kubernetes</span>
                    <span class="skill-tag">AWS / GCP</span>
                    <span class="skill-tag">Terraform</span>
                    <span class="skill-tag">CI/CD Pipelines</span>
                </div>
                <ul class="track-highlights-list">
                    <li>อัตโนมัติการทดสอบและปรับปรุงซอฟต์แวร์</li>
                    <li>การตั้งค่า Monitoring & Observability</li>
                    <li>การบริหารทรัพยากรแบบ Infrastructure as Code</li>
                </ul>
            </div>

            <!-- Track 3: AI Application & Data Engineering -->
            <div class="track-card">
                <div class="track-badge">High Tech</div>
                <div class="track-icon">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                </div>
                <h3 class="track-title">AI Application & Data Engineering</h3>
                <p class="track-desc">
                    ประยุกต์ใช้โมเดลปัญญาประดิษฐ์ (AI/LLM) ในระบบซอฟต์แวร์ประยุกต์ การทำ Data Pipeline และประมวลผลข้อมูลขนาดใหญ่
                </p>
                <div class="track-skills">
                    <span class="skill-tag">Python</span>
                    <span class="skill-tag">PyTorch</span>
                    <span class="skill-tag">LLM Integration</span>
                    <span class="skill-tag">Apache Spark</span>
                    <span class="skill-tag">Vector DB</span>
                </div>
                <ul class="track-highlights-list">
                    <li>การเชื่อมต่อ AI APIs เข้ากับผลิตภัณฑ์ซอฟต์แวร์</li>
                    <li>การจัดการและทำความสะอาด Data Pipelines</li>
                    <li>การประมวลผล Real-time Analytics</li>
                </ul>
            </div>

            <!-- Track 4: Software Architecture & Security -->
            <div class="track-card">
                <div class="track-badge">Leadership</div>
                <div class="track-icon">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3 class="track-title">Software Architecture & Security</h3>
                <p class="track-desc">
                    การวางสถาปัตยกรรมระบบซอฟต์แวร์ขนาดใหญ่ Design Patterns และการปกป้องระบบจากภัยคุกคามทางไซเบอร์
                </p>
                <div class="track-skills">
                    <span class="skill-tag">System Design</span>
                    <span class="skill-tag">Microservices</span>
                    <span class="skill-tag">DevSecOps</span>
                    <span class="skill-tag">OWASP Security</span>
                    <span class="skill-tag">Domain-Driven Design</span>
                </div>
                <ul class="track-highlights-list">
                    <li>การวางรากฐานระบบ Enterprise Application</li>
                    <li>Security Audit & Threat Modeling</li>
                    <li>การปรับปรุงประสิทธิภาพ High Availability Systems</li>
                </ul>
            </div>
        </div>
    </div>
</section>
