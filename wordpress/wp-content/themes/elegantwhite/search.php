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

<h1><?php _e( 'Search results for:', 'elegantwhite' ); ?><?php echo ' '.$_GET['s']; ?></h1>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div id="post" <?php post_class(); ?>>
  
  <?php if ( is_sticky() ) : ?><div class="post-title"><?php _e( 'Featured', 'elegantwhite' ); ?></div><?php endif; ?>
  
  <h1><a class="h1" href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h1>
  
  
  <div id="articledate"><span class="date"><?php elegantwhite_get_date(); ?></span></div>
  
    <?php the_content( __( 'read more ...', 'elegantwhite' ) ); ?>
   
   
  <div class="clear"></div>
   <div id="next-article"></div>
  </div>

<?php endwhile; ?> 

<?php else : ?>
	<h4><?php _e( 'No Search Result Found', 'elegantwhite'); ?></h4>
		
			<?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'elegantwhite'); ?>

<p><?php get_search_form(); ?></p>


<?php endif; ?>

</div>

<div id="sidebar">
<?php get_sidebar(); ?>
</div><div id="clear"></div>

</div>



<?php get_footer(); ?>