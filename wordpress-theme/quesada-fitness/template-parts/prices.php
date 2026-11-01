<?php
/**
 * Price lists from the Customizer (Appearance → Customize → Quesada Fitness → Prices).
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_lists = array(
	array(
		'title'    => __( 'Gym plans', 'quesada-fitness' ),
		'icon'     => 'dumbbell',
		'rows'     => qf_parse_lines( qf_mod( 'prices_gym' ), 3 ),
		'featured' => false,
	),
	array(
		'title'    => __( 'Special offers', 'quesada-fitness' ),
		'icon'     => 'flame',
		'rows'     => qf_parse_lines( qf_mod( 'prices_offers' ), 3 ),
		'featured' => true,
	),
	array(
		'title'    => __( 'Treatments & discounts', 'quesada-fitness' ),
		'icon'     => 'hand',
		'rows'     => qf_parse_lines( qf_mod( 'prices_extras' ), 3 ),
		'featured' => false,
	),
);
?>
<section class="section section--alt" id="prices">
	<div class="container">
		<?php
		qf_section_head(
			__( 'Prices', 'quesada-fitness' ),
			__( 'Check our <span>prices</span>', 'quesada-fitness' ),
			__( 'Special offers for new members and exclusive class discounts for members.', 'quesada-fitness' )
		);
		?>
		<div class="price-lists">
			<?php foreach ( $qf_lists as $qf_list ) : ?>
				<?php
				if ( ! $qf_list['rows'] ) {
					continue;
				}
				?>
				<article class="card price-list<?php echo $qf_list['featured'] ? ' price-list--featured' : ''; ?> reveal">
					<h3 class="price-list__title"><span class="icon-tile icon-tile--sm"><?php echo qf_icon( $qf_list['icon'], 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php echo esc_html( $qf_list['title'] ); ?></h3>
					<ul class="price-list__rows">
						<?php foreach ( $qf_list['rows'] as $qf_row ) : ?>
							<li>
								<span class="price-list__name">
									<?php if ( $qf_row[2] ) : ?>
										<a href="<?php echo esc_url( $qf_row[2] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $qf_row[0] ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $qf_row[0] ); ?>
									<?php endif; ?>
								</span>
								<span class="price-list__value"><?php echo esc_html( $qf_row[1] ); ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
					<?php if ( $qf_list['featured'] ) : ?>
						<a href="<?php echo esc_url( qf_mod( 'booking_url' ) ); ?>" class="btn btn--primary btn--block" target="_blank" rel="noopener"><?php esc_html_e( 'Book online', 'quesada-fitness' ); ?></a>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
