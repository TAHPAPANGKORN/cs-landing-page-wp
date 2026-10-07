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
                        item.style.display = 'block';
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
});




