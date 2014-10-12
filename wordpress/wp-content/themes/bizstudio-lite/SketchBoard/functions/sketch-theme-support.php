<?php
global $themename;
global $shortname;

/**

 * Filter content with empty post title
 *
 * @since bizstudio
 */

add_filter('the_title', 'bizstudio_untitled');

function bizstudio_untitled($title) {
	if ($title == '') {
		return __('Untitled', 'bizstudio');
	} else {
		return $title;
	}
}



/********************************************

 THUMBNAIL SUPPORT

*********************************************/



function bizstudio_theme_support(){

    add_theme_support('automatic-feed-links');

	add_theme_support('post-thumbnails');

	add_image_size('bizstudio_standard_img',620,144,true); 

	set_post_thumbnail_size( 600, 220, true );

	add_editor_style();

}

add_action('after_setup_theme', 'bizstudio_theme_support');