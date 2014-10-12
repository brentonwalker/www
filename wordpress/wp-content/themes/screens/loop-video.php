<article <?php post_class() ?>>	
<?php
				global $post;
				$post_options = get_post_options_api('1.0.1');
				$video = $post_options -> get_post_option($post -> ID, 'pf-video');
				if (!empty($video)) {
					$var = apply_filters('the_content', "[embed width=\"640\"]" . $video . "[/embed]");
					echo $var;
				}
	?>	
	<header>
		<?php screens_date(); ?>
		<h2><a href="<?php	the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<ul class="meta_post">
		<li><?php screens_author(); ?></li>
		<?php screens_cat(); ?>
				<?php if ( comments_open() && ! post_password_required()) {?>
		<li class="leavecomments">
			<?php	comments_popup_link(__('Leave a comment', 'screens'), __('1 Comment', 'screens'), __('% Comments', 'screens')); ?>
		</li>
		<?php }?>
		</ul>
	</header>
	<?php  the_excerpt();?> 
		<?php screens_tag(); ?>	
	<div class="clear"></div>
</article>