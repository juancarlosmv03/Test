<?php
/**
 * Posts index, archives and search results.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( is_search() ) {
	/* translators: %s: search terms */
	$qf_title = sprintf( __( 'Results for <span>%s</span>', 'quesada-fitness' ), esc_html( get_search_query() ) );
} elseif ( is_archive() ) {
	$qf_title = wp_strip_all_tags( get_the_archive_title() );
} else {
	$qf_title = __( 'Latest <span>news</span>', 'quesada-fitness' );
}

get_template_part(
	'template-parts/page-hero',
	null,
	array(
		'eyebrow' => __( 'News', 'quesada-fitness' ),
		'title'   => $qf_title,
	)
);
?>

<section class="section">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<div class="grid grid--cards">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/post-card' );
				}
				?>
			</div>
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 1,
					'prev_text' => qf_icon( 'chevron-left', 'icon--sm' ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'quesada-fitness' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'quesada-fitness' ) . '</span>' . qf_icon( 'chevron-right', 'icon--sm' ),
				)
			);
			?>
		<?php else : ?>
			<div class="empty-state">
				<p class="section__text"><?php esc_html_e( 'Nothing found. Try another search.', 'quesada-fitness' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php
get_footer();
