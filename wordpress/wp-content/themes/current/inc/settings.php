<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package so-current
 * @since so-current 1.0
 * @license GPL 2.0
 */

/**
 * Setup theme settings.
 * 
 * @since so-current 1.0
 */
function so_current_theme_settings(){
	siteorigin_settings_add_section('general', __('General', 'so-current'));
	siteorigin_settings_add_section('home', __('Home Page', 'so-current'));

	/**
	 * General Settings
	 */
	
	siteorigin_settings_add_field('general', 'logo', 'media', __('Logo', 'so-current'), array(
		'choose' => __('Choose Image', 'so-current'),
		'update' => __('Set Logo', 'so-current'),
	));

	/**
	 * Home Page
	 */

	siteorigin_settings_add_field('home', 'message', 'checkbox', __('Display Home Page Message', 'so-current'));

	siteorigin_settings_add_field('home', 'message_title', 'text', __('Message Title', 'so-current'));
	siteorigin_settings_add_field('home', 'message_text', 'text', __('Message Text', 'so-current'));
	siteorigin_settings_add_field('home', 'message_button', 'text', __('Button Text', 'so-current'));
	siteorigin_settings_add_field('home', 'message_url', 'text', __('Button URL', 'so-current'));
	siteorigin_settings_add_field('home', 'message_image', 'media', __('Image', 'so-current'));
	siteorigin_settings_add_field('home', 'message_frame', 'select', __('Image', 'so-current'), array(
		'options' => array(
			'tablet' => __('Tablet - [222 x 295 px image]', 'so-current'),
			'phone' => __('Mobile Phone 1 - [151 x 265 px image]', 'so-current'),
			'phone2' => __('Mobile Phone 2 - [163 x 288 px image]', 'so-current'),
		)
	));
}
add_action('admin_init', 'so_current_theme_settings');

/**
 * Setup theme default settings.
 * 
 * @param $defaults
 * @return mixed
 * @since so-current 1.0
 */
function so_current_theme_setting_defaults($defaults){
	$defaults['general_logo'] = '';

	$defaults['home_message'] = true;
	$defaults['home_message_title'] = __('Show Off Your Software or App', 'so-current');
	$defaults['home_message_text'] = __("Maybe tell your visitors a little bit about what your app, product or service does. You have their attention now, so you'd better make full use of it. Ideally you want them to hit the big action button.", 'so-current');
	$defaults['home_message_button'] = __('Download Now', 'so-current');
	$defaults['home_message_url'] = '#';
	$defaults['home_message_image'] = false;
	$defaults['home_message_frame'] = 'tablet';

	return $defaults;
}
add_filter('siteorigin_theme_default_settings', 'so_current_theme_setting_defaults');