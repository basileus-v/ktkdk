<?php

  add_action('init', 'register_ktkdk_menus');
  add_action('init', 'register_ktkdk_sidebars');

  add_action('wp_ajax_nopriv_calendar-mini', 'calendar_mini');
  add_action('wp_ajax_calendar-mini', 'calendar_mini');

  /**
   * Use latest jQuery release
   */
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"), false, '');
    wp_enqueue_script('jquery');

    wp_deregister_script('jquery-ui');
    wp_register_script('jquery-ui', ("http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"), false, '');
    wp_enqueue_script('jquery-ui');
  }


  function register_ktkdk_menus()
  {
    register_nav_menus(
      array('header-menu' => __('Header Menu'))
    );
  }


  function register_ktkdk_sidebars()
  {
    register_sidebar(array(
      'name' => __('Language Sidebar'),
      'id' => 'language-sidebar'
    ));
  }


  function calendar_mini()
  {
    tribe_calendar_mini_grid();
    die();
  }

  function ktkdk_breadcrumbs()
  {

    $showOnHome = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
    $delimiter = '&raquo;'; // разделить между "крошками"
    $home = 'KTKDK'; // текст ссылка "Главная"
    $showCurrent = 1; // 1 - показывать название текущей статьи/страницы, 0 - не показывать
    $before = '<span class="current">'; // тег перед текущей "крошкой"
    $after = '</span>'; // тег после текущей "крошки"

    global $post;
    $homeLink = get_bloginfo('url');

    if (is_home() || is_front_page()) {

      if ($showOnHome == 1) echo '<div class="breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></div>';

    } else {

      echo '<div class="breadcrumb"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

      if (is_single() && !is_attachment()) {
        if (get_post_type() != 'post') {
          $post_type = get_post_type_object(get_post_type()); //tribe_events
          $slug = $post_type->rewrite;
          echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
          if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } else {
          #$cat = get_the_category();
          #$cat = $cat[0];
          #$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          #if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
          #echo $cats;
          if ($showCurrent == 1) echo $before . get_the_title() . $after;
        }

      } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
        echo '333';
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;

      } elseif (is_attachment()) {
        echo '444';
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

      } elseif (is_page() && !$post->post_parent) {
        if ($showCurrent == 1) echo $before . get_the_title() . $after;

      } elseif (is_page() && $post->post_parent) {
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
        }
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

      } elseif (is_tag()) {
        echo $before . 'Записи с тегом "' . single_tag_title('', false) . '"' . $after;

      } elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . 'Статьи автора ' . $userdata->display_name . $after;

      } elseif (is_404()) {
        echo $before . 'Error 404' . $after;
      }

      if (get_query_var('paged')) {
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
        echo __('Page') . ' ' . get_query_var('paged');
        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
      }

      echo '</div>';

    }
  } // end ktkdk_breadcrumbs()


?>
