<?php get_header(); ?>
<div id="wrapper">
	<div class="container">
<h1 class="sixteen columns title_headers"><?php printf(__('Search Results for: %s', 'screens'), '<em>' . get_search_query() . '</em>'); ?></h1>
<div class="sixteen columns"><?php screens_breadcrumb(); ?></div>		
		<section class="eleven columns">					
		<?php if ( have_posts() ) : while (have_posts()) : the_post();
		?>				
<article <?php post_class() ?>>
	<header>		
<?php	/* Gallery*/ if ( 'gallery' == get_post_format( $post->ID) ) : 
$args = array(  'post_type' => 'attachment',
                'orderby' => 'menu_order',
                'order' => ASC,
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
			<?php  endif; ?> 
			
		<?php		 /* Image */
				if ('image' == get_post_format($post -> ID)) :
					if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) :
						$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
						echo '
		<div class="lightbox_large">
			<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
						the_post_thumbnail('post');
						echo '</a>
		</div>';
					endif;
				endif;
			?>
		
		
		<?php	/*Video */
			if ('video' == get_post_format($post -> ID)) :
				global $post;
				$post_options = get_post_options_api('1.0.1');
				$video = $post_options -> get_post_option($post -> ID, 'pf-video');
				if (!empty($video)) {
					$var = apply_filters('the_content', "[embed width=\"640\"]" . $video . "[/embed]");
					echo $var;
				}
			endif;
 ?>	
		<?php if (!is_search() ) :
		?>
		<div class="post-comments">
			<?php	comments_popup_link(__('Leave a comment', 'screens'), __('1 Comment', 'screens'), __('% Comments', 'screens')); ?>
		</div>
		<?php screens_meta(); ?>
		<?php  endif; ?>
		<h2><a href="<?php	the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header>
	<?php  the_excerpt(); ?> 
				<?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'screens'), 'after' => '</div>'));?>

	    <div class="clear"></div>
</article>
					<?php endwhile; else : ?>
						<article>
			<header>
					<?php	_e('<h1>Nothing Found</h1>', 'screens'); ?>
			</header>
				<p>
					<?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'screens'); ?>
				</p>
						<?php	endif; ?>
			</article>
		</section>
		<?php get_sidebar(); ?>
<div class="sixteen columns">	
		<?php
		if (function_exists('wp_pagenavi')) { wp_pagenavi();
		} else { screens_pagination();
		}
		?>
</div>
	</div>
</div>
<?php get_footer(); ?>