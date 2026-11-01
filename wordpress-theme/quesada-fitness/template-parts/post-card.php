<?php
/**
 * News card for the current post in the loop.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'card post-card reveal' ); ?>>
	<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'qf-card', array( 'loading' => 'lazy', 'alt' => '' ) ); ?>
		<?php else : ?>
			<span class="post-card__placeholder"><?php echo qf_icon( 'trophy' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		<?php endif; ?>
	</a>
	<div class="post-card__body">
		<time class="post-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<h3 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p class="post-card__excerpt"><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
		<a class="post-card__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'quesada-fitness' ); ?><span class="screen-reader-text">: <?php the_title(); ?></span><?php echo qf_icon( 'arrow', 'icon--xs' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a>
	</div>
</article>
