<?php
/**
 * Custom template tags for this theme.
 *
 * @package toothpaste
 * @since toothpaste 1.0
 */

if ( ! function_exists( 'toothpaste_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since toothpaste 1.0
 */
function toothpaste_content_nav( $nav_id ) {
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
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'toothpaste' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'toothpaste' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'toothpaste' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'toothpaste' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'toothpaste' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // toothpaste_content_nav

if ( ! function_exists( 'toothpaste_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since toothpaste 1.0
 */
function toothpaste_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'toothpaste' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'toothpaste' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
			</div><!-- .comment-author .vcard -->
				
			<footer>
				<?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ); ?>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'toothpaste' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
								/* translators: 1: date, 2: time */
								printf( __( '%1$s at %2$s', 'toothpaste' ), get_comment_date(), get_comment_time() );
							?>
						</time>
					</a>
					
					<span class="reply">
						<?php
						comment_reply_link(
							array_merge(
								$args,
								array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '&middot; ' )
							)
						);
						?>
					</span><!-- .reply -->

					<?php
						if ( current_user_can( 'edit_comment', get_comment_ID() ) ) echo '&middot; ';
						edit_comment_link( __( 'Edit', 'toothpaste' ), ' ' );
					?>
					
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content entry-content">
				<?php comment_text(); ?>
			</div>
			
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for toothpaste_comment()

if ( ! function_exists( 'toothpaste_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since toothpaste 1.0
 */
function toothpaste_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'toothpaste' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'toothpaste' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

if(!function_exists('toothpaste_display_logo')):
/**
 * Display the logo 
 */
function toothpaste_display_logo(){
	$logo = siteorigin_setting('general_logo');

	if(empty($logo)) {
		// Just display the site title
		bloginfo( 'name' );
		return;
	}
	
	// load the logo image
	$image = wp_get_attachment_image_src($logo, 'full');
	$height = $image[2];
	$width = $image[1];

	// echo $image;
	?><img src="<?php echo $image[0] ?>" width="<?php echo round($width) ?>" height="<?php echo round($height) ?>" /><?php
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since toothpaste 1.0
 */
function toothpaste_categorized_blog() {
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
		// This blog has more than 1 category so toothpaste_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so toothpaste_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in toothpaste_categorized_blog
 *
 * @since toothpaste 1.0
 */
function toothpaste_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'toothpaste_category_transient_flusher' );
add_action( 'save_post', 'toothpaste_category_transient_flusher' );

/**
 * Return the archive title depending on which page is being displayed.
 * 
 * @since toothpaste 1.0
 */
function toothpaste_get_archive_title(){
	$title = '';
	if ( is_category() ) {
		$title = sprintf( __( 'Category Archives: %s', 'toothpaste' ), '<span>' . single_cat_title( '', false ) . '</span>' );

	}
	elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag Archives: %s', 'toothpaste' ), '<span>' . single_tag_title( '', false ) . '</span>' );

	}
	elseif ( is_author() ) {
		the_post();
		$title = sprintf( __( 'Author Archives: %s', 'toothpaste' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
		rewind_posts();

	}
	elseif ( is_day() ) {
		$title = sprintf( __( 'Daily Archives: %s', 'toothpaste' ), '<span>' . get_the_date() . '</span>' );

	}
	elseif ( is_month() ) {
		$title = sprintf( __( 'Monthly Archives: %s', 'toothpaste' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

	}
	elseif ( is_year() ) {
		$title = sprintf( __( 'Yearly Archives: %s', 'toothpaste' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

	}
	else {
		$title = __( 'Archives', 'toothpaste' );
	}
	
	return apply_filters('toothpaste_archive_title', $title);
}

/**
 * Get the post meta.
 * 
 * @since toothpaste 1.0
 */
function toothpaste_get_post_meta(){
	/* translators: used between list items, there is a space after the comma */
	$category_list = get_the_category_list( __( ', ', 'toothpaste' ) );

	/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list( '', __( ', ', 'toothpaste' ) );

	if ( ! toothpaste_categorized_blog() ) {
		// This blog only has 1 category so we just need to worry about tags in the meta text
		if ( '' != $tag_list ) {
			$meta_text = __( 'This entry was tagged %2$s.', 'toothpaste' );
		} else {
			$meta_text = '';
		}

	} else {
		// But this blog has loads of categories so we should probably display them here
		if ( '' != $tag_list ) {
			$meta_text = __( 'This entry was posted in %1$s and tagged %2$s.', 'toothpaste' );
		} else {
			$meta_text = __( 'This entry was posted in %1$s.', 'toothpaste' );
		}

	} // end check for categories on this blog
	
	$meta = sprintf(
		$meta_text,
		$category_list,
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
	
	return apply_filters('toothpaste_post_meta', $meta);
}