<?php
/**
 * Contact page (slug "contacto").
 *
 * The form comes from the Customizer shortcode setting, or from the first
 * [contact-form-7 ...] shortcode found in this page's content (the gym's existing form).
 * Without either, a simple form opens the visitor's email app.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$qf_form = qf_mod( 'contact_form' );
if ( ! $qf_form && preg_match( '/\[contact-form-7[^\]]*\]/', (string) get_post_field( 'post_content', get_the_ID() ), $qf_match ) ) {
	$qf_form = $qf_match[0];
}

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'eyebrow' => __( 'Contact', 'quesada-fitness' ),
		'title'   => __( 'Get in <span>touch</span>', 'quesada-fitness' ),
		'text'    => __( 'Call us, send us a WhatsApp or write to us. We\'ll be happy to help.', 'quesada-fitness' ),
	)
);
?>

<section class="section">
	<div class="container contact">
		<div class="contact__info reveal">
			<?php get_template_part( 'template-parts/contact-info' ); ?>
			<div class="hours">
				<h2 class="hours__title"><?php esc_html_e( 'Opening hours', 'quesada-fitness' ); ?></h2>
				<dl class="hours__list">
					<?php foreach ( qf_opening_rows() as $qf_row ) : ?>
						<div><dt><?php echo esc_html( $qf_row['label'] ); ?></dt><dd><?php echo esc_html( $qf_row['hours'] ); ?></dd></div>
					<?php endforeach; ?>
				</dl>
			</div>
			<?php get_template_part( 'template-parts/socials' ); ?>
		</div>

		<div class="card form-card reveal">
			<h2 class="form__title"><?php esc_html_e( 'Send us a message', 'quesada-fitness' ); ?></h2>
			<?php if ( $qf_form ) : ?>
				<div class="cf7-wrap"><?php echo do_shortcode( $qf_form ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/mail-form' ); ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php if ( qf_mod( 'map_embed' ) ) : ?>
	<section class="section section--alt section--map">
		<div class="container">
			<div class="map" data-map="<?php echo esc_url( qf_mod( 'map_embed' ) ); ?>">
				<div class="map__placeholder">
					<span class="icon-tile"><?php echo qf_icon( 'pin' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<p class="map__address"><?php echo esc_html( qf_mod( 'address_1' ) ); ?><br><?php echo esc_html( qf_mod( 'address_2' ) ); ?></p>
					<div class="map__actions">
						<button type="button" class="btn btn--primary btn--sm" data-map-load><?php esc_html_e( 'Show map', 'quesada-fitness' ); ?></button>
						<a class="btn btn--ghost btn--sm" href="<?php echo esc_url( qf_mod( 'maps_url' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Open in Google Maps', 'quesada-fitness' ); ?></a>
					</div>
					<p class="map__note"><?php esc_html_e( 'The map is loaded from Google Maps when you click "Show map".', 'quesada-fitness' ); ?></p>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
get_footer();
