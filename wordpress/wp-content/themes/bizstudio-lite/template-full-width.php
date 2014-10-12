<?php 
/*
Template Name: Full Width
*/
get_header(); ?>
<?php global $shortname; ?>

<div id="full_Width" class="grid_23 alpha omega">
  <div id="content">
    <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <div class="entry">
        <?php the_content(); ?>
        <?php wp_link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
        <?php edit_post_link('Edit', '<p>', '</p>'); ?>
      </div>
    </div>
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
<!-- content -->
<?php get_footer(); ?>