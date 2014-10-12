<?php
wp_enqueue_script('masonry');
global $NHP_Options;
$blog_link = $NHP_Options -> get('blog2');
?>
<section class="container toggle_viev" id="masonry_container">
	<?php $args = array('orderby' => 'date', 'order' => 'DESC', );
	$wp_query = new WP_Query($args);
  ?>	
		<?php 	  
  if( have_posts() ) : 
		while ($wp_query->have_posts()) : $wp_query->the_post();
		?>
		<?php /* Image */ if ( 'image' == get_post_format( $post->ID) ) :
?>
		<article class="four columns masonry_box masonry_box_mobile">	
			<?php
			if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
				the_post_thumbnail('box');
			}
			?>
				<ul class="cover">
						<?php
						if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
							$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
							echo '<li class="lightbox_large"><a href="' . $large_image_url[0] . '" title="' . esc_attr(sprintf(__(' %s', 'screens'), the_title_attribute('echo=0'))) . '" > ' . __('Zoom', 'screens') . '</a></li>';
						}
						?>
				</ul>
				
			<h3><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h3>	
		</article>
<?php /* GALLERY */ elseif ( 'gallery' == get_post_format( $post->ID) ) : ?>
		<article class="four columns masonry_box masonry_box_mobile">
			<?php
			$args = array('post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post -> ID);
			$attachments = get_posts($args);
			if ($attachments) :
				echo '<div class="flex-container">
		<div class="flexslider"><ul class="slides">';
				foreach ($attachments as $attachment) :
					echo '<li>';
					echo wp_get_attachment_image($attachment -> ID, 'box');
					echo '</li>';
				endforeach;
				echo '</ul></div></div>';
			endif;
                    ?>
			<h3><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		</article>
<script>
	jQuery(document).ready(function($) {
		$(".flexslider").flexslider({
			controlsContainer : ".flex-container",
			slideDirection : "horizontal",
			animation : "fade",
			directionNav : true,
			slideshow : false,
			controlNav : true,
			pauseOnHover : true,
			slideshowSpeed : 6000,
			animationDuration : 600
		});
	});
</script>		
<?php /* ASIDE */ elseif ( 'aside' == get_post_format( $post->ID) ) : ?>
		<article class="four columns masonry_box masonry_box_mobile">
			<p><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php echo esc_html(get_the_date()); ?></a></p>		
			<?php  the_excerpt(); ?>
		</article>
		<?php /* QUOTE */ elseif ( 'quote' == get_post_format( $post->ID) ) : ?>
		<article class="four columns masonry_box format-quote masonry_box_mobile">
			<?php screens_post_quote(); ?>	
			<p><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php echo esc_html(get_the_date()); ?></a></p>		
			<?php  the_excerpt(); ?>
		</article>
		<?php /* LINK */ elseif ( 'link' == get_post_format( $post->ID) ) : ?>
		<article class="four columns masonry_box format-link masonry_box_mobile">
			<h3 class="link"><a href="<?php echo screens_link_format(); ?>" title="<?php echo esc_attr(sprintf(__('Links &raquo; %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h3>	

			<p><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php echo esc_html(get_the_date()); ?></a></p>					
			<?php  the_excerpt(); ?>
		</article>
	<?php /* VIDEO */ elseif ( 'video' == get_post_format( $post->ID) ) : ?>
		<article class="four columns masonry_box video-box masonry_box_mobile">
			<?php
			global $post;
			$post_options = get_post_options_api('1.0.1');
			$video = $post_options -> get_post_option($post -> ID, 'pf-video');
			if (!empty($video)) {
				$var = apply_filters('the_content', "[embed width=\"220\"]" . $video . "[/embed]");
				echo $var;
			}
			?>			
			<h3><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
		</article>
<?php  else  : ?>
		<article class="four columns masonry_box masonry_box_mobile">
			<?php
			if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
				the_post_thumbnail('box');
			}
			?>
				<ul class="cover">
						<?php
						if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
							$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
							echo '<li class="lightbox_large"><a  href="' . $large_image_url[0] . '" title="' . esc_attr(sprintf(__(' %s', 'screens'), the_title_attribute('echo=0'))) . '" > ' . __('Zoom', 'screens') . '</a></li>';
						}
						?>
				</ul>			
			<h3><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h3>	
			<p class="meta_post"><a href="<?php	the_permalink(); ?>" title="<?php	echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" ><?php echo esc_html(get_the_date()); ?>, </a>					
		<?php echo sprintf(__('%s', 'screens'), get_the_category_list(__(', ', 'screens'))) ?></p>		
			<?php  the_excerpt(); ?>
		</article>
		<?php endif; ?>
		<?php endwhile; endif; wp_reset_postdata(); ?>

<div class="clear"></div>
</section>
			