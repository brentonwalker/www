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

<h1><?php printf( __( 'Tag: %s', 'elegantwhite' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div id="post" <?php post_class(); ?>>
  
  <?php if ( is_sticky() ) : ?><div class="post-title"><?php _e( 'Featured', 'elegantwhite' ); ?></div><?php endif; ?>
  
  <h1><a class="h1" href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h1>
  

  
  <div id="articledate"><span class="date"><?php elegantwhite_get_date(); ?></span></div>
  
    <?php if ( has_post_thumbnail() ) { ?><a href="<?php esc_url ( the_permalink() ); ?>"><div id="post-thumbnail"><?php the_post_thumbnail(); ?></div></a><?php } ?>
  
   <?php the_content( __( 'read more ...', 'elegantwhite' ) ); ?>
   
   
  <div class="clear"></div>
   <div id="next-article"></div>
  </div>

<?php endwhile; ?> 

 <p align="center" class="links"><?php next_posts_link('&laquo; '. __( 'older entries', 'elegantWhite').'') ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php previous_posts_link(''. __( 'newer entries', 'elegantWhite').' &raquo;'); ?></p>


<?php endif; ?>

</div>

<div id="sidebar">
<?php get_sidebar(); ?>
</div><div id="clear"></div>

</div>



<?php get_footer(); ?>