<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 *
 */
//require_once( get_template_directory() . '/options/options.php' );
get_template_part('options/options');
/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
//function change_framework_args($args){
	
//	$args['dev_mode'] = false;
	
//	return $args;
	
//}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');


/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;

//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
$args['intro_text'] = __('<p>Screens is simple and utility theme for blog and portfolio.</p>', 'screens');

//Setup custom links in the footer for share icons
//$args['share_icons']['twitter'] = array(
//										'link' => 'http://twitter.com/lee__mason',
//							// 'title' => 'Folow me on Twitter', 
//										'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_322_twitter.png'
//										);
//$args['share_icons']['linked_in'] = array(
//										'link' => 'http://uk.linkedin.com/pub/lee-mason/38/618/bab',
//										'title' => 'Find me on LinkedIn', 
//										'img' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_337_linked_in.png'
//										);

//Choose to disable the import/export feature
//$args['show_import_export'] = false;
//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'screens';

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Theme Options', 'screens');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Screens Theme Options', 'screens');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 27;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = false;
$args['help_tabs'][] = false;

//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = false;

$font_select_web = array("1" => "None", "2" => "Helvetica Arial","3" => "Verdana","4" => "Georgia","5" => "Palatino Linotype", "6" => "Open Sans (Google Fonts)", "7" => "Droid Sans (Google Fonts)", "8" => "Oswald (Google Fonts)", "9" => "Vollkorn (Google Fonts)",  "10" => "Old Standard TT (Google Fonts)", "11" => "Maven Pro (Google Fonts)", "12" => "Bevan (Google Fonts)", "13" => "Poly (Google Fonts)","14" => "Lato (Google Fonts)" ,"15" => "PT Serif (Google Fonts)","16" => "Ubuntu (Google Fonts)","17" => "Playfair Display (Google Fonts)","18" => "Abril Fatface (Google Fonts)","19" => "Hammersmith One (Google Fonts)","20" => "Raleway (Google Fonts)","21" => "Cabin (Google Fonts)", "22" => "Josefin Sans (Google Fonts)", "23" => "Droid Sans Mono (Google Fonts)", "24" => "Droid Serif (Google Fonts)", "25" => "PT Sens (Google Fonts)");

$img_array = array('1' => array('title' => 'Background 1','img' => get_template_directory_uri().'/images/bg/bg-none.jpg'),
                   '2' => array('title' => 'Background 2','img' => get_template_directory_uri().'/images/bg/bg-1.jpg'),
				   '3' => array('title' => 'Background 3','img' => get_template_directory_uri().'/images/bg/bg-2.jpg'),
				   '4' => array('title' => 'Background 4','img' => get_template_directory_uri().'/images/bg/bg-3.jpg'),
				   '5' => array('title' => 'Background 5','img' => get_template_directory_uri().'/images/bg/bg-4.jpg'),
				   '6' => array('title' => 'Background 6','img' => get_template_directory_uri().'/images/bg/bg-5.jpg'),
				   '7' => array('title' => 'Background 7','img' => get_template_directory_uri().'/images/bg/bg-6.jpg'),
				   '8' => array('title' => 'Background 8','img' => get_template_directory_uri().'/images/bg/bg-7.jpg'),
				   '9' => array('title' => 'Background 9','img' => get_template_directory_uri().'/images/bg/bg-8.jpg'),
				   '10' => array('title' => 'Background 10','img' => get_template_directory_uri().'/images/bg/bg-9.jpg'),
				   '11' => array('title' => 'Background 11','img' => get_template_directory_uri().'/images/bg/bg-10.jpg'),
				   '12' => array('title' => 'Background 12','img' => get_template_directory_uri().'/images/bg/bg-11.jpg'));
$sections = array();

$sections[] = array(
	//			'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_039_notes.png',
				'title' => __('General  options', 'screens'),
				'desc' => __('<p class="description">General options</p>', 'screens'),
				'fields' => array(
					array(
						'id' => 'primary5',
						'type' => 'select', 						
						'title' => __('Skin select', 'screens'), 
						'desc' => __('Select the default color scheme here.', 'screens'),
						'options' => array('1' => 'Light Theme','2' => 'Dark Theme','3' => 'Orange Theme'),
						'std' => '1'
						),	
					array(
						'id' => 'primary1', //must be unique
						'type' => 'upload', 						
						'title' => __('Custom Logo', 'screens'), 
						'desc' => __('If you want to add a logo instead of the text in the Web title, you should add it by uploader and then you should place url address of the picture into the next text file. The width of the picture should not be more than 280px, a lucent file .PNG. is recommended.', 'screens')				
						),
				   array(
						'id' => 'primary2', //must be unique
						'type' => 'upload', 						
						'title' => __('Custom Favicon', 'screens'), 
						'desc' => __('If you want to add "Favicon" (a picture which is in breadcrumb bar browser), you can use the website which was resulted from the picture. <strong>http://www.genfavicon.com/</strong> 
						<strong>http://www.degraeve.com/favicon</strong>', 'screens')				
						),
			    	array(
						'id' => 'primary3', //must be unique
						'type' => 'upload', 						
						'title' => __('Custom Avatar', 'screens'), 
						'desc' => __('If you want to change a default avatar into your own, add the picture (max80x80px), then go into Settings>Discussion and activate it.', 'screens')				
						),
					array(
						'id' => 'primary4', //must be unique
						'type' => 'select', 						
						'title' => __('Lightbox theme', 'screens'), 
						'desc' => __('Select the default lightbox theme.', 'screens'),
						'options' => array('1' => 'Theme 1','2' => 'Theme 2','3' => 'Theme 3','4' => 'Theme 4','5' => 'Theme 5'),//Must provide key => value pairs for radio options
						'std' => '1'
						),
					array(
						'id' => 'primary6', 				
						'title' => __('Background color', 'screens'), 
						'desc' => __('Change the colour of the background.', 'screens'),
						"type" => "color"
						),
					array(
						'id' => 'primary7', 				
						'title' => __('Primary color', 'screens'), 
						'desc' => __('Change the colour.', 'screens'),
						"type" => "color"
						),
			       array(
						'id' => 'primary8',
						'type' => 'radio_img',
						'title' => __('Background image ', 'screens'), 
						'sub_desc' => __('Select background image.', 'screens'),
						'options' =>$img_array ,
						'std' => '1'
						),
		           array(
						'id' => 'primary9',
						'type' => 'upload',
						'title' => __('Custom image background (repeat image)', 'screens'), 
						'sub_desc' => __('Select background image.', 'screens')
						)					
					)
				);	

$sections[] = array(
			//	'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_137_computer_service.png',
				'title' => __('Home  options', 'screens'),
				'desc' => __('<p class="description">Home page options</p>', 'screens'),
				'fields' => array(
					array(
						'id' => 'home1', 
						'type' => 'select', 						
						'title' => __('Panels', 'screens'), 
						'desc' => __('Show the panel (only a horizontal menu).', 'screens'),
						'options' => array('1' => __('None', 'screens'),'2' => __('All', 'screens'),'3' => __('Description', 'screens'),'4' => __('Portfolio', 'screens'),'5' => __('Blog', 'screens'),'6' => __('Contact', 'screens')),
						'std' => '1'),						
				    array(
						'id' => 'home2',
						'type' => 'checkbox',
						'title' => __('Display description', 'screens'), 						
						'desc' => __('Enable.', 'screens'),
						'std' => '0'// 1 = on | 0 = off
						),
					 array(
						'id' => 'home3',
						'type' => 'checkbox',
						'title' => __('Display portfolio', 'screens'), 						
						'desc' => __('Enable.', 'screens'),
						'std' => '0'// 1 = on | 0 = off
						),
					array(
						'id' => 'home4',
						'type' => 'checkbox',
						'title' => __('Display blog', 'screens'), 						
						'desc' => __('Enable.', 'screens'),
						'std' => '1'// 1 = on | 0 = off
						),
					 array(
						'id' => 'home5',
						'type' => 'checkbox',
						'title' => __('Display contact', 'screens'), 						
						'desc' => __('Enable.', 'screens'),
						'std' => '0'// 1 = on | 0 = off
						),

					)
				);
				
$sections[] = array(
			//	'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_003_user.png',
				'title' => __('Description', 'screens'),
				'desc' => __('<p class="description">Description options</p>', 'screens'),
				'fields' => array(
					array(
						'id' => 'desc1', //must be unique
						'type' => 'text', 						
						'title' => __('Title menu', 'screens'), 
						'desc' => __('Insert  text.', 'screens'),
						'std' => 'Welcome',
						),
					array(
						'id' => 'desc2', //must be unique
						'type' => 'text', 						
						'title' => __('Title', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						'std' => 'Welcome',
						),
					array(
						'id' => 'desc3', //must be unique
						'type' => 'editor', 						
						'title' => __('Content', 'screens'), 
						),	
					array(
						'id' => 'desc4', 				
						'title' => __('Background color', 'screens'), 
						'desc' => __('Change the colour of the background.', 'screens'),
						"type" => "color"
						),
					array(
						'id' => 'desc5', //must be unique
						'type' => 'upload', 						
						'title' => __('Custom backgound', 'screens'), 
						'desc' => __('Position top, left', 'screens')				
						)		
					)
				);
				
$sections[] = array(
		//		'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_159_picture.png',
				'title' => __('Portfolio', 'screens'),
				'desc' => __('<p class="description">Portfolio options</p>', 'screens'),
				'fields' => array(
					array(
						'id' => 'portfolio1', //must be unique
						'type' => 'text', 						
						'title' => __('Title menu', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						'std' => 'Portfolio',
						),
					array(
						'id' => 'portfolio2', //must be unique
						'type' => 'radio', 						
						'title' => __('Gallery options', 'screens'), 
						'options' => array('1' => 'Slideshow','2' => '2 columns','3' => '4 columns'),//Must provide key => value pairs for radio options
						'std' => '3'
						)						
					)
				);
				
$sections[] = array(
			//	'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_151_edit.png',
				'title' => __('Blog', 'screens'),
				'desc' => __('<p class="description">Blog options</p>', 'screens'),
				'fields' => array(
					array(
						'id' => 'blog1', //must be unique
						'type' => 'text', 						
						'title' => __('Title menu', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						'std' => 'Blog',
						),					
				    array(
						'id' => 'blog4',
						'type' => 'checkbox',
						'title' => __('Social media icon', 'screens'), 						
						'desc' => __('By choosing this option, you add the icon of social media next to the content of the entry (Google Plus, Twitter, Stumbleupon, Pinterest). If you need to add more "Sexy bookmarks" plug in is recommended.', 'screens'),
						'std' => '0'// 1 = on | 0 = off
						),
					array(
						'id' => 'blog5',
						'type' => 'checkbox',
						'title' => __('Display the information about the author', 'screens'), 						
						'desc' => __('By choosing this option you will display the information about the author of the article on the entry page ( to display the data you must fill in the author profile )', 'screens'),
						'std' => '0'// 1 = on | 0 = off
						)				
					)
				);
				
$sections[] = array(
			//	'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_124_message_plus.png',
				'title' => __('Contact', 'screens'),
				'desc' => __('<p class="description">Contact options</p>', 'screens'),
				'fields' => array(
					array(
						'id' => 'contact1', //must be unique
						'type' => 'text', 						
						'title' => __('Title menu', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						'std' => 'Contact',
						),
						array(
						'id' => 'contact5', //must be unique
						'type' => 'text', 						
						'title' => __('Name', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						),
											array(
						'id' => 'contact6', //must be unique
						'type' => 'text', 						
						'title' => __('Address#1', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						),
											array(
						'id' => 'contact7', //must be unique
						'type' => 'text', 						
						'title' => __('Address#2', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						),
											array(
						'id' => 'contact8', //must be unique
						'type' => 'text', 						
						'title' => __('Phone#1', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						),
											array(
						'id' => 'contact9', //must be unique
						'type' => 'text', 						
						'title' => __('Phone#2 ', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						),					array(
						'id' => 'contact10', //must be unique
						'type' => 'text', 						
						'title' => __('E-mail', 'screens'), 
						'desc' => __('Insert text.', 'screens'),
						),
					array(
						'id' => 'contact2', //must be unique
						'type' => 'textarea', 						
						'title' => __('Content - Left box (max width 400px)', 'screens'), 
						'validate' => 'no_html',
						),
					array(
						'id' => 'contact3', //must be unique
						'type' => 'editor', 						
						'title' => __('Content - Right box (max width 340px)', 'screens'), 
						//'desc' => __('Insert code.', 'nhp-opts')
						)				
					)
				);

				
$sections[] = array(
			//	'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_100_font.png',
				'title' => __('Color and fonts', 'screens'),
				'desc' => __('<p class="description">Color and fonts options</p>', 'screens'),
				'fields' => array(
					array(
						'id' => 'font1', 				
						'title' => __('Links', 'screens'), 
						'desc' => __('Change the colour of the links.', 'screens'),
						"type" => "color"
						),
					array(
						'id' => 'font2', 				
						'title' => __('Headers', 'screens'), 
						'desc' => __('Change the colour of the headers (h1, h2, h3, h4, h5, h6).', 'screens'),
						"type" => "color"
						),
					array(
						'id' => 'font3', //must be unique
						'type' => 'select', 						
						'title' => __('Choose the type of the font for the text', 'screens'), 
						'desc' => __('The default font is "Helvetica (Macintosh), Arial.', 'screens'),
						'options' => array('1' => 'Helvetica, Arial','2' => 'Verdana ','3' => 'Georgia','4' => 'Palatino Linotype', '5' => 'Consolas', '6' => 'PT Serif (Google Fonts)', '9' => 'PT Sens (Google Fonts)', '7' => 'Droid Sans (Google Fonts)', '8' => 'Droid Serif (Google Fonts)'),
						'std' => '1'
						),
					array(
						'id' => 'font5', //must be unique
						'type' => 'select', 						
						'title' => __('Change the font size', 'screens'), 
						'desc' => __('The default font size is 14px.', 'screens'),
						'options' => array('4' => '16 px', '1' => '14 px','2' => '13 px','3' => '12 px'),
						'std' => '1'
						),
					array(
						'id' => 'font4', //must be unique
						'type' => 'select', 						
						'title' => __('Choose the kind of the font for the header', 'screens'), 
						'sub_desc' => __('If you want to use  non-standard font in the page header, activate the options. In case of other languages before the using of the fonts you should check if the diacritical marks of the language are displayed.', 'screens'),
						'desc' => __('Google Fonts', 'screens'),
						'options' => $font_select_web,
						'std' => '1'
						),
						
					)
				);
				
$sections[] = array(
		//		'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_118_embed_close.png',
				'title' => __('Custom code', 'screens'),
				'desc' => __('<p class="description">Css code and other.</p>', 'screens'),
				'fields' => array(
					array(
						'id' => 'code1', //must be unique
						'type' => 'text', 						
						'title' => __('Footer copyright text', 'screens'), 
						//'desc' => __('Insert text.', 'screens'),
						'std' => 'Copyright &copy; Blank Canvas. All rights reserved.',
						'validate' => 'no_html',
						),
					array(
						'id' => 'code3', //must be unique
						'type' => 'text', 						
						'title' => __('Left footer text', 'screens'), 
						//'desc' => __('Insert text.', 'screens'),
						'validate' => 'no_html',
						),
					array(
						'id' => 'code2', //must be unique
						'type' => 'textarea', 						
						'title' => __('Custom css', 'screens'), 
						)						
					)
				);
								
				
	$tabs = array();
	if (function_exists('wp_get_theme')){
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data->get('ThemeURI');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');
	}else{
		$theme_data = wp_get_theme(trailingslashit(get_stylesheet_directory()).'style.css');
		$theme_uri = $theme_data['URI'];
		$description = $theme_data['Description'];
		$author = $theme_data['Author'];
		$version = $theme_data['Version'];
		$tags = $theme_data['Tags'];
	}	

	$theme_info = '<div class="nhp-opts-section-desc">';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'screens').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'screens').$author.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'screens').$version.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-description">'.$description.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'screens').implode(', ', $tags).'</p>';
	
	$theme_info .= '</div>';
	
	
	
	$tabs['theme_info'] = array(
					'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_161_macbook.png',
					'title' => __('Theme Information ', 'screens'),
					'content' => $theme_info
					);
/*					
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'doc/index.html')){
		$tabs['theme_docs'] = array(
					//	'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_039_notes.png',
						'title' => __('Theme Documentation', 'screens'),
						'content' => file_get_contents(trailingslashit(get_stylesheet_directory()).'doc/index.html')
						);
	}//if
*/
	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>