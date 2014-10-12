<?php
/**
 * Displays 
 * 
 * @package portal
 * @since portal 1.0
 * @license GPL 2.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<?php if(!is_single()) : ?><a href="<?php the_permalink() ?>"><?php endif; ?>
				<?php the_title(); ?>
			<?php if(!is_single()) : ?></a><?php endif; ?>
		</h1>

		<div class="entry-meta <?php if(get_the_title() == '') echo 'no-title' ?>">
			<?php portal_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-thumbnail">
		<?php portal_entry_thumbnail() ?>
	</div>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'portal' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php echo portal_get_post_meta() ?>
		<?php edit_post_link( __( 'Edit', 'portal' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

	<?php if(!is_single()) : ?><div class="decoration"></div><?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->