<form method="get" id="searchform" class="login" action="<?php bloginfo('home'); ?>/">
<p>Search the website:<label><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
<input type="submit" id="submit" value="Search" /></label>
</p>
</form>
