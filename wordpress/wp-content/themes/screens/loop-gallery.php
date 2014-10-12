<article <?php post_class() ?>>
			<?php	
$args = array(  'post_type' => 'attachment',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'numberposts' => -1,
                'post_status' => null,
                'post_parent' => $post->ID
                    );
                    $attachments = get_posts($args);
                    if ( $attachments ):
						echo '<div class="flex-container">
		<div class="flexslider"><ul class="slides">';
                        foreach ( $attachments as $attachment ):
							echo '<li>';
                            echo wp_get_attachment_image($attachment->ID, 'large');
							echo '</li>';
                        endforeach;
						echo '</ul></div></div>';
                    endif;
                    ?>
                    <script>jQuery(document).ready(function($){$(".flexslider").flexslider({
				controlsContainer : ".flex-container" ,
				slideDirection : "horizontal",
		        animation :"fade",
                directionNav : true, 
                slideshow: false,					
				controlNav : true,
				pauseOnHover : true,
				slideshowSpeed : 6000,
				animationDuration : 600
			});});</script>	
				
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