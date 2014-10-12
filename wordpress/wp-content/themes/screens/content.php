<?php if (have_posts()) : the_post();
?>
<section class="eleven columns">
	<?php screens_breadcrumb(); ?>
	<article <?php post_class('post') ?>>
		<?php		 /* Image */ if ( 'image' == get_post_format( $post->ID) ) :  
if((function_exists('add_theme_support')) && ( has_post_thumbnail())) :
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		echo '
		<div class="lightbox_large">
			<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
			the_post_thumbnail('large');
			echo '</a>
		</div>';	
	/* /Image ELSE */	else :
		$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 1 ) );	
		if ( $images ) :
		$total_images = count( $images );
		$image = array_shift( $images );
		$image_img_tag = wp_get_attachment_image( $image->ID, 'large' );
			echo $image_img_tag;
		endif; endif;
		?>
		<?php else :
			if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
			$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
			echo '<div class="lightbox_large"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
			the_post_thumbnail('post');
			echo '</a></div>';
			} endif;
		?>
		<?php the_title('<h1>', '</h1>'); ?>
		<div class="entry">
			<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('<em>Pages</em>:', 'screens'), 'after' => '</div>')); ?>
			<?php		 /* Image */
				if ('quote' == get_post_format($post -> ID)) :  screens_post_quote();
				endif;
			?>
			<?php	the_content(); ?>
			<?php	wp_link_pages(array('before' => '<div class="page-link">' . __('<em>Pages</em>:', 'screens'), 'after' => '</div>')); ?>

			<?php
	if (function_exists('screens_desc'))
		screens_desc();
			?>
			<div class="clear"></div>
		</div>
	</article>
	<div class="wp-pagenavi">
		<?php previous_post_link('<div class="alignleft">' . __('Previous Post', 'screens') . ' <br />%link</div>'); ?>
		<?php next_post_link('<div class="alignright">' . __('Next Post', 'screens') . ' <br />%link</div>'); ?>
		<div class="clear"></div>
	</div>
	<?php comments_template('', true); ?>
</section>
<?php  endif; ?>
<?php get_sidebar(); ?>