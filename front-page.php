<?php
/**
 * Front page: one-page layout for a plumbing business.
 */
get_header();

$services = rjp_services();
$reviews  = rjp_reviews();
$status   = isset( $_GET['request'] ) ? sanitize_key( wp_unslash( $_GET['request'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification -- display only.
?>

<section class="hero">
  <div class="wrap hero-grid">
    <div class="hero-copy">
      <div class="eyebrow"><?php rjp_icon( 'pin' ); ?><?php echo esc_html( sprintf( __( 'Serving %s', 'rj-plumbing' ), implode( ', ', array_slice( rjp_areas(), 0, 3 ) ) ) ); ?></div>
      <h1><?php echo esc_html( rjp_opt( 'hero_title' ) ); ?></h1>
      <p class="lead"><?php echo esc_html( rjp_opt( 'hero_text' ) ); ?></p>
      <div class="hero-actions">
        <a class="btn btn-accent btn-lg" href="<?php echo esc_url( rjp_tel() ); ?>"><?php rjp_icon( 'phone' ); ?><?php echo esc_html( sprintf( __( 'Call %s', 'rj-plumbing' ), rjp_opt( 'phone' ) ) ); ?></a>
        <a class="btn btn-outline btn-lg" href="#contact"><?php esc_html_e( 'Request Service', 'rj-plumbing' ); ?><?php rjp_icon( 'arrow' ); ?></a>
      </div>
      <ul class="hero-points">
        <li><?php rjp_icon( 'check' ); ?><?php echo esc_html( rjp_opt( 'license' ) ); ?></li>
        <li><?php rjp_icon( 'check' ); ?><?php esc_html_e( 'Upfront pricing', 'rj-plumbing' ); ?></li>
        <li><?php rjp_icon( 'check' ); ?><?php esc_html_e( 'Clean, respectful crews', 'rj-plumbing' ); ?></li>
      </ul>
    </div>

    <div class="hero-card" aria-label="<?php esc_attr_e( 'How to reach us', 'rj-plumbing' ); ?>">
      <div class="hero-card-art" aria-hidden="true">
        <svg viewBox="0 0 320 180" class="pipes">
          <path class="pipe-run" d="M-10 130 H110 a30 30 0 0 0 30 -30 V60 a30 30 0 0 1 30 -30 H330"/>
          <path class="pipe-flow" d="M-10 130 H110 a30 30 0 0 0 30 -30 V60 a30 30 0 0 1 30 -30 H330"/>
          <circle class="pipe-joint" cx="140" cy="80" r="11"/>
          <circle class="pipe-joint" cx="230" cy="30" r="11"/>
        </svg>
      </div>
      <?php if ( rjp_opt( 'emergency' ) ) : ?>
        <div class="hero-card-flag"><span class="pulse" aria-hidden="true"></span><?php esc_html_e( 'Emergency? We answer 24/7', 'rj-plumbing' ); ?></div>
      <?php endif; ?>
      <h2><?php esc_html_e( 'Get a plumber on the way', 'rj-plumbing' ); ?></h2>
      <ol class="hero-steps">
        <li><span>1</span><?php esc_html_e( 'Call or send a request', 'rj-plumbing' ); ?></li>
        <li><span>2</span><?php esc_html_e( 'Get an upfront price', 'rj-plumbing' ); ?></li>
        <li><span>3</span><?php esc_html_e( 'We fix it and clean up', 'rj-plumbing' ); ?></li>
      </ol>
      <a class="btn btn-primary btn-block" href="#contact"><?php esc_html_e( 'Book a Service Call', 'rj-plumbing' ); ?><?php rjp_icon( 'arrow' ); ?></a>
    </div>
  </div>
</section>

<section class="section" id="services">
  <div class="wrap">
    <div class="section-head">
      <div class="eyebrow"><?php esc_html_e( 'What we do', 'rj-plumbing' ); ?></div>
      <h2><?php esc_html_e( 'Plumbing services for homes and businesses', 'rj-plumbing' ); ?></h2>
      <p><?php esc_html_e( 'From a dripping tap to a flooded basement, one call gets it handled.', 'rj-plumbing' ); ?></p>
    </div>
    <div class="services-grid">
      <?php foreach ( $services as $service ) : ?>
        <article class="service-card">
          <span class="service-icon"><?php rjp_icon( $service['icon'] ); ?></span>
          <h3><?php echo esc_html( $service['title'] ); ?></h3>
          <p><?php echo esc_html( $service['text'] ); ?></p>
          <a class="service-link" href="#contact" data-service="<?php echo esc_attr( $service['title'] ); ?>"><?php esc_html_e( 'Request this', 'rj-plumbing' ); ?><?php rjp_icon( 'arrow' ); ?></a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php if ( rjp_opt( 'emergency' ) ) : ?>
<section class="emergency">
  <div class="wrap emergency-inner">
    <span class="emergency-icon" aria-hidden="true"><?php rjp_icon( 'alert' ); ?></span>
    <div>
      <h2><?php esc_html_e( 'Burst pipe, flooding or no hot water?', 'rj-plumbing' ); ?></h2>
      <p><?php esc_html_e( 'Turn off your main water valve if you can, then call us right away. Emergency service is available day and night.', 'rj-plumbing' ); ?></p>
    </div>
    <a class="btn btn-light btn-lg" href="<?php echo esc_url( rjp_tel() ); ?>"><?php rjp_icon( 'phone' ); ?><?php echo esc_html( rjp_opt( 'phone' ) ); ?></a>
  </div>
</section>
<?php endif; ?>

<section class="section section--pale" id="why-us">
  <div class="wrap why-grid">
    <div class="section-head">
      <div class="eyebrow"><?php esc_html_e( 'Why choose us', 'rj-plumbing' ); ?></div>
      <h2><?php echo esc_html( sprintf( __( 'Why homeowners call %s', 'rj-plumbing' ), rjp_opt( 'business_name' ) ) ); ?></h2>
      <p><?php esc_html_e( 'Plumbing work happens in your home. We treat it that way: on time, clear about cost, and tidy when we leave.', 'rj-plumbing' ); ?></p>
    </div>
    <ul class="why-list">
      <li><span class="why-icon"><?php rjp_icon( 'shield' ); ?></span><div><h3><?php echo esc_html( rjp_opt( 'license' ) ); ?></h3><p><?php esc_html_e( 'Qualified plumbers and work done to code, so it passes inspection and lasts.', 'rj-plumbing' ); ?></p></div></li>
      <li><span class="why-icon"><?php rjp_icon( 'check' ); ?></span><div><h3><?php esc_html_e( 'Upfront pricing', 'rj-plumbing' ); ?></h3><p><?php esc_html_e( 'You see the price before work starts. No surprise charges on the invoice.', 'rj-plumbing' ); ?></p></div></li>
      <li><span class="why-icon"><?php rjp_icon( 'clock' ); ?></span><div><h3><?php esc_html_e( 'On time, every time', 'rj-plumbing' ); ?></h3><p><?php esc_html_e( 'We show up when we say we will and keep you updated if anything changes.', 'rj-plumbing' ); ?></p></div></li>
      <li><span class="why-icon"><?php rjp_icon( 'wrench' ); ?></span><div><h3><?php esc_html_e( 'Done right the first time', 'rj-plumbing' ); ?></h3><p><?php esc_html_e( 'We fix the cause, not just the symptom, and clean up before we go.', 'rj-plumbing' ); ?></p></div></li>
    </ul>
  </div>
</section>

<?php if ( $reviews || rjp_opt( 'google_url' ) ) : ?>
<section class="section" id="reviews">
  <div class="wrap">
    <div class="section-head section-head--center">
      <div class="eyebrow"><?php esc_html_e( 'Reviews', 'rj-plumbing' ); ?></div>
      <h2><?php esc_html_e( 'What our customers say', 'rj-plumbing' ); ?></h2>
    </div>
    <?php if ( $reviews ) : ?>
      <div class="reviews-grid">
        <?php foreach ( $reviews as $review ) : ?>
          <figure class="review">
            <div class="stars" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'rj-plumbing' ); ?>"><?php for ( $s = 0; $s < 5; $s++ ) { rjp_icon( 'star' ); } ?></div>
            <blockquote><?php echo esc_html( $review['text'] ); ?></blockquote>
            <?php if ( $review['name'] ) : ?><figcaption><?php echo esc_html( $review['name'] ); ?></figcaption><?php endif; ?>
          </figure>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <?php if ( rjp_opt( 'google_url' ) ) : ?>
      <p class="center"><a class="btn btn-outline" href="<?php echo esc_url( rjp_opt( 'google_url' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Read our Google reviews', 'rj-plumbing' ); ?><?php rjp_icon( 'arrow' ); ?></a></p>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<section class="section section--dark" id="areas">
  <div class="wrap areas-grid">
    <div class="section-head">
      <div class="eyebrow"><?php esc_html_e( 'Service areas', 'rj-plumbing' ); ?></div>
      <h2><?php esc_html_e( 'Local plumbers, close by when you need us', 'rj-plumbing' ); ?></h2>
      <p><?php esc_html_e( 'Don’t see your town? Call us — we can often still help.', 'rj-plumbing' ); ?></p>
    </div>
    <ul class="areas-list">
      <?php foreach ( rjp_areas() as $area ) : ?>
        <li><?php rjp_icon( 'pin' ); ?><?php echo esc_html( $area ); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="section" id="faq">
  <div class="wrap faq-wrap">
    <div class="section-head section-head--center">
      <div class="eyebrow"><?php esc_html_e( 'FAQ', 'rj-plumbing' ); ?></div>
      <h2><?php esc_html_e( 'Common questions', 'rj-plumbing' ); ?></h2>
    </div>
    <div class="faq-list">
      <?php foreach ( rjp_faqs() as $faq ) : ?>
        <details class="faq">
          <summary><?php echo esc_html( $faq['q'] ); ?><?php rjp_icon( 'plus' ); ?></summary>
          <p><?php echo esc_html( $faq['a'] ); ?></p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--pale" id="contact">
  <div class="wrap contact-grid">
    <div class="section-head">
      <div class="eyebrow"><?php esc_html_e( 'Contact', 'rj-plumbing' ); ?></div>
      <h2><?php esc_html_e( 'Book a service call', 'rj-plumbing' ); ?></h2>
      <p><?php esc_html_e( 'Tell us what’s going on and we’ll get back to you to confirm a time. For emergencies, please call.', 'rj-plumbing' ); ?></p>
      <ul class="contact-list">
        <li><a href="<?php echo esc_url( rjp_tel() ); ?>"><?php rjp_icon( 'phone' ); ?><?php echo esc_html( rjp_opt( 'phone' ) ); ?></a></li>
        <li><a href="mailto:<?php echo esc_attr( rjp_opt( 'email' ) ); ?>"><?php rjp_icon( 'mail' ); ?><?php echo esc_html( rjp_opt( 'email' ) ); ?></a></li>
        <li><?php rjp_icon( 'pin' ); ?><?php echo esc_html( rjp_opt( 'address' ) ); ?></li>
        <li><?php rjp_icon( 'clock' ); ?><?php echo esc_html( rjp_opt( 'hours' ) ); ?></li>
      </ul>
    </div>

    <form class="request-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
      <?php if ( 'sent' === $status ) : ?>
        <p class="form-note form-note--ok" role="status"><?php esc_html_e( 'Thanks — your request was sent. We’ll be in touch shortly.', 'rj-plumbing' ); ?></p>
      <?php elseif ( 'missing' === $status ) : ?>
        <p class="form-note form-note--error" role="alert"><?php esc_html_e( 'Please add your name and phone number so we can reach you.', 'rj-plumbing' ); ?></p>
      <?php elseif ( 'expired' === $status ) : ?>
        <p class="form-note form-note--error" role="alert"><?php esc_html_e( 'The form expired. Please send it again.', 'rj-plumbing' ); ?></p>
      <?php endif; ?>
      <input type="hidden" name="action" value="rjp_request">
      <?php wp_nonce_field( 'rjp_request', 'rjp_nonce' ); ?>
      <div class="hp" aria-hidden="true"><label>Website <input type="text" name="company_website" tabindex="-1" autocomplete="off"></label></div>
      <div class="field-row">
        <label class="field"><span><?php esc_html_e( 'Name', 'rj-plumbing' ); ?> *</span><input type="text" name="name" required autocomplete="name"></label>
        <label class="field"><span><?php esc_html_e( 'Phone', 'rj-plumbing' ); ?> *</span><input type="tel" name="phone" required autocomplete="tel"></label>
      </div>
      <label class="field"><span><?php esc_html_e( 'Email', 'rj-plumbing' ); ?></span><input type="email" name="email" autocomplete="email"></label>
      <label class="field"><span><?php esc_html_e( 'Service needed', 'rj-plumbing' ); ?></span>
        <select name="service" id="request-service">
          <option value=""><?php esc_html_e( 'Choose a service', 'rj-plumbing' ); ?></option>
          <?php foreach ( $services as $service ) : ?>
            <option><?php echo esc_html( $service['title'] ); ?></option>
          <?php endforeach; ?>
          <option><?php esc_html_e( 'Something else', 'rj-plumbing' ); ?></option>
        </select>
      </label>
      <label class="field"><span><?php esc_html_e( 'What’s going on?', 'rj-plumbing' ); ?></span><textarea name="message" rows="4"></textarea></label>
      <button class="btn btn-accent btn-lg btn-block" type="submit"><?php esc_html_e( 'Send Request', 'rj-plumbing' ); ?><?php rjp_icon( 'arrow' ); ?></button>
    </form>
  </div>
</section>

<?php
get_footer();
