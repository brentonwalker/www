<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Sidekick
 * @since Sidekick 1.0
 */

if ( '' != get_the_post_thumbnail( $post->ID ) ) :
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'sidekick-panoramic' );

	// If the image is wider than or equal to 1500, and at smaller than or equal to 500, add class and show image
	if ( $image[1] >= 1500 && $image[2] <= 500 ) :
?>
		<div class="hentry-wrap <?php echo 'featured'; ?>">
<?php
			the_post_thumbnail( 'sidekick-panoramic' );
	endif;
else :
?>
		<div class="hentry-wrap">
<?php
endif;
?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'sidekick' ), 'after' => '</div>' ) ); ?>
					<?php edit_post_link( __( 'Edit', 'sidekick' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->
		</div><!-- .hentry-wrap -->
