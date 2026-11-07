</main>

<footer class="site-footer">
  <div class="wrap footer-grid">
    <div>
      <a class="brand brand--inverse" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span class="brand-badge" aria-hidden="true"><?php rjp_icon( 'drop' ); ?></span>
        <span class="brand-name"><?php echo esc_html( rjp_opt( 'business_name' ) ); ?></span>
      </a>
      <p class="footer-about"><?php echo esc_html( rjp_opt( 'tagline' ) ); ?>. <?php echo esc_html( rjp_opt( 'license' ) ); ?>.</p>
    </div>
    <div>
      <h2 class="footer-title"><?php esc_html_e( 'Contact', 'rj-plumbing' ); ?></h2>
      <ul class="footer-list">
        <li><a href="<?php echo esc_url( rjp_tel() ); ?>"><?php rjp_icon( 'phone' ); ?><?php echo esc_html( rjp_opt( 'phone' ) ); ?></a></li>
        <li><a href="mailto:<?php echo esc_attr( rjp_opt( 'email' ) ); ?>"><?php rjp_icon( 'mail' ); ?><?php echo esc_html( rjp_opt( 'email' ) ); ?></a></li>
        <li><?php rjp_icon( 'pin' ); ?><?php echo esc_html( rjp_opt( 'address' ) ); ?></li>
        <li><?php rjp_icon( 'clock' ); ?><?php echo esc_html( rjp_opt( 'hours' ) ); ?></li>
      </ul>
    </div>
    <div>
      <h2 class="footer-title"><?php esc_html_e( 'Service areas', 'rj-plumbing' ); ?></h2>
      <ul class="footer-list footer-areas">
        <?php foreach ( rjp_areas() as $area ) : ?>
          <li><?php echo esc_html( $area ); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <span>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( rjp_opt( 'business_name' ) ); ?></span>
    <?php
    wp_nav_menu( array(
        'theme_location' => 'footer',
        'container'      => 'nav',
        'container_class' => 'footer-nav',
        'fallback_cb'    => false,
        'depth'          => 1,
    ) );
    ?>
    <span class="credit"><?php esc_html_e( 'Website by', 'rj-plumbing' ); ?> <a href="https://neurallabs.ca">Neural Labs</a></span>
  </div>
</footer>

<div class="mobile-call" aria-hidden="false">
  <a class="btn btn-accent" href="<?php echo esc_url( rjp_tel() ); ?>"><?php rjp_icon( 'phone' ); ?><?php esc_html_e( 'Call now', 'rj-plumbing' ); ?></a>
  <a class="btn btn-light" href="<?php echo esc_url( ( is_front_page() ? '' : home_url( '/' ) ) . '#contact' ); ?>"><?php esc_html_e( 'Book service', 'rj-plumbing' ); ?></a>
</div>

<?php wp_footer(); ?>
</body>
</html>
