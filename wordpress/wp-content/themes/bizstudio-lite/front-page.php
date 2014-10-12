<?php
if ( 'page' == get_option( 'show_on_front' ) ) {
	if ( sketch_get_option($shortname.'_hide_frontlayout') == 'false') {
	get_header();
	global $shortname; 
?>

<!-- #box --->

<div class="twitter-bg">
  <?php 
							$wrap_class = "text-wrap";
					?>
  <div class="<?php echo $wrap_class;?>">
    <div class="twitter">
      <div id="twitter_div">
        <ul id="twitter_update_list">
          <li>
            <?php if(sketch_get_option($shortname."_mid_sidebar_text")){ echo sketch_get_option($shortname."_mid_sidebar_text");} else { echo 'A Multipurpose, Responsive WordPress Theme with Fullwidth BG.';} ?>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!--#twitter-->

<div class="front-page-box clearfix">
  <div class="box-container widget_text grid_7">
    <div class="title">
      <?php if(sketch_get_option($shortname.'_fb1_heading')){ echo sketch_get_option($shortname.'_fb1_heading','bizstudio'); } else { ?>
      <?php _e('Creative','bizstudio'); } ?>
    </div>
    <div class="textwidget"><a href="javascript:void(0);"> <img src="<?php if(sketch_get_option($shortname.'_fb1_icon')){ echo sketch_get_option($shortname.'_fb1_icon','bizstudio'); } else { echo get_template_directory_uri() ?>/images/wPimage-creative.png <?php } ?>"/></a>
      <div class="text">
        <?php if(sketch_get_option($shortname.'_fb1_content')){ echo sketch_get_option($shortname.'_fb1_content','bizstudio'); } else { _e('We have the most talented people in house that are excited to start with your new project. It&#39;s the drive that makes them creative.','bizstudio'); } ?>
      </div>
    </div>
  </div>
  <div class="box-container widget_text grid_7">
    <div class="title">
      <?php if(sketch_get_option($shortname.'_fb2_heading')){ echo sketch_get_option($shortname.'_fb2_heading','bizstudio'); } else { ?>
      <?php _e('Multipurpose','bizstudio'); } ?>
    </div>
    <div class="textwidget"><a href="javascript:void(0);"> <img src="<?php if(sketch_get_option($shortname.'_fb2_icon')){ echo sketch_get_option($shortname.'_fb2_icon','bizstudio'); } else { echo get_template_directory_uri() ?>/images/wPimage-multipurpose.png <?php } ?>"/></a>
      <div class="text">
        <?php if(sketch_get_option($shortname.'_fb2_content')){ echo sketch_get_option($shortname.'_fb2_content','bizstudio'); } else { _e('We have the most talented people in house that are excited to start with your new project. It&#39;s the drive that makes them creative.','bizstudio'); } ?>
      </div>
    </div>
  </div>
  <div class="box-container widget_text grid_7">
    <div class="title">
      <?php if(sketch_get_option($shortname.'_fb3_heading')){ echo sketch_get_option($shortname.'_fb3_heading','bizstudio'); } else { ?>
      <?php _e('Responsive','bizstudio'); } ?>
    </div>
    <div class="textwidget"><a href="javascript:void(0);"> <img src="<?php if(sketch_get_option($shortname.'_fb3_icon')){ echo sketch_get_option($shortname.'_fb3_icon','bizstudio'); } else { echo get_template_directory_uri() ?>/images/wPimage-responsive.png <?php } ?>"/></a>
      <div class="text">
        <?php if(sketch_get_option($shortname.'_fb3_content')){ echo sketch_get_option($shortname.'_fb3_content','bizstudio'); } else { _e('We have the most talented people in house that are excited to start with your new project. It&#39;s the drive that makes them creative.','bizstudio'); } ?>
      </div>
    </div>
  </div>
</div>
<div class="content">
  <div class="title">
    <?php if(sketch_get_option($shortname.'_main_heading')){ echo sketch_get_option($shortname.'_main_heading','bizstudio'); } else { ?>
    <?php _e('Welcome To Our Website!','bizstudio'); } ?>
  </div>
  <p>
    <?php if(sketch_get_option($shortname.'_main_content')){ echo sketch_get_option($shortname.'_main_content','bizstudio'); } else { _e(' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed enim erat, fringilla et dignissim et, sollicitudin ut sem. Fusce sit amet massa mi, id hendrerit quam. Donec vulputate tincidunt turpis eget varius. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed enim erat, fringilla et dignissim et, sollicitudin ut sem. Fusce sit amet massa mi, id hendrerit quam. Donec vulputate tincidunt turpis eget varius.','bizstudio'); } ?>
  </p>
</div>

<!--#content--> 

<!--#recentpost-->

<div class="recent-post clearfix ">
  <div class="box grid_7">
    <div class="image-bg"><a rel="home_group" class="hover_zoom" href="<?php if(sketch_get_option($shortname.'_rp1_icon')){ echo sketch_get_option($shortname.'_rp1_icon','bizstudio'); }  else { echo get_template_directory_uri() ?>/images/post-image.jpg <?php } ?>"><img src="<?php if(sketch_get_option($shortname.'_rp1_icon')){ echo sketch_get_option($shortname.'_rp1_icon','bizstudio'); }  else { echo get_template_directory_uri() ?>/images/post-image.jpg<?php } ?>"/><i class="fade"></i></a></div>
    <img src="<?php echo get_template_directory_uri(); ?>/images/recent-shadow-image.png" alt="shadow" class="shadow" />
    <div class="title">
      <?php if(sketch_get_option($shortname.'_rp1_heading')){ echo sketch_get_option($shortname.'_rp1_heading','bizstudio'); } else { ?>
      <?php _e('Bespoke Development','bizstudio'); } ?>
    </div>
    <div class="text">
      <?php if(sketch_get_option($shortname.'_rp1_content')){ echo sketch_get_option($shortname.'_rp1_content','bizstudio'); } else { _e('Duis sed tempus ante. Sed sollic itudin lacus vitae eros semper semper ac scelerisque nisl. Maecenas tortor lectus,...','bizstudio'); } ?>
    </div>
  </div>
  
  <!--#first-->
  
  <div class="box grid_7">
    <div class="image-bg"><a rel="home_group" class="hover_zoom" href="<?php if(sketch_get_option($shortname.'_rp2_icon')){ echo sketch_get_option($shortname.'_rp2_icon','bizstudio'); }  else { echo get_template_directory_uri() ?>/images/water-165219_640.jpg <?php } ?>"><img src="<?php if(sketch_get_option($shortname.'_rp2_icon')){ echo sketch_get_option($shortname.'_rp2_icon','bizstudio'); }  else { echo get_template_directory_uri() ?>/images/water-165219_640.jpg<?php } ?>"/><i class="fade"></i></a></div>
    <img src="<?php echo get_template_directory_uri(); ?>/images/recent-shadow-image.png" alt="shadow" class="shadow" />
    <div class="title">
      <?php if(sketch_get_option($shortname.'_rp2_heading')){ echo sketch_get_option($shortname.'_rp2_heading','bizstudio'); } else { ?>
      <?php _e('Tailored Solutions','bizstudio'); } ?>
    </div>
    <div class="text">
      <?php if(sketch_get_option($shortname.'_rp2_content')){ echo sketch_get_option($shortname.'_rp2_content','bizstudio'); } else { _e('Duis sed tempus ante. Sed sollic itudin lacus vitae eros semper semper ac scelerisque nisl. Maecenas tortor lectus,...','bizstudio'); } ?>
    </div>
  </div>
  
  <!--#second-->
  
  <div class="box grid_7">
    <div class="image-bg"><a rel="home_group" class="hover_zoom" href="<?php if(sketch_get_option($shortname.'_rp3_icon')){ echo sketch_get_option($shortname.'_rp3_icon','bizstudio'); }  else { echo get_template_directory_uri() ?>/images/blue-69764_640.jpg <?php } ?>"><img src="<?php if(sketch_get_option($shortname.'_rp3_icon')){ echo sketch_get_option($shortname.'_rp3_icon','bizstudio'); } else { echo get_template_directory_uri() ?>/images/blue-69764_640.jpg<?php } ?>"/><i class="fade"></i></a></div>
    <img src="<?php echo get_template_directory_uri(); ?>/images/recent-shadow-image.png" alt="shadow" class="shadow" />
    <div class="title">
      <?php if(sketch_get_option($shortname.'_rp3_heading')){ echo sketch_get_option($shortname.'_rp3_heading','bizstudio'); } else { ?>
      <?php _e('Elegant Business Model','bizstudio'); } ?>
    </div>
    <div class="text">
      <?php if(sketch_get_option($shortname.'_rp3_content')){ echo sketch_get_option($shortname.'_rp3_content','bizstudio'); } else { _e('Duis sed tempus ante. Sed sollic itudin lacus vitae eros semper semper ac scelerisque nisl. Maecenas tortor lectus,...','bizstudio'); } ?>
    </div>
  </div>
  
  <!--#third-->
  
  <div class="box-radius"></div>
</div>

<!--#recentpost--> 

<!-- box --> 

<!-- #imageslider -->

<ul id="mycarousel" class="jcarousel-skin-tango">
  <li><a href="#" title="<?php if(sketch_get_option($shortname.'_img1_title')){ echo sketch_get_option($shortname.'_img1_title','bizstudio'); } ?>"><img src="<?php if(sketch_get_option($shortname.'_img1_icon')){ echo sketch_get_option($shortname.'_img1_icon','bizstudio'); } else { echo get_template_directory_uri();?>/images/slides/jcslide1.png <?php } ?>" alt="" /></a></li>
  <li><a href="#" title="<?php if(sketch_get_option($shortname.'_img2_title')){ echo sketch_get_option($shortname.'_img2_title','bizstudio'); } ?>"><img src="<?php if(sketch_get_option($shortname.'_img2_icon')){ echo sketch_get_option($shortname.'_img2_icon','bizstudio'); } else { echo get_template_directory_uri();?>/images/slides/jcslide2.png <?php } ?>" alt="" /></a></li>
  <li><a href="#" title="<?php if(sketch_get_option($shortname.'_img3_title')){ echo sketch_get_option($shortname.'_img3_title','bizstudio'); } ?>"><img src="<?php if(sketch_get_option($shortname.'_img3_icon')){ echo sketch_get_option($shortname.'_img3_icon','bizstudio'); } else { echo get_template_directory_uri();?>/images/slides/jcslide3.png <?php } ?>" alt="" /></a></li>
  <li><a href="#" title="<?php if(sketch_get_option($shortname.'_img4_title')){ echo sketch_get_option($shortname.'_img4_title','bizstudio'); } ?>"><img src="<?php if(sketch_get_option($shortname.'_img4_icon')){ echo sketch_get_option($shortname.'_img4_icon','bizstudio'); } else { echo get_template_directory_uri();?>/images/slides/jcslide4.png <?php } ?>" alt="" /></a></li>
  <li><a href="#" title="<?php if(sketch_get_option($shortname.'_img5_title')){ echo sketch_get_option($shortname.'_img5_title','bizstudio'); } ?>"><img src="<?php if(sketch_get_option($shortname.'_img5_icon')){ echo sketch_get_option($shortname.'_img5_icon','bizstudio'); } else { echo get_template_directory_uri();?>/images/slides/jcslide5.png <?php } ?>" alt="" /></a></li>
</ul>

<!-- #imageslider --> 

<!-- content -->

<?php get_footer(); ?>
<?php 
}else{  include('index-page.php'); }
} else {
	include( get_home_template() );
}
 ?>