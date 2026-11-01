<?php
/**
 * Latest posts section.
 *
 * Expects $args: count (int), eyebrow, title.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_args  = wp_parse_args(
	$args ?? array(),
	array(
		'count'   => 3,
		'eyebrow' => __( 'News', 'quesada-fitness' ),
		'title'   => __( 'Latest <span>news</span>', 'quesada-fitness' ),
	)
);
$qf_query = new WP_Query(
	array(
		'posts_per_page'      => (int) $qf_args['count'],
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
if ( ! $qf_query->have_posts() ) {
	return;
}
$qf_news_url = qf_news_url();
?>
<section class="section" id="news">
	<div class="container">
		<?php qf_section_head( $qf_args['eyebrow'], $qf_args['title'], __( 'Competitions, results and what\'s new at the gym.', 'quesada-fitness' ) ); ?>
		<div class="grid grid--cards">
			<?php
			while ( $qf_query->have_posts() ) {
				$qf_query->the_post();
				get_template_part( 'template-parts/post-card' );
			}
			wp_reset_postdata();
			?>
		</div>
		<?php if ( $qf_news_url && (int) get_option( 'page_for_posts' ) ) : ?>
			<p class="section__more"><a class="btn btn--ghost" href="<?php echo esc_url( $qf_news_url ); ?>"><?php esc_html_e( 'All news', 'quesada-fitness' ); ?><?php echo qf_icon( 'arrow', 'icon--sm' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></p>
		<?php endif; ?>
	</div>
</section>
