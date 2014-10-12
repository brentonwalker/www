<?php

function focus_theme_settings(){
	siteorigin_settings_add_section('general', __('General', 'focus'));
	siteorigin_settings_add_section('slider', __('Slider', 'focus'));
	siteorigin_settings_add_section('video', __('Video', 'focus'));
	siteorigin_settings_add_section('layout', __('Layout', 'focus'));
	siteorigin_settings_add_section('text', __('Text', 'focus'));
	siteorigin_settings_add_section('menu', __('Main Menu', 'focus'));
	siteorigin_settings_add_section('cta', __('Call To Action', 'focus'));
	siteorigin_settings_add_section('comments', __('Comments', 'focus'));

	/**
	 * General Settings
	 */

	siteorigin_settings_add_field('general', 'logo', 'media',__('Logo', 'focus'), array(
		'choose' => __('Choose Logo Image', 'focus'),
		'update' => __('Set Logo', 'focus'),
	));
	siteorigin_settings_add_field('general', 'logo_scale', 'checkbox',__('Scale Logo', 'focus'), array(
		'description' => __('If used, scale the logo to fit the menu bar', 'focus'),
	));
	
	siteorigin_settings_add_field('general', 'display_author', 'checkbox',__('Display Post Author', 'focus'), array(
		'description' => __('Displays post author information on a post page.', 'focus')
	));

	siteorigin_settings_add_field('general', 'posts_nav', 'checkbox',__('Display Post Navigation', 'focus'), array(
		'description' => __('Display next and previous post links on post single pages.', 'focus')
	));
	
	siteorigin_settings_add_teaser('general', 'ajax_comments', __('Ajax Comments', 'focus'), array(
		'description' => __('Lets your users post comments without interrupting video play.', 'focus')
	));

	siteorigin_settings_add_teaser('general', 'siteorigin_credits', __('Display Credit Link', 'focus'), array(
		'description' => __('Display "Theme by SiteOrigin" in your footer.', 'focus')
	));

	/**
	 * Home Page Slider
	 */

	siteorigin_settings_add_field('slider', 'post_count', 'number', __('Post Count', 'focus'), array(
		'description' => __('The number of posts to display.', 'focus')
	));

	siteorigin_settings_add_teaser('slider', 'post_cat', __('Post Category', 'focus'), array(
		'description' => __('Which category to fetch the video posts from.', 'focus')
	));

	siteorigin_settings_add_teaser('slider', 'post_orderby', __('Posts Order', 'focus'), array(
		'description' => __('The order in which to display the posts.', 'focus')
	));

	/**
	 * Video Player
	 */

	siteorigin_settings_add_field('video', 'by_text', 'text', __('Video By Text', 'focus'), array(
		'description' => __('Change the text "video by" on single post pages.', 'focus')
	));
	
	siteorigin_settings_add_teaser('video', 'autoplay', __('Autoplay Videos', 'focus'), array(
		'description' => __('Videos start playing as soon as the video page is loaded.', 'focus')
	));

	siteorigin_settings_add_teaser('video', 'hide_related', __('Hide Related Videos', 'focus'), array(
		'description' => __('Hides related videos after a YouTube or Vimeo Plus video finishes.', 'focus')
	));

	siteorigin_settings_add_teaser('video', 'default_hd', __('Play Videos in HD', 'focus'), array(
		'description' => __('Play YouTube oEmbed videos in HD. Vimeo HD playback is controlled on Vimeo itself.', 'focus')
	));

	siteorigin_settings_add_teaser('video', 'play_button', __('Play Button', 'focus'), array(
		'description' => __('Add a custom play button to self hosted video.', 'focus')
	));

	siteorigin_settings_add_teaser('video', 'premium_access', __('Premium Access Rights', 'focus'), array(
		'description' => __('The access rights required to view the premium version of a video. Can be used to integrate with plugins like <a href="http://www.s2member.com/3000.html">S2Member</a>', 'focus')
	));

	/**
	 * Page Layout
	 */

	siteorigin_settings_add_teaser('layout', 'responsive', __('Responsive Layout', 'focus'), array(
		'description' => __('Make your site responsive.', 'focus')
	));

	/**
	 * Site Text
	 */

	siteorigin_settings_add_field('text', 'no_results', 'text', __('No Search Results', 'focus'), array(
		'description' => __('Text displayed on your no search results pages.', 'focus')
	));

	siteorigin_settings_add_field('text', 'not_found', 'text', __('Page Not Found', 'focus'), array(
		'description' => __('Text displayed on your 404 pages.', 'focus')
	));

	siteorigin_settings_add_field('text', 'footer_copyright', 'text', __('Footer Copyright', 'focus'), array(
		'description' => __('Text in your site footer.', 'focus')
	));

	siteorigin_settings_add_field('text', 'latest_posts', 'text', __('Latest Posts Headline', 'focus'));
	
	/**
	 * Main Menu
	 */

	siteorigin_settings_add_field('menu', 'home', 'checkbox', __('Home Link', 'focus'), array(
		'description' => __('Add a home link to your menu bar.', 'focus')
	));

	siteorigin_settings_add_teaser('menu', 'search', __('Search', 'focus'), array(
		'description' => __('Adds a small search box in your menu bar.', 'focus'),
		'teaser-image' => get_template_directory_uri().'/upgrade/features/search-bar.jpg'
	));
	
	/**
	 * Footer CTA
	 */

	siteorigin_settings_add_field('cta', 'text', 'text', __('CTA Text', 'focus'));
	siteorigin_settings_add_field('cta', 'button_text', 'text', __('CTA Button Text', 'focus'));
	siteorigin_settings_add_field('cta', 'button_url', 'text', __('CTA Button URL', 'focus'));

	siteorigin_settings_add_teaser('cta', 'hide', __('Hide CTA', 'focus'), array(
		'description' => __('Comma separated list of capabilities from which to hide the CTA.', 'focus')
	));
	
	/**
	 * Comments
	 */

	siteorigin_settings_add_field('comments', 'page_hide', 'checkbox',__('Hide Page Comments', 'focus'), array(
		'description' => __('Automatically hides the comments and comment form on pages.', 'focus'),
		'label' => __('Hide', 'focus'),
	));

	siteorigin_settings_add_field('comments', 'hide_allowed_tags', 'checkbox',__('Hide Allowed Tags', 'focus'), array(
		'description' => __('Hides allowed tags from the comment form.', 'focus'),
		'label' => __('Hide', 'focus'),
	));
}
add_action('admin_init', 'focus_theme_settings');

function focus_theme_setting_defaults($defaults){
	$defaults['general_logo'] = '';
	$defaults['general_logo_scale'] = true;
	$defaults['general_ajax_comments'] = false;
	$defaults['general_display_author'] = true;
	$defaults['general_posts_nav'] = true;
	$defaults['general_siteorigin_credits'] = true;

	$defaults['menu_home'] = true;
	$defaults['menu_search'] = false;
	
	$defaults['text_not_found'] = false;
	$defaults['text_no_results'] = false;
	$defaults['text_latest_posts'] = false;
	$defaults['text_footer_copyright'] = false;
	
	$defaults['cta_text'] = '';
	$defaults['cta_button_url'] = '';
	$defaults['cta_button_text'] = '';
	$defaults['cta_hide'] = '';

	// The slider
	$defaults['slider_post_count'] = 5;
	$defaults['slider_post_cat'] = '';
	$defaults['slider_post_orderby'] = 'date';
	
	// The Video
	$defaults['video_by_text'] = '';
	$defaults['video_premium_access'] = '';
	$defaults['video_play_button'] = false;
	$defaults['video_default_hd'] = false;
	$defaults['video_autoplay'] = false;
	$defaults['video_hide_related'] = false;
	
	// Comments
	$defaults['comments_page_hide'] = false;
	$defaults['comments_hide_allowed_tags'] = false;

	$defaults['layout_responsive'] = false;
	
	return $defaults;
}
add_filter('siteorigin_theme_default_settings', 'focus_theme_setting_defaults');