<div class="content-container loop-container">
	
	<?php if ( have_posts() ) : ?>
	
		<div class="wrapper">
			
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
	
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<a href="<?php the_permalink() ?>"><h2 class="entry-title"><span>
						<?php echo get_the_title() ? get_the_title() : __('Untitled', 'focus') ?>
					</span></h2></a>
					
					<a href="<?php the_permalink() ?>" class="thumbnail-wrapper">
						<!-- <div class="time"></div> -->
						<?php echo has_post_thumbnail() ? get_the_post_thumbnail() : focus_default_post_thumbnail();  ?>
					</a>
				</article>
		
			<?php endwhile; ?>
			
		</div>
		
	<?php else : ?>
	
		<?php get_template_part( 'no-results', 'index' ); ?>
	
	<?php endif; ?>

	<div class="clear"></div>
	
</div>

<?php focus_content_nav( 'nav-below' ); ?>