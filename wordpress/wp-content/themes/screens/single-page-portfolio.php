<?php get_header(); ?>
<div id="wrapper">
	<?php if (have_posts()) : the_post();
	?>	
	<div class="container">		
		<section class="eleven columns post">
			<?php screens_breadcrumb(); ?>
			<article>
			<?php	the_title('<h1>', '</h1>'); ?>	
<?php
				global $post;
				$post_options = get_post_options_api('1.0.1');
				$video = $post_options -> get_post_option($post -> ID, 'pvideo');
				$args = array(
				'post_type' => 'attachment', 
				'numberposts' => -1, 
				'post_status' => null, 
				'post_parent' => $post -> ID
				);
				$args_not_thumb = array(
					'post_type' => 'attachment',
					'numberposts' => -1,
					'post_status' => null,
					'post_parent' => $post->ID,
					 'exclude' => get_post_thumbnail_id()
				);
				if (!empty($video)) {
					$var = apply_filters('the_content', "[embed width=\"640\"]" . $video . "[/embed]");
					echo $var;
				}
	?>
				<?php
$pgallery = $post_options -> get_post_option($post -> ID, 'pgallery');
if (($pgallery) =='option-3') { //GALLERY - SLIDESHOW
				?>			
				<script><?php wp_enqueue_script('flex-slide'); ?>
				jQuery(document).ready(function($) {
					$('.flexslider').flexslider({
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
                <?php
				if (!empty($video)) {
					$attachments = get_posts($args_not_thumb);
				} else {
					$attachments = get_posts($args);
				}
				if ($attachments) :
					echo '<div class="flex-container"><div class="flexslider"><ul class="slides">';
					foreach ($attachments as $attachment) :
						echo '<li>';
						echo wp_get_attachment_image($attachment -> ID, 'large');
						echo '</li>';
					endforeach;
					echo '</ul></div></div>';
				endif;
                ?>							
				<?php  } 
				elseif (($pgallery) =='option-2')  {
					 //GALLERY - 2 COLUMNS, LIGHTBOX
					echo do_shortcode('[gallery link="file" size="s-gallery" columns="2" ]');
			    } else {
			    	 //GALLERY - 1 COLUMNS
				if (!empty($video)) {
					$attachments = get_posts($args_not_thumb);
				} else {
					$attachments = get_posts($args);
				}
					
					if ( $attachments ):
					echo '<ul>';
					foreach ( $attachments as $attachment ):
					echo '<li>';
					echo wp_get_attachment_image($attachment->ID, 'large');
					echo '</li>';
					endforeach;
					echo '</ul>';
					endif;
					}
				?>	
				</article>				
		</section>
		<?php get_sidebar('portfolio'); ?>
	</div>
	<?php  //END
		endif;
	?>
</div>
<?php get_footer(); ?>