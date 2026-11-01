<?php
/**
 * Classes page (slug "clases").
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'eyebrow' => __( 'Group classes', 'quesada-fitness' ),
		'title'   => __( 'Our <span>classes</span>', 'quesada-fitness' ),
		'text'    => __( 'Want to reach your fitness goals? Our instructors supervise you at all times. Try our classes, learn the best techniques and reduce the risk of injury.', 'quesada-fitness' ),
		'photo'   => '2023/09/QFG7.jpg',
	)
);
?>

<section class="section">
	<div class="container feature-split">
		<div class="feature-split__text reveal">
			<span class="eyebrow"><?php esc_html_e( 'Boxing & kickboxing', 'quesada-fitness' ); ?></span>
			<h2 class="section__title"><?php esc_html_e( 'Train with a', 'quesada-fitness' ); ?> <span class="text-red"><?php esc_html_e( 'champion', 'quesada-fitness' ); ?></span></h2>
			<p class="section__text"><?php esc_html_e( 'Boxing and kickboxing classes with Santiago López Silva, Spanish kickboxing champion! Are you ready to push your body to the limit? Don\'t wait any longer, sign up!', 'quesada-fitness' ); ?></p>
			<ul class="checklist">
				<li><span class="checklist__icon"><?php echo qf_icon( 'check', 'icon--xs' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php esc_html_e( 'Classes for adults and juniors', 'quesada-fitness' ); ?></li>
				<li><span class="checklist__icon"><?php echo qf_icon( 'check', 'icon--xs' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span><?php esc_html_e( 'One-to-one kickboxing personal training', 'quesada-fitness' ); ?></li>
			</ul>
			<a href="<?php echo esc_url( qf_mod( 'booking_url' ) ); ?>" class="btn btn--primary" target="_blank" rel="noopener"><?php esc_html_e( 'Book a class', 'quesada-fitness' ); ?></a>
		</div>
		<div class="feature-split__media reveal">
			<?php echo qf_video( '2025/01/VID-20250113-WA0002.mp4', __( 'Boxing and kickboxing class video', 'quesada-fitness' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
	</div>
</section>

<section class="section section--alt" id="timetable">
	<div class="container container--narrow">
		<?php qf_section_head( __( 'Class timetable', 'quesada-fitness' ), __( 'Weekly <span>timetable</span>', 'quesada-fitness' ) ); ?>
		<?php get_template_part( 'template-parts/timetable' ); ?>
	</div>
</section>

<section class="section">
	<div class="container">
		<?php qf_section_head( __( 'What we offer', 'quesada-fitness' ), __( 'Find your <span>class</span>', 'quesada-fitness' ) ); ?>
		<div class="grid grid--cards">
			<?php foreach ( qf_class_types() as $qf_class ) : ?>
				<article class="card program reveal">
					<span class="icon-tile"><?php echo qf_icon( $qf_class['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<h3 class="card__title"><?php echo esc_html( $qf_class['title'] ); ?></h3>
					<p class="card__text"><?php echo esc_html( $qf_class['text'] ); ?></p>
					<?php if ( $qf_class['meta'] ) : ?>
						<ul class="tags"><li class="tag"><?php echo esc_html( $qf_class['meta'] ); ?></li></ul>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="section section--alt">
	<div class="container">
		<?php qf_section_head( __( 'In action', 'quesada-fitness' ), __( 'See our <span>classes</span>', 'quesada-fitness' ) ); ?>
		<div class="video-grid">
			<?php echo qf_video( '2021/11/classes.mp4', __( 'Group classes video', 'quesada-fitness' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
			<?php echo qf_video( '2021/11/mergemerge.mp4', __( 'Boxing and kickboxing training video', 'quesada-fitness' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta' );
get_footer();
