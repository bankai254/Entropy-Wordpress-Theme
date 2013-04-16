	<footer>
		<div class="container">
			<ul>
				<li><?php previous_posts_link('&larr; Previous Page', 0) ?></li>
				<li><?php next_posts_link('Next Page &rarr;', 0); ?></li>
			</ul>
			<p>&copy; <?php the_time('Y') ?> <?php bloginfo('name'); ?>. All Rights Reserved. <a href="http://timothy-long.com/entropy">Entropy Wordpress Theme</a> by <a href="http://timothy-long.com">Timothy Long</a></p>
		</div>
	</footer>
<?php
// insert wp_footer function, which is required for many wordpress actions
// http://codex.wordpress.org/Function_Reference/wp_footer
wp_footer();
?>
</body>
</html>
