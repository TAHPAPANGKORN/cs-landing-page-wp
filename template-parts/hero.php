<?php
/**
 * Template Part: Hero Section
 *
 * @package BUU_SE_Landing
 */

?>
<section id="hero" class="hero-section hero-premium">
    <div class="hero-grid-pattern" aria-hidden="true"></div>
    <div class="hero-orb hero-orb-primary" aria-hidden="true"></div>
    <div class="hero-orb hero-orb-secondary" aria-hidden="true"></div>

    <div class="container hero-container">
        <div class="hero-layout">
            <!-- Hero Content Text Column -->
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="pulse-dot"></span>
                    <span>เปิดรับสมัคร TCAS 68 • หลักสูตรวิทยาศาสตรบัณฑิต</span>
                </div>

                <h1 class="hero-title">
                    สร้างสรรค์อนาคตด้วย <br/>
                    <span class="hero-title-accent">Software Engineering</span> <br/>
                    มหาวิทยาลัยบูรพา
                </h1>

                <p class="hero-subtitle">
                    หลักสูตรวิศวกรรมซอฟต์แวร์ คณะวิทยาการสารสนเทศ มุ่งเน้นการลงมือพัฒนาซอฟต์แวร์จริง เรียนรู้กระบวนการระดับอุตสาหกรรม (Agile, Cloud, DevOps, AI) พร้อมก้าวสู่สายอาชีพ Tech Standard ระดับสากล
                </p>

                <div class="hero-actions">
                    <a href="#admission" class="btn btn-gold btn-lg hero-cta-primary">
                        <span>สนใจสมัครเรียน (TCAS)</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="#tracks" class="btn btn-outline-light btn-lg hero-cta-secondary">
                        <span>ดูแผนการเรียน & Tracks</span>
                    </a>
                </div>

                <!-- Quick Tech Highlights Badges -->
                <div class="hero-tags">
                    <span class="tag-pill">Full-Stack Development</span>
                    <span class="tag-pill">DevOps & Cloud</span>
                    <span class="tag-pill">AI & Data Pipeline</span>
                    <span class="tag-pill">Software Architecture</span>
                </div>
            </div>

            <!-- Hero Visual Showcase Card -->
            <div class="hero-media-shell">
                <div class="code-terminal-card">
                    <div class="terminal-header">
                        <div class="terminal-dots">
                            <span class="dot dot-red"></span>
                            <span class="dot dot-yellow"></span>
                            <span class="dot dot-green"></span>
                        </div>
                        <span class="terminal-title">buu_se_curriculum.config.ts</span>
                    </div>
                    <div class="terminal-body">
                        <pre><code><span class="code-keyword">import</span> { <span class="code-type">SoftwareEngineer</span> } <span class="code-keyword">from</span> <span class="code-string">'@buu/informatics'</span>;

<span class="code-keyword">const</span> student = <span class="code-keyword">new</span> <span class="code-type">SoftwareEngineer</span>({
  university: <span class="code-string">'Burapha University'</span>,
  faculty: <span class="code-string">'Informatics'</span>,
  handsOnRatio: <span class="code-string">'70% Practical / 30% Theory'</span>,
  careerOutcome: [
    <span class="code-string">'Full-Stack Engineer'</span>,
    <span class="code-string">'DevOps Engineer'</span>,
    <span class="code-string">'AI Application Architect'</span>
  ],
  employmentRate: <span class="code-number">98.5</span>
});

student.<span class="code-func">compileSuccess</span>();</code></pre>
                    </div>
                </div>

                <!-- Live Highlight Floating Pill -->
                <div class="floating-stat-pill">
                    <div class="stat-icon-wrap">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <div>
                        <div class="stat-val">98.5%</div>
                        <div class="stat-lbl">อัตราการได้งานทำหลังจบการศึกษา</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
