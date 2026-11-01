<?php
/**
 * Default page template (legal pages and any other page).
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/page-hero', null, array( 'title' => get_the_title() ) );
	?>
	<section class="section section--content">
		<div class="container container--content">
			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry-media"><?php the_post_thumbnail( 'large' ); ?></figure>
			<?php endif; ?>
			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>
		</div>
	</section>
	<?php
endwhile;

get_footer();
