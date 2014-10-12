<?php

/**

* A unique identifier is defined to store the options in the database and reference them from the theme.

* By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.

* If the identifier changes, it'll appear as if the options have been reset.

*/

function optionsframework_option_name() {

	global $shortname;

	global $themename;

	// This gets the theme name from the stylesheet

	$themename = get_option( 'stylesheet' );

	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );

	$optionsframework_settings['id'] = $themename;

	update_option( 'optionsframework', $optionsframework_settings );

}

/**

* Defines an array of options that will be used to generate the settings page and be saved in the database.

* When creating the 'id' fields, make sure to use all lowercase and no spaces.

*

* If you are making your theme translatable, you should replace 'bizstudio'

* with the actual text domain for your theme.  Read more:

* http://codex.wordpress.org/Function_Reference/load_theme_textdomain

*/

function optionsframework_options() {

global $shortname;

global $themename;

// Background Defaults

$background_style = array(

	'color' => '',

	'image' => '',

	'repeat' => 'repeat',

	'position' => 'top center',

	'attachment'=>'scroll' );

//Feed Icon

$feed_icon_array = array(

	'true' => __('Yes', 'bizstudio'),

	'false' => __('No', 'bizstudio')

);

//mode_test_array

$mode_test_array = array(

	'fade' => __('Fade', 'bizstudio'),

	'slide' => __('Slide', 'bizstudio')

);

//showcontrols_test_array

$showcontrols_test_array = array(

	'true' => __('Show', 'bizstudio'),

	'false' => __('Hide', 'bizstudio')

);

//showmarkers_array

$showmarkers_array = array(

	'true' => __('Yes', 'bizstudio'),

	'false' => __('No', 'bizstudio')

);

//usecaptions_array

$direction_array = array(

	'horizontal' => __('Horizontal', 'bizstudio'),

	'vertical' => __('Vertical', 'bizstudio')

);

// pagination

$test_pagiarray = array(

	1 => __('Yes', 'bizstudio'),

	0 => __('No', 'bizstudio')

);

// rss_feed_icon

$test_rss_feed_icon = array(

	1 => __('Yes', 'bizstudio'),

	0 => __('No', 'bizstudio')

);

//radio_array

$radio_array = array(

	'true' => __('Show', 'bizstudio'),

	'false' => __('Hide', 'bizstudio')

);

//radiothird_array

$radiothird_array = array(

	'true' => __('Show', 'bizstudio'),

	'false' => __('Hide', 'bizstudio')

);

//latp_array

$latp_array = array(

	'true' => __('Show', 'bizstudio'),

	'false' => __('Hide', 'bizstudio')

);

//Front page layout Show/hide
	$frontpagelayout_array = array(
		'true' => __('Static Layout', 'bizstudio'),
		'false' => __('Custom Layout', 'bizstudio')
	);

// Pull all the categories into an array

$options_categories = array();

$options_categories_obj = get_categories();

foreach ($options_categories_obj as $category) {

	$options_categories[$category->cat_ID] = $category->cat_name;

}

// Pull all tags into an array

$options_tags = array();

$options_tags_obj = get_tags();

foreach ( $options_tags_obj as $tag ) {

	$options_tags[$tag->term_id] = $tag->name;

}

// Pull all the pages into an array

$options_pages = array();

$options_pages_obj = get_pages('sort_column=post_parent,menu_order');

$options_pages[''] = 'Select a page:';

foreach ($options_pages_obj as $page) {

	$options_pages[$page->ID] = $page->post_title;

}

// set pages

$options_pages = array();

$options_pages_obj = get_pages('sort_column=post_parent,menu_order');

$options_pages[''] = 'Select a page:';

foreach ($options_pages_obj as $page) {

	$options_pages[$page->ID] = $page->post_title;

}

// If using image radio buttons, define a directory path

$imagepath =  get_template_directory_uri() . '/images/';

$options = array();

//General Settings

$options[] = array(

	'name' => __('General Settings', 'bizstudio'),

	'type' => 'heading');

$options[] = array(

	'name' => __('Change logo (full path to logo image)', 'bizstudio'),

	'desc' => __('This creates a Custom logo that previews the image.', 'bizstudio'),

	'id' => $shortname.'_logo_img',

	'std' => '',

	'type' => 'upload');

$options[] = array(

	'name' => __('Logo ALT Text', 'bizstudio'),

	'desc' => __('Logo ALT Text field.', 'bizstudio'),

	'id' => $shortname.'_logo_alt',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Change favicon', 'bizstudio'),

	'desc' => __('This creates a Custom favicon that previews the image.', 'bizstudio'),

	'id' => $shortname.'_favicon',

	'std' => '',

	'type' => 'upload');

$options[] = array(

	'name' => __('Show Custom Pagination', 'bizstudio'),

	'desc' => __('Show custom pagination on blog page.', 'bizstudio'),

	'id' => $shortname.'_show_pagination',

	'std' => 'yes',

	'type' => 'select',

	'class' => 'mini', //mini, tiny, small

	'options' => $test_pagiarray);

//Bg style

$options[] = array(

	'name' =>  __('Custom Background', 'bizstudio'),

	'desc' => __('Change the background CSS.', 'bizstudio'),

	'id' => $shortname.'_bg_style',

	'std' => $background_style,

	'type' => 'background' );

//Slider Setting

$options[] = array(

	'name' => __('Slider Configuration', 'bizstudio'),

	'type' => 'heading');

	

$options[] = array(

			'name' => __('Upload Slider Image 1', 'bizstudio'),

			'desc' => __('Upload Slider Image 1.', 'bizstudio'),

			'id' => $shortname.'_slider_img1',

			'std' => $imagepath.'beach-15689_1280.jpg',

			'type' => 'upload');



$options[] = array(

			'name' => __('Enter Content For Slide 1 Caption.', 'bizstudio'),

			'desc' => __('Enter Content For Slide 1 Caption.', 'bizstudio'),

			'id' => $shortname.'_content_slider1',

			'std' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy",

			'type' => 'textarea');

			

$options[] = array(

			'name' => __('Enter Slider Link 1.', 'bizstudio'),

			'desc' => __('Enter slider Link 1.', 'bizstudio'),

			'id' => $shortname.'_slider_link1',

			'std' => '#',

			'type' => 'text');



$options[] = array(

			'name' => __('Upload Slider Image 2', 'bizstudio'),

			'desc' => __('Upload Slider Image 2.', 'bizstudio'),

			'id' => $shortname.'_slider_img2',

			'std' => $imagepath.'mother-84628_1280.jpg',

			'type' => 'upload');



$options[] = array(

			'name' => __('Enter Content For Slide 2 Caption.', 'bizstudio'),

			'desc' => __('Enter Content For Slide 2 Caption.', 'bizstudio'),

			'id' => $shortname.'_content_slider2',

			'std' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy",

			'type' => 'textarea');

			

$options[] = array(

			'name' => __('Enter Slider Link 2.', 'bizstudio'),

			'desc' => __('Enter slider Link 2.', 'bizstudio'),

			'id' => $shortname.'_slider_link2',

			'std' => '#',

			'type' => 'text');

			

$options[] = array(

			'name' => __('Upload Slider Image 3', 'bizstudio'),

			'desc' => __('Upload Slider Image 3.', 'bizstudio'),

			'id' => $shortname.'_slider_img3',

			'std' => $imagepath.'accessories-84528_1280.jpg',

			'type' => 'upload');



$options[] = array(

			'name' => __('Enter Content For Slide 3 Caption.', 'bizstudio'),

			'desc' => __('Enter Content For Slide 3 Caption.', 'bizstudio'),

			'id' => $shortname.'_content_slider3',

			'std' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy",

			'type' => 'textarea');

			

$options[] = array(

			'name' => __('Enter Slider Link 3.', 'bizstudio'),

			'desc' => __('Enter slider Link 3.', 'bizstudio'),

			'id' => $shortname.'_slider_link3',

			'std' => '#',

			'type' => 'text');

			

$options[] = array(

	'name' => __('Select Mode', 'bizstudio'),

	'desc' => __('Select Mode.', 'bizstudio'),

	'id' => $shortname.'_mode_select',

	'std' => 'fade',

	'type' => 'select',

	'class' => 'mini', //mini, tiny, small

	'options' => $mode_test_array);

$options[] = array(

	'name' => __('Direction', 'bizstudio'),

	'desc' => __('Select the sliding direction, "horizontal" or "vertical".', 'bizstudio'),

	'id' =>  $shortname.'_direction',

	'std' => 'true',

	'type' => 'select',

	'class' => 'mini', //mini, tiny, small

	'options' => $direction_array);

$options[] = array(

	'name' => __('Animation duration', 'bizstudio'),

	'desc' => __('how fast the animation are.', 'bizstudio'),

	'id' => $shortname.'_animduration',

	'std' => '450',

	'type' => 'text');

$options[] = array(

	'name' => __('Animationspeed', 'bizstudio'),

	'desc' => __('The delay between each slide.', 'bizstudio'),

	'id' => $shortname.'_animspeed',

	'std' => '4000',

	'type' => 'text');

$options[] = array(

	'name' => __('show next and prev controls', 'bizstudio'),

	'desc' => __('If true, show next and prev controls.', 'bizstudio'),

	'id' => $shortname.'_showcontrols',

	'std' => '',

	'type' => 'select',

	'class' => 'mini', //mini, tiny, small

	'options' => $showcontrols_test_array);

$options[] = array(

	'name' => __('Show individual slide markers', 'bizstudio'),

	'desc' => __('navigation for paging control of each slide.(Pro Version)', 'bizstudio'),

	'id' => $shortname.'_showmarkers',

	'std' => 'true',

	'type' => 'select',

	'class' => 'mini', //mini, tiny, small

	'options' => $showmarkers_array);



//Footer	

$options[] = array(

	'name' => __('Footer', 'bizstudio'),

	'type' => 'heading');

	

$options[] = array(

	'name' => __('CopyrightText', 'bizstudio'),

	'desc' => __('', 'bizstudio'),

	'id' => $shortname.'_copyright',

	'std' => 'Your &copy; copyright text here.',

	'type' => 'textarea');

	

//Front Page Options	

$options[] = array(

	'name' => __('Front Page Options', 'bizstudio'),

	'type' => 'heading');

$options[] = array(
			'name' => __('Select Your Front Page Layout.', 'bizstudio'),
			'desc' => __('if you select Static layout for front page your selected page content is show otherwise custom front page layout show.', 'bizstudio'),
			'id' => $shortname.'_hide_frontlayout',
			'std' => 'true',
			'type' => 'radio',
			'options' => $frontpagelayout_array);	

$options[] = array(

	'name' => __('Front page middle Sidebar Text', 'bizstudio'),

	'desc' => __('Front page middle Sidebar Text.', 'bizstudio'),

	'id' => $shortname.'_mid_sidebar_text',

	'std' => '',

	'type' => 'textarea');

//Main Box

$options[] = array(

	'name' => __('Main Box Heading:', 'bizstudio'),

	'desc' => __('Enter Main Box Heading.', 'bizstudio'),

	'id' => $shortname.'_main_heading',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Main Box content', 'bizstudio'),

	'desc' => __('Main Box content', 'bizstudio'),

	'id' => $shortname.'_main_content',

	'std' => '',

	'type' => 'textarea');

//Featured Area 1

$options[] = array(

	'name' => __('Featured Box 1 Heading:', 'bizstudio'),

	'desc' => __('Enter Featured Box 1 Heading.', 'bizstudio'),

	'id' => $shortname.'_fb1_heading',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Featured Box 1 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_fb1_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Featured Box 1 Content:', 'bizstudio'),

	'desc' => __('Enter Featured Box 1 Content.','bizstudio'),

	'id' => $shortname.'_fb1_content',

	'std' => '',

	'type' => 'textarea');

$options[] = array(

	'name' => __('Featured Box 2 Heading:', 'bizstudio'),

	'desc' => __('Enter Featured Box 2 Heading.', 'bizstudio'),

	'id' => $shortname.'_fb2_heading',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Featured Box 2 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_fb2_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Featured Box 2 Content:', 'bizstudio'),

	'desc' => __('Enter Featured Box 2 Content.','bizstudio'),

	'id' => $shortname.'_fb2_content',

	'std' => '',

	'type' => 'textarea');

$options[] = array(

	'name' => __('Featured Box 3 Heading:', 'bizstudio'),

	'desc' => __('Enter Featured Box 3 Heading.', 'bizstudio'),

	'id' => $shortname.'_fb3_heading',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Featured Box 3 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_fb3_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Featured Box 3 Content:', 'bizstudio'),

	'desc' => __('Enter Featured Box 3 Content.','bizstudio'),

	'id' => $shortname.'_fb3_content',

	'std' => '',

	'type' => 'textarea');

//recent-post

$options[] = array(

	'name' => __('Recent Box 1 Heading:', 'bizstudio'),

	'desc' => __('Enter Recent Box 1 Heading.', 'bizstudio'),

	'id' => $shortname.'_rp1_heading',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Recent Box 1 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_rp1_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Recent Box 1 Content:', 'bizstudio'),

	'desc' => __('Enter Recent Box 1 Content.','bizstudio'),

	'id' => $shortname.'_rp1_content',

	'std' => '',

	'type' => 'textarea');

$options[] = array(

	'name' => __('Recent Box 2 Heading:', 'bizstudio'),

	'desc' => __('Enter Recent Box 2 Heading.', 'bizstudio'),

	'id' => $shortname.'_rp2_heading',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Recent Box 2 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_rp2_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Recent Box 2 Content:', 'bizstudio'),

	'desc' => __('Enter Recent Box 2 Content.','bizstudio'),

	'id' => $shortname.'_rp2_content',

	'std' => '',

	'type' => 'textarea');

$options[] = array(

	'name' => __('Recent Box 3 Heading:', 'bizstudio'),

	'desc' => __('Enter Recent Box 3 Heading.', 'bizstudio'),

	'id' => $shortname.'_rp3_heading',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Recent Box 3 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_rp3_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Recent Box 3 Content:', 'bizstudio'),

	'desc' => __('Enter Recent Box 3 Content.','bizstudio'),

	'id' => $shortname.'_rp3_content',

	'std' => '',

	'type' => 'textarea');

// jcarousel

$options[] = array(

	'name' => __('Image 1 Title:', 'bizstudio'),

	'desc' => __('Enter Image 1 Title.', 'bizstudio'),

	'id' => $shortname.'_img1_title',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Image 1 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_img1_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Image 2 Title:', 'bizstudio'),

	'desc' => __('Enter Image 1 Title.', 'bizstudio'),

	'id' => $shortname.'_img2_title',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Image 2 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_img2_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Image 3 Title:', 'bizstudio'),

	'desc' => __('Enter Image 1 Title.', 'bizstudio'),

	'id' => $shortname.'_img3_title',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Image 3 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_img3_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Image 4 Title:', 'bizstudio'),

	'desc' => __('Enter Image 1 Title.', 'bizstudio'),

	'id' => $shortname.'_img4_title',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Image 4 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_img4_icon',

	'type' => 'upload');

$options[] = array(

	'name' => __('Image 5 Title:', 'bizstudio'),

	'desc' => __('Enter Image 1 Title.', 'bizstudio'),

	'id' => $shortname.'_img5_title',

	'std' => '',

	'type' => 'text');

$options[] = array(

	'name' => __('Image 5 Icon', 'bizstudio'),

	'desc' => __('This creates a full size uploader that previews the image.', 'bizstudio'),

	'id' => $shortname.'_img5_icon',

	'type' => 'upload');

return $options;

}

/*

* This is an example of how to add custom scripts to the options panel.

* This example shows/hides an option when a checkbox is clicked.

*/

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>
<script type="text/javascript">

	jQuery(document).ready(function($) {

		$('#example_showhidden').click(function() {

		$('#section-example_text_hidden').fadeToggle(400);

		});

		if ($('#example_showhidden:checked').val() !== undefined) {

			$('#section-example_text_hidden').show();

		}

	});

</script>
<?php

}