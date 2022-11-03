	<div id="hottags">		

			

			<!-- Author information is disabled by default. Uncomment and fill in your details if you want to use it.
			<h2><?php _e('Author'); ?></h2>
			<p><?php _e('A little something about you, the author. Nothing lengthy, just an overview.'); ?></p>
			
			-->

			
			<?php /* If this is a 404 page */ if (is_404()) { ?>
			<?php /* If this is a category archive */ } elseif (is_category()) { ?>
			<p><?php printf(__('You are currently browsing the archives for the %s category.'), single_cat_title('', false) ); ?></p>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<p><?php printf(__('You are currently browsing the <a href="%1$s">%2$s</a> weblog archives for the year %3$s.'), get_bloginfo('home'), get_bloginfo('name'), get_the_time('Y')); ?></p>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<p><?php printf(__('You are currently browsing the <a href="%1$s">%2$s</a> weblog archives for %3$s.'), get_bloginfo('home'), get_bloginfo('name'), get_the_time('F, Y')); ?></p>

      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<p><?php printf(__('You are currently browsing the <a href="%1$s">%2$s</a> weblog archives for the year %3$s.'), get_bloginfo('home'), get_bloginfo('name'), get_the_time('Y')); ?></p>

			<?php /* If this is a search results page */ } elseif (is_search()) { ?>
			<p><?php printf(__('You have searched the <a href="%1$s">%2$s</a> weblog archives for <strong>&#8216;%3$s\&#8217;</strong>. If you are unable to find anything in these search results, you can try one of these links.'), get_bloginfo('home'), get_bloginfo('name'), wp_specialchars($s)); ?></p>

			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p><?php printf(__('You are currently browsing the <a href="%1$s">%2$s</a> weblog archives.'), get_bloginfo('home'), get_bloginfo('name')); ?></p>

			<?php } ?>
			
	                <h2><?php _e('Latest'); ?></h2>
                        <ul>
                        <?php mdv_recent_posts(10, '<li>', '</li>', true, 0, false)?>
                        </ul>

			<br/><?php wp_list_pages('title_li=<h2>' . __('Pages') . '</h2>' ); ?>

			<br/><h2><?php _e('Archives'); ?></h2>
				<ul>
				<?php wp_get_archives('type=monthly'); ?>
				</ul>
			

			<br/><h2><?php _e('Categories'); ?></h2>
				<ul>
				<?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
				</ul>
			

			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
				<br/><?php get_links_list(); ?>

<!--				<br/><h2><?php _e('Meta'); ?></h2>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>
					<li><a href="http://gmpg.org/xfn/"><?php _e('<abbr title="XHTML Friends Network">XFN</abbr>'); ?></a></li>
					<li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.'); ?>">WordPress</a>
					<?php wp_meta(); ?>
				</ul>
-->
			<?php } ?>
    <br/>


	</div>


<?php
/*
Plugin Name: Recent Posts
Plugin URI: http://mtdewvirus.com/code/wordpress-plugins/
Description: Returns a list of the most recent posts.
Version: 1.07
Author: Nick Momrik
Author URI: http://mtdewvirus.com/

Hacked by Mauro Graziani http://www.maurograziani.org
to call Polyglot for title translation

Instructions:
Copy the whole function (from <?php to ?> included)
and paste at the end of php module where you want the
recent post list appear (e.g. sidebar.php)

Place the function call in wherever you want the recent posts to appear.
<?php mdv_recent_posts(); ?>

Configuration:
You may pass parameters when calling the function to configure some of the options.
Example: mdv_recent_posts(10, '', '<br />', true, 5, false)

The parameters:
$no_posts - sets the number of recent posts to display
$before - text to be displayed before the link to the recent post
$after - text to be displayed after the link to the recent post
$hide_pass_post - whether or not to display password protected posts
$skip_posts - allows skipping of a number of posts before showing the number of posts specified with the $no_posts parameter
$show_excerpts - allows the post excerpt to be output after the post title
*/

function mdv_recent_posts($no_posts = 5, $before = '<li>', $after = '</li>', $hide_pass_post = true, $skip_posts = 0, $show_excerpts = false) {
    global $wpdb;
        $time_difference = get_settings('gmt_offset');
        $now = gmdate("Y-m-d H:i:s",time());
    $request = "SELECT ID, post_title, post_excerpt FROM $wpdb->posts WHERE post_status = 'publish' ";
        if($hide_pass_post) $request .= "AND post_password ='' ";
        $request .= "AND post_date_gmt < '$now' ORDER BY post_date DESC LIMIT $skip_posts, $no_posts";
    $posts = $wpdb->get_results($request);
        $output = '';
    if($posts) {
                foreach ($posts as $post) {
                        $post_title = stripslashes($post->post_title);
                        $permalink = get_permalink($post->ID);

						/* this is MG simple hack: call polyglot function to translate post-title*/
						if (function_exists('lang_picker_respect_more')) {
							$post_title = lang_picker_respect_more($post_title);
						}

                        $output .= $before . '<a href="' . $permalink . '" rel="bookmark" title="Permanent Link: ' . htmlspecialchars($post_title, ENT_COMPAT) . '">' . htmlspecialchars($post_title) . '</a>';
                        if($show_excerpts) {
                                $post_excerpt = stripslashes($post->post_excerpt);
                                $output.= '<br />' . $post_excerpt;
                        }
                        $output .= $after;
                }
        } else {
                $output .= $before . "None found" . $after;
        }
    echo $output;
}
?>



