<?php
/**
 * Page Template
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
			?>
			<div class="single-post-layout-container">
				<!-- Breadcrumbs Navigation -->
				<nav class="post-breadcrumbs" aria-label="Breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">หน้าแรก</a>
					<span class="sep">&gt;</span>
					<span class="current"><?php the_title(); ?></span>
				</nav>

				<!-- Page Header -->
				<div class="post-category-header">
					<span class="category-accent-bar" style="background-color: #D97706;"></span>
					<h1 class="category-header-title"><?php the_title(); ?></h1>
				</div>

				<!-- Main Page Container -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-card-frame' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="card-post-media" style="margin-bottom: 24px;">
							<?php the_post_thumbnail( 'full', array( 'class' => 'card-post-img' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="card-post-content article-body">
						<?php the_content(); ?>
					</div>
				</article>
			</div>
		<?php endwhile; ?>
	</div>
</div>

<?php
get_footer();
