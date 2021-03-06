<?php
  /**
   * Displays all of the <head> section and everything up till <div id="main">
   */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head >
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width" />
  <title >
    <?php
    /*
    * Print the <title> tag based on what is being viewed.
    */
    global $page, $paged;

    wp_title('|', true, 'right');

    // Add the blog name.
    bloginfo('name');

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
      echo " | $site_description";
    }
    ?>
  </title >
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
  <?php
  wp_head();
  ?>

  <script type="text/javascript" >
    var $j = jQuery.noConflict();
    $j(document).ready(function () {
        //$j('.content-picture').css('min-width', $j('.fill').width() + 600);i
        $j('#main').css('min-height', $j('#left-column').height());
      }
    );
  </script >

</head >

<body <?php body_class(); ?>>
<div id="header" >
  <div class="contentRight h80 alr" >
    <span class="header" ><?php bloginfo('name'); ?></span >
        <span class="lang" >
          <?php
          $baseUrl = preg_replace('/\?lang=([a-zA-Z]{2})/', '', get_permalink());
          if (strpos($baseUrl, '?') !== false) {
            $baseUrl .= '&';
          } else {
            $baseUrl .= '?';
          }
          ?>
          <a href="<?php echo $baseUrl; ?>lang=et" class="lang" >Est</a > | <a href="<?php echo $baseUrl; ?>lang=en"
                                                                               class="lang" >Eng</a >
      </span >
  </div >
</div >
<!-- #header -->


<div id="menu" >
  <div class="logo fleft" >
    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
       rel="home" >
      <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" width="176" height="50" alt="" />
    </a >
  </div >
  <!-- #logo -->
  <div class="menu" >
    <?php
    $defaults = array(
      'theme_location' => 'header-menu',
      'menu_class' => 'header-menu',
      'echo' => true,
      'container' => false,
      'depth' => 1);
    wp_nav_menu($defaults);
    ?>
  </div >
  <div class="fill" ></div >
  <div class="clear" ></div >
</div >
<!-- #menu -->
<div id="wrapper" >
  <div id="left-column" >
    <div class="submenu" >
      <?php
      if (is_page() && $post->post_parent) {
        // This is a subpage
        $parent_post = get_post($post->post_parent);
        while ($parent_post->post_parent) {
          // In sub menu we alway display only second level menu items, so we need to find upmost parent
          $parent_post = get_post($parent_post->post_parent);
        }
        $children = wp_list_pages("title_li=&child_of=" . $parent_post->ID . "&echo=0&sort_column=menu_order&depth=1");
      } else {
        // This is a parent page that have subpages
        $children = wp_list_pages("title_li=&child_of=" . $post->ID . "&echo=0&sort_column=menu_order&depth=1");
      }
      ?>
      <?php // Check to see if we have anything to output ?>
      <?php if ($children) { ?>
      <ul >
        <?php echo $children; ?>
      </ul >
      <?php } ?>
    </div >
    <!-- #submenu -->

    <div id="calendar_wrap" >
      <?php tribe_calendar_mini_grid(); ?>
    </div >
    <!-- #calendar_wrap -->
    <div class="banner-left" >
      <a href="<?php echo esc_url(site_url('/uritused/2013-2/talvekool-2013/?lang=')) . qtrans_getLanguage(); ?>" >
        <img src="<?php bloginfo('template_directory'); ?>/images/banners/banner_winter_school_2013.jpg" width="212"
             height="525" alt="" />
      </a >
    </div >
  </div >
  <!-- #left-column -->

  <div id="main" >
