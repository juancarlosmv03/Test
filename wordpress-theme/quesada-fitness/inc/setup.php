<?php
/**
 * Theme setup, assets and small WordPress tweaks.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme supports and menu locations.
 */
function qf_setup() {
	load_theme_textdomain( 'quesada-fitness', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 320,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );

	// Same location ids as the previous theme (Divi), so existing menus stay assigned after switching.
	register_nav_menus(
		array(
			'primary-menu' => __( 'Main menu', 'quesada-fitness' ),
			'footer-menu'  => __( 'Footer menu', 'quesada-fitness' ),
		)
	);

	add_image_size( 'qf-card', 800, 600, true );
}
add_action( 'after_setup_theme', 'qf_setup' );

/**
 * Content width used by embeds and images inside posts.
 */
function qf_content_width() {
	$GLOBALS['content_width'] = 760;
}
add_action( 'after_setup_theme', 'qf_content_width', 0 );

/**
 * Styles and scripts.
 */
function qf_assets() {
	$uri = get_template_directory_uri();

	wp_enqueue_style( 'qf-main', $uri . '/assets/css/main.css', array(), QF_VERSION );

	wp_enqueue_script(
		'qf-main',
		$uri . '/assets/js/main.js',
		array(),
		QF_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	$settings = array(
		'hours' => qf_opening_minutes(),
		'email' => qf_mod( 'email' ),
		'i18n'  => array(
			'openUntil'   => __( 'Open now · until %s', 'quesada-fitness' ),
			'opensAt'     => __( 'Closed · opens %s', 'quesada-fitness' ),
			'opensDay'    => __( 'Closed · opens %1$s %2$s', 'quesada-fitness' ),
			'days'        => array(
				__( 'Sun', 'quesada-fitness' ),
				__( 'Mon', 'quesada-fitness' ),
				__( 'Tue', 'quesada-fitness' ),
				__( 'Wed', 'quesada-fitness' ),
				__( 'Thu', 'quesada-fitness' ),
				__( 'Fri', 'quesada-fitness' ),
				__( 'Sat', 'quesada-fitness' ),
			),
			'formSent'    => __( 'Your email app should now open with the message ready to send. If it doesn\'t, write to us at %s.', 'quesada-fitness' ),
			'required'    => __( 'Please fill in this field.', 'quesada-fitness' ),
			'invalidMail' => __( 'Please enter a valid email address.', 'quesada-fitness' ),
		),
	);
	wp_add_inline_script( 'qf-main', 'window.qfSettings = ' . wp_json_encode( $settings ) . ';', 'before' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'qf_assets' );

/**
 * Preload the two self-hosted fonts used above the fold.
 */
function qf_preload_fonts() {
	$fonts = array( 'bebas-neue-latin.woff2', 'inter-latin-var.woff2' );
	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_template_directory_uri() . '/assets/fonts/' . $font )
		);
	}
}
add_action( 'wp_head', 'qf_preload_fonts', 1 );

/**
 * Shorter excerpts with a plain ellipsis.
 *
 * @param int $length Default length.
 * @return int
 */
function qf_excerpt_length( $length ) {
	return is_admin() ? $length : 22;
}
add_filter( 'excerpt_length', 'qf_excerpt_length' );

/**
 * Replace "[...]" at the end of excerpts.
 *
 * @return string
 */
function qf_excerpt_more() {
	return '…';
}
add_filter( 'excerpt_more', 'qf_excerpt_more' );

/**
 * Add a class to menu links so they share the theme's nav styles.
 *
 * @param array    $atts Link attributes.
 * @param WP_Post  $item Menu item.
 * @param stdClass $args Menu arguments.
 * @return array
 */
function qf_menu_link_class( $atts, $item, $args ) {
	if ( isset( $args->theme_location ) && 'primary-menu' === $args->theme_location ) {
		$atts['class'] = trim( ( $atts['class'] ?? '' ) . ' nav__link' );
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'qf_menu_link_class', 10, 3 );

/**
 * Clean up page-builder shortcodes left over from the previous theme.
 *
 * The legal pages were written with WPBakery ([vc_row]…) and some pages with the
 * Divi builder ([et_pb_section]…). When those builders are not active, their tags
 * would be printed as plain text, so strip the tags and keep the content.
 *
 * @param string $content Post content.
 * @return string
 */
function qf_strip_orphan_builder_shortcodes( $content ) {
	$prefixes = array();
	if ( ! shortcode_exists( 'vc_row' ) ) {
		$prefixes[] = 'vc_';
	}
	if ( ! shortcode_exists( 'et_pb_section' ) ) {
		$prefixes[] = 'et_pb_';
	}
	if ( ! $prefixes ) {
		return $content;
	}
	$names = implode( '|', array_map( 'preg_quote', $prefixes ) );

	// Encoded raw-HTML blocks can't be shown without the builder.
	$content = preg_replace( '/\[(' . $names . ')raw_(html|js)[^\]]*\].*?\[\/\1raw_\2\]/s', '', $content );
	// Remove the remaining opening and closing tags, keep what's between them.
	$content = preg_replace( '/\[\/?(?:' . $names . ')[a-z0-9_]*(?:\s[^\]]*)?\]/', '', $content );
	// Paragraphs left empty by the removed tags.
	return preg_replace( '#<p>(?:\s|&nbsp;)*</p>#', '', $content );
}
add_filter( 'the_content', 'qf_strip_orphan_builder_shortcodes', 8 );

/**
 * Use the browser's own emoji instead of WordPress's emoji script and images.
 */
function qf_disable_emoji() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'qf_disable_emoji' );
