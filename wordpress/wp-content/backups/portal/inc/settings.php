<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package portal
 * @since portal 1.0
 * @license GPL 2.0
 */

/**
 * Setup theme settings.
 * 
 * @since portal 1.0
 */
function portal_theme_settings(){
	siteorigin_settings_add_section('general', __('General', 'portal'));
	siteorigin_settings_add_section('home', __('Home Page', 'portal'));
	siteorigin_settings_add_section('layout', __('Layout', 'portal'));
	siteorigin_settings_add_section('social', __('Social', 'portal'));
	siteorigin_settings_add_section('text', __('Site Text', 'portal'));

	/**
	 * General Settings
	 */

	siteorigin_settings_add_field('general', 'logo', 'media', __('Logo', 'portal'), array(
		'choose' => __('Choose Image', 'portal'),
		'update' => __('Set Logo', 'portal'),
	));

	siteorigin_settings_add_field('general', 'site_description', 'checkbox', __('Site Description', 'portal'), array(
		'description' => __('Display your site description under your logo.', 'portal')
	));
	
	siteorigin_settings_add_field('general', 'search_bar', 'checkbox', __('Top Search Bar', 'portal'), array(
		'description' => __('Display a search bar at the top of the screen.', 'portal'),
		'label' => __('Display', 'portal'),
	));

	siteorigin_settings_add_field('general', 'contact_text', 'text', __('Top Area Text', 'portal'), array(
		'description' => __('The text that appears above your page container, perfect for displaying contact information', 'portal')
	));

	siteorigin_settings_add_field('home', 'title_display', 'checkbox', __('Display Headline', 'portal'), array(
		'description' => __('Display the headline on your home page.', 'portal'),
	));

	siteorigin_settings_add_field('home', 'title', 'text', __('Main Headline', 'portal'), array(
		'description' => __('The main title on your home page', 'portal'),
	));

	siteorigin_settings_add_field('home', 'subtitle', 'text', __('Sub Title', 'portal'), array(
		'description' => __('The sub title on your home page', 'portal'),
	));

	siteorigin_settings_add_field('home', 'loop', 'select', __('Home Page Posts Layout', 'portal'), array(
		'description' => __('Choose how posts are displayed on your home page.', 'portal'),
		'options' => array(
			'' => __('Default', 'portal'),
			'slider' => __('Slider', 'portal'),
		)
	));

	/**
	 * Layout Settings
	 */

	siteorigin_settings_add_field('layout', 'responsive', 'checkbox', __('Responsive Layout', 'portal'), array(
		'description' => __('Scale your layout for small screen devices.', 'portal')
	));
	
	siteorigin_settings_add_field('layout', 'page_margin', 'checkbox', __('Page Top Margin', 'portal'), array(
		'description' => __('Adds a top margin to the page container.', 'portal')
	));

	/**
	 * Social
	 */

	siteorigin_settings_add_field('social', 'twitter', 'text', __('Twitter', 'portal'), array(
		'description' => __('Set to blank to remove a social link', 'portal')
	));
	siteorigin_settings_add_field('social', 'facebook', 'text', __('Facebook', 'portal'));
	siteorigin_settings_add_field('social', 'dribbble', 'text', __('Dribbble', 'portal'));
	siteorigin_settings_add_field('social', 'flickr', 'text', __('Flickr', 'portal'));
	siteorigin_settings_add_field('social', 'google', 'text', __('Google', 'portal'));
	siteorigin_settings_add_field('social', 'youtube', 'text', __('YouTube', 'portal'));
	siteorigin_settings_add_field('social', 'vimeo', 'text', __('Vimeo', 'portal'));
	siteorigin_settings_add_field('social', 'behance', 'text', __('Behance', 'portal'));
	siteorigin_settings_add_field('social', 'forrst', 'text', __('Forrst', 'portal'));
	siteorigin_settings_add_field('social', 'github', 'text', __('GitHub', 'portal'));
	siteorigin_settings_add_field('social', 'paypal', 'text', __('PayPal', 'portal'));
	siteorigin_settings_add_field('social', 'wordpress', 'text', __('WordPress', 'portal'));

	/**
	 * Site Text
	 */

	siteorigin_settings_add_field('text', 'footer_copyright', 'text', __('Footer Text', 'portal'), array(
		'description' => __('The main title on your home page', 'portal'),
	));

}
add_action('admin_init', 'portal_theme_settings');

/**
 * Setup theme default settings.
 * 
 * @param $defaults
 * @return mixed
 * @since portal 1.0
 */
function portal_theme_setting_defaults($defaults){
	$defaults['general_logo'] = '';
	$defaults['general_ajax_comments'] = false;
	$defaults['general_site_description'] = true;
	$defaults['general_search_bar'] = false;
	$defaults['general_contact_text'] = '';

	$defaults['home_slider'] = '';
	$defaults['home_title_display'] = true;
	$defaults['home_title'] = '';
	$defaults['home_subtitle'] = '';
	$defaults['home_loop'] = '';

	$defaults['layout_responsive'] = true;
	$defaults['layout_responsive_menu'] = true;
	$defaults['layout_page_margin'] = false;

	$defaults['social_twitter'] = '#';
	$defaults['social_facebook'] = '#';
	$defaults['social_dribbble'] = '#';
	$defaults['social_flickr'] = '';
	$defaults['social_google'] = '';
	$defaults['social_youtube'] = '';
	$defaults['social_vimeo'] = '';
	$defaults['social_behance'] = '';
	$defaults['social_forrst'] = '';
	$defaults['social_github'] = '';
	$defaults['social_paypal'] = '';
	$defaults['social_wordpress'] = '';

	$defaults['text_footer_copyright'] = '';

	$defaults['design_top_border'] = '#2A8FBD';
	$defaults['design_link_color'] = '#2a8fbd';

	return $defaults;
}
add_filter('siteorigin_theme_default_settings', 'portal_theme_setting_defaults');