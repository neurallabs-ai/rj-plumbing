<?php
// All front-end requests are answered in functions.php (template_redirect); this only runs if that is bypassed.
defined( 'ABSPATH' ) || exit;
rjp_send_page( '404', get_template_directory() . '/pages/404.html', 404 );
