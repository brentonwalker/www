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
  
  
  
  <div id="articledate"><span class="date"><?php elegantwhite_get_date(); ?>&nbsp;&nbsp;&nbsp;<?php edit_post_link( __( 'Edit article', 'elegantwhite' ), '<span class="edit-link">', '</span>' ); ?></span></div>
  
  
  
 <?php 

$size = "large";
$icon = "false"; 

echo wp_get_attachment_image( $attachment_id, $size, $icon, '' ); ?>

 <p> <div class="alignleft"><?php previous_image_link('', ''. __( 'Previous image', 'elegantwhite' ) .'') ?></div><div class="alignright"><?php next_image_link( '', ''. __( 'Next image', 'elegantwhite' ) .'' ); ?> </div>  </p>    
   
  <div id="clear"></div>
  
  
  
  </div>

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