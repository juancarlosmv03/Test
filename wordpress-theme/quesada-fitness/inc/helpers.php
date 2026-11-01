<?php
/**
 * Template helpers.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SVG icon from the sprite in template-parts/icons.php.
 *
 * @param string $name  Icon id without the "i-" prefix.
 * @param string $class Extra classes (icon--sm, icon--xs...).
 * @return string
 */
function qf_icon( $name, $class = '' ) {
	return sprintf(
		'<svg class="icon %1$s" aria-hidden="true" focusable="false"><use href="#i-%2$s"></use></svg>',
		esc_attr( $class ),
		esc_attr( $name )
	);
}

/**
 * URL of a file in the media library uploads folder, e.g. "2023/09/QFG7.jpg".
 *
 * The theme points at the photos already uploaded to the gym's WordPress, so
 * nothing has to be uploaded again when the theme is activated.
 *
 * @param string $path Path relative to wp-content/uploads.
 * @return string
 */
function qf_upload_url( $path ) {
	$dir = wp_get_upload_dir();
	return trailingslashit( $dir['baseurl'] ) . ltrim( $path, '/' );
}

/**
 * Split a Customizer textarea into rows of "a | b | c" columns.
 *
 * @param string $text    Raw text, one row per line.
 * @param int    $columns Number of columns to return per row.
 * @return array<int, string[]>
 */
function qf_parse_lines( $text, $columns = 2 ) {
	$rows = array();
	foreach ( preg_split( '/\r\n|\r|\n/', (string) $text ) as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$parts  = array_map( 'trim', explode( '|', $line ) );
		$rows[] = array_pad( array_slice( $parts, 0, $columns ), $columns, '' );
	}
	return $rows;
}

/**
 * Convert "HH:MM" into minutes after midnight.
 *
 * @param string $time Time string.
 * @return int|null
 */
function qf_time_to_minutes( $time ) {
	if ( ! preg_match( '/^(\d{1,2}):(\d{2})$/', trim( (string) $time ), $m ) ) {
		return null;
	}
	return (int) $m[1] * 60 + (int) $m[2];
}

/**
 * Opening hours per weekday (0 = Sunday) as [opens, closes] in minutes, for the live status badge.
 *
 * @return array<int, int[]>
 */
function qf_opening_minutes() {
	$weekday = array( qf_time_to_minutes( qf_mod( 'weekday_open' ) ), qf_time_to_minutes( qf_mod( 'weekday_close' ) ) );
	$weekend = array( qf_time_to_minutes( qf_mod( 'weekend_open' ) ), qf_time_to_minutes( qf_mod( 'weekend_close' ) ) );
	$hours   = array();
	for ( $day = 0; $day < 7; $day++ ) {
		$slot = ( 0 === $day || 6 === $day ) ? $weekend : $weekday;
		if ( null !== $slot[0] && null !== $slot[1] ) {
			$hours[ $day ] = $slot;
		}
	}
	return $hours;
}

/**
 * Opening hours rows for display.
 *
 * @return array<int, array{label:string, hours:string, days:string}>
 */
function qf_opening_rows() {
	return array(
		array(
			'label' => __( 'Monday – Friday', 'quesada-fitness' ),
			'hours' => qf_mod( 'weekday_open' ) . ' – ' . qf_mod( 'weekday_close' ),
			'days'  => '1,2,3,4,5',
		),
		array(
			'label' => __( 'Saturday & Sunday', 'quesada-fitness' ),
			'hours' => qf_mod( 'weekend_open' ) . ' – ' . qf_mod( 'weekend_close' ),
			'days'  => '6,0',
		),
	);
}

/**
 * Link for a phone number.
 *
 * @param string $number Phone number as displayed.
 * @return string
 */
function qf_tel_href( $number ) {
	return 'tel:' . preg_replace( '/[^\d+]/', '', (string) $number );
}

/**
 * WhatsApp chat link for a phone number.
 *
 * @param string $number Phone number with country code.
 * @return string
 */
function qf_whatsapp_url( $number ) {
	return 'https://wa.me/' . preg_replace( '/\D/', '', (string) $number );
}

/**
 * Permalink of a page by slug, or null when the page doesn't exist.
 *
 * @param string $slug Page slug.
 * @return string|null
 */
function qf_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : null;
}

/**
 * Where "all news" links point: the posts page if one is set, otherwise the gallery page.
 *
 * @return string|null
 */
function qf_news_url() {
	$posts_page = (int) get_option( 'page_for_posts' );
	if ( $posts_page ) {
		return get_permalink( $posts_page );
	}
	return qf_page_url( 'galeria' );
}

/**
 * Main pages used by the menu fallback and the footer, in menu order.
 *
 * @return array<int, array{label:string, url:string, external?:bool}>
 */
function qf_main_links() {
	$links = array(
		array(
			'label' => __( 'Home', 'quesada-fitness' ),
			'url'   => home_url( '/' ),
		),
	);
	$pages = array(
		'clases'  => __( 'Classes', 'quesada-fitness' ),
		'equipo'  => __( 'Team', 'quesada-fitness' ),
		'galeria' => __( 'Gallery', 'quesada-fitness' ),
		'contacto' => __( 'Contact', 'quesada-fitness' ),
	);
	foreach ( $pages as $slug => $label ) {
		$url = qf_page_url( $slug );
		if ( $url ) {
			$links[] = array(
				'label' => $label,
				'url'   => $url,
			);
		}
	}
	return $links;
}

/**
 * Menu fallback when no menu is assigned to the main location.
 */
function qf_menu_fallback() {
	echo '<ul class="nav__list">';
	$here = is_front_page() ? home_url( '/' ) : ( is_page() ? get_permalink() : '' );
	foreach ( qf_main_links() as $link ) {
		$current = $here && untrailingslashit( $link['url'] ) === untrailingslashit( $here );
		printf(
			'<li><a class="nav__link" href="%1$s"%3$s>%2$s</a></li>',
			esc_url( $link['url'] ),
			esc_html( $link['label'] ),
			$current ? ' aria-current="page"' : ''
		);
	}
	echo '</ul>';
}

/**
 * Legal pages that exist on the site, keyed by slug.
 *
 * @return array<string, string> URL => label.
 */
function qf_legal_links() {
	$pages = array(
		'aviso-legal'            => __( 'Legal notice', 'quesada-fitness' ),
		'politica-de-privacidad' => __( 'Privacy policy', 'quesada-fitness' ),
		'politica-de-cookies'    => __( 'Cookie policy', 'quesada-fitness' ),
	);
	$links = array();
	foreach ( $pages as $slug => $label ) {
		$url = qf_page_url( $slug );
		if ( $url ) {
			$links[ $url ] = $label;
		}
	}
	return $links;
}

/**
 * Section heading block used across templates.
 *
 * @param string $eyebrow Small label above the title.
 * @param string $title   Title; wrap the highlighted part in <span>.
 * @param string $text    Optional intro text.
 * @param string $tag     Heading tag.
 */
function qf_section_head( $eyebrow, $title, $text = '', $tag = 'h2' ) {
	$allowed = array( 'span' => array() );
	echo '<header class="section__head reveal">';
	if ( $eyebrow ) {
		echo '<span class="eyebrow">' . esc_html( $eyebrow ) . '</span>';
	}
	printf(
		'<%1$s class="section__title">%2$s</%1$s>',
		tag_escape( $tag ),
		wp_kses( str_replace( '<span>', '<span class="text-red">', $title ), array( 'span' => array( 'class' => array() ) ) )
	);
	if ( $text ) {
		echo '<p class="section__text">' . wp_kses( $text, $allowed ) . '</p>';
	}
	echo '</header>';
}

/**
 * Video player for an MP4 in the uploads folder.
 *
 * @param string $path  Path relative to wp-content/uploads.
 * @param string $label Accessible label.
 * @return string
 */
function qf_video( $path, $label ) {
	return sprintf(
		'<video class="video" controls playsinline preload="metadata" aria-label="%2$s"><source src="%1$s#t=0.1" type="video/mp4"></video>',
		esc_url( qf_upload_url( $path ) ),
		esc_attr( $label )
	);
}
