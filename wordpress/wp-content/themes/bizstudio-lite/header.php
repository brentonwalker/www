<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 	global $shortname;	global $themename;?>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
<div class="container_24 clearfix hfeed" id="wrapper">
<div id="wrapper-mid" class="container_24 clearfix">
<div id="header" class="clearfix">
  <div id="masthead" class="clearfix"> 
    <!-- #logo -->
    <div id="logo" class="grid_6 clearfix">
      <?php if(sketch_get_option($shortname."_logo_img")){ ?>
      <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" rel="home"> <img src="<?php echo sketch_get_option($shortname."_logo_img"); ?>" alt="<?php echo sketch_get_option($shortname."_logo_alt"); ?>"/> </a>
      <?php } else{ ?>
      <h1 id="site-title"> <span> <a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
        <?php bloginfo( 'name' ); ?>
        </a> </span> </h1>
      <div class="clear"></div>
      <div id="site-description">
        <?php bloginfo( 'description' ); ?>
      </div>
      <?php } ?>
    </div>
    
    <!-- #logo --> 
    
    <!-- #navigation -->
    <div id="nav" class="grid_17 clearfix">
      <div class="navi clearfix">
        <div id="skenav">
          <?php 

				if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'Header' ) ) {

					wp_nav_menu(array( 'container_class' => 'menu', 'container_id' => 'menu-container', 'menu_id' => 'menu-main','theme_location' => 'Header' )); 

				} else {

				?>
          <div class="menu" id="menu-container">
            <ul id="menu-main" class="menu">
              <?php wp_list_pages('title_li=&depth=0'); ?>
            </ul>
          </div>
          
          <!-- #menu-container -->
          
          <?php

				}

				?>
        </div>
        <!-- #skenav -->   
      </div>
      <!--navi--> 
    </div>
  </div>
  
  <!-- #masthead -->
  
  <?php $classes = get_body_class(); ?>
  <?php if(in_array('front-page',$classes)) { ?>
  
  <!-- flexslider jQuery Slider -->
  
  <div class="flexslider">
    <ul class="slides">
      <li> <a href="<?php if(sketch_get_option($shortname.'_slider_link1')) { echo sketch_get_option($shortname.'_slider_link1'); } ?>"><img src="<?php if(sketch_get_option($shortname.'_slider_img1')) { echo sketch_get_option($shortname.'_slider_img1'); } ?>" width="940" height="450" alt="Sliderimg"/></a>
        <?php if(sketch_get_option($shortname.'_content_slider1')) { ?>
		<p class="flex-caption">
           <?php echo sketch_get_option($shortname.'_content_slider1'); ?>
        </p>
		<?php } ?>
      </li>
      <li> <a href="<?php if(sketch_get_option($shortname.'_slider_link2')) { echo sketch_get_option($shortname.'_slider_link2'); } ?>"><img src="<?php if(sketch_get_option($shortname.'_slider_img2')) { echo sketch_get_option($shortname.'_slider_img2'); } ?>" width="940" height="450" alt="Sliderimg"/></a>
	  <?php if(sketch_get_option($shortname.'_content_slider2')) { ?>
        <p class="flex-caption">
          <?php echo sketch_get_option($shortname.'_content_slider2'); ?>
        </p>
		<?php } ?>
      </li>
      <li> <a href="<?php if(sketch_get_option($shortname.'_slider_link3')) { echo sketch_get_option($shortname.'_slider_link3'); } ?>"><img src="<?php if(sketch_get_option($shortname.'_slider_img3')) { echo sketch_get_option($shortname.'_slider_img3'); } ?>" width="940" height="450" alt="Sliderimg"/></a>
	  <?php if(sketch_get_option($shortname.'_content_slider3')) { ?>
        <p class="flex-caption">
          <?php echo sketch_get_option($shortname.'_content_slider3'); ?>
        </p>
		<?php } ?>
      </li>
    </ul>
  </div>
  
  <!-- end flexslider jQuery Slider -->
  
  <?php } ?>
</div>
<!-- #header -->
<div id="main">