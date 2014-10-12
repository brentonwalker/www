<?php
/**
 * @package web2feel
 * @since web2feel 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?>>


	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'web2feel' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			
            <span class="entry-author"><?php _e('Posted by', 'web2feel') ?> <?php the_author_posts_link(); ?></span>
            <span class="comment-count"> | <?php comments_popup_link(__('0 Comments', 'web2feel'), __('1 Comment', 'web2feel'), __('% Comments', 'web2feel')); ?></span>   
		</div><!-- .entry-meta -->
	
	</header><!-- .entry-header -->

	<?php if ( is_search() || is_archive() || is_home() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'web2feel' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'web2feel' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	</article><!-- #post-<?php the_ID(); ?> -->
