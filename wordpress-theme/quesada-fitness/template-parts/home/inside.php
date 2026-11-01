<?php
/**
 * A look inside the gym: a short photo grid linking to the gallery.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_gallery_url = qf_page_url( 'galeria' );
?>
<section class="section section--alt" id="inside">
	<div class="container">
		<?php qf_section_head( __( 'Gallery', 'quesada-fitness' ), __( 'Take a look <span>inside</span>', 'quesada-fitness' ) ); ?>
		<?php get_template_part( 'template-parts/photo-grid', null, array( 'limit' => 8 ) ); ?>
		<?php if ( $qf_gallery_url ) : ?>
			<p class="section__more"><a class="btn btn--ghost" href="<?php echo esc_url( $qf_gallery_url ); ?>"><?php esc_html_e( 'See the full gallery', 'quesada-fitness' ); ?><?php echo qf_icon( 'arrow', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></p>
		<?php endif; ?>
	</div>
</section>
