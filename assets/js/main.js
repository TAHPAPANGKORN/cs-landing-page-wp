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
});
