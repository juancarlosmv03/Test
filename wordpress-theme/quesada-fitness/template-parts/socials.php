<?php
/**
 * Social and WhatsApp links.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_socials = array(
	array( 'facebook', qf_mod( 'facebook_url' ), __( 'Quesada Fitness GYM on Facebook', 'quesada-fitness' ) ),
	array( 'instagram', qf_mod( 'instagram_url' ), __( 'Quesada Fitness GYM on Instagram', 'quesada-fitness' ) ),
	array( 'whatsapp', qf_whatsapp_url( qf_mod( 'whatsapp' ) ), __( 'Chat with us on WhatsApp', 'quesada-fitness' ) ),
);
?>
<ul class="socials">
	<?php foreach ( $qf_socials as $qf_social ) : ?>
		<?php if ( $qf_social[1] ) : ?>
			<li><a href="<?php echo esc_url( $qf_social[1] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $qf_social[2] ); ?>"><?php echo qf_icon( $qf_social[0], 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>
