<?php get_header(); ?>
<?php global $shortname; ?>
<div id="container" class="grid_16">
  <div id="content" role="main">
    <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>">
      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title(); ?>
        </a></h2>
      <div class="post-image clearfix">
        <?php

				if(has_post_thumbnail())

				{ ?>
        <?php 

				  $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'bizstudio_standard_img');

				  $pretty_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');

			?>
        <a href="<?php echo $pretty_thumb[0];?>" rel="blog_posts"><img src="<?php echo $thumbnail[0];?>" /><i class="fade"></i></a>
        <?php } ?>
      </div>
      <div class="entry-meta"> <span class="author-name">
        <?php the_author_posts_link(); ?>
        </span> <span class="date-time">
        <?php the_time('jS, Y') ?>
        </span> <span class="category-name">
        <?php the_category(','); ?>
        </span> <span class="comment">
        <?php comments_popup_link(__('No Comments ','bizstudio'), __('1 Comment ','bizstudio'), __('% Comments ','bizstudio')) ; ?>
        </span> </div>
      <div class="entry clearfix">
        <?php the_content(); ?>
      </div>
      <div class="post-tags">
        <?php _e('Tags:','bizstudio'); ?>
        <?php the_tags(''); ?>
      </div>
      
      <!-- post tags -->
      
      <?php wp_link_pages('<p class="clear"><strong>Pages:</strong> ', '</p>', 'number'); ?>
      <?php edit_post_link('Edit', '<p>', '</p>'); ?>
    </div>
    <div class="clearfix"></div>
    
    <!--border-post-->
    
    <div class="border-post"></div>
    
    <!--border-post--> 
    
    <!--Start Comment box-->
    
    <?php comments_template(); ?>
    
    <!--End comment Section-->
    
    <?php endwhile; ?>
    
    <!--pagination-->
    
    <div class="pagination">
      <?php  if (function_exists("bizstudio_paginate") && sketch_get_option($shortname.'_show_pagination')) { bizstudio_paginate(); } else {?>
      <div class="alignleft">
        <?php previous_posts_link(__('&larr;Previous','bizstudio')) ?>
      </div>
      <div class="alignright">
        <?php next_posts_link(__('Next&rarr;','bizstudio'),'') ?>
      </div>
      <?php } ?>
    </div>
    <?php else :  ?>
    <div class="post">
      <h2>
        <?php _e('Not Found','bizstudio'); ?>
      </h2>
    </div>
    <?php endif; ?>
  </div>
</div>

<!-- content --> 

<!-- Sidebar -->

<div id="siderbar" class="grid_6">
  <?php get_sidebar(); ?>
  <div class="clear"></div>
  <!-- Sidebar --> 
</div>
<?php get_footer(); ?>