<?php
/**
 * Home hero: slogan, photo of the gym floor and live opening hours.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_prices_link = '#prices';
?>
<section class="hero hero--photo">
	<img class="hero__photo" src="<?php echo esc_url( qf_upload_url( '2024/11/IMG-20241031-WA0007.jpg' ) ); ?>" alt="" fetchpriority="high">
	<div class="hero__bg" aria-hidden="true"></div>
	<div class="container hero__inner">
		<div class="hero__content">
			<span class="eyebrow"><span class="eyebrow__dot"></span><?php esc_html_e( 'Ciudad Quesada · Rojales', 'quesada-fitness' ); ?></span>
			<h1 class="hero__title"><?php esc_html_e( 'More than', 'quesada-fitness' ); ?> <span class="text-red"><?php esc_html_e( 'just a gym', 'quesada-fitness' ); ?></span></h1>
			<p class="hero__text"><?php esc_html_e( 'A fully air-conditioned gym with the equipment, facilities and specialist staff you need for your training: weights, machines, cardio, martial arts, classes and personal training.', 'quesada-fitness' ); ?></p>
			<div class="hero__actions">
				<a href="<?php echo esc_url( qf_mod( 'booking_url' ) ); ?>" class="btn btn--primary btn--lg" target="_blank" rel="noopener"><?php esc_html_e( 'Book online', 'quesada-fitness' ); ?><?php echo qf_icon( 'arrow', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
				<a href="<?php echo esc_url( $qf_prices_link ); ?>" class="btn btn--ghost btn--lg"><?php esc_html_e( 'See prices', 'quesada-fitness' ); ?></a>
			</div>
			<ul class="hero__stats">
				<li class="stat"><strong class="stat__value">2016</strong><span class="stat__label"><?php esc_html_e( 'Opened its doors', 'quesada-fitness' ); ?></span></li>
				<li class="stat"><strong class="stat__value">10,000+</strong><span class="stat__label"><?php esc_html_e( 'Members joined', 'quesada-fitness' ); ?></span></li>
				<li class="stat"><strong class="stat__value">7</strong><span class="stat__label"><?php esc_html_e( 'Days a week', 'quesada-fitness' ); ?></span></li>
			</ul>
		</div>
		<div class="hero__visual">
			<?php get_template_part( 'template-parts/hours-card' ); ?>
		</div>
	</div>
</section>
