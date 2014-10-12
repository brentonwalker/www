<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Book Lite
 * @since Book Lite 100
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'booklite' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'booklite' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
