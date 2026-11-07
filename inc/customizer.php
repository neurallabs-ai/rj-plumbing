<?php
/**
 * Business details, edited in Appearance → Customize → Business details.
 * Defaults are placeholders: replace them with the client's real details before launch.
 */

defined( 'ABSPATH' ) || exit;

function rjp_defaults() {
	return array(
		'business_name' => 'RJ Plumbing',
		'tagline'       => 'Licensed Plumbing, Drains & Water Heaters',
		'phone'         => '(555) 555-0123',
		'email'         => 'info@example.com',
		'address'       => 'Your street address, City, Province',
		'hours'         => 'Mon–Fri 7am–7pm · Sat 8am–4pm',
		'emergency'     => '1',
		'areas'         => 'Your City, Nearby Town, Another Town, Rural Area',
		'hero_title'    => 'Plumbing problems fixed fast, done right the first time.',
		'hero_text'     => 'Repairs, drains, water heaters and emergency service from a local, licensed plumbing team. Upfront pricing before any work starts.',
		'license'       => 'Licensed & insured',
		'google_url'    => '',
		'review_1'      => '',
		'review_1_name' => '',
		'review_2'      => '',
		'review_2_name' => '',
		'review_3'      => '',
		'review_3_name' => '',
	);
}

/**
 * A business setting, falling back to its placeholder default.
 */
function rjp_opt( $key ) {
	$defaults = rjp_defaults();
	$value    = get_theme_mod( 'rjp_' . $key, $defaults[ $key ] ?? '' );
	return is_string( $value ) ? trim( $value ) : $value;
}

/**
 * Service areas as a list.
 */
function rjp_areas() {
	return array_values( array_filter( array_map( 'trim', explode( ',', rjp_opt( 'areas' ) ) ) ) );
}

/**
 * Reviews entered in the Customizer (empty ones are skipped, so none are shown until real reviews are added).
 */
function rjp_reviews() {
	$reviews = array();
	for ( $i = 1; $i <= 3; $i++ ) {
		$text = rjp_opt( 'review_' . $i );
		if ( '' !== $text ) {
			$reviews[] = array( 'text' => $text, 'name' => rjp_opt( 'review_' . $i . '_name' ) );
		}
	}
	return $reviews;
}

add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {
	$wp_customize->add_section( 'rjp_business', array(
		'title'       => __( 'Business details', 'rj-plumbing' ),
		'description' => __( 'Shown across the site. Replace every placeholder before the site goes live.', 'rj-plumbing' ),
		'priority'    => 30,
	) );

	$fields = array(
		'business_name' => array( 'Business name', 'text' ),
		'tagline'       => array( 'Tagline (browser title)', 'text' ),
		'phone'         => array( 'Phone number', 'text' ),
		'email'         => array( 'Email', 'email' ),
		'address'       => array( 'Address', 'text' ),
		'hours'         => array( 'Hours', 'text' ),
		'emergency'     => array( 'Offer 24/7 emergency service', 'checkbox' ),
		'areas'         => array( 'Service areas (comma separated)', 'textarea' ),
		'hero_title'    => array( 'Homepage headline', 'text' ),
		'hero_text'     => array( 'Homepage intro', 'textarea' ),
		'license'       => array( 'Licence / insurance line', 'text' ),
		'google_url'    => array( 'Google reviews link', 'url' ),
	);
	for ( $i = 1; $i <= 3; $i++ ) {
		$fields[ 'review_' . $i ]           = array( "Review {$i} — text (leave empty to hide)", 'textarea' );
		$fields[ 'review_' . $i . '_name' ] = array( "Review {$i} — customer name", 'text' );
	}

	$defaults = rjp_defaults();
	foreach ( $fields as $key => list( $label, $type ) ) {
		$sanitize = 'sanitize_text_field';
		if ( 'textarea' === $type ) {
			$sanitize = 'sanitize_textarea_field';
		} elseif ( 'email' === $type ) {
			$sanitize = 'sanitize_email';
		} elseif ( 'url' === $type ) {
			$sanitize = 'esc_url_raw';
		} elseif ( 'checkbox' === $type ) {
			$sanitize = function ( $v ) { return $v ? '1' : ''; };
		}
		$wp_customize->add_setting( 'rjp_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( 'rjp_' . $key, array(
			'label'   => $label,
			'section' => 'rjp_business',
			'type'    => $type,
		) );
	}
} );
