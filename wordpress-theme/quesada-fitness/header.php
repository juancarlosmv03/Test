<?php
/**
 * Site header.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php get_template_part( 'template-parts/icons' ); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'quesada-fitness' ); ?></a>

<header class="header">
	<div class="container header__inner">
		<?php if ( has_custom_logo() ) : ?>
			<div class="logo logo--custom"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
				<img class="logo__img" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-light.png' ); ?>" width="900" height="137" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			</a>
		<?php endif; ?>

		<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="<?php esc_attr_e( 'Open menu', 'quesada-fitness' ); ?>" data-label-open="<?php esc_attr_e( 'Open menu', 'quesada-fitness' ); ?>" data-label-close="<?php esc_attr_e( 'Close menu', 'quesada-fitness' ); ?>">
			<?php echo qf_icon( 'menu', 'icon--menu' ) . qf_icon( 'close', 'icon--close' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</button>

		<nav class="nav" id="site-nav" aria-label="<?php esc_attr_e( 'Main', 'quesada-fitness' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-menu',
					'container'      => false,
					'menu_class'     => 'nav__list',
					'depth'          => 1,
					'fallback_cb'    => 'qf_menu_fallback',
				)
			);
			?>
			<a href="<?php echo esc_url( qf_mod( 'booking_url' ) ); ?>" class="btn btn--primary nav__cta" target="_blank" rel="noopener"><?php esc_html_e( 'Book online', 'quesada-fitness' ); ?></a>
		</nav>
	</div>
</header>

<main id="main" class="site-main">
