<?php
/**
 * The Template for displaying single attachments.
 *
 * @package focus
 * @since focus 1.0
 */

get_header(); the_post(); ?>

	<a name="wrapper"></a>
	<div id="primary" class="content-area">

		<div id="single-header">
			<?php echo wp_get_attachment_image(get_the_ID(), 'slider') ?>
			<div class="overlay"></div>

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
						<?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>
						<?php wp_link_pages(array('before' => '<div class="clear"></div>'.'<p>' . __('Pages:', 'focus'))) ?>
					</div>

					<div class="clear"></div>

					<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) comments_template( '', true );
					?>
				</div><!-- #content .site-content.content-container -->

				<?php get_sidebar(); ?>

				<div class="clear"></div>
			</div>
			<?php if(siteorigin_setting('general_posts_nav')) focus_content_nav('posts-nav') ?>
		</div>
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>