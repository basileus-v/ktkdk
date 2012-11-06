<?php
  /**
   * The template for displaying all single posts.
   */

  get_header(); ?>
<!--single.php-->
<div class="content fleft" >
  <div class="content-picture" ></div >
  <div class="content-txt" role="main" >
    <?php while (have_posts()) : the_post(); ?>
    <nav id="nav-single" >
        <span class="nav-previous" >
          <?php previous_post_link('%link', __('<span class="meta-nav">&larr;</span> Previous', 'twentyeleven')); ?>
        </span >
        <span class="nav-next" >
          <?php next_post_link('%link', __('Next <span class="meta-nav">&rarr;</span>', 'twentyeleven')); ?>
        </span >
    </nav ><!-- #nav-single -->
    <?php get_template_part('content', 'single'); ?>
    <?php endwhile; // end of the loop. ?>
  </div >
  <!-- #content-txt -->
</div ><!-- #content fleft -->
<div class="clear" ></div >

<?php get_footer(); ?>
