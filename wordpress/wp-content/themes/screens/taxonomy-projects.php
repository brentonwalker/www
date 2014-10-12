<?php get_header(); ?>
<?php
global $NHP_Options;
$portfoliotype = $NHP_Options -> get('portfolio2');
?>
<div id="wrapper">
	<div class="container">
	<h1 class="sixteen columns title_headers"><?php
	printf(__('%s', 'screens'), single_tag_title('', false));
?></h1>
	<?php
	$tag_desc = tag_description();
	if ($tag_desc) :
		printf(__('<div class="sixteen columns">%s</div>', 'screens'), $tag_desc);
	endif;
	?>			
<?php $locations_list = wp_list_categories(array('taxonomy' => 'projects', 'orderby' => 'name', 'show_count' => 0, 'pad_counts' => 0, 'hierarchical' => 1, 'echo' => 0, 'title_li' => ''));
    if ($locations_list)
		echo '<ul id="portfolio-filter" class="sixteen columns">' . $locations_list . '</ul>';
 ?> 		
	</div>
<div class="container" id="home_portfolio">
	<ul id="portfolio-list">

<?php 		
		if ( have_posts() ) : while (have_posts()) : the_post();
?>
			<?php
	$terms = get_the_terms($post -> ID, 'projects');

	if ($terms && !is_wp_error($terms)) :
		$links = array();

		foreach ($terms as $term) {
			$links[] = $term -> name;
		}
		$links = str_replace(' ', '-', $links);
		$tax = join(" ", $links);
	else :
		$tax = '';
	endif;
	?>
<li class="four columns  captionfull">
<?php
if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
	the_post_thumbnail('box');
} else { echo '<img src="' . get_template_directory_uri() . '/images/post_thumb.jpg" />';
}
?>
<div class="gallery_title"><h3><a title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
<em><?php echo $tax; ?>
</em></div>
					<div class="cover">
						<?php
						if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
							$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
							echo '<span class="lightbox_large"><a  href="' . $large_image_url[0] . '" title="' . esc_attr(sprintf(__(' %s', 'screens'), the_title_attribute('echo=0'))) . '" > ' . __('Zoom', 'screens') . '</a></span>';
						}
						?>
				</div>									
</li>	
<?php endwhile; endif; ?>
</ul>	
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