<?php
/**
 * The Template for displaying all single posts.
 *
 * @package web2feel
 * @since web2feel 1.0
 */

get_header(); ?>
	<div class="topbar grid_6">
		<h3>Blog posts</h3>
		<div class="postsnav">
			<div class="pnavi">  <?php previous_post_link('%link', 'Previous ', TRUE); ?> </div>
			<div class="pnavi"> <?php next_post_link('%link', 'Next', TRUE); ?>  </div>
		</div>
	</div>
		<div id="primary" class="content-area grid_4">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

	
				<?php get_template_part( 'content', 'single' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>