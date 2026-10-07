<?php
/**
 * Single Post Template - Matched Reference Design
 *
 * Displays individual news articles inside a clean white card container
 * with breadcrumbs and section header perfectly aligned.
 *
 * @package BUU_SE_Landing
 */

get_header();
?>

<div class="single-page-wrapper bg-slate section-padding">
    <div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			$categories    = get_the_category();
			$category_name = ! empty( $categories ) ? $categories[0]->name : 'ข่าวสาร';
			?>
            <div class="single-post-layout-container">
                <!-- Breadcrumbs Navigation -->
                <nav class="post-breadcrumbs" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">หน้าแรก</a>
                    <span class="sep">&gt;</span>
                    <a href="<?php echo esc_url( home_url( '/#news' ) ); ?>">ข่าวสาร</a>
                    <?php if ( ! empty( $categories ) ) : ?>
                        <span class="sep">&gt;</span>
                        <span class="current"><?php echo esc_html( $category_name ); ?></span>
                    <?php endif; ?>
                </nav>

                <!-- Category Section Title Header -->
                <div class="post-category-header">
                    <span class="category-accent-bar"></span>
                    <h2 class="category-header-title">ข่าวสาร & กิจกรรม</h2>
                </div>

                <!-- Main Post White Card Container -->
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-card-frame' ); ?>>
                    <!-- Post Title inside Card -->
                    <h1 class="card-post-title"><?php the_title(); ?></h1>

                    <!-- Post Date Metadata -->
                    <div class="card-post-date">
                        <span><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
                    </div>

                    <!-- Featured Image inside Card -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="card-post-media">
                            <?php the_post_thumbnail( 'full', array( 'class' => 'card-post-img' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Article Paragraph Content -->
                    <div class="card-post-content article-body">
                        <?php the_content(); ?>
                    </div>

                    <!-- Post Tags Footer -->
                    <?php if ( has_tag() ) : ?>
                        <div class="post-tags-container">
                            <span class="tags-title">แท็ก:</span>
                            <div class="tags-list">
                                <?php the_tags( '<span class="post-tag">', '</span><span class="post-tag">', '</span>' ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </article>

                <!-- Next & Previous Navigation Links -->
                <nav class="card-post-nav" aria-label="Post Navigation">
                    <div class="nav-prev">
                        <?php previous_post_link( '%link', '← ข่าวก่อนหน้า' ); ?>
                    </div>
                    <div class="nav-next">
                        <?php next_post_link( '%link', 'ข่าวต่อไป →' ); ?>
                    </div>
                </nav>
            </div>
		<?php endwhile; ?>
    </div>
</div>

<?php
get_footer();
