<?php
/**
 * Estimate request forms.
 *
 * Every request is saved as a private "Estimate request" in wp-admin, so nothing is lost
 * even where the server can't send email, and a copy is emailed. On the demo site the copy
 * goes to the WordPress admin email; filter 'rjp_request_recipient' to send it to the client.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type( 'rjp_request', array(
		'labels'          => array(
			'name'          => __( 'Estimate requests', 'rj-plumbing' ),
			'singular_name' => __( 'Estimate request', 'rj-plumbing' ),
		),
		'public'          => false,
		'show_ui'         => true,
		'menu_icon'       => 'dashicons-hammer',
		'supports'        => array( 'title', 'editor' ),
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
	) );
} );

/**
 * Hidden fields added inside every estimate form when a page is served.
 */
function rjp_form_fields( $route ) {
	return '<input type="hidden" name="action" value="rjp_request">'
		. '<input type="hidden" name="from_page" value="' . esc_attr( $route ) . '">'
		. wp_nonce_field( 'rjp_request', 'rjp_nonce', false, false );
}

add_action( 'admin_post_nopriv_rjp_request', 'rjp_handle_request' );
add_action( 'admin_post_rjp_request', 'rjp_handle_request' );

function rjp_handle_request() {
	$thanks = home_url( '/thank-you/' );
	$from   = sanitize_text_field( wp_unslash( $_POST['from_page'] ?? '' ) );
	$back   = home_url( '/' . ( $from ? trailingslashit( $from ) : '' ) ) . '#estimate';

	if ( ! isset( $_POST['rjp_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['rjp_nonce'] ) ), 'rjp_request' ) ) {
		wp_safe_redirect( $back );
		exit;
	}
	// Hidden field that people never fill in; bots usually do.
	if ( ! empty( $_POST['company_website'] ) ) {
		wp_safe_redirect( $thanks );
		exit;
	}

	$name      = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$phone     = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$service   = sanitize_text_field( wp_unslash( $_POST['service'] ?? '' ) );
	$message   = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
	$marketing = ! empty( $_POST['marketing_consent'] ) ? 'Yes' : 'No';

	if ( '' === $name || '' === $phone ) {
		wp_safe_redirect( $back );
		exit;
	}

	$body = "Name: {$name}\nPhone: {$phone}\nService: {$service}\nOffers & reminders consent: {$marketing}\nSent from: /{$from}\n\n{$message}";
	wp_insert_post( array(
		'post_type'    => 'rjp_request',
		'post_status'  => 'private',
		'post_title'   => sprintf( '%s — %s', $name, $service ? $service : __( 'General request', 'rj-plumbing' ) ),
		'post_content' => $body,
	) );

	$to = apply_filters( 'rjp_request_recipient', get_option( 'admin_email' ) );
	wp_mail( $to, sprintf( 'New estimate request from %s', $name ), $body );

	wp_safe_redirect( $thanks );
	exit;
}
