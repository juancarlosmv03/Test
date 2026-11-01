<?php
/**
 * Lightbox dialog shared by photo grids (controlled by main.js).
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<dialog class="lightbox" data-lightbox-dialog aria-label="<?php esc_attr_e( 'Photo viewer', 'quesada-fitness' ); ?>">
	<figure class="lightbox__figure">
		<img class="lightbox__img" alt="">
		<figcaption class="lightbox__caption"></figcaption>
	</figure>
	<button type="button" class="lightbox__btn lightbox__btn--close" data-lightbox-close aria-label="<?php esc_attr_e( 'Close', 'quesada-fitness' ); ?>"><?php echo qf_icon( 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
	<button type="button" class="lightbox__btn lightbox__btn--prev" data-lightbox-prev aria-label="<?php esc_attr_e( 'Previous photo', 'quesada-fitness' ); ?>"><?php echo qf_icon( 'chevron-left' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
	<button type="button" class="lightbox__btn lightbox__btn--next" data-lightbox-next aria-label="<?php esc_attr_e( 'Next photo', 'quesada-fitness' ); ?>"><?php echo qf_icon( 'chevron-right' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
</dialog>
