<?php
/**
 * The template for displaying full width pages.
 *
 * @package focus
 * @since focus 1.0
 */

/*
Template Name: Full Width
*/

get_header(); the_post(); ?>

	<div id="primary" class="content-area">

		<div id="single-header">
			<?php if(has_post_thumbnail()) : ?>
				<?php the_post_thumbnail('slider') ?>
				<div class="overlay"></div>
			<?php endif; ?>

			<div class="container">
				<div class="post-heading">
					<h1><?php the_title() ?></h1>
					<?php if(has_excerpt()) : ?><p><?php the_excerpt() ?></p><?php endif; ?>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="container-decoration"></div>

			<div class="content-container">
				<div id="content" class="site-content" role="main">

					<div class="entry-content">
						<?php the_content() ?>
					</div>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) comments_template( '', true );
					?>
				</div><!-- #content .site-content.content-container -->

				<div class="clear"></div>
			</div>

		</div>
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>