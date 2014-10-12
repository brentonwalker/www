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
 * @package portal
 * @since portal 1.0
 * @license GPL 2.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php if( is_home() && $GLOBALS['wp_query']->get('paged') == 0 && siteorigin_setting('home_title_display') ) : ?>
			<div id="home-title">
			<?php
			the_widget(
				'Portal_Widget_MegaTitle',
				array(
					'title' => siteorigin_setting('home_title', __("Portal Makes Blogging Cool Again", 'portal')),
					'subtitle' => siteorigin_setting('home_subtitle', __("We all knew it wouldn't be gone for long. Blogging is back and a better way than ever to elevate your business or personal brand.", 'portal')),
					'editable' => array(
						'title' => 'home_title',
						'subtitle' => 'home_subtitle',
					)
				)
			);
			?>
			</div>
		<?php endif ?>

		<?php if( is_home() && $GLOBALS['wp_query']->get('paged') == 0 && siteorigin_setting('home_slider') && class_exists('SiteOrigin_Slider_Widget') ) : ?>
			<?php
			the_widget(
				'SiteOrigin_Slider_Widget',
				array(
					'slider_id' => siteorigin_setting('home_slider'),
				),
				array(
					'before_widget' => '<div id="home-page-slider">',
					'after_widget' => '</div>',
				)
			);
			?>
		<?php endif ?>

		<?php if ( have_posts() ) : ?>

			<?php get_template_part('loop', siteorigin_setting('home_loop')) ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

<?php get_footer(); ?>