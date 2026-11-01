<?php
/**
 * Contact summary at the bottom of the home page.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_contact_url = qf_page_url( 'contacto' );
?>
<section class="section" id="contact">
	<div class="container contact">
		<div class="contact__info reveal">
			<span class="eyebrow"><?php esc_html_e( 'Find us', 'quesada-fitness' ); ?></span>
			<h2 class="section__title"><?php esc_html_e( 'Visit', 'quesada-fitness' ); ?> <span class="text-red"><?php esc_html_e( 'Quesada Fitness', 'quesada-fitness' ); ?></span></h2>
			<?php get_template_part( 'template-parts/contact-info' ); ?>
			<?php if ( $qf_contact_url ) : ?>
				<p class="section__more section__more--start"><a class="btn btn--primary" href="<?php echo esc_url( $qf_contact_url ); ?>"><?php esc_html_e( 'Send us a message', 'quesada-fitness' ); ?><?php echo qf_icon( 'arrow', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></p>
			<?php endif; ?>
		</div>
		<figure class="entrance reveal">
			<img src="<?php echo esc_url( qf_upload_url( '2023/09/Gym-entrance-2.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Entrance of Quesada Fitness GYM', 'quesada-fitness' ); ?>" loading="lazy" decoding="async">
			<figcaption><?php echo qf_icon( 'pin', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( qf_mod( 'address_1' ) ); ?></figcaption>
		</figure>
	</div>
</section>
