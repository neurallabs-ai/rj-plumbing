<?php
get_header();
?>

<div class="wrap section">
  <div class="entry">
    <div class="eyebrow">404</div>
    <h1><?php esc_html_e( 'Page not found', 'rj-plumbing' ); ?></h1>
    <p><?php esc_html_e( 'The page you’re looking for doesn’t exist or has moved.', 'rj-plumbing' ); ?></p>
    <a class="btn btn-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'rj-plumbing' ); ?></a>
  </div>
</div>

<?php
get_footer();
