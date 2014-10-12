<?php get_header(); ?>
<?php global $shortname; ?>
<div id="container" class="grid_16">
  <div id="content">
    <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
    <div class="post clearfix" id="post-<?php the_ID(); ?>">
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <?php if(!is_home()){

					     if ((class_exists('bizstudio_breadcrumb_class'))) {$bizstudio_breadcumb->custom_breadcrumb();}
					    }
					?>
      <div class="entry clearfix">
        <?php the_content(); ?>
        <?php wp_link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
      </div>
      <?php edit_post_link('Edit', '<p>', '</p>'); ?>
    </div>
    
    <!--Start Comment box-->
    
    <?php comments_template(); ?>
    
    <!--End comment Section-->
    
    <?php endwhile; ?>
    <?php else :  ?>
    <div class="post">
      <h2>
        <?php _e('Not Found','bizstudio'); ?>
      </h2>
    </div>
    <?php endif; ?>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>

<!-- container --> 

<!-- Sidebar -->

<div id="siderbar" class="grid_6">
  <?php get_sidebar(); ?>
  <div class="clear"></div>
  <!-- Sidebar --> 
</div>
<?php get_footer(); ?>