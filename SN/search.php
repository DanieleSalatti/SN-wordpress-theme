<?php get_header(); ?>

<?php get_sidebar(); ?>

	<div id="discussions">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle"><?php _e('Search Results'); ?></h2>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;')) ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to'); the_title(); ?>"><?php the_title(); ?></a></h3>
				<small><?php the_time(__('l, F jS, Y')) ?></small>

				

				<p class="postmetadata"><?php _e('Posted in'); echo ' '; the_category(', ') ?> <strong>|</strong> <?php edit_post_link(__('Edit'),'','<strong>|</strong>'); ?>  <?php comments_popup_link(__('No Comments &#187;'), __('1 Comment &#187;'), __('% Comments &#187;'), '', __('Comments Off')); ?></p>


			</div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries')) ?></div>
			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;')) ?></div>
		</div>

	<?php else : ?>

		<h2 class="center"><?php _e('No posts found. Try a different search?') ?></h2>

	<?php endif; ?>

	</div>



<?php get_footer(); ?>
