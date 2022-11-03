<?php get_header(); ?>

<?php get_sidebar(); ?>

	<? include("leftbar.php"); ?>
	
	<div id="discussions"">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entrytext">
				<?php the_content('<p class="serif">' . __('Read the rest of this page &raquo;') . '</p>'); ?>

				<?php link_pages('<p><strong>' . __('Pages:') . '</strong> ', '</p>', 'number'); ?>

			</div>
		</div>
	  <?php endwhile; endif; ?>
	<?php edit_post_link(__('Edit this entry.'), '<p>', '</p>'); ?>
	</div>



<?php get_footer(); ?>
