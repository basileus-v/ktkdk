<?php
/*
Template Name: Events archive
*/

get_header(); ?>
<!--event-archive-->  
<div class="content fleft">
  <?php get_template_part( 'picture-and-breadcrump' ); ?>
  <div class="content-txt" role="main">
    <div class="event-archive-list">
        <?php
          global $post;
          global $more;
          $latest_posts = tribe_get_events(array( 'eventDisplay'=>'past', 'order'=>'DESC', 'posts_per_page'=>'-1'));
          $prevEventYear;
          foreach( $latest_posts as $post ) : setup_postdata($post);
          $startDate = tribe_get_start_date( null, false, 'd.m.Y' );
          list($currEventDay, $currEventMonth, $currEventYear) = split('\.', $startDate);
          if ($currEventYear != $prevEventYear) {
            if (isset($prevEventYear)) {
              echo '</ul>';
            }
            echo '<div class="event-archive-year"><h1>'.$currEventYear.'</h1></div><ul>';
            $prevEventYear = $currEventYear;
          }
        ?>
        <li>
          <span class="event-archive-item-date">
            <?php 
              echo tribe_get_start_date( null, false, 'd.m' );
              if (tribe_get_start_date() !== tribe_get_end_date()) {
                echo ' - '.tribe_get_end_date( null, false, 'd.m' );
              }
            ?>
          </span>
          <span class="event-archive-item-title">
            <a href="<?php the_permalink();?>">
              <?php the_title(); ?>
            </a>
	  </span>
        </li>
        <?php endforeach; wp_reset_postdata(); echo '</ul>'; ?>
    </div> <!-- #event-archive-list -->
  </div><!-- #content-txt -->
</div><!-- #content fleft -->
<div class="clear"></div>

<?php get_footer(); ?>
