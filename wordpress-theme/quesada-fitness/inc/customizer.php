<?php
/**
 * Customizer settings: contact details, opening hours, prices and timetable.
 *
 * Everything the gym changes regularly can be edited in Appearance → Customize,
 * without touching code. Defaults are the values published on quesadafitness.com.
 *
 * @package Quesada_Fitness
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Default values for every setting.
 *
 * @return array<string, string>
 */
function qf_defaults() {
	return array(
		// Contact.
		'phone'           => '+34 865 77 45 77',
		'whatsapp'        => '+34 681 96 45 56',
		'email'           => 'info@quesadafitness.com',
		'address_1'       => 'Avenida del Aeropuerto, 50-D',
		'address_2'       => '03170 Ciudad Quesada, Rojales (Alicante)',
		'maps_url'        => 'https://www.google.es/maps/place/Quesada+Fitness+Gym/@38.071691,-0.712849,15z/data=!4m5!3m4!1s0x0:0xc60f2dfd83b596e2!8m2!3d38.0716526!4d-0.7129151',
		'map_embed'       => 'https://www.google.com/maps?q=38.0716526,-0.7129151&z=16&output=embed',
		'contact_form'    => '',

		// Links.
		'booking_url'     => 'https://quesadafitnessgym.setmore.com/',
		'facebook_url'    => 'https://www.facebook.com/quesada.fitness.gym.boxing.and.mma.club',
		'instagram_url'   => 'https://www.instagram.com/fitnessquesada/',

		// Opening hours.
		'weekday_open'    => '07:00',
		'weekday_close'   => '21:30',
		'weekend_open'    => '09:00',
		'weekend_close'   => '13:00',

		// Prices: one row per line, "Name | Price" (optionally "| link").
		'prices_gym'      => implode(
			"\n",
			array(
				__( 'Registration card', 'quesada-fitness' ) . ' | €7',
				__( '1 week gym', 'quesada-fitness' ) . ' | €27.50',
				__( '2 weeks gym', 'quesada-fitness' ) . ' | €32.50',
				__( '3 weeks gym', 'quesada-fitness' ) . ' | €37.50',
				__( '4 weeks gym', 'quesada-fitness' ) . ' | €42.50',
				__( 'Gym + boxing / kickboxing (adults)', 'quesada-fitness' ) . ' | €55',
				__( 'Boxing / kickboxing (juniors)', 'quesada-fitness' ) . ' | €40',
				__( 'Single gym session', 'quesada-fitness' ) . ' | €10',
				__( 'Single junior boxing / kickboxing session', 'quesada-fitness' ) . ' | €6',
				__( 'Single class (without gym membership)', 'quesada-fitness' ) . ' | €7',
				__( 'Single class (with gym membership)', 'quesada-fitness' ) . ' | €3.50',
				__( '12-class pass (valid for 6 months)', 'quesada-fitness' ) . ' | €57.50',
				__( 'Personal trainer, 1 hour', 'quesada-fitness' ) . ' | €30',
				__( 'Kickboxing personal trainer, 1 hour', 'quesada-fitness' ) . ' | €40',
			)
		),
		'prices_offers'   => implode(
			"\n",
			array(
				__( '4 weeks gym + 4 classes a week', 'quesada-fitness' ) . ' | €52.50',
				__( 'Gym introduction', 'quesada-fitness' ) . ' | €14',
			)
		),
		'prices_extras'   => implode(
			"\n",
			array(
				__( 'Osteopathy session, 1 hour', 'quesada-fitness' ) . ' | €50',
				__( 'Chiromassage session, 1 hour', 'quesada-fitness' ) . ' | €38 | https://maribel-quesada-chiromassage.com/',
				__( 'Ayurvedic session, 1 hour', 'quesada-fitness' ) . ' | €32 | https://maribel-quesada-chiromassage.com/',
				__( 'Over-65 discount', 'quesada-fitness' ) . ' | 10%',
				__( 'Large family discount (4+)', 'quesada-fitness' ) . ' | 10%',
				__( '12-week membership discount', 'quesada-fitness' ) . ' | 10%',
			)
		),

		// Timetable: one class per line, "HH:MM | Class". End a name with * for outside instructors.
		'timetable_mon'   => "09:30 | Buttlift / TRX\n11:00 | Zumba\n17:30 | Spin",
		'timetable_tue'   => "09:30 | Fit for All (toning)\n09:30 | Spin\n10:30 | Pilates\n11:30 | Zumba Chair\n18:00 | Mixed Pilates",
		'timetable_wed'   => "09:30 | Boxercises\n10:30 | Studio Circuits\n10:30 | Zumba*\n11:30 | Stretch & Tone\n17:30 | Total Body Workout (toning)\n18:30 | Spin",
		'timetable_thu'   => "09:30 | Fit for All (toning)\n09:30 | Stretch Pilates\n10:30 | Pump FX\n10:30 | Stretch Pilates\n17:00 | Tai Chi*\n18:30 | Zumba",
		'timetable_fri'   => "09:30 | Tabata\n18:00 | Total Body Workout",
		'timetable_sat'   => "09:30 | Spin\n11:00 | Zumba",
		'timetable_sun'   => '10:30 | Studio Circuits',
		'timetable_image' => '2026/07/AllClassesTimetable-4.png',
	);
}

/**
 * Get a theme setting, falling back to its default.
 *
 * @param string $key Setting key without the "qf_" prefix.
 * @return string
 */
function qf_mod( $key ) {
	$defaults = qf_defaults();
	$value    = get_theme_mod( 'qf_' . $key, $defaults[ $key ] ?? '' );
	return is_string( $value ) ? $value : (string) ( $defaults[ $key ] ?? '' );
}

/**
 * Sanitize a "HH:MM" time.
 *
 * @param string               $value   Input.
 * @param WP_Customize_Setting $setting Setting object.
 * @return string
 */
function qf_sanitize_time( $value, $setting ) {
	$value = trim( (string) $value );
	return preg_match( '/^([01]?\d|2[0-3]):[0-5]\d$/', $value ) ? $value : $setting->default;
}

/**
 * Sanitize a shortcode field: keep a single [shortcode ...] tag only.
 *
 * @param string $value Input.
 * @return string
 */
function qf_sanitize_shortcode( $value ) {
	$value = trim( wp_strip_all_tags( (string) $value ) );
	return preg_match( '/^\[[a-z0-9_-]+[^\[\]]*\]$/i', $value ) ? $value : '';
}

/**
 * Register Customizer sections and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function qf_customize_register( $wp_customize ) {
	$defaults = qf_defaults();

	$wp_customize->add_panel(
		'qf_panel',
		array(
			'title'    => __( 'Quesada Fitness', 'quesada-fitness' ),
			'priority' => 30,
		)
	);

	$sections = array(
		'qf_contact'   => __( 'Contact details', 'quesada-fitness' ),
		'qf_links'     => __( 'Booking & social links', 'quesada-fitness' ),
		'qf_hours'     => __( 'Opening hours', 'quesada-fitness' ),
		'qf_prices'    => __( 'Prices', 'quesada-fitness' ),
		'qf_timetable' => __( 'Class timetable', 'quesada-fitness' ),
	);
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section(
			$id,
			array(
				'title' => $title,
				'panel' => 'qf_panel',
			)
		);
	}

	$price_help     = __( 'One row per line: Name | Price. Add "| https://…" to link the name.', 'quesada-fitness' );
	$timetable_help = __( 'One class per line: 09:30 | Class name. End the name with * for classes run by outside instructors.', 'quesada-fitness' );

	$fields = array(
		// key => [section, label, type, sanitize, description].
		'phone'           => array( 'qf_contact', __( 'Phone', 'quesada-fitness' ), 'text', 'sanitize_text_field' ),
		'whatsapp'        => array( 'qf_contact', __( 'WhatsApp', 'quesada-fitness' ), 'text', 'sanitize_text_field' ),
		'email'           => array( 'qf_contact', __( 'Email', 'quesada-fitness' ), 'email', 'sanitize_email' ),
		'address_1'       => array( 'qf_contact', __( 'Address line 1', 'quesada-fitness' ), 'text', 'sanitize_text_field' ),
		'address_2'       => array( 'qf_contact', __( 'Address line 2', 'quesada-fitness' ), 'text', 'sanitize_text_field' ),
		'maps_url'        => array( 'qf_contact', __( 'Google Maps link', 'quesada-fitness' ), 'url', 'esc_url_raw' ),
		'map_embed'       => array( 'qf_contact', __( 'Map embed URL', 'quesada-fitness' ), 'url', 'esc_url_raw', __( 'Loaded only when a visitor clicks "Show map", so no Google cookies are set before that.', 'quesada-fitness' ) ),
		'contact_form'    => array( 'qf_contact', __( 'Contact form shortcode', 'quesada-fitness' ), 'text', 'qf_sanitize_shortcode', __( 'Optional, e.g. [contact-form-7 id="123"]. If empty, the form found in the Contact page content is used.', 'quesada-fitness' ) ),
		'booking_url'     => array( 'qf_links', __( 'Online booking link', 'quesada-fitness' ), 'url', 'esc_url_raw' ),
		'facebook_url'    => array( 'qf_links', __( 'Facebook', 'quesada-fitness' ), 'url', 'esc_url_raw' ),
		'instagram_url'   => array( 'qf_links', __( 'Instagram', 'quesada-fitness' ), 'url', 'esc_url_raw' ),
		'weekday_open'    => array( 'qf_hours', __( 'Monday – Friday opens', 'quesada-fitness' ), 'text', 'qf_sanitize_time', __( 'Format HH:MM', 'quesada-fitness' ) ),
		'weekday_close'   => array( 'qf_hours', __( 'Monday – Friday closes', 'quesada-fitness' ), 'text', 'qf_sanitize_time' ),
		'weekend_open'    => array( 'qf_hours', __( 'Saturday & Sunday opens', 'quesada-fitness' ), 'text', 'qf_sanitize_time' ),
		'weekend_close'   => array( 'qf_hours', __( 'Saturday & Sunday closes', 'quesada-fitness' ), 'text', 'qf_sanitize_time' ),
		'prices_gym'      => array( 'qf_prices', __( 'Gym plans', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field', $price_help ),
		'prices_offers'   => array( 'qf_prices', __( 'Special offers', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field', $price_help ),
		'prices_extras'   => array( 'qf_prices', __( 'Treatments & discounts', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field', $price_help ),
		'timetable_mon'   => array( 'qf_timetable', __( 'Monday', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field', $timetable_help ),
		'timetable_tue'   => array( 'qf_timetable', __( 'Tuesday', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field' ),
		'timetable_wed'   => array( 'qf_timetable', __( 'Wednesday', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field' ),
		'timetable_thu'   => array( 'qf_timetable', __( 'Thursday', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field' ),
		'timetable_fri'   => array( 'qf_timetable', __( 'Friday', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field' ),
		'timetable_sat'   => array( 'qf_timetable', __( 'Saturday', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field' ),
		'timetable_sun'   => array( 'qf_timetable', __( 'Sunday', 'quesada-fitness' ), 'textarea', 'sanitize_textarea_field' ),
		'timetable_image' => array( 'qf_timetable', __( 'Timetable image (path in uploads)', 'quesada-fitness' ), 'text', 'sanitize_text_field', __( 'For example 2026/07/AllClassesTimetable-4.png. Leave empty to hide the link.', 'quesada-fitness' ) ),
	);

	foreach ( $fields as $key => $field ) {
		$wp_customize->add_setting(
			'qf_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $field[3],
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'qf_' . $key,
			array(
				'section'     => $field[0],
				'label'       => $field[1],
				'type'        => $field[2],
				'description' => $field[4] ?? '',
			)
		);
	}
}
add_action( 'customize_register', 'qf_customize_register' );
