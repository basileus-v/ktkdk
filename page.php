<?php
/** The template for displaying all pages. */
get_header();
?>
<!--page.php-->
      <div class="content fleft">
        <?php get_template_part( 'picture-and-breadcrump' ); ?>        
        <div class="content-txt" role="main">
          <?php while ( have_posts() ) : the_post(); ?>
          <?php the_content(); ?>
          <?php endwhile; ?>
        </div><!-- #content-txt -->
      </div><!-- #content fleft -->
      <div class="clear"></div>
<?php get_footer(); ?>
