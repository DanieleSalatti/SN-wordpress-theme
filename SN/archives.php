<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="content" class="widecolumn">

<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<h2><?php _e('Archives by Month:'); ?></h2>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>

	<h2><?php _e('Archives by Subject:'); ?></h2>
  <ul>
     <?php wp_list_cats(); ?>
  </ul>

</div>

<?php get_footer(); ?>
