<?php
/**
 * Template Name: Portfolio - 4 Columns (Navigations)
 ***/
?>
<?php get_header();?>
<div id="wrapper">
<div class="container">
	<?php	the_title('<h1 class="sixteen columns title_headers">', '</h1>'); ?>		
</div>	
<div class="container portfolio-nav" id="home_portfolio">
	<ul id="portfolio-list">
<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$temp = $wp_query; 
$wp_query = null;
$wp_query = new WP_Query(array( 'post_type' => 'page-portfolio', 'posts_per_page' =>'8', 'paged' => $paged ) ); 

if( have_posts() ) : while ($wp_query->have_posts()) : $wp_query->the_post(); 

global $post;
$post_options = get_post_options_api('1.0.1');
$video = $post_options -> get_post_option($post -> ID, 'pvideo');
?>

<li class="four columns  captionfull">
<?php
if ((function_exists('add_theme_support')) && ( has_post_thumbnail())) {
	the_post_thumbnail('box');
} else { echo '<img src="' . get_template_directory_uri() . '/images/post_thumb.jpg" />';
}
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
<div class="gallery_title"><h3><a title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
<em><?php echo $tax; ?></em></div>									
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
<?php  $wp_query = $temp;  wp_reset_postdata(); ?>
</div>
</div>
</div>
<?php get_footer();?>			