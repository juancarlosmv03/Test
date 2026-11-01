<?php
/**
 * Grid of gym photos that open in a lightbox.
 *
 * Expects $args: limit (int, 0 = all).
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_args   = wp_parse_args( $args ?? array(), array( 'limit' => 0 ) );
$qf_photos = qf_gallery_photos();
if ( $qf_args['limit'] ) {
	$qf_photos = array_slice( $qf_photos, 0, (int) $qf_args['limit'] );
}
?>
<ul class="photo-grid" data-lightbox-group>
	<?php foreach ( $qf_photos as $qf_photo ) : ?>
		<li class="photo-grid__item reveal">
			<a href="<?php echo esc_url( qf_upload_url( $qf_photo['path'] ) ); ?>" data-lightbox>
				<img src="<?php echo esc_url( qf_upload_url( $qf_photo['path'] ) ); ?>" alt="<?php echo esc_attr( $qf_photo['alt'] ); ?>" loading="lazy" decoding="async">
			</a>
		</li>
	<?php endforeach; ?>
</ul>
