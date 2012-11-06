<?php
  /**
   * A single event.  This displays the event title, description, meta, and
   * optionally, the Google map for the event.
   *
   * You can customize this view by putting a replacement file of the same name (single.php) in the events/ directory of your theme.
   */

// Don't load directly
  if (!defined('ABSPATH')) {
    die('-1');
  }
?>

<script type="text/javascript" >
  $j(document).ready(function () {
    $j("#accordion").accordion({collapsible:true, active:false});
  });
</script >

<span class="back" ><a
  href="<?php echo tribe_get_events_link(); ?>" ><?php _e('&laquo; Back to Events', 'tribe-events-calendar'); ?></a ></span >
<?php
  $gmt_offset = (get_option('gmt_offset') >= '0') ? ' +' . get_option('gmt_offset') : " " . get_option('gmt_offset');
  $gmt_offset = str_replace(array('.25', '.5', '.75'), array(':15', ':30', ':45'), $gmt_offset);
  if (strtotime(tribe_get_end_date(get_the_ID(), false, 'Y-m-d G:i') . $gmt_offset) <= time()) {
    ?>
  <div class="event-passed" ><?php  _e('This event has passed.', 'tribe-events-calendar'); ?></div ><?php } ?>


<div class="entry" >
  <?php
  if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
    ?>
    <?php the_post_thumbnail(); ?>
    <?php } ?>
  <div class="summary" ><?php the_content(); ?></div >
  <?php if (function_exists('tribe_get_ticket_form') && tribe_get_ticket_form()) {
  tribe_get_ticket_form();
} ?>
</div >
<?php if (function_exists('tribe_get_single_ical_link')): ?>
<a class="ical single"
   href="<?php echo tribe_get_single_ical_link(); ?>" ><?php _e('iCal Import', 'tribe-events-calendar'); ?></a >
<?php endif; ?>
<?php if (function_exists('tribe_get_gcal_link')): ?>
<a href="<?php echo tribe_get_gcal_link(); ?>" class="gcal-add"
   title="<?php _e('Add to Google Calendar', 'tribe-events-calendar'); ?>" ><?php _e('+ Google Calendar', 'tribe-events-calendar'); ?></a >
<?php endif; ?>

<div class="navlink tribe-previous" ><?php tribe_previous_event_link('Prev'); ?></div >
<div class="navlink tribe-next" ><?php tribe_next_event_link('Next'); ?></div >
<div style="clear:both" ></div >
