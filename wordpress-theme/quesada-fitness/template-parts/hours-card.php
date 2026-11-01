<?php
/**
 * Opening hours card with a live "open now / closed" badge (filled in by main.js).
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="hours-card">
	<div class="hours-card__head">
		<span class="status" data-open-status><span class="status__dot"></span><span data-open-status-text><?php esc_html_e( 'Opening hours', 'quesada-fitness' ); ?></span></span>
	</div>
	<p class="hours-card__title"><?php esc_html_e( 'Opening hours', 'quesada-fitness' ); ?></p>
	<ul class="hours-card__list">
		<?php foreach ( qf_opening_rows() as $row ) : ?>
			<li data-days="<?php echo esc_attr( $row['days'] ); ?>"><span><?php echo esc_html( $row['label'] ); ?></span><strong><?php echo esc_html( $row['hours'] ); ?></strong></li>
		<?php endforeach; ?>
	</ul>
	<div class="hours-card__links">
		<a class="hours-card__link" href="<?php echo esc_attr( qf_tel_href( qf_mod( 'phone' ) ) ); ?>"><?php echo qf_icon( 'phone', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo esc_html( qf_mod( 'phone' ) ); ?></a>
		<a class="hours-card__link" href="<?php echo esc_url( qf_whatsapp_url( qf_mod( 'whatsapp' ) ) ); ?>" target="_blank" rel="noopener"><?php echo qf_icon( 'whatsapp', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'WhatsApp', 'quesada-fitness' ); ?></a>
	</div>
</div>
