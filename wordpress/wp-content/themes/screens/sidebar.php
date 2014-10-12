<aside id="sidebar" class="five columns">
	<?php	if ( is_single()) {
	?>
	<ul class="widget sidebar_meta">
		<li>
			<?php echo esc_attr(get_the_date()); ?>,
			<?php screens_author(); ?>
		</li>
		<?php screens_cat(); ?>
		<?php printf(__('%1$s', 'screens'), get_the_tag_list(__('<li>Tags: ', 'screens'), ', ', '</li>')); ?>
		<?php if ( comments_open() && ! post_password_required()) {
		?>
		<li>
			<?php	comments_popup_link(__('Leave a comment', 'screens'), __('1 Comment', 'screens'), __('% Comments', 'screens')); ?>
		</li>
		<?php } ?>
	</ul>
	<?php } ?>
	<?php	if ( is_active_sidebar( 'sidebar-blog' ) ) {
	?>
	<ul  class="widget">
		<?php  dynamic_sidebar('sidebar-blog'); ?>
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