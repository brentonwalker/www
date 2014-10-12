<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package focus
 * @since focus 1.0
 */

get_header(); ?>
	
<?php get_template_part('slider') ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		
		<div class="container">
			
			<h2 class="archive-title"><?php echo esc_html(siteorigin_setting('text_latest_posts', __("Latest Videos", 'focus'))) ?></h2>
			
			<?php get_template_part('loop') ?>
			
		</div>
	</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>