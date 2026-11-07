<?php
/**
 * R. Jacobs Plumbing theme.
 *
 * Every front-end URL is answered from pages/, built from the approved static design in
 * source/ by tools/build-from-export.mjs. Edit the design there and rebuild; don't edit pages/.
 * wp-admin, wp-login.php and the REST API are untouched.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_template_directory() . '/inc/requests.php';

/**
 * Path of the current request relative to the site home, without slashes ("" for the homepage).
 */
function rjp_request_route() {
	$path = (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH );
	$home = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH );
	if ( 0 === strpos( $path, $home ) ) {
		$path = substr( $path, strlen( $home ) );
	}
	return trim( rawurldecode( $path ), '/' );
}

/**
 * Built page file for a route, or null when there is none.
 */
function rjp_page_file( $route ) {
	if ( ! preg_match( '#^[a-z0-9\-/]*$#', $route ) || false !== strpos( $route, '..' ) ) {
		return null;
	}
	$file = get_template_directory() . '/pages/' . ( '' === $route ? 'index' : $route ) . '.html';
	return is_file( $file ) ? $file : null;
}

function rjp_page_title( $route ) {
	static $titles = null;
	if ( null === $titles ) {
		$titles = json_decode( (string) file_get_contents( get_template_directory() . '/pages/titles.json' ), true );
	}
	return $titles[ $route ] ?? 'R. Jacobs Plumbing';
}

function rjp_send_page( $route, $file, $status ) {
	$assets = get_template_directory_uri() . '/assets';
	$body   = strtr( (string) file_get_contents( $file ), array(
		'{{BASE}}'        => untrailingslashit( home_url() ),
		'{{ASSETS}}'      => $assets,
		'{{FORM_ACTION}}' => esc_url( admin_url( 'admin-post.php' ) ),
		'{{FORM_FIELDS}}' => rjp_form_fields( $route ),
	) );

	status_header( $status );
	nocache_headers();
	header( 'Content-Type: text/html; charset=utf-8' );
	?>
<!doctype html>
<html lang="en-CA">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<title><?php echo esc_html( html_entity_decode( rjp_page_title( $route ), ENT_QUOTES ) ); ?></title>
<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( $assets . '/images/rje-mark.svg' ); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@600;700&amp;family=Inter:wght@400..700&amp;display=swap">
<link rel="stylesheet" href="<?php echo esc_url( $assets . '/site.css?ver=' . filemtime( get_template_directory() . '/assets/site.css' ) ); ?>">
</head>
<body>
<?php echo $body; // phpcs:ignore WordPress.Security.EscapeOutput -- approved static design markup. ?>
</body>
</html>
	<?php
	exit;
}

// Priority 0: answer before WordPress's canonical redirects try to "fix" these URLs.
add_action(
	'template_redirect',
	function () {
		if ( is_feed() || is_robots() || is_trackback() || is_preview() ) {
			return;
		}
		$route = rjp_request_route();
		$file  = rjp_page_file( $route );
		if ( $file ) {
			rjp_send_page( $route, $file, 200 );
		}
		rjp_send_page( '404', get_template_directory() . '/pages/404.html', 404 );
	},
	0
);

add_filter( 'wp_sitemaps_enabled', '__return_false' );
