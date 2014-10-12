<?php get_header(); ?>
<div id="wrapper">
<div class="container">	
	<?php
	global $NHP_Options;
	$blog_title = $NHP_Options -> get('blog1');
	if ($blog_title) :
		echo '<h1 class="sixteen columns title_headers">' . $blog_title . '</h1>';
	endif;
	?>
	<div class="sixteen columns"><?php screens_breadcrumb(); ?></div>
	<section class="eleven columns">
		<?php if ( have_posts() ) : while (have_posts()) : the_post();
		?>
		<?php get_template_part('loop', get_post_format()); ?>
		<?php endwhile; endif; ?>
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