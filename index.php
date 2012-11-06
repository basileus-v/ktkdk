<?php
  /**
   * The most generic template file
   */
  get_header(); ?>
<!--index.php-->
<div class="content fleft" >
  <div class="content-picture" ></div >
  <div class="content-txt" role="main" >
    <?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; ?>
  </div >
  <!-- #content-txt -->
</div ><!-- #content fleft -->
<div class="clear" ></div >
<?php get_footer(); ?>
