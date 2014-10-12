<?php get_header(); ?>
<?php global $shortname; ?>
<div id="container" class="grid_16">
  <div id="content" role="main">
    <h2 class="center">
      <?php _e( 'Error 404 - Not Found', 'bizstudio' ); ?>
    </h2>
  </div>
  <div class="skepost">
    <p>
      <?php _e( 'We bet this is not what you expected to see here!', 'bizstudio' ); ?>
    </p>
    <?php get_search_form(); ?>
  </div>
  
  <!-- skepost --> 
  
</div>

<!-- content --> 

<!-- Sidebar -->

<div id="siderbar" class="grid_6">
  <?php get_sidebar(); ?>
  <div class="clear"></div>
  
  <!-- Sidebar --> 
  
</div>
<?php get_footer(); ?>