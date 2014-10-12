<?php get_header(); ?>
<?php global $shortname; ?>
<div id="container" class="grid_16">
  <div id="content">
    <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <?php $src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ,'full'); ?>
      <div class="post-image">
        <?php if($src) { ?>
        <?php the_post_thumbnail('full'); ?>
        <?php } ?>
      </div>
      <div class="entry clearfix">
        <div class="entry-meta"> <span class="author-name">
          <?php the_author_posts_link(); ?>
          </span> <span class="date-time">
          <?php the_time('jS, Y') ?>
          </span> <span class="category-name">
          <?php the_category(','); ?>
          </span> </div>
        <div class="single_content clearfix">
          <?php the_content(); ?>
        </div>
      </div>
      <div class="post-tags">
        <?php _e('Tags:','bizstudio'); ?>
        <?php the_tags(''); ?>
      </div>
      
      <!-- post tags -->
      
      <?php wp_link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="navigation"> <span class="nav-previous">
      <?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bizstudio' ) . '</span> %title' ); ?>
      </span> <span class="nav-next">
      <?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bizstudio' ) . '</span>' ); ?>
      </span> </div>
    <div class="clearfix"></div>
    <div class="comments-template">
      <?php comments_template(); ?>
    </div>
    <?php endwhile; ?>
    <?php else :  ?>
    <div class="post">
      <h2>
        <?php _e('Not Found','bizstudio'); ?>
      </h2>
    </div>
    <?php endif; ?>
  </div>
  
  <!-- content --> 
  
</div>

<!-- container --> 

<!-- Sidebar -->

<div id="siderbar" class="grid_6">
  <?php get_sidebar(); ?>
  <div class="clear"></div>
  <!-- Sidebar --> 
</div>
<?php get_footer(); ?>