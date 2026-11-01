<?php
/**
 * Single post.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article <?php post_class(); ?>>
		<header class="page-hero page-hero--post">
			<div class="hero__bg" aria-hidden="true"></div>
			<div class="container container--content page-hero__inner">
				<span class="eyebrow"><span class="eyebrow__dot"></span><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>
				<h1 class="page-hero__title page-hero__title--post"><?php the_title(); ?></h1>
			</div>
		</header>

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

				<?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="post-nav__label">' . esc_html__( 'Previous', 'quesada-fitness' ) . '</span><span class="post-nav__title">%title</span>',
						'next_text' => '<span class="post-nav__label">' . esc_html__( 'Next', 'quesada-fitness' ) . '</span><span class="post-nav__title">%title</span>',
					)
				);

				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</div>
		</section>
	</article>
	<?php
endwhile;

get_footer();
