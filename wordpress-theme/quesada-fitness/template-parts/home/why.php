<?php
/**
 * "Why choose our gym?" with photo cards of the facilities.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section" id="why">
	<div class="container">
		<?php
		qf_section_head(
			__( 'Why choose us', 'quesada-fitness' ),
			__( 'Why choose <span>our gym?</span>', 'quesada-fitness' ),
			__( 'Quesada Fitness GYM is fully air-conditioned. We offer personal training, add nutrition plans and design training programmes focused on our clients\' goals.', 'quesada-fitness' )
		);
		?>
		<div class="grid grid--cards">
			<?php foreach ( qf_facilities() as $qf_item ) : ?>
				<article class="card photo-card reveal">
					<div class="photo-card__media">
						<img src="<?php echo esc_url( qf_upload_url( $qf_item['photo'] ) ); ?>" alt="" loading="lazy" decoding="async">
						<span class="icon-tile photo-card__icon"><?php echo qf_icon( $qf_item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					</div>
					<div class="photo-card__body">
						<h3 class="card__title"><?php echo esc_html( $qf_item['title'] ); ?></h3>
						<p class="card__text"><?php echo esc_html( $qf_item['text'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
