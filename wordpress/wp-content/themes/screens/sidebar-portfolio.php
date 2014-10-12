<aside id="sidebar" class="five columns">
	<ul  class="widget">
		<li class="wp-pagenavi">
			<?php previous_post_link('<div class="alignleft">'.__('Previous Project', 'screens').'<br />%link</div>');?>
			<?php next_post_link('<div class="alignright">'.__('Next Project', 'screens').'<br />%link</div>');?>
			<div class="clear"></div>
		</li>
		<li>
			<ul>
				<li>
					<?php echo get_the_term_list($post -> ID, 'projects', __('<strong>Project</strong>: ', 'screens'), ', ', '');?>
				</li>
				<?php global $post;
$post_options = get_post_options_api('1.0.1');
$live = $post_options -> get_post_option($post -> ID, 'portfolio-live');
$client = $post_options -> get_post_option($post -> ID, 'portfolio-client');
$client_link = $post_options -> get_post_option($post -> ID, 'portfolio-c-link');
if (!empty($client)) {
echo '<li>';
if (!empty($client_link)) {
				?>
				<?php  _e('<strong>Client</strong>: ', 'screens');?><a class="live" title="<?php  _e('Live Preview', 'screens');?>" href="<?php echo esc_url($live);?>" target="_blank"><?php  echo $client;?></a>
				<?php	} else {
					echo _e('<strong>Client</strong>: ', 'screens'). $client;
					}
					echo '</li>';
					}

					if (!empty($live)) {
				?>
				<li>
					<a class="live" title="<?php  _e('Live Preview', 'screens');?>" href="<?php echo esc_url($live);?>" target="_blank"><?php  _e('Live Preview  &rarr;', 'screens');?></a>
				</li>
				<?php }?>
			<?php //VIDEO GALLERY
			$video = $post_options -> get_post_option($post -> ID, 'pvideo');
			if (empty($video)) {
				echo '<li>'.get_the_content().'</li>';
 }?>
				
			</ul>
		</li>
	</ul>
	<?php	if ( is_active_sidebar( 'sidebar-portfolio' ) ) {
	?>
	<ul class="widget">
		<?php  dynamic_sidebar('sidebar-portfolio');?>
	</ul>
	<?php }?>
</aside>