<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package so-current
 * @since so-current 1.0
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
	<div class="single-entry-content">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'so-current' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
