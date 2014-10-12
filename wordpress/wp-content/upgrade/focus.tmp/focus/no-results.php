<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package focus
 * @since focus 1.0
 */
?>

<div class="entry-content no-results-container">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'focus' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php else : ?>

		<p><?php echo wp_kses_post(siteorigin_setting('text_no_results', __("We couldn't find any results for your query.", 'focus'))) ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>
</div><!-- .entry-content -->