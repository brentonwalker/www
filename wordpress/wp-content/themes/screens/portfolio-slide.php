<?php
wp_enqueue_script('carou');
$loop = new WP_Query( array('post_type' => 'page-portfolio', 'posts_per_page' => -1));
$count = 0;
?>
<div class="list_carousel">
	<ul id="carusel">
		
		<?php if ( $loop ) :

while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<?php
		global $post;
		$post_options = get_post_options_api('1.0.1');
		$video = $post_options -> get_post_option($post -> ID, 'pvideo');
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
		<li class="eight columns <?php echo strtolower($tax); ?> all captionfull">
			<?php
if ((function_exists('add_theme_support')) && ( has_post_thumbnail())){
the_post_thumbnail('box');
echo '<div class="gallery_title"><a  href="'.get_permalink().'">';
the_title('<h2>', '</h2>');
echo '</a><em>'.$tax.'</em></div>';
} else {
if (!empty($video)){
$var = apply_filters('the_content', "[embed width=\"460\"]" . $video . "[/embed]");
echo $var; ?>
<div class="gallery_title"><h2><a title="<?php echo esc_attr(sprintf(__('Permanent Link to %s', 'screens'), the_title_attribute('echo=0'))); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
<?php echo '<em>'.$tax.'</em>'; ?>
</div>
			<?php  } }?>
		</li>
		<?php endwhile; else: ?>
		<li>
			<?php  _e('Sorry, no portfolio entries for while.', 'screens'); ?>
		</li>
		<?php endif; wp_reset_postdata(); wp_enqueue_script('carou'); ?>
	</ul>
	<div class="clearfix"></div>
	<a id="prev2" class="prev" href="#">&lt;</a>
	<a id="next2" class="next" href="#">&gt;</a>
</div>
<script>
	jQuery(document).ready(function($) {
		$("#carusel").carouFredSel({
			width : "100%",
			scroll : 1,
			auto: false,
			prev: '#prev2',
		    next: '#next2',
		});
	}); 
</script>