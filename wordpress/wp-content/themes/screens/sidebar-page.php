<aside id="sidebar" class="five columns">
	<?php	if ( is_active_sidebar( 'sidebar-page' ) ) {
	?>
	<ul  class="widget">
		<?php  dynamic_sidebar('sidebar-page'); ?>
	</ul>
	<?php  } else { ?>
	<ul class="widget">
		<li>
			<?php  get_search_form(); ?>
		</li>
		<li>
			<h3><?php  _e('Categories', 'screens'); ?></h3>
			<ul>
				<?php wp_list_categories('show_count=1&title_li=&show_last_update=1&use_desc_for_title=1'); ?>
			</ul>
		</li>
	</ul>
	<?php } ?>
</aside>