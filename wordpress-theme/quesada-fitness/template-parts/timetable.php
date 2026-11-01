<?php
/**
 * Weekly class timetable with day tabs (Customizer → Quesada Fitness → Class timetable).
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_days = array(
	'mon' => array( __( 'Mon', 'quesada-fitness' ), __( 'Monday', 'quesada-fitness' ), 1 ),
	'tue' => array( __( 'Tue', 'quesada-fitness' ), __( 'Tuesday', 'quesada-fitness' ), 2 ),
	'wed' => array( __( 'Wed', 'quesada-fitness' ), __( 'Wednesday', 'quesada-fitness' ), 3 ),
	'thu' => array( __( 'Thu', 'quesada-fitness' ), __( 'Thursday', 'quesada-fitness' ), 4 ),
	'fri' => array( __( 'Fri', 'quesada-fitness' ), __( 'Friday', 'quesada-fitness' ), 5 ),
	'sat' => array( __( 'Sat', 'quesada-fitness' ), __( 'Saturday', 'quesada-fitness' ), 6 ),
	'sun' => array( __( 'Sun', 'quesada-fitness' ), __( 'Sunday', 'quesada-fitness' ), 0 ),
);
$qf_has_outside = false;
$qf_image       = qf_mod( 'timetable_image' );
$qf_uid         = wp_unique_id( 'tt-' );
?>
<div class="timetable" data-timetable>
	<div class="tabs" role="tablist" aria-label="<?php esc_attr_e( 'Days of the week', 'quesada-fitness' ); ?>">
		<?php $qf_first = true; ?>
		<?php foreach ( $qf_days as $qf_key => $qf_day ) : ?>
			<button class="tab" type="button" role="tab" id="<?php echo esc_attr( "$qf_uid-tab-$qf_key" ); ?>" data-day="<?php echo esc_attr( $qf_day[2] ); ?>" aria-controls="<?php echo esc_attr( "$qf_uid-panel-$qf_key" ); ?>" aria-selected="<?php echo $qf_first ? 'true' : 'false'; ?>"<?php echo $qf_first ? '' : ' tabindex="-1"'; ?>>
				<span aria-hidden="true"><?php echo esc_html( $qf_day[0] ); ?></span><span class="screen-reader-text"><?php echo esc_html( $qf_day[1] ); ?></span>
			</button>
			<?php $qf_first = false; ?>
		<?php endforeach; ?>
	</div>

	<?php $qf_first = true; ?>
	<?php foreach ( $qf_days as $qf_key => $qf_day ) : ?>
		<?php $qf_rows = qf_parse_lines( qf_mod( 'timetable_' . $qf_key ), 2 ); ?>
		<div class="timetable__panel" role="tabpanel" id="<?php echo esc_attr( "$qf_uid-panel-$qf_key" ); ?>" aria-labelledby="<?php echo esc_attr( "$qf_uid-tab-$qf_key" ); ?>" data-day="<?php echo esc_attr( $qf_day[2] ); ?>"<?php echo $qf_first ? '' : ' hidden'; ?>>
			<?php if ( $qf_rows ) : ?>
				<ul class="class-list">
					<?php foreach ( $qf_rows as $qf_row ) : ?>
						<?php
						$qf_outside = '*' === substr( $qf_row[1], -1 );
						$qf_name    = rtrim( $qf_row[1], '* ' );
						if ( $qf_outside ) {
							$qf_has_outside = true;
						}
						?>
						<li class="class-item">
							<span class="class-item__time"><?php echo esc_html( $qf_row[0] ); ?></span>
							<span class="class-item__name"><?php echo esc_html( $qf_name ); ?></span>
							<?php if ( $qf_outside ) : ?>
								<span class="class-item__badge"><?php esc_html_e( 'Outside instructor', 'quesada-fitness' ); ?></span>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<p class="timetable__empty"><?php esc_html_e( 'No classes on this day.', 'quesada-fitness' ); ?></p>
			<?php endif; ?>
		</div>
		<?php $qf_first = false; ?>
	<?php endforeach; ?>

	<div class="timetable__foot">
		<?php if ( $qf_has_outside ) : ?>
			<p class="timetable__note"><?php esc_html_e( 'Classes marked "Outside instructor" are not included in specials, class passes or half-price class memberships. Book them directly with the instructor.', 'quesada-fitness' ); ?></p>
		<?php endif; ?>
		<div class="timetable__actions">
			<a href="<?php echo esc_url( qf_mod( 'booking_url' ) ); ?>" class="btn btn--primary btn--sm" target="_blank" rel="noopener"><?php echo qf_icon( 'calendar', 'icon--xs' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Book a class', 'quesada-fitness' ); ?></a>
			<?php if ( $qf_image ) : ?>
				<a href="<?php echo esc_url( qf_upload_url( $qf_image ) ); ?>" class="btn btn--ghost btn--sm" target="_blank" rel="noopener"><?php echo qf_icon( 'image', 'icon--xs' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php esc_html_e( 'Timetable as an image', 'quesada-fitness' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
