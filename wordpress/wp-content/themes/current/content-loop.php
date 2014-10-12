<?php
/**
 * Displays 
 * 
 * @package so-current
 * @since so-current 1.0
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('loop'); ?>>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink() ?>">
			<?php if(has_post_thumbnail()) the_post_thumbnail(); else so_current_placeholder_thumbnail(); ?>
		</a>
	</div>

	<div class="decoration">

		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'so-current' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php so_current_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
