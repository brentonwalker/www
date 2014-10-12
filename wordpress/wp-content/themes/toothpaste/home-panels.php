<?php
/**
 * The template for displaying the home page panel
 *
 * @package toothpaste
 * @since toothpaste 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		
		<div class="entry-content">
			<?php echo siteorigin_panels_render('home'); ?>
		</div>
		
	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>