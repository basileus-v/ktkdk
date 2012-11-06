<?php
/*
Template Name: Upcoming events
*/

get_header(); ?>
<!--events-upcoming-->  
<div class="content fleft">
  <?php get_template_part( 'picture-and-breadcrump' ); ?>
  <div class="content-txt" role="main">
    <div class="upcoming-events-intro">
      <?php the_content() ?>
    </div>
    <div class="event-archive-list">
        <?php
          global $post;
          global $more;
          $latest_posts = tribe_get_events(array( 'eventDisplay'=>'upcoming', 'order'=>'ASC', 'posts_per_page'=>'-1'));
          $prevEventYear;
          $prevEventMonth;
          foreach( $latest_posts as $post ) : setup_postdata($post);
          $startDate = tribe_get_start_date( null, false, 'F.Y' );
          list($currEventMonth, $currEventYear) = split('\.', $startDate);
          if ($currEventYear != $prevEventYear) {
            if (isset($prevEventYear)) {
              echo '</ul>';
            }
            echo '<div class="event-archive-year"><h1>'.$currEventYear.'</h1></div>';
            echo '<div class="event-archive-month"><h6>'.$currEventMonth.'</h6></div><ul>';
            $prevEventYear = $currEventYear;
          } else if ($currEventMonth != $prevEventMonth) {
            if (isset($prevEventMonth)) {
              echo '</ul>';
            }
            echo '<div class="event-archive-month"><h6>'.$currEventMonth.'</h6></div><ul>';
            $prevEventMonth = $currEventMonth;
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
