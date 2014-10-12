<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package focus
 * @since focus 1.0
 */
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>

	<?php if ( ! dynamic_sidebar( 'sidebar-' . ( is_page() ? 'page' : 'post' ) ) ) : ?>

		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>

	<?php endif; // end sidebar widget area ?>
</div><!-- #secondary .widget-area -->
