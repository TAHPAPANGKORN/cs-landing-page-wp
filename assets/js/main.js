/**
 * BUU Software Engineering Landing Page Main JavaScript
 * Zero-dependency Vanilla JS
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Drawer Navigation Toggle
    const mobileToggleBtn = document.getElementById('mobile-drawer-toggle');
    const drawerOverlay = document.getElementById('drawer-overlay');
    const drawerCloseBtn = document.getElementById('drawer-close-btn');
    const mobileDrawer = document.getElementById('mobile-drawer');
    const drawerLinks = document.querySelectorAll('.drawer-link');

    function openMobileMenu() {
        if (!mobileDrawer) return;
        mobileDrawer.classList.add('open');
        mobileDrawer.setAttribute('aria-hidden', 'false');
        if (mobileToggleBtn) mobileToggleBtn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        if (!mobileDrawer) return;
        mobileDrawer.classList.remove('open');
        mobileDrawer.setAttribute('aria-hidden', 'true');
        if (mobileToggleBtn) mobileToggleBtn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (mobileToggleBtn) {
        mobileToggleBtn.addEventListener('click', openMobileMenu);
    }
    if (drawerCloseBtn) {
        drawerCloseBtn.addEventListener('click', closeMobileMenu);
    }
    if (drawerOverlay) {
        drawerOverlay.addEventListener('click', closeMobileMenu);
    }

    drawerLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // 2. Sticky Navbar Scroll Effect
    const siteHeader = document.getElementById('site-header');
    window.addEventListener('scroll', () => {
        if (!siteHeader) return;
        if (window.scrollY > 40) {
            siteHeader.classList.add('scrolled');
        } else {
            siteHeader.classList.remove('scrolled');
        }
    });

    // 3. FAQ Accordion Toggle Interaction
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const questionBtn = item.querySelector('.faq-question');
        if (questionBtn) {
            questionBtn.addEventListener('click', () => {
                const isActive = item.classList.contains('active');

                // Close all other items
                faqItems.forEach(otherItem => {
                    otherItem.classList.remove('active');
                    const otherBtn = otherItem.querySelector('.faq-question');
                    if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                });

                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                    questionBtn.setAttribute('aria-expanded', 'true');
                }
            });
        }
    });

    // 4. Smooth Anchor Scroll for Header Links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                e.preventDefault();
                const navHeight = siteHeader ? siteHeader.offsetHeight : 80;
                const elementPosition = targetSection.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - navHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // 5. Scroll Active State Highlighting for Navigation
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        let currentSectionId = '';
        const scrollPosition = window.pageYOffset + 120;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSectionId = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${currentSectionId}`) {
                link.classList.add('active');
            }
        });
    });

    // 6. Interactive Category Pill Filter for Archive Gallery Page
    const pillTabs = document.querySelectorAll('.pill-tab');
    const newsCards = document.querySelectorAll('.archive-news-card');

    if (pillTabs.length > 0 && newsCards.length > 0) {
        pillTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const filter = tab.getAttribute('data-filter');

                // Toggle Active Tab
                pillTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Filter Cards
                newsCards.forEach(card => {
                    if (filter === 'all' || card.classList.contains(filter)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }

    // 7. Interactive TCAS Round Tab Switcher (Reference Matched)
    const tcasCards = document.querySelectorAll('.tcas-select-card');
    const tcasDetailPanels = document.querySelectorAll('.tcas-detail-card');

    if (tcasCards.length > 0 && tcasDetailPanels.length > 0) {
        tcasCards.forEach(card => {
            card.addEventListener('click', () => {
                const targetId = card.getAttribute('data-target');

                // Switch Active Card Button
                tcasCards.forEach(c => {
                    c.classList.remove('active');
                    c.setAttribute('aria-selected', 'false');
                });
                card.classList.add('active');
                card.setAttribute('aria-selected', 'true');

                // Switch Active Detail Panel
                tcasDetailPanels.forEach(panel => {
                    if (panel.getAttribute('id') === `panel-${targetId}`) {
                        panel.classList.add('active');
                    } else {
                        panel.classList.remove('active');
                    }
                });
            });
        });
    }

    // 8. PLO Accordion Toggle (Reference UI Matched)
    const ploAccBtns = document.querySelectorAll('.plo-acc-btn');
    ploAccBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.plo-acc-item');
            const content = item.querySelector('.plo-acc-content');
            const arrow = btn.querySelector('.acc-arrow');
            const isActive = item.classList.contains('active');

            if (isActive) {
                item.classList.remove('active');
                btn.setAttribute('aria-expanded', 'false');
                if (arrow) arrow.textContent = '►';
                if (content) content.style.display = 'none';
            } else {
                item.classList.add('active');
                btn.setAttribute('aria-expanded', 'true');
                if (arrow) arrow.textContent = '▼';
                if (content) content.style.display = 'block';
            }
        });
    });

    // 9. Interactive Activity Photo Gallery Filter & Single-Row Slider Controls
    const galleryFilterBtns = document.querySelectorAll('.gallery-filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-card-item');
    const sliderTrack = document.getElementById('gallery-slider-track');
    const prevBtn = document.getElementById('gallery-slider-prev');
    const nextBtn = document.getElementById('gallery-slider-next');

    function updateSliderArrows() {
        if (!sliderTrack || !prevBtn || !nextBtn) return;

        const visibleCards = Array.from(galleryItems).filter(item => item.style.display !== 'none');
        
        // Hide arrows if visible items <= 3 on desktop
        if (visibleCards.length <= 3 && window.innerWidth > 992) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
            return;
        } else {
            prevBtn.style.display = 'flex';
            nextBtn.style.display = 'flex';
        }

        const maxScrollLeft = sliderTrack.scrollWidth - sliderTrack.clientWidth;
        if (sliderTrack.scrollLeft <= 5) {
            prevBtn.classList.add('disabled');
        } else {
            prevBtn.classList.remove('disabled');
        }

        if (sliderTrack.scrollLeft >= maxScrollLeft - 5) {
            nextBtn.classList.add('disabled');
        } else {
            nextBtn.classList.remove('disabled');
        }
    }

    if (sliderTrack && prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            const cardWidth = sliderTrack.querySelector('.gallery-card-item')?.offsetWidth || 350;
            sliderTrack.scrollBy({ left: -(cardWidth + 24), behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', () => {
            const cardWidth = sliderTrack.querySelector('.gallery-card-item')?.offsetWidth || 350;
            sliderTrack.scrollBy({ left: cardWidth + 24, behavior: 'smooth' });
        });

        sliderTrack.addEventListener('scroll', updateSliderArrows);
        window.addEventListener('resize', updateSliderArrows);
        setTimeout(updateSliderArrows, 300);
    }

    if (galleryFilterBtns.length > 0 && galleryItems.length > 0) {
        galleryFilterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter');

                galleryFilterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                galleryItems.forEach(item => {
                    const category = item.getAttribute('data-category');
                    if (filter === 'all' || category === filter) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });

                if (sliderTrack) {
                    sliderTrack.scrollLeft = 0;
                    setTimeout(updateSliderArrows, 150);
                }
            });
        });
    }

    // 10. Interactive Lightbox Photo Viewer for Single Activity Posts
    const articleImages = document.querySelectorAll('.single-post-card-frame img, .article-body img, .card-post-media img');

    if (articleImages.length > 0) {
        let imageList = [];
        articleImages.forEach(img => {
            if (img.width > 0 && img.width < 50 && img.height < 50) return;

            img.style.cursor = 'zoom-in';
            img.title = 'คลิกเพื่อดูรูปภาพขนาดใหญ่';

            const src = img.getAttribute('src');
            if (!src) return;

            const alt = img.getAttribute('alt') || document.title || 'ภาพกิจกรรม CS BUU';
            const fullSrc = src.replace(/-\d+x\d+(\.[a-zA-Z0-9]+)$/i, '$1');

            imageList.push({ src: fullSrc, alt: alt, element: img });
        });

        if (imageList.length > 0) {
            const lightbox = document.createElement('div');
            lightbox.className = 'cs-lightbox-modal';
            lightbox.id = 'csLightboxModal';
            lightbox.setAttribute('aria-hidden', 'true');
            lightbox.innerHTML = `
                <div class="cs-lightbox-backdrop"></div>
                <div class="cs-lightbox-dialog">
                    <div class="cs-lightbox-topbar">
                        <span class="cs-lightbox-counter" id="csLightboxCounter">1 / 1</span>
                        <span class="cs-lightbox-caption" id="csLightboxCaption"></span>
                        <button type="button" class="cs-lightbox-close" id="csLightboxClose" aria-label="ปิด"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="cs-lightbox-body">
                        <button type="button" class="cs-lightbox-nav prev" id="csLightboxPrev" aria-label="รูปภาพก่อนหน้า"><i class="fas fa-chevron-left"></i></button>
                        <div class="cs-lightbox-img-wrap">
                            <img src="" id="csLightboxImg" alt="" />
                        </div>
                        <button type="button" class="cs-lightbox-nav next" id="csLightboxNext" aria-label="รูปภาพถัดไป"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            `;
            document.body.appendChild(lightbox);

            const counterEl = document.getElementById('csLightboxCounter');
            const captionEl = document.getElementById('csLightboxCaption');
            const imgEl = document.getElementById('csLightboxImg');
            const closeBtn = document.getElementById('csLightboxClose');
            const prevBtn = document.getElementById('csLightboxPrev');
            const nextBtn = document.getElementById('csLightboxNext');
            const backdrop = lightbox.querySelector('.cs-lightbox-backdrop');

            let currentIndex = 0;

            function showImage(index) {
                currentIndex = (index + imageList.length) % imageList.length;
                const item = imageList[currentIndex];

                imgEl.style.opacity = '0';
                imgEl.style.transform = 'scale(0.96)';

                setTimeout(() => {
                    imgEl.src = item.src;
                    imgEl.alt = item.alt;
                    
                    const postTitle = document.querySelector('.card-post-title')?.textContent?.trim() || '';
                    const captionText = (item.alt && item.alt !== 'ภาพกิจกรรม CS BUU' && item.alt !== 'Computer Science BUU') ? item.alt : (postTitle || 'วิทยาการคอมพิวเตอร์ BUU');
                    captionEl.textContent = captionText;
                    counterEl.textContent = `รูปที่ ${currentIndex + 1} จาก ${imageList.length}`;

                    imgEl.style.opacity = '1';
                    imgEl.style.transform = 'scale(1)';
                }, 120);

                if (imageList.length <= 1) {
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'none';
                } else {
                    prevBtn.style.display = 'flex';
                    nextBtn.style.display = 'flex';
                }
            }

            function openLightbox(index) {
                lightbox.classList.add('open');
                lightbox.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                showImage(index);
            }

            function closeLightbox() {
                lightbox.classList.remove('open');
                lightbox.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            imageList.forEach((item, index) => {
                item.element.addEventListener('click', (e) => {
                    e.preventDefault();
                    openLightbox(index);
                });
            });

            closeBtn.addEventListener('click', closeLightbox);
            backdrop.addEventListener('click', closeLightbox);
            prevBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                showImage(currentIndex - 1);
            });
            nextBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                showImage(currentIndex + 1);
            });

            document.addEventListener('keydown', (e) => {
                if (!lightbox.classList.contains('open')) return;
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft') showImage(currentIndex - 1);
                if (e.key === 'ArrowRight') showImage(currentIndex + 1);
            });
        }
    }
});




