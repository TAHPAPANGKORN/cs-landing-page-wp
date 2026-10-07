<?php
/**
 * The main template file fallback
 *
 * @package BUU_SE_Landing
 */

get_header();
?>

<div class="container section-padding">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'fallback-card' ); ?>>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
	else :
		echo '<p>' . esc_html__( 'No content found.', 'buu-se-landing' ) . '</p>';
	endif;
	?>
</div>

<?php
get_footer();
