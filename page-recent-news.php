<?php

  /**
   * The template for displaying latest news (a list of 5 recent posts).
   */

  get_header();
?>
<!--page-recent-news-->
<div class="content fleft" >
  <?php get_template_part('picture-and-breadcrump'); ?>
  <div class="content-txt" role="main" >
    <div class="recent-posts" >
      <ul >
        <?php
        global $post;
        global $more;
        $args = array('numberposts' => 5);
        $recentPosts = get_posts($args);
        foreach ($recentPosts as $post) : setup_postdata($post);
          ?>
          <li >
            <span class="recent-post-date" >
              <?php the_date(); ?>
            </span >
            <a href="<?php the_permalink();?>" class="recent-post-title" >
              <?php the_title(); ?>
            </a >

            <div class="recent-post-excerpt" >
              <?php $more = 0; the_content(); ?>
            </div >
          </li >
          <?php endforeach; wp_reset_postdata(); ?>
      </ul >
    </div >
    <!-- #latest-posts -->
  </div >
  <!-- #content-txt -->
</div ><!-- #content fleft -->
<div class="clear" ></div >

<?php get_footer(); ?>
