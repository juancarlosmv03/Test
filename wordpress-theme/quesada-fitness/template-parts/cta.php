<?php
/**
 * Red booking banner.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section section--tight">
	<div class="container">
		<div class="cta reveal">
			<h2 class="cta__title"><?php esc_html_e( 'Book your session online', 'quesada-fitness' ); ?></h2>
			<p class="cta__text"><?php esc_html_e( 'Book your class or session online, or call us and we\'ll help you get started.', 'quesada-fitness' ); ?></p>
			<div class="cta__actions">
				<a href="<?php echo esc_url( qf_mod( 'booking_url' ) ); ?>" class="btn btn--light btn--lg" target="_blank" rel="noopener"><?php esc_html_e( 'Book online', 'quesada-fitness' ); ?><?php echo qf_icon( 'arrow', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
				<a href="<?php echo esc_attr( qf_tel_href( qf_mod( 'phone' ) ) ); ?>" class="btn btn--outline-light btn--lg"><?php echo qf_icon( 'phone', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( qf_mod( 'phone' ) ); ?></a>
			</div>
		</div>
	</div>
</section>
