<?php get_header(); ?>
<div id="wrapper">
	<div class="container">
		<section class="sixteen columns">		
				<h1><?php _e('Error 404 - Not Found', 'screens'); ?></h1>
				<p>
					<?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'screens'); ?>
				</p>
				<?php get_search_form(); ?>
				<div class="five columns">
					<?php the_widget('WP_Widget_Recent_Posts', array('number' => 5)); ?>
				</div>
				<div class="five columns">
					<?php the_widget('WP_Widget_Categories', array('dropdown' => 0)); ?>
				</div>
				<div class="five columns">
					<?php the_widget('WP_Widget_Tag_Cloud'); ?>
				</div>
		
		</section>
	</div>
<?php wp_footer(); ?>
</body>
</html>