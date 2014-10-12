<article <?php post_class() ?>>	
	<?php
			if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) { ?>
				<div class="img_box">
			<?php	the_post_thumbnail('post');
	?>
	<ul class="cover">
		<?php
		if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
			$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
			echo '<li class="lightbox_large"><a  href="' . $large_image_url[0] . '" title="' . esc_attr(sprintf(__(' %s', 'screens'), the_title_attribute('echo=0'))) . '" > ' . __('Zoom', 'screens') . '</a></li>';
		}
		?>
	</ul>
	</div>
	<script>
		jQuery(document).ready(function($) {
			$(".img_box").hover(function() {
				$(".cover", this).stop().animate({
					top : "0px"
				}, {
					queue : false,
					duration : 600
				});
			}, function() {
				$(".cover", this).stop().animate({
					top : "-45px"
				}, {
					queue : false,
					duration : 600
				});
			});
		});
	</script>
	<?php	} ?>
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
	<?php  the_excerpt(); ?>
	<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'screens'), 'after' => '</div>'));?>
	<?php screens_tag(); ?>		
<div class="clear"></div>
</article>