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
			$is_gallery    = ( 'cs_gallery' === get_post_type() );
			$categories    = $is_gallery ? get_the_terms( get_the_ID(), 'gallery_category' ) : get_the_category();
			$category_name = ! empty( $categories ) && ! is_wp_error( $categories ) ? $categories[0]->name : ( $is_gallery ? 'กิจกรรมนิสิต' : 'ข่าวสาร' );
			$parent_url    = $is_gallery ? home_url( '/#gallery' ) : home_url( '/#news' );
			$parent_title  = $is_gallery ? 'ภาพกิจกรรม' : 'ข่าวสาร';
			$section_title = $is_gallery ? 'ภาพบรรยากาศกิจกรรม' : 'ข่าวสาร & กิจกรรม';
			$accent_style  = $is_gallery ? 'style="background-color: #F4B41A;"' : '';
			?>
            <div class="single-post-layout-container">
                <!-- Breadcrumbs Navigation -->
                <nav class="post-breadcrumbs" aria-label="Breadcrumb">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">หน้าแรก</a>
                    <span class="sep">&gt;</span>
                    <a href="<?php echo esc_url( $parent_url ); ?>"><?php echo esc_html( $parent_title ); ?></a>
                    <?php if ( ! empty( $category_name ) ) : ?>
                        <span class="sep">&gt;</span>
                        <span class="current"><?php echo esc_html( $category_name ); ?></span>
                    <?php endif; ?>
                </nav>

                <!-- Category Section Title Header -->
                <div class="post-category-header">
                    <span class="category-accent-bar" <?php echo $accent_style; ?>></span>
                    <h2 class="category-header-title"><?php echo esc_html( $section_title ); ?></h2>
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
