<?php
/**
 * Team page (slug "equipo").
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
		'eyebrow' => __( 'Our team', 'quesada-fitness' ),
		'title'   => __( 'Meet the <span>team</span>', 'quesada-fitness' ),
		'text'    => __( 'Our team is made up of people with a real passion for fitness. They work every day to keep this wonderful community alive and look after the health and wellbeing of our members.', 'quesada-fitness' ),
		'photo'   => '2024/12/upgradedgym2.jpg',
	)
);
?>

<section class="section">
	<div class="container feature-split">
		<figure class="feature-split__media founders reveal">
			<img src="<?php echo esc_url( qf_upload_url( '2021/11/usforwebsite.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Vivienne and Michael', 'quesada-fitness' ); ?>" loading="lazy" decoding="async">
		</figure>
		<div class="feature-split__text reveal">
			<span class="eyebrow"><?php esc_html_e( 'Our story', 'quesada-fitness' ); ?></span>
			<h2 class="section__title"><?php esc_html_e( 'Vivienne', 'quesada-fitness' ); ?> <span class="text-red">&amp; <?php esc_html_e( 'Michael', 'quesada-fitness' ); ?></span></h2>
			<div class="prose">
				<p><?php esc_html_e( 'After suffering health problems, Vivienne moved to Spain from her native Newcastle with a view to early retirement. Instead, she bought a gym despite having little experience in the fitness industry. A very entrepreneurial woman, together with her then partner and now husband Michael, a keen bodybuilder, she created a special place that was loved by staff and members alike.', 'quesada-fitness' ); ?></p>
				<p><?php esc_html_e( 'A few years later, they decided it was time to build a specialist gym in Ciudad Quesada.', 'quesada-fitness' ); ?></p>
				<blockquote class="quote">
					<p><?php esc_html_e( 'This is the biggest risk I\'ve taken in my life, but every day I\'m rewarded by such wonderful staff and members. We try to break the mould of impersonal gyms by creating a community with no barriers of age, sex or nationality. We\'ve never had so much fun, despite all the effort and dedication this project takes.', 'quesada-fitness' ); ?></p>
					<cite><?php esc_html_e( 'Vivienne', 'quesada-fitness' ); ?></cite>
				</blockquote>
			</div>
		</div>
	</div>
</section>

<section class="section section--alt">
	<div class="container">
		<?php
		qf_section_head(
			__( 'The people', 'quesada-fitness' ),
			__( 'Our <span>instructors</span>', 'quesada-fitness' ),
			__( 'Thanks to them, the gym is a place where you can exercise and learn new sports disciplines completely safely. Don\'t know who they are? Meet them!', 'quesada-fitness' )
		);
		?>
		<div class="team-grid">
			<?php foreach ( qf_team() as $qf_member ) : ?>
				<article class="card team-card reveal">
					<div class="team-card__photo">
						<img src="<?php echo esc_url( qf_upload_url( $qf_member['photo'] ) ); ?>" alt="<?php echo esc_attr( $qf_member['name'] ); ?>" loading="lazy" decoding="async">
					</div>
					<div class="team-card__body">
						<h3 class="card__title"><?php echo esc_html( $qf_member['name'] ); ?></h3>
						<p class="team-card__role"><?php echo esc_html( $qf_member['role'] ); ?></p>
						<p class="card__text"><?php echo esc_html( $qf_member['bio'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php
get_template_part( 'template-parts/cta' );
get_footer();
