<?php
/**
 * Header band for inner pages.
 *
 * Expects $args: eyebrow, title (may contain <span> for the red part), text, photo (uploads path).
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qf_args = wp_parse_args(
	$args ?? array(),
	array(
		'eyebrow' => '',
		'title'   => get_the_title(),
		'text'    => '',
		'photo'   => '',
	)
);
?>
<section class="page-hero<?php echo $qf_args['photo'] ? ' page-hero--photo' : ''; ?>">
	<?php if ( $qf_args['photo'] ) : ?>
		<img class="page-hero__photo" src="<?php echo esc_url( qf_upload_url( $qf_args['photo'] ) ); ?>" alt="" fetchpriority="high">
	<?php endif; ?>
	<div class="hero__bg" aria-hidden="true"></div>
	<div class="container page-hero__inner">
		<?php if ( $qf_args['eyebrow'] ) : ?>
			<span class="eyebrow"><span class="eyebrow__dot"></span><?php echo esc_html( $qf_args['eyebrow'] ); ?></span>
		<?php endif; ?>
		<h1 class="page-hero__title"><?php echo wp_kses( str_replace( '<span>', '<span class="text-red">', $qf_args['title'] ), array( 'span' => array( 'class' => array() ) ) ); ?></h1>
		<?php if ( $qf_args['text'] ) : ?>
			<p class="page-hero__text"><?php echo esc_html( $qf_args['text'] ); ?></p>
		<?php endif; ?>
	</div>
</section>
