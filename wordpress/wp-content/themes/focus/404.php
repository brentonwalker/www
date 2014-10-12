<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package focus
 * @since focus 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<div id="single-header">
			<div class="container">
				<div class="post-heading">
					<h1><?php _e('Page Not Found', 'focus') ?></h1>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="container-decoration"></div>

			<div class="content-container">
				<div id="content" class="site-content" role="main">
					<div class="entry-content">

						<p><?php echo wp_kses_post(siteorigin_setting('text_not_found', __("We couldn't find the page you were looking for.", 'focus'))) ?></p>
						
						<?php get_search_form(); ?>
	
						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
	
						<div class="widget">
							<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'focus' ); ?></h2>
							<ul>
								<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
							</ul>
						</div><!-- .widget -->
	
						<?php
						/* translators: %1$s: smilie */
						$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'focus' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
						?>
	
						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					</div>
					
				</div><!-- #content .site-content.content-container -->

				<?php get_sidebar(); ?>

				<div class="clear"></div>
			</div>

		</div>
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>