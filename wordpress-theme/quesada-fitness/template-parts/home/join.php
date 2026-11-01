<?php
/**
 * "Would you like to join us?" with the three member situations from the original home page.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="section section--alt" id="join">
	<div class="container about">
		<div class="about__content reveal">
			<span class="eyebrow"><?php esc_html_e( 'Membership', 'quesada-fitness' ); ?></span>
			<h2 class="section__title"><?php esc_html_e( 'Would you like to', 'quesada-fitness' ); ?> <span class="text-red"><?php esc_html_e( 'join us?', 'quesada-fitness' ); ?></span></h2>
			<p class="section__text"><?php esc_html_e( 'A community with no barriers of age, sex or nationality, where you can train and learn new sports safely.', 'quesada-fitness' ); ?></p>
			<div class="about__actions">
				<a href="#prices" class="btn btn--primary"><?php esc_html_e( 'See prices', 'quesada-fitness' ); ?></a>
				<?php $qf_team = qf_page_url( 'equipo' ); ?>
				<?php if ( $qf_team ) : ?>
					<a href="<?php echo esc_url( $qf_team ); ?>" class="btn btn--ghost"><?php esc_html_e( 'Meet the team', 'quesada-fitness' ); ?></a>
				<?php endif; ?>
			</div>
		</div>

		<div class="steps">
			<article class="card step reveal">
				<span class="icon-tile"><?php echo qf_icon( 'users' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<div>
					<h3 class="card__title"><?php esc_html_e( 'New member?', 'quesada-fitness' ); ?></h3>
					<p class="card__text"><?php esc_html_e( 'Become a member of Quesada Fitness GYM and make the most of our special offers for new clients.', 'quesada-fitness' ); ?></p>
				</div>
			</article>
			<article class="card step reveal">
				<span class="icon-tile"><?php echo qf_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<div>
					<h3 class="card__title"><?php esc_html_e( 'Already a member?', 'quesada-fitness' ); ?></h3>
					<p class="card__text"><?php esc_html_e( 'With your membership you also get exclusive discounts on our classes.', 'quesada-fitness' ); ?></p>
				</div>
			</article>
			<article class="card step reveal">
				<span class="icon-tile"><?php echo qf_icon( 'dumbbell' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				<div>
					<h3 class="card__title"><?php esc_html_e( 'First time in a gym?', 'quesada-fitness' ); ?></h3>
					<p class="card__text"><?php esc_html_e( 'Get a gym introduction pass to learn the rules and how the machines work, with advice from our instructors to reach your fitness goals.', 'quesada-fitness' ); ?></p>
				</div>
			</article>
		</div>
	</div>
</section>
