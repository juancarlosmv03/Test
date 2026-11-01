<?php
/**
 * Gallery page (slug "galeria").
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
		'eyebrow' => __( 'Gallery', 'quesada-fitness' ),
		'title'   => __( 'Inside <span>Quesada Fitness</span>', 'quesada-fitness' ),
		'text'    => __( 'Our gym floor, studios, martial arts area, changing rooms and relaxation areas.', 'quesada-fitness' ),
		'photo'   => '2024/12/upgradedgym7.jpg',
	)
);
?>

<section class="section">
	<div class="container">
		<?php qf_section_head( __( 'Photos', 'quesada-fitness' ), __( 'The <span>gym</span>', 'quesada-fitness' ) ); ?>
		<?php get_template_part( 'template-parts/photo-grid' ); ?>
	</div>
</section>

<?php $qf_videos = qf_gallery_videos(); ?>
<?php if ( $qf_videos ) : ?>
	<section class="section section--alt">
		<div class="container">
			<?php qf_section_head( __( 'Videos', 'quesada-fitness' ), __( 'Watch <span>us train</span>', 'quesada-fitness' ) ); ?>
			<div class="video-grid video-grid--portrait">
				<?php foreach ( $qf_videos as $qf_index => $qf_video ) : ?>
					<?php
					/* translators: %d: video number */
					echo qf_video( $qf_video, sprintf( __( 'Gym video %d', 'quesada-fitness' ), $qf_index + 1 ) ); // phpcs:ignore WordPress.Security.EscapeOutput
					?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
get_template_part(
	'template-parts/news',
	null,
	array(
		'count' => 6,
		'title' => __( 'From the <span>gym</span>', 'quesada-fitness' ),
	)
);
get_template_part( 'template-parts/lightbox' );
get_footer();
