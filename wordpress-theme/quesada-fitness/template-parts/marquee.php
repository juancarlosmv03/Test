<?php
/**
 * Red band with scrolling class names.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_items = qf_marquee_items();
?>
<div class="container">
	<div class="marquee" aria-hidden="true">
		<div class="marquee__track">
			<?php for ( $qf_i = 0; $qf_i < 2; $qf_i++ ) : ?>
				<?php foreach ( $qf_items as $qf_item ) : ?>
					<span><?php echo esc_html( $qf_item ); ?></span><span>★</span>
				<?php endforeach; ?>
			<?php endfor; ?>
		</div>
	</div>
</div>
