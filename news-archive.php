<?php
/*
Template Name: News archive
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
          $latest_posts = get_posts(array( 'post_type'=>'post', 'order'=>'DESC' ));
          $prevEventYear;
          foreach( $latest_posts as $post ) : setup_postdata($post);
          $startDate = the_date(null, null, null, false);
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
              echo $currEventDay.".".$currEventMonth
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
