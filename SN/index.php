<?php get_header(); ?>


<?php get_sidebar(); ?>

<? include("leftbar.php"); ?>

<div id="discussions">


<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %1$s'), the_title()); ?>"><?php the_title(); ?></a></h2>
				<small><?php the_time(__('F jS, Y')) ?></small>
				<!-- Alternate version, with author:
				<small><?php printf(__('%1$s by %2$s'), get_the_time(__('F jS, Y')), the_author('', false)) ?></small>
				-->

				<div class="entry">
					<?php the_content(__('Read the rest of this entry &raquo;')); ?>
				</div>

				<p class="postmetadata"><?php _e('Posted in'); echo ' '; the_category(', ') ?> <strong>|</strong> <?php edit_post_link(__('Edit'),'','<strong>|</strong>'); ?>  <?php comments_popup_link(__('No Comments &#187;'), __('1 Comment &#187;'), __('% Comments &#187;'), '', __('Comments Off')); ?></p>

				<!--
				<?php trackback_rdf(); ?>
				-->
			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;')) ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('Not Found'); ?></h2>
		<p class="center"><?php _e('Sorry, but you are looking for something that isn&#8217;t here.'); ?></p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>




</div>

<?php get_footer(); ?>
