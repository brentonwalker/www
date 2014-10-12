<?php
global $themename;
global $shortname;

/************************************************
*
*  enquque css and javascript
*
************************************************/

//enqueue jquery 

function bizstudio_script_enqueqe() {

	global $shortname;

	if(!is_admin())

	{

		wp_enqueue_script('jquery');

		wp_enqueue_script('flexslider_js', get_template_directory_uri() .'/js/jquery.flexslider.js',array('jquery'),'1.0' );

		wp_enqueue_script('bizstudio_componentssimple_slide', get_template_directory_uri().'/js/customscript.js',array('jquery'),'1.0' );

		wp_enqueue_script('bizstudio_jcarousel_js', get_template_directory_uri().'/js/jquery.jcarousel.js',array('jquery'),'1.0' );

        wp_enqueue_script('bizstudio_jflickrfeed_js', get_template_directory_uri().'/js/jflickrfeed.min.js',array('jquery'),'1.0' );

		wp_enqueue_script("comment-reply");}    

		wp_enqueue_script('bizstudio_mobilemenu_js', get_template_directory_uri().'/js/jquery.mobilemenu.js',array('jquery'),'1.0' );

}

add_action('wp_enqueue_scripts', 'bizstudio_script_enqueqe');

//enqueue admin css

function bizstudio_theme_stylesheet(){

global $themename;

global $shortname;

if ( !is_admin() ) {

	global $wp_version;

	$bizstudio_version = NULL;

		$theme = wp_get_theme();

		$bizstudio_version = $theme->Version;

	wp_enqueue_script('bizstudio_fancybox_mousewheel_slide', get_template_directory_uri().'/js/jquery.mousewheel-3.0.4.pack.js',array('jquery'),'1.0' );

	wp_enqueue_script('bizstudio_fancybox_slide', get_template_directory_uri().'/js/jquery.fancybox-1.3.4.pack.js',array('jquery'),'1.0' );

	wp_enqueue_script('bizstudio_ddsmoothmenusimple_slide', get_template_directory_uri().'/js/ddsmoothmenu.js',array('jquery'),'1.0' );

	wp_register_style( 'bizstudio-style', get_stylesheet_uri(), false, $bizstudio_version );

	wp_enqueue_style( 'bizstudio-style' );

	wp_register_style( 'bizstudio-theme-stylesheet', get_template_directory_uri().'/SketchBoard/css/skt-theme-stylesheet.css', false, $theme->Version );

	wp_enqueue_style( 'bizstudio-theme-stylesheet' );

	wp_register_style( 'flexslider-stylesheet', get_template_directory_uri().'/css/flexslider.css', false, $theme->Version );

	wp_enqueue_style( 'flexslider-stylesheet' );

	wp_register_style( 'flexslider-demo-stylesheet', get_template_directory_uri().'/css/demo.css', false, $theme->Version );

	wp_enqueue_style( 'flexslider-demo-stylesheet' );

	wp_register_style( 'fancybox-demo-stylesheet', get_template_directory_uri().'/css/jquery.fancybox-1.3.4.css', false, $theme->Version );

	wp_enqueue_style( 'fancybox-demo-stylesheet' );

	wp_register_style( 'jcarousel-stylesheet', get_template_directory_uri().'/css/jcarousel.css', false, $theme->Version );

	wp_enqueue_style( 'jcarousel-stylesheet' );

	wp_register_style( 'responsive-css', get_template_directory_uri().'/css/960_24_col_responsive.css', false, $theme->Version );

	wp_enqueue_style( 'responsive-css' );

	/*-- Google Fonts --*/

	wp_register_style( 'googleFontsTangerine','http://fonts.googleapis.com/css?family=Tangerine:400,700', false, $theme->Version);

	wp_enqueue_style( 'googleFontsTangerine' );

	wp_register_style( 'googleFontsABeeZee','http://fonts.googleapis.com/css?family=ABeeZee|Alice|Artifika|Bitter', false, $theme->Version);

	wp_enqueue_style( 'googleFontsABeeZee' );

	}

}

add_action('wp_enqueue_scripts', 'bizstudio_theme_stylesheet');



function bizstudio_head(){

	global $shortname;

	$bizstudio_favicon = "";

	$bizstudio_meta = '<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">'."\n";



	if(sketch_get_option($shortname.'_favicon')){

		$bizstudio_favicon = sketch_get_option($shortname.'_favicon','bizstudio');

		$bizstudio_meta .= "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"$bizstudio_favicon\"/>\n";

	}

	echo $bizstudio_meta;

}



add_action('wp_head', 'bizstudio_head');



//enqueue footer script 

function bizstudio_footer_script() {

	global $shortname;

	if(!is_admin())

	{

		require_once(get_template_directory().'/js/flexslider-slider-config.php');

	}

	if(bizstudio_bg_style($shortname."_bg_style") != Null){

	?>
    <style type="text/css">
.body-background {
<?php echo bizstudio_bg_style($shortname."_bg_style");
?>
}
</style>
    <?php

	}

}

add_action('wp_footer', 'bizstudio_footer_script');
