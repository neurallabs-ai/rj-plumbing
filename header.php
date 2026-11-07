<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'rj-plumbing' ); ?></a>

<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
  <defs>
    <symbol id="i-phone" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></symbol>
    <symbol id="i-clock" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></g></symbol>
    <symbol id="i-shield" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="M9 12l2 2 4-4"/></g></symbol>
    <symbol id="i-check" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" d="M5 12.5l4.2 4.2L19 7"/></symbol>
    <symbol id="i-arrow" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6"/></symbol>
    <symbol id="i-pin" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"><path d="M12 21s-7-6.5-7-12a7 7 0 0 1 14 0c0 5.5-7 12-7 12z"/><circle cx="12" cy="9" r="2.5"/></g></symbol>
    <symbol id="i-mail" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></g></symbol>
    <symbol id="i-star" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2.8l2.8 5.8 6.4.9-4.6 4.5 1.1 6.3L12 17.3l-5.7 3 1.1-6.3-4.6-4.5 6.4-.9z"/></symbol>
    <symbol id="i-alert" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0z"/><path d="M12 9v4M12 17h.01"/></g></symbol>
    <symbol id="i-drain" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M8 9h8M7 12h10M8 15h8"/></g></symbol>
    <symbol id="i-flame" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" d="M12 3c1 3 5 5 5 10a5 5 0 0 1-10 0c0-2.4 1.2-4 2.5-5 .4 1.6 1.4 2.4 2.2 2.4C11.7 7.8 11 5.4 12 3z"/></symbol>
    <symbol id="i-drop" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" d="M12 3s6 6.5 6 11a6 6 0 0 1-12 0c0-4.5 6-11 6-11z"/></symbol>
    <symbol id="i-pump" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="7" y="3" width="10" height="12" rx="2"/><path d="M12 15v5M7 21h10M10 7h4M10 11h4"/></g></symbol>
    <symbol id="i-faucet" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 9h9a4 4 0 0 1 4 4v1"/><path d="M4 6v6M9 9V5h4M7 5h8"/><path d="M17 18v.01M17 21v.01"/></g></symbol>
    <symbol id="i-pipe" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7h9a5 5 0 0 1 5 5v9"/><path d="M3 4v6M14 21h6"/></g></symbol>
    <symbol id="i-wrench" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" d="M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18l3 3 6.3-6.3a4 4 0 0 0 5.4-5.4l-2.6 2.6-2.4-.6-.6-2.4z"/></symbol>
    <symbol id="i-menu" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></symbol>
    <symbol id="i-x" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M6 6l12 12M18 6 6 18"/></symbol>
    <symbol id="i-plus" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M12 5v14M5 12h14"/></symbol>
  </defs>
</svg>

<?php $home = is_front_page() ? '' : home_url( '/' ); ?>

<div class="topbar">
  <div class="wrap topbar-inner">
    <?php if ( rjp_opt( 'emergency' ) ) : ?>
      <span class="topbar-flag"><span class="pulse" aria-hidden="true"></span><?php esc_html_e( '24/7 emergency service', 'rj-plumbing' ); ?></span>
    <?php endif; ?>
    <span class="topbar-hours"><?php rjp_icon( 'clock' ); ?><?php echo esc_html( rjp_opt( 'hours' ) ); ?></span>
    <span class="topbar-license"><?php rjp_icon( 'shield' ); ?><?php echo esc_html( rjp_opt( 'license' ) ); ?></span>
  </div>
</div>

<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <?php if ( has_custom_logo() ) : ?>
        <?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'medium', false, array( 'class' => 'brand-logo', 'alt' => rjp_opt( 'business_name' ) ) ); ?>
      <?php else : ?>
        <span class="brand-badge" aria-hidden="true"><?php rjp_icon( 'drop' ); ?></span>
        <span class="brand-name"><?php echo esc_html( rjp_opt( 'business_name' ) ); ?></span>
      <?php endif; ?>
    </a>

    <nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Main', 'rj-plumbing' ); ?>">
      <ul>
        <li><a href="<?php echo esc_url( $home . '#services' ); ?>"><?php esc_html_e( 'Services', 'rj-plumbing' ); ?></a></li>
        <li><a href="<?php echo esc_url( $home . '#why-us' ); ?>"><?php esc_html_e( 'Why Us', 'rj-plumbing' ); ?></a></li>
        <li><a href="<?php echo esc_url( $home . '#areas' ); ?>"><?php esc_html_e( 'Service Areas', 'rj-plumbing' ); ?></a></li>
        <li><a href="<?php echo esc_url( $home . '#faq' ); ?>"><?php esc_html_e( 'FAQ', 'rj-plumbing' ); ?></a></li>
        <li><a href="<?php echo esc_url( $home . '#contact' ); ?>"><?php esc_html_e( 'Contact', 'rj-plumbing' ); ?></a></li>
      </ul>
    </nav>

    <a class="header-phone" href="<?php echo esc_url( rjp_tel() ); ?>">
      <?php rjp_icon( 'phone' ); ?>
      <span><small><?php esc_html_e( 'Call now', 'rj-plumbing' ); ?></small><?php echo esc_html( rjp_opt( 'phone' ) ); ?></span>
    </a>
    <a class="btn btn-accent header-cta" href="<?php echo esc_url( $home . '#contact' ); ?>"><?php esc_html_e( 'Book Service', 'rj-plumbing' ); ?></a>

    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="site-nav">
      <svg class="icon icon-open" aria-hidden="true"><use href="#i-menu"/></svg>
      <svg class="icon icon-close" aria-hidden="true" hidden><use href="#i-x"/></svg>
      <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'rj-plumbing' ); ?></span>
    </button>
  </div>
</header>

<main id="main">
