<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Sidekick
 */

get_header(); ?>

	<div id="primary" class="content-area full-width-page">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post hentry error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'sidekick' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try searching?', 'sidekick' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>