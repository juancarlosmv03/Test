<?php
/**
 * Contact details list (address, phone, WhatsApp, email).
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<ul class="info-list">
	<li class="info-item">
		<span class="icon-tile icon-tile--sm"><?php echo qf_icon( 'pin', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<span>
			<strong><?php esc_html_e( 'Address', 'quesada-fitness' ); ?></strong>
			<?php echo esc_html( qf_mod( 'address_1' ) ); ?><br><?php echo esc_html( qf_mod( 'address_2' ) ); ?>
			<?php if ( qf_mod( 'maps_url' ) ) : ?>
				<a class="info-item__more" href="<?php echo esc_url( qf_mod( 'maps_url' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Open in Google Maps', 'quesada-fitness' ); ?></a>
			<?php endif; ?>
		</span>
	</li>
	<li class="info-item">
		<span class="icon-tile icon-tile--sm"><?php echo qf_icon( 'phone', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<span><strong><?php esc_html_e( 'Phone', 'quesada-fitness' ); ?></strong><a href="<?php echo esc_attr( qf_tel_href( qf_mod( 'phone' ) ) ); ?>"><?php echo esc_html( qf_mod( 'phone' ) ); ?></a></span>
	</li>
	<li class="info-item">
		<span class="icon-tile icon-tile--sm"><?php echo qf_icon( 'whatsapp', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<span><strong><?php esc_html_e( 'WhatsApp', 'quesada-fitness' ); ?></strong><a href="<?php echo esc_url( qf_whatsapp_url( qf_mod( 'whatsapp' ) ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( qf_mod( 'whatsapp' ) ); ?></a></span>
	</li>
	<li class="info-item">
		<span class="icon-tile icon-tile--sm"><?php echo qf_icon( 'mail', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<span><strong><?php esc_html_e( 'Email', 'quesada-fitness' ); ?></strong><a href="mailto:<?php echo esc_attr( antispambot( qf_mod( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( qf_mod( 'email' ) ) ); ?></a></span>
	</li>
</ul>
