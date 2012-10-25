<?php

function print_calendar() {
  // Вычисляем число дней в текущем месяце
  $dayofmonth = date('t');
  // Счётчик для дней месяца
  $day_count = 1;

  // 1. Первая неделя
  $num = 0;
  for($i = 0; $i < 7; $i++)
  {
    // Вычисляем номер дня недели для числа
    $dayofweek = date('w',
                      mktime(0, 0, 0, date('m'), $day_count, date('Y')));
    // Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
    $dayofweek = $dayofweek - 1;
    if($dayofweek == -1) $dayofweek = 6;

    if($dayofweek == $i)
    {
      // Если дни недели совпадают,
      // заполняем массив $week
      // числами месяца
      $week[$num][$i] = $day_count;
      $day_count++;
    }
    else
    {
      $week[$num][$i] = "";
    }
  }

  // 2. Последующие недели месяца
  while(true)
  {
    $num++;
    for($i = 0; $i < 7; $i++)
    {
      $week[$num][$i] = $day_count;
      $day_count++;
      // Если достигли конца месяца - выходим
      // из цикла
      if($day_count > $dayofmonth) break;
    }
    // Если достигли конца месяца - выходим
    // из цикла
    if($day_count > $dayofmonth) break;
  }

  // 3. Выводим содержимое массива $week
  // в виде календаря
  // Выводим таблицу
  //echo "<table border=1>";
  
  $events = getMonthEvents();
  
  for($i = 0; $i < count($week); $i++)
  {
    echo '<div class="calendar-week-row">';
    for($j = 0; $j < 7; $j++)
    {
      if(!empty($week[$i][$j]))
      {
        // Если имеем дело с субботой и воскресенья
        // подсвечиваем их
        //if($j == 5 || $j == 6) 
        //     echo "<td><font color=red>".$week[$i][$j]."</font></td>";
        /*else*/ 
      $eventPostId = getEventPostId($events, 2012, 10, $week[$i][$j]);
      if (isset($eventPostId)) {
        $eventPostPermalink = get_permalink($eventPostId);
        echo '<div class="date"><a href="'.$eventPostPermalink.'">'.$week[$i][$j].'</a></div>';
      } else {
        echo '<div class="date">'.$week[$i][$j].'</div>';
      }
      } else echo '<div class="empty">&nbsp;</div>';
    }
    echo "</div>";
  } 
  //echo "</table>";
}

function getMonthEvents(/*$year, $month*/) {
  global $wpdb;
  $sql = 
    "SELECT p.id AS post_id, p.post_title, STR_TO_DATE(pm.meta_value, '%Y-%m-%d') AS start_date"
    ." FROM wp_postmeta pm"
    ."  INNER JOIN wp_posts p ON ( p.id = pm.post_id )"
    ." WHERE (pm.meta_key = '_EventStartDate' AND"
    ."   STR_TO_DATE(pm.meta_value,  '%Y-%m-%d %H:%i:%s' )"  
    ."     BETWEEN STR_TO_DATE('2012-10-01 00:00', '%Y-%m-%d %H:%i:')"
    ."         AND STR_TO_DATE('2012-10-31 23:59', '%Y-%m-%d %H:%i:')"
    ."       )"
    ."  OR (pm.meta_key = '_EventEndDate' AND"
    ."   STR_TO_DATE(pm.meta_value,  '%Y-%m-%d %H:%i:%s' )"
    ."     BETWEEN STR_TO_DATE('2012-10-01 00:00', '%Y-%m-%d %H:%i:')"
    ."         AND STR_TO_DATE('2012-10-31 23:59', '%Y-%m-%d %H:%i:')"
    ."     )";

  return $wpdb->get_results($sql);
}

function getEventPostId($events, $year, $month, $day) {
  $calendarDate = mktime(0, 0, 0, $month, $day, $year);
  $format = 'Y-m-d';
  for ($i = 0; $i < count($events); $i++) {
    $eventStartDate = new DateTime($events[$i]->start_date);
    if ($eventStartDate->getTimestamp() == $calendarDate) {
      return $events[$i]->post_id;
    }
  }
  return null;
}

?>
