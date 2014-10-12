<?php
/**
 * @package Sidekick
 * @since Sidekick 1.0
 */
?>

<?php
$featured = false;

if ( '' != get_the_post_thumbnail( $post->ID ) ) :
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'sidekick-panoramic' );

	// If the image is wider than or equal to 1500, and at taller than or equal to 500, add class and show image
	if ( $image[1] >= 1500 && $image[2] <= 500 ) :
		$featured = true;
?>
		<div class="hentry-wrap<?php if ( $featured ) { echo ' featured'; } ?>">
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

					<div class="entry-meta">
						<?php superhero_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'sidekick' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->

				<footer class="entry-meta">
					<?php
						/* translators: used between list items, there is a space after the comma */
						$category_list = get_the_category_list( __( ', ', 'sidekick' ) );

						/* translators: used between list items, there is a space after the comma */
						$tag_list = get_the_tag_list( '', __( ', ', 'sidekick' ) );

						if ( ! superhero_categorized_blog() ) {
							// This blog only has 1 category so we just need to worry about tags in the meta text
							if ( '' != $tag_list ) {
								$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sidekick' );
							} else {
								$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sidekick' );
							}

						} else {
							// But this blog has loads of categories so we should probably display them here
							if ( '' != $tag_list ) {
								$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sidekick' );
							} else {
								$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'sidekick' );
							}

						} // end check for categories on this blog

						printf(
							$meta_text,
							$category_list,
							$tag_list,
							get_permalink(),
							the_title_attribute( 'echo=0' )
						);
					?>

					<?php edit_post_link( __( 'Edit', 'sidekick' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
			</article><!-- #post-<?php the_ID(); ?> -->
		</div><!-- .hentry-wrap -->
