<?php
/**
 * Site footer.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main>

<footer class="footer">
	<div class="container">
		<div class="footer__grid">
			<div class="footer__brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
					<span class="logo__mark"><?php echo qf_icon( 'pulse' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					<span class="logo__text"><?php esc_html_e( 'Quesada', 'quesada-fitness' ); ?><span><?php esc_html_e( 'Fitness', 'quesada-fitness' ); ?></span></span>
				</a>
				<p class="footer__tagline"><?php esc_html_e( 'More than just a gym', 'quesada-fitness' ); ?></p>
				<?php get_template_part( 'template-parts/socials' ); ?>
			</div>

			<nav class="footer__col" aria-label="<?php esc_attr_e( 'Footer', 'quesada-fitness' ); ?>">
				<h2 class="footer__title"><?php esc_html_e( 'Explore', 'quesada-fitness' ); ?></h2>
				<?php
				if ( has_nav_menu( 'footer-menu' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer-menu',
							'container'      => false,
							'depth'          => 1,
						)
					);
				} else {
					echo '<ul>';
					foreach ( qf_main_links() as $link ) {
						printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $link['url'] ), esc_html( $link['label'] ) );
					}
					printf( '<li><a href="%1$s" target="_blank" rel="noopener">%2$s</a></li>', esc_url( qf_mod( 'booking_url' ) ), esc_html__( 'Book online', 'quesada-fitness' ) );
					echo '</ul>';
				}
				?>
			</nav>

			<div class="footer__col">
				<h2 class="footer__title"><?php esc_html_e( 'Opening hours', 'quesada-fitness' ); ?></h2>
				<ul>
					<?php foreach ( qf_opening_rows() as $row ) : ?>
						<li><?php echo esc_html( $row['label'] ); ?><br><strong class="footer__hours"><?php echo esc_html( $row['hours'] ); ?></strong></li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="footer__col">
				<h2 class="footer__title"><?php esc_html_e( 'Contact', 'quesada-fitness' ); ?></h2>
				<ul>
					<li><?php echo esc_html( qf_mod( 'address_1' ) ); ?><br><?php echo esc_html( qf_mod( 'address_2' ) ); ?></li>
					<li><a href="<?php echo esc_attr( qf_tel_href( qf_mod( 'phone' ) ) ); ?>"><?php echo esc_html( qf_mod( 'phone' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( qf_whatsapp_url( qf_mod( 'whatsapp' ) ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'WhatsApp %s', 'quesada-fitness' ), qf_mod( 'whatsapp' ) ) ); ?></a></li>
					<li><a href="mailto:<?php echo esc_attr( antispambot( qf_mod( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( qf_mod( 'email' ) ) ); ?></a></li>
				</ul>
			</div>
		</div>

		<div class="footer__bottom">
			<p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
			<?php $legal = qf_legal_links(); ?>
			<?php if ( $legal ) : ?>
				<ul class="footer__legal">
					<?php foreach ( $legal as $url => $label ) : ?>
						<li><a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
