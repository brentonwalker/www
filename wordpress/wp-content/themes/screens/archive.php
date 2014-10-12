<?php	get_header(); ?>
<div id="wrapper">
	<div class="container">
			<?php
			if (is_category()) :
				printf(__('<h1 class="sixteen columns title_headers">Category Archives: <em>%s</em></h1>', 'screens'), single_cat_title('', false));
				$cat_desc = category_description();
				if ($cat_desc) :
					printf(__('<div class="sixteen columns">%s</div>', 'screens'), $cat_desc);
				endif;
			elseif (is_tag()) :
				printf(__('<h1 class="sixteen columns title_headers">Tag Archives: <em>%s</em></h1>', 'screens'), single_tag_title('', false));
				$tag_desc = tag_description();
				if ($tag_desc) :
					printf(__('<div class="sixteen columns">%s</div>', 'screens'), $tag_desc);
				endif;
			elseif (is_day()) :
				printf(__('<h1 class="sixteen columns title_headers">Daily Archives: <em>%s</em></h1>', 'screens'), get_the_date());
			elseif (is_month()) :
				printf(__('<h1 class="sixteen columns title_headers">Monthly Archives: <em>%s</em></h1>', 'screens'), get_the_date('F Y'));
			elseif (is_year()) :
				printf(__('<h1 class="sixteen columns title_headers">Yearly Archives: <em>%s</em></h1>', 'screens'), get_the_date('Y'));
			elseif (is_author()) :
				printf(__('<h1 class="sixteen columns title_headers">Author Archives: <em>%s</em></h1>', 'screens'), get_the_author());
			elseif (has_post_format('gallery')) :
				_e('<h1 class="sixteen columns title_headers">Gallery</h1>', 'screens');
			elseif (has_post_format('link')) :
				_e('<h1 class="sixteen columns title_headers">Link</h1>', 'screens');
			elseif (has_post_format('aside')) :
				_e('<h1 class="sixteen columns title_headers">Aside</h1>', 'screens');
			elseif (has_post_format('quote')) :
				_e('<h1 class="sixteen columns title_headers">Quote</h1>', 'screens');
			elseif (has_post_format('video')) :
				_e('<h1 class="sixteen columns title_headers">Video</h1>', 'screens');
			elseif (has_post_format('image')) :
				_e('<h1 class="sixteen columns title_headers">Images</h1>', 'screens');
			else :
				_e('<h1 class="sixteen columns title_headers">Blog Archives</h1>', 'screens');
			endif;
			?>
<div class="sixteen columns"><?php screens_breadcrumb(); ?></div>
	<section class="eleven columns content">
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