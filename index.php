<?php
/**
 * Fallback template: blog index, archives and search results.
 */
get_header();
?>

<div class="wrap section">
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <article <?php post_class( 'entry' ); ?>>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?>
      </article>
    <?php endwhile; ?>
    <?php the_posts_pagination(); ?>
  <?php else : ?>
    <p><?php esc_html_e( 'Nothing here yet.', 'rj-plumbing' ); ?></p>
  <?php endif; ?>
</div>

<?php
get_footer();
