<?php
wp_enqueue_script('quick');

$terms = get_terms("projects");
$count = count($terms);
if ($count > 0) {
	echo '<ul id="portfolio-filter" class="filter  sixteen columns">';
	echo '<li><a href="javascript:void(0)" class="all">' . __('All', 'screens') . '</a></li>';
	foreach ($terms as $term) {
		$termname = strtolower($term -> name);
		$termname = str_replace(' ', '-', $termname);
		echo '<li><a href="javascript:void(0)" class="' . $term -> slug . '">' . $term -> name . '</a></li>';
	}
	echo "</ul>";
}
?>

<div id="portfolio">			
<ul id="portfolio-list" class="filterable-grid">
		<?php 
		query_posts( array('post_type' => 'page-portfolio', 'posts_per_page' => '-1' ) );
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
	<?php
	global $post;
	$post_options = get_post_options_api('1.0.1');
	$video = $post_options -> get_post_option($post -> ID, 'pvideo');
	?>
	
	<li data-id="id-<?php echo $count; ?>" data-type="<?php echo strtolower($tax); ?>" class="eight columns captionfull">
			<?php
if ((function_exists('add_theme_support')) && ( has_post_thumbnail())){
the_post_thumbnail('box');
echo '<div class="gallery_title"><h2><a  href="'.get_permalink().'">';
the_title();
echo '</a></h2><em>'.$tax.'</em></div>';
} else {
if (!empty($video)){
$var = apply_filters('the_content', "[embed width=\"440\"]" . $video . "[/embed]");
echo $var; ?>
<div class="gallery_title"><h2><a title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	<em><?php echo $tax ?></em>
</div>
<?php  } }?>
</li>
<?php $count++; 
 endwhile; endif; 
 wp_reset_postdata(); ?>
</ul>

</div>