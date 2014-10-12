<?php
/**
 * Custom template tags for this theme.
 *
 * @package so-current
 * @since so-current 1.0
 * @license GPL 2.0
 */

if ( ! function_exists( 'so_current_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since so-current 1.0
 */
function so_current_content_nav( $nav_id ) {
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
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'so-current' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'so-current' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'so-current' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'so-current' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'so-current' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // so_current_content_nav

if ( ! function_exists( 'so_current_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since so-current 1.0
 */
function so_current_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'so-current' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'so-current' ), ' ' ); ?></p>
			<?php
			break;
		default :
			?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">

					<footer>
						<?php echo get_avatar( $comment, 60 ); ?>
					</footer>

					<footer style="display: none">
						<div class="comment-author vcard">
							<?php echo get_avatar( $comment, 40 ); ?>
							<?php printf( __( '%s <span class="says">says:</span>', 'so-current' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
						</div><!-- .comment-author .vcard -->
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php _e( 'Your comment is awaiting moderation.', 'so-current' ); ?></em>
							<br />
						<?php endif; ?>
		
						<div class="comment-meta commentmetadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
							<?php
								/* translators: 1: date, 2: time */
								printf( __( '%1$s at %2$s', 'so-current' ), get_comment_date(), get_comment_time() ); ?>
							</time></a>
						</div><!-- .comment-meta .commentmetadata -->
					</footer>

					<div class="comment-text">
						<div class="comment-author"><?php echo get_comment_author_link() ?></div>
						<div class="comment-date"><?php echo get_comment_date() ?></div>
						<div class="comment-content entry-content">
							<?php comment_text(); ?>
						</div>
					</div>
		
					<div class="comment-action-links">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						<?php edit_comment_link( __( 'Edit', 'so-current' ), ' ' ) ?>
					</div><!-- .reply -->
				</article><!-- #comment-## -->

			<?php
			break;
	endswitch;
}
endif; // ends check for so_current_comment()

if ( ! function_exists( 'so_current_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since so-current 1.0
 */
function so_current_posted_on() {
	printf( __( 'Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> by <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'so-current' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'so-current' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

if(!function_exists('so_current_display_logo')):
/**
 * Display the logo 
 */
function so_current_display_logo(){
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
 * @since so-current 1.0
 */
function so_current_categorized_blog() {
	if ( false === ( $count = get_transient( 'so_current_categorized_blog_cache_count' ) ) ) {
		// Count the number of non-empty categories
		$count = count( get_categories( array(
			'hide_empty' => 1,
		) ) );
		
		// Count the number of categories that are attached to the posts
		set_transient( 'so_current_categorized_blog_cache_count', $count );
	}
	
	// Return true if this blog has categories, or else false.
	return ($count >= 1);
}

/**
 * Flush out the transients used in so_current_categorized_blog
 *
 * @since so-current 1.0
 */
function so_current_category_transient_flusher() {
	delete_transient( 'so_current_categorized_blog_cache_count' );
}
add_action( 'edit_category', 'so_current_category_transient_flusher' );
add_action( 'save_post', 'so_current_category_transient_flusher' );

/**
 * Return the archive title depending on which page is being displayed.
 * 
 * @since so-current 1.0
 */
function so_current_get_archive_title(){
	$title = '';
	if ( is_category() ) {
		$title = sprintf( __( 'Category Archives: %s', 'so-current' ), '<span>' . single_cat_title( '', false ) . '</span>' );

	}
	elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag Archives: %s', 'so-current' ), '<span>' . single_tag_title( '', false ) . '</span>' );

	}
	elseif ( is_author() ) {
		the_post();
		$title = sprintf( __( 'Author Archives: %s', 'so-current' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
		rewind_posts();

	}
	elseif ( is_day() ) {
		$title = sprintf( __( 'Daily Archives: %s', 'so-current' ), '<span>' . get_the_date() . '</span>' );

	}
	elseif ( is_month() ) {
		$title = sprintf( __( 'Monthly Archives: %s', 'so-current' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

	}
	elseif ( is_year() ) {
		$title = sprintf( __( 'Yearly Archives: %s', 'so-current' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

	}
	else {
		$title = __( 'Archives', 'so-current' );
	}
	
	return apply_filters('so_current_archive_title', $title);
}

/**
 * Get the post meta.
 * 
 * @since so-current 1.0
 */
function so_current_get_post_meta(){
	/* translators: used between list items, there is a space after the comma */
	$category_list = get_the_category_list( __( ', ', 'so-current' ) );

	/* translators: used between list items, there is a space after the comma */
	$tag_list = get_the_tag_list( '', __( ', ', 'so-current' ) );

	if ( ! so_current_categorized_blog() ) {
		// This blog only has 1 category so we just need to worry about tags in the meta text
		if ( '' != $tag_list ) {
			$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'so-current' );
		} else {
			$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'so-current' );
		}

	} else {
		// But this blog has loads of categories so we should probably display them here
		if ( '' != $tag_list ) {
			$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'so-current' );
		} else {
			$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'so-current' );
		}

	} // end check for categories on this blog

	$meta = sprintf(
		$meta_text,
		$category_list,
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
	
	return apply_filters('so_current_post_meta', $meta);
}

/**
 * Gets the URL that should be displayed when clicking on an image in the view image page.
 * 
 * @param null $post
 * @return string
 */
function so_current_next_attachment_url($post = null){
	if(empty($post)){
		global $post;
	}
	
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 */
	$attachments = array_values( get_children( array(
		'post_parent'    => $post->post_parent,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) ){
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		}
		else{
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
		}
			
	}
	else {
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
	
	return $next_attachment_url;
}

function so_current_page_header(){
	if(is_home() && siteorigin_setting('home_message')){
		if(siteorigin_setting('home_message_image')) {
			$image = wp_get_attachment_image_src(siteorigin_setting('home_message_image'), 'original');
		}

		?>
		<div id="page-header">
			<div class="container">
				<div class="home-text">
					<h2><?php echo esc_html(siteorigin_setting('home_message_title')) ?></h2>
					<h4><?php echo esc_html(siteorigin_setting('home_message_text')) ?></h4>
					<a href="<?php echo esc_url(siteorigin_setting('home_message_url')) ?>" class="button"><?php echo esc_html(siteorigin_setting('home_message_button')) ?></a>
				</div>
				<div class="image-frame-wrapper">
					<div class="image-frame image-frame-<?php echo esc_attr(siteorigin_setting('home_message_frame')) ?>">
						<div class="image-frame-image" <?php if(!empty($image)) echo 'style="background-image: url('.esc_url($image[0]).')"' ?>></div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	elseif(is_archive()) {
		if ( is_category() ) {
			// show an optional category description
			$description = category_description();
			if ( ! empty( $category_description ) )
				$description = apply_filters( 'so_current_category_archive_meta', '<div class="excerpt">' . $description . '</div>' );

		}
		elseif ( is_tag() ) {
			// show an optional tag description
			$description = tag_description();
			if ( ! empty( $description ) )
				$description = apply_filters( 'so_current_tag_archive_meta', '<div class="excerpt">' . $description . '</div>' );
		}
		?>
		<div id="page-header">
			<div class="container">
				<h1><?php echo so_current_get_archive_title() ?></h1>
				<?php if(!empty($description)) echo $description; ?>
			</div>
		</div>
		<?php
	}
	elseif(is_singular()) {
		/* translators: used between list items, there is a space after the comma */
		$category_list = get_the_category_list( __( ', ', 'so-current' ) );

		/* translators: used between list items, there is a space after the comma */
		$tag_list = get_the_tag_list( '', __( ', ', 'so-current' ) );

		?>
		<div id="page-header">
			<div class="container">
				<h1><?php single_post_title() ?></h1>
				<?php if(is_page()) : ?>
					<?php if(get_the_excerpt()) : ?>
						<div class="excerpt">
							<?php the_excerpt() ?>
						</div>
					<?php endif; ?>
				<?php else : ?>
					<ul class="meta">
						<li class="date"><?php echo get_the_date() ?></li>
						<li class="comments"><?php comments_number( __('No Comments', 'so-current'), __('One Comment', 'so-current'), __('% Comments', 'so-current') ); ?>.</li>
						<?php if(so_current_categorized_blog() && !empty($category_list)) : ?>
							<li class="categories"><?php echo $category_list ?></li>
						<?php endif ?>

						<?php if(!empty($tag_list)) : ?>
							<li class="tags"><?php echo $tag_list ?></li>
						<?php endif ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
	elseif(is_404()){
		?>
		<div id="page-header">
			<div class="container">
				<h1><?php _e('Page Not Found', 'so-current') ?></h1>
			</div>
		</div>
		<?php
	}
	else {
		?>
		<div id="page-header" class="empty"></div>
		<?php
	}
}

function so_current_placeholder_thumbnail(){
	?><img src="<?php echo get_template_directory_uri() ?>/images/placeholder.png" width="320" height="156" /><?php
}