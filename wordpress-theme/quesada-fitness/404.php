<?php
/**
 * Not found.
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
		'eyebrow' => '404',
		'title'   => __( 'Page <span>not found</span>', 'quesada-fitness' ),
		'text'    => __( 'The page you are looking for doesn\'t exist or has moved.', 'quesada-fitness' ),
	)
);
?>
<section class="section">
	<div class="container container--content empty-state">
		<?php get_search_form(); ?>
		<p class="section__more"><a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to the home page', 'quesada-fitness' ); ?></a></p>
	</div>
</section>
<?php
get_footer();
