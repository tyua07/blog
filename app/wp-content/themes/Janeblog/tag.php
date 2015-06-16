<?php
/*
 * The template for displaying Tag pages
 */
get_header(); ?>

<div id="main">
  <?php if ( have_posts() ) : ?>
  <?php /* The loop */ ?>
  <?php get_template_part( 'content', get_post_format() ); ?>
  <?php else : ?>
  <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>
</div>
<!-- #content -->

<?php get_footer(); ?>
