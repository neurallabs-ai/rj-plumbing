<?php
/**
 * "Request service" form handler.
 *
 * Every request is saved as a private "Service request" in wp-admin, so nothing is lost
 * even where the server can't send email; the business email also gets a copy.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type( 'rjp_request', array(
		'labels'          => array(
			'name'          => __( 'Service requests', 'rj-plumbing' ),
			'singular_name' => __( 'Service request', 'rj-plumbing' ),
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

add_action( 'admin_post_nopriv_rjp_request', 'rjp_handle_request' );
add_action( 'admin_post_rjp_request', 'rjp_handle_request' );

function rjp_handle_request() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'request', $back );

	if ( ! isset( $_POST['rjp_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['rjp_nonce'] ) ), 'rjp_request' ) ) {
		wp_safe_redirect( add_query_arg( 'request', 'expired', $back ) . '#contact' );
		exit;
	}
	// Hidden field that people never fill in; bots usually do.
	if ( ! empty( $_POST['company_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'request', 'sent', $back ) . '#contact' );
		exit;
	}

	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$service = sanitize_text_field( wp_unslash( $_POST['service'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

	if ( '' === $name || '' === $phone ) {
		wp_safe_redirect( add_query_arg( 'request', 'missing', $back ) . '#contact' );
		exit;
	}

	$body = "Name: {$name}\nPhone: {$phone}\nEmail: {$email}\nService: {$service}\n\n{$message}";
	wp_insert_post( array(
		'post_type'    => 'rjp_request',
		'post_status'  => 'private',
		'post_title'   => sprintf( '%s — %s', $name, $service ? $service : __( 'General request', 'rj-plumbing' ) ),
		'post_content' => $body,
	) );

	$to = is_email( rjp_opt( 'email' ) ) && 'info@example.com' !== rjp_opt( 'email' ) ? rjp_opt( 'email' ) : get_option( 'admin_email' );
	$headers = $email ? array( 'Reply-To: ' . $name . ' <' . $email . '>' ) : array();
	wp_mail( $to, sprintf( 'New service request from %s', $name ), $body, $headers );

	wp_safe_redirect( add_query_arg( 'request', 'sent', $back ) . '#contact' );
	exit;
}
