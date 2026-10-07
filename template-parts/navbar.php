<?php
/**
 * Template Part: Navbar Header Navigation
 *
 * @package BUU_SE_Landing
 */

?>
<header class="site-header sticky-navbar" id="site-header">
    <div class="header-container container">
        <!-- Brand Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo" aria-label="Computer Science BUU Home">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <div class="logo-badge">
                    <span class="logo-code">CS</span>
                </div>
                <div class="logo-text">
                    <span class="logo-title">Computer Science</span>
                    <span class="logo-sub">INFORMATICS BURAPHA</span>
                </div>
            <?php endif; ?>
        </a>

        <!-- Desktop Navigation -->
        <nav class="desktop-nav" aria-label="Primary Navigation">
            <ul class="nav-menu">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link">หน้าแรก</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#news' ) ); ?>" class="nav-link">ข่าวสาร</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#tracks' ) ); ?>" class="nav-link">หลักสูตร</a></li>
                <li><a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>" class="nav-link">FAQ</a></li>
            </ul>
        </nav>

        <!-- Mobile Menu Toggle -->
        <div class="header-actions">
            <button class="mobile-toggle" id="mobile-drawer-toggle" aria-label="Toggle Navigation Menu" aria-expanded="false" aria-controls="mobile-drawer">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div class="mobile-drawer" id="mobile-drawer" aria-hidden="true">
        <div class="drawer-overlay" id="drawer-overlay"></div>
        <div class="drawer-content">
            <div class="drawer-header">
                <div class="logo-badge">
                    <span class="logo-code">CS</span>
                </div>
                <button class="drawer-close" id="drawer-close-btn" aria-label="Close menu">&times;</button>
            </div>
            <nav class="drawer-nav">
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="drawer-link">หน้าแรก</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#news' ) ); ?>" class="drawer-link">ข่าวสาร</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#tracks' ) ); ?>" class="drawer-link">หลักสูตร</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>" class="drawer-link">FAQ</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
