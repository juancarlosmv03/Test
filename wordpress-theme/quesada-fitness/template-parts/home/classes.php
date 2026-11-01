<?php
/**
 * This week's classes on the home page.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_classes_url = qf_page_url( 'clases' );
?>
<section class="section" id="classes">
	<div class="container container--narrow">
		<?php
		qf_section_head(
			__( 'Class timetable', 'quesada-fitness' ),
			__( 'This week\'s <span>classes</span>', 'quesada-fitness' ),
			__( 'Our instructors supervise you at all times. Try our classes, learn the best techniques and reduce the risk of injury.', 'quesada-fitness' )
		);
		get_template_part( 'template-parts/timetable' );
		?>
		<?php if ( $qf_classes_url ) : ?>
			<p class="section__more"><a class="btn btn--ghost" href="<?php echo esc_url( $qf_classes_url ); ?>"><?php esc_html_e( 'About our classes', 'quesada-fitness' ); ?><?php echo qf_icon( 'arrow', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></p>
		<?php endif; ?>
	</div>
</section>
