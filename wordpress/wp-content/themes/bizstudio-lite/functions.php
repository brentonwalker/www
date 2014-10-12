<?php

//	Registers the Widgets and Sidebars 

function bizstudio_widgets_init() {

register_sidebar(array(

	'name' => 'primary-widget-area',

	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

	'after_widget' => '</li>',

	'before_title' => '<h3 class="widget-title">',

	'after_title' => '</h3>',

));

register_sidebar(array(

	'name' => 'secondary-widget-area',

	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

	'after_widget' => '</li>',

	'before_title' => '<h3 class="widget-title">',

	'after_title' => '</h3>',

));

register_sidebar(array(

	'name' => 'first-footer-widget-area',

	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

	'after_widget' => '</li>',

	'before_title' => '<h3 class="widget-title">',

	'after_title' => '</h3>',

));

register_sidebar(array(

	'name' => 'second-footer-widget-area',

	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

	'after_widget' => '</li>',

	'before_title' => '<h3 class="widget-title">',

	'after_title' => '</h3>',

));

register_sidebar(array(

	'name' => 'third-footer-widget-area',

	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',

	'after_widget' => '</li>',

	'before_title' => '<h3 class="widget-title">',

	'after_title' => '</h3>',

));

}

add_action( 'widgets_init', 'bizstudio_widgets_init' );



/***************register nav menus*********************/

function bizstudio_nav_menus_call() {

	global $shortname;

	

	register_nav_menus( array(

		'Header' => __( 'Main Navigation', 'bizstudio' ),

	));

	

}

add_action( 'after_setup_theme', 'bizstudio_nav_menus_call' ); 





function the_commenter_avatar() {

    $email = get_comment_author_email();

    $avatar = get_avatar( "$email", "40"  );

    echo $avatar;

}



function bizstudio_new_excerpt_more($more) {

       global $post;

	return '<div><a class="readmore" href="'. get_permalink($post->ID) . '">Read More </a></div>';

}

add_filter('excerpt_more', 'bizstudio_new_excerpt_more');



/***** Make theme available for translation ****/

// Translations can be filed in the /languages/ directory



function bizstudio_lang_setup(){

	load_theme_textdomain('bizstudio', get_template_directory() . '/languages');

}

add_action('after_setup_theme', 'bizstudio_lang_setup');



/**

* Funtion to add CSS class to body

*/

/**

* Funtion to add CSS class to body

*/

function bizstudio_add_class( $classes ) {



	if ( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_front_page() ) {

		$classes[] = 'front-page';

	}

	return $classes;

}



add_filter( 'body_class','bizstudio_add_class' );



/**

* Funtion to add CSS class to body for apply background

*/

function bizstudio_addbackground_class( $classes ) {

global $shortname;

	$classes[] = 'body-background' ;

	return $classes;

}

add_filter( 'body_class','bizstudio_addbackground_class' );



/*  * Loads the Options Panel * * If you're loading from a child theme use stylesheet_directory * instead of template_directory */ 

if ( !function_exists( 'optionsframework_init' ) ){	

	//Theme Shortname	

	$shortname = 'bizstudiolite';	

	$themename= 'Biz Studio Theme';	

	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/SketchBoard/includes/' );	

	require_once get_template_directory(). '/SketchBoard/includes/options-framework.php';	

	require_once get_template_directory(). '/SketchBoard/functions/admin-init.php';

	require ( get_template_directory() . '/SketchBoard/includes/sketchtheme-upsell.php' );

}

