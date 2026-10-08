<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/default-news.png' ); ?>" />
    <link rel="shortcut icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/default-news.png' ); ?>" />
    <link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/default-news.png' ); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip link for Accessibility -->
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'buu-se-landing' ); ?></a>

<?php get_template_part( 'template-parts/navbar' ); ?>

<main id="main-content" class="site-main">
