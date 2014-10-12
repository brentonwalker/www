<?php
/**
 * Displays a single post
 * 
 * @package so-current
 * @since so-current 1.0
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>

	<?php if(has_post_thumbnail()) : ?>
		<div class="thumbnail-wrapper">
			<?php the_post_thumbnail('so-current-single'); ?>
		</div>
	<?php endif; ?>

	<div class="single-entry-content">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'so-current' ), 'after' => '</div>' ) ); ?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->