<?php $elegantwhite_options = get_option('elegantwhite_options'); ?>
<?php 
/*
Copyright: Themes by Fimply
Theme: elegantWhite

All rights reserved.
Alle Rechte vorbehalten.
*/
?>

<?php get_header(); ?>

<div id="second-container">

<div id="content">


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div id="post" <?php post_class(); ?>>
  
  <?php if ( is_sticky() ) : ?><div class="post-title"><?php _e( 'Featured', 'elegantwhite' ); ?></div><?php endif; ?>
  
  <h1><a class="h1" href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h1>
 
  
  <div id="articledate"><span class="date"><?php elegantwhite_get_date(); ?></span></div>
  
    <?php if ( has_post_thumbnail() ) { ?><a href="<?php esc_url ( the_permalink() ); ?>"><div id="post-thumbnail"><?php the_post_thumbnail(); ?></div></a><?php } ?>
  
   <?php the_content(); ?>
   
   
  <div id="clear"></div>
  
   <div class="page-links"><?php wp_link_pages('before=<div class="page-title">PAGES</div>'); ?></div>
    
    
    <?php if ( isset( $elegantwhite_options['author-box'] ) && esc_attr( $elegantwhite_options['author-box'] ) == 1 ) : ?>
    <div class="author">
    <div id="author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?></div><div id="author-description"><?php _e( 'Author', 'elegantWhite' ); ?>: <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a><p><?php echo get_the_author_meta('description'); ?></p></div></div><?php endif; ?>
    
    <?php if ( isset( $elegantwhite_options['show-tags'] ) && esc_attr( $elegantwhite_options['show-tags'] ) == 1 ) : ?><div class="tag-links"><?php the_tags('<div class="tags-title">TAGS</div>', '', ''); ?></div><div id="clear"></div><?php endif; ?>
     
     <?php if ( isset( $elegantwhite_options['show-categories'] ) && esc_attr( $elegantwhite_options['show-categories'] ) == 1 ) : ?><div class="category-links"><div class="tags-title"><?php _e( 'CATEGORIES', 'elegantWhite' ); ?></div><?php the_category(''); ?></div><div id="clear"></div><?php endif; ?>
  
  
  </div>
 <?php if ( isset( $elegantwhite_options['post-navi'] ) && esc_attr( $elegantwhite_options['post-navi'] ) == 0 ) : ?><p><div class="alignleft"><?php previous_post_link(); ?></div>    <div class="alignright"><?php next_post_link(); ?></div></p><?php endif; ?>
 <div id="clear"></div>
<?php endwhile; ?> 

<?php endif; ?>


<?php if ( comments_open() ) : ?>
<?php comments_template(); ?> 

<?php endif; ?>

</div>

<div id="sidebar">
<?php get_sidebar(); ?>
</div><div id="clear"></div>

</div>



<?php get_footer(); ?>