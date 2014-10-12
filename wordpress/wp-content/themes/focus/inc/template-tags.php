<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package focus
 * @since focus 1.0
 */

if ( ! function_exists( 'focus_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since focus 1.0
 */
function focus_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'focus' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'focus' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'focus' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'focus' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'focus' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // focus_content_nav

if ( ! function_exists( 'focus_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since focus 1.0
 */
function focus_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'focus' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'focus' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, $depth == 1 ? 60 : 35 ); ?>
			</div><!-- .comment-author .vcard -->
			
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'focus' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-text-area">
				<div class="comment-meta commentmetadata">
					<cite class="fn"><?php comment_author_link() ?></cite>
					
					<div class="comment-text-area-right">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-permalink"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
							<?php
							/* translators: 1: date, 2: time */
							echo get_comment_date(); ?>
						</time></a>
						
						<?php if(current_user_can( 'edit_comment', $comment->comment_ID ) || ($depth != 0 && $args['max_depth'] > $depth) ) : ?>
							<span class="comment-links">
								-
								<?php
								edit_comment_link( __( 'Edit', 'focus' ), '' , ' ');
								comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
								?>
							</span><!-- .comment-links -->
						<?php endif ?>
					</div><!-- .comment-text-area-right -->
				</div><!-- .comment-meta .commentmetadata -->
				
				<div class="comment-content entry-content">
					<?php comment_text(); ?>
				</div>
			</div>
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for focus_comment()

if ( ! function_exists( 'focus_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since focus 1.0
 */
function focus_posted_on() {
	printf(
		__('Posted On %s in %s with %s.', 'focus'),
		get_the_date(),
		get_the_category_list(', '),
		sprintf(_n( 'One Comment', '%s Comments', get_comments_number(), 'focus' ), get_comments_number())
	);
	
	the_tags(__('Tagged: ', 'focus'), ', ', '.');
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since focus 1.0
 */
function focus_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so focus_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so focus_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in focus_categorized_blog
 *
 * @since focus 1.0
 */
function focus_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'focus_category_transient_flusher' );
add_action( 'save_post', 'focus_category_transient_flusher' );