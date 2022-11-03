<?php get_header(); ?>
        <?php get_sidebar(); ?>
	<? include("leftbar.php"); ?>
	<div id="discussions">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!--<div class="navigation">
			<div class="alignleft"><?php previous_post_link( __('&laquo; %link')) ?></div>
			<div class="alignright"><?php next_post_link(__('%link &raquo;')) ?></div>
		</div>-->

		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link:'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>

			<div class="entrytext">
				<?php the_content('<p class="serif">'.__('Read the rest of this entry &raquo;').'</p>'); ?>

				<?php link_pages('<p><strong>'.__('Pages:').'</strong> ', '</p>', 'number'); ?>

				<p class="postmetadata alt">
					<small>
					<?php printf(__('This entry was posted on %1$s at %2$s and is filed under %3$s. You can follow any responses to this entry through the <a href="%4$s">RSS 2.0</a> feed.'), get_the_time(__('l, F jS, Y')), get_the_time(__('g:i a')), get_the_category_list(', '), get_bloginfo_rss('comments_rss2_url')); ?>

						<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Both Comments and Pings are open 
							printf(__('You can <a href="#respond">leave a response</a>, or <a href="%1$s">trackback</a> from your own site. '), trackback_url(false));
						?>
						<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
							// Only Pings are Open 
							printf(__('Responses are currently closed, but you can <a href="%1$s">trackback</a> from your own site.'), trackback_url(false));
						?>
						<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Comments are open, Pings are not 
							_e('You can skip to the end and leave a response. Pinging is currently not allowed.'); 
						?>
						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
							// Neither Comments, nor Pings are open 
							_e('Both comments and pings are currently closed.');
						?>
					<?php } edit_post_link(__('Edit this entry.'),'',''); ?>

					</small>
				</p>

			</div>
		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

	</div>

<?php get_footer(); ?>
