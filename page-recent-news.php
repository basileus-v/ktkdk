<?php

/**
 * The template for displaying front page with news (a list of 5 recent posts).
 */

get_header(); ?>
<!--page-recent-news-->  
<div class="content fleft">
  <?php get_template_part( 'picture-and-breadcrump' ); ?>
  <div class="content-txt" role="main">
    <div class="latest-posts">
      <ul>
        <?php
          global $post;
          global $more;
          $args = array( 'numberposts' => 5 );
          $latest_posts = get_posts( $args );
          foreach( $latest_posts as $post ) :	setup_postdata($post); 
        ?>
        <li>
          <a href="<?php the_permalink();?>" class="post-title">
            <?php the_title(); ?>
          </a>
          <div class="post-preview">
            <?php $more = 0; the_content(); ?>
          </div>
        </li>
        <?php endforeach; wp_reset_postdata(); ?>
      </ul>
    </div> <!-- #latest-posts -->
  </div><!-- #content-txt -->
</div><!-- #content fleft -->
<div class="clear"></div>

<?php get_footer(); ?>
