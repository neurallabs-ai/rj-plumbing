<?php
/**
 * RJ Plumbing theme — plumbing business template by Neural Labs.
 *
 * Business details (name, phone, areas, hours, reviews) are Customizer settings,
 * so the same theme can be reused for another plumbing client by changing them.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RJP_VERSION', '1.0.0' );

require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/service-requests.php';

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 240, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'script', 'style', 'navigation-widgets' ) );
	add_theme_support( 'responsive-embeds' );

	register_nav_menus( array(
		'footer' => __( 'Footer menu', 'rj-plumbing' ),
	) );
} );

/**
 * Version string for a theme file: its modified time, so browsers pick up edits.
 */
function rjp_ver( $relative ) {
	$file = get_template_directory() . '/' . $relative;
	return is_file( $file ) ? (string) filemtime( $file ) : RJP_VERSION;
}

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'rjp-fonts', 'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap', array(), null );
	wp_enqueue_style( 'rjp-theme', get_stylesheet_uri(), array( 'rjp-fonts' ), rjp_ver( 'style.css' ) );
	wp_enqueue_script( 'rjp-main', get_template_directory_uri() . '/assets/js/main.js', array(), rjp_ver( 'assets/js/main.js' ), array( 'strategy' => 'defer', 'in_footer' => true ) );

	// The front page is hand-built and uses no blocks.
	if ( is_front_page() ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'classic-theme-styles' );
	}
} );

add_action( 'wp_head', function () {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( get_template_directory_uri() . '/assets/img/favicon.svg' ) . '">' . "\n";
	echo '<meta name="theme-color" content="#0B1B2B">' . "\n";
	if ( is_front_page() ) {
		echo '<meta name="description" content="' . esc_attr( rjp_opt( 'hero_text' ) ) . '">' . "\n";
		rjp_schema();
	}
}, 1 );

add_filter( 'pre_get_document_title', function ( $title ) {
	if ( is_front_page() ) {
		return rjp_opt( 'business_name' ) . ' | ' . rjp_opt( 'tagline' );
	}
	return $title;
} );

/**
 * Print an icon from the sprite in header.php.
 */
function rjp_icon( $name, $class = '' ) {
	printf( '<svg class="icon %s" aria-hidden="true"><use href="#i-%s"/></svg>', esc_attr( $class ), esc_attr( $name ) );
}

/**
 * tel: link for the business phone number.
 */
function rjp_tel() {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', rjp_opt( 'phone' ) );
}

/**
 * Services shown on the front page. Filter 'rjp_services' to change them per client.
 */
function rjp_services() {
	return apply_filters( 'rjp_services', array(
		array( 'icon' => 'alert', 'title' => 'Emergency repairs', 'text' => 'Burst pipes, major leaks and backups handled fast, day or night.' ),
		array( 'icon' => 'drain', 'title' => 'Drain cleaning', 'text' => 'Slow or blocked sinks, tubs, toilets and floor drains cleared properly.' ),
		array( 'icon' => 'flame', 'title' => 'Water heaters', 'text' => 'Tank and tankless repair, replacement and new installs.' ),
		array( 'icon' => 'drop', 'title' => 'Leak detection', 'text' => 'Find hidden leaks early and stop water damage before it spreads.' ),
		array( 'icon' => 'pump', 'title' => 'Sump pumps', 'text' => 'Inspection, repair and replacement to keep your basement dry.' ),
		array( 'icon' => 'faucet', 'title' => 'Fixtures & faucets', 'text' => 'Taps, toilets, showers and sinks repaired or upgraded.' ),
		array( 'icon' => 'pipe', 'title' => 'Sewer & water lines', 'text' => 'Camera inspection, repairs and line replacement.' ),
		array( 'icon' => 'wrench', 'title' => 'Renovation plumbing', 'text' => 'Rough-ins and finishing for kitchens, bathrooms and basements.' ),
	) );
}

/**
 * Common questions. Filter 'rjp_faqs' to change them per client.
 */
function rjp_faqs() {
	return apply_filters( 'rjp_faqs', array(
		array( 'q' => 'Do you offer emergency plumbing service?', 'a' => 'Yes. Call us any time for burst pipes, flooding, sewer backups or no hot water, and we’ll get someone to you as quickly as we can.' ),
		array( 'q' => 'Will I know the price before work starts?', 'a' => 'Yes. We look at the problem first and give you an upfront price. No work starts until you approve it.' ),
		array( 'q' => 'What areas do you serve?', 'a' => 'See the service areas listed on this page. If you’re nearby but not listed, call us — we can often still help.' ),
		array( 'q' => 'Do you repair and install water heaters?', 'a' => 'We repair, replace and install both tank and tankless water heaters, and can help you choose the right size for your home.' ),
		array( 'q' => 'How do I book a service call?', 'a' => 'Call us or send a request with the form below. We’ll get back to you to confirm a time.' ),
	) );
}

/**
 * LocalBusiness structured data for search engines, built from the Customizer settings.
 */
function rjp_schema() {
	$data = array(
		'@context'  => 'https://schema.org',
		'@type'     => 'Plumber',
		'name'      => rjp_opt( 'business_name' ),
		'telephone' => rjp_opt( 'phone' ),
		'email'     => rjp_opt( 'email' ),
		'url'       => home_url( '/' ),
		'address'   => rjp_opt( 'address' ),
		'areaServed' => rjp_areas(),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
}
