<?php
/**
 * Template Part: Hero Section - Computer Science (CS) BUU
 *
 * @package BUU_SE_Landing
 */

?>
<section id="hero" class="hero-section hero-cs-100vh">
    <div class="hero-grid-pattern" aria-hidden="true"></div>

    <div class="container hero-container">
        <div class="hero-layout">
            <!-- Hero Content Text Column -->
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="pulse-dot"></span>
                    <span>เปิดรับสมัคร TCAS • หลักสูตรวิทยาศาสตรบัณฑิต (วิทยาการคอมพิวเตอร์)</span>
                </div>

                <h1 class="hero-title">
                    ขับเคลื่อนนวัตกรรมด้วย <br/>
                    <span class="hero-title-accent">Computer Science</span> <br/>
                    คณะวิทยาการสารสนเทศ ม.บูรพา
                </h1>

                <p class="hero-subtitle">
                    หลักสูตรปรับปรุง พ.ศ. 2565 มุ่งเน้นทฤษฎีการคำนวณ (Theory of Computation), ปัญญาประดิษฐ์ (AI & Machine Learning), การวิเคราะห์ขั้นตอนวิธี (Algorithms) และการประมวลผลข้อมูลสารสนเทศ เพื่อผลิตนักวิทยาศาสตร์คอมพิวเตอร์และนักพัฒนาซอฟต์แวร์ชั้นนำ
                </p>

                <div class="hero-actions">
                    <a href="#news" class="btn btn-gold btn-lg hero-cta-primary">
                        <span>ข่าวสาร & รายละเอียดหลักสูตร</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                    <a href="#tracks" class="btn btn-outline-light btn-lg hero-cta-secondary">
                        <span>ดูสายงานเฉพาะทาง (Tracks)</span>
                    </a>
                </div>

                <!-- Quick Tech Highlights Badges -->
                <div class="hero-tags">
                    <span class="tag-pill">AI & Machine Learning</span>
                    <span class="tag-pill">Algorithms & Data Structures</span>
                    <span class="tag-pill">Computational Science</span>
                    <span class="tag-pill">Cloud & Distributed Systems</span>
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
                        <span class="terminal-title">buu_cs_curriculum_2565.py</span>
                    </div>
                    <div class="terminal-body">
                        <pre><code><span class="code-keyword">class</span> <span class="code-type">ComputerScienceBUU</span>:
    <span class="code-keyword">def</span> <span class="code-func">__init__</span>(self):
        self.degree = <span class="code-string">"วท.บ. (วิทยาการคอมพิวเตอร์)"</span>
        self.credits = <span class="code-number">123</span>  <span class="code-comment"># Minimum credits</span>
        self.tuition = <span class="code-string">"23,000 THB / Semester"</span>
        self.focus_areas = [
            <span class="code-string">"Theory of Computation & AI"</span>,
            <span class="code-string">"Algorithm Analysis & Design"</span>,
            <span class="code-string">"Data Science & Computational Math"</span>
        ]

    <span class="code-keyword">def</span> <span class="code-func">get_career_outcomes</span>(self):
        <span class="code-keyword">return</span> [
            <span class="code-string">"AI / Machine Learning Engineer"</span>,
            <span class="code-string">"Data Scientist & Researcher"</span>,
            <span class="code-string">"Full-Stack Software Architect"</span>
        ]

cs_program = ComputerScienceBUU()
print(cs_program.get_career_outcomes())</code></pre>
                    </div>
                </div>

                <!-- Live Highlight Floating Badge -->
                <div class="floating-stat-pill">
                    <div class="stat-icon-wrap">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <div>
                        <div class="stat-val">23,000 บาท</div>
                        <div class="stat-lbl">ค่าธรรมเนียมการศึกษาแบบเหมาจ่าย / เทอม</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
