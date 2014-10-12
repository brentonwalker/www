<?php

function toothpaste_theme_settings(){
	siteorigin_settings_add_section('general', __('General', 'toothpaste'));
	siteorigin_settings_add_section('layout', __('Layout', 'toothpaste'));
	siteorigin_settings_add_section('blog', __('Blog', 'toothpaste'));

	/**
	 * General Settings
	 */
	
	siteorigin_settings_add_field('general', 'logo', 'media', __('Logo', 'toothpaste'), array(
		'choose' => __('Choose Image', 'toothpaste'),
		'update' => __('Set Logo', 'toothpaste'),
	));

	siteorigin_settings_add_field('general', 'site_description', 'checkbox', __('Site Description', 'toothpaste'), array(
		'description' => __('Display your site description under your logo.', 'toothpaste')
	));
	
	siteorigin_settings_add_teaser('general', 'ajax_comments', __('Ajax Comments', 'toothpaste'), array(
		'description' => __('Keep your conversations flowing with ajax comments.', 'toothpaste')
	));

	siteorigin_settings_add_field('general', 'footer_copyright', 'text', __('Footer Copyright Text', 'toothpaste'), array(
		'description' => __('Display your site description under your logo.', 'toothpaste')
	));

	/**
	 * Layout Settings
	 */

	siteorigin_settings_add_field('layout', 'responsive', 'checkbox', __('Responsive Layout', 'toothpaste'), array(
		'description' => __('Scale your layout for small screen devices.', 'toothpaste')
	));
	
	siteorigin_settings_add_teaser('layout', 'responsive_menu', __('Responsive Menu', 'toothpaste'), array(
		'description' => __('Use a special responsive menu for small screen devices.', 'toothpaste')
	));
	
	/**
	 * Blog Settings
	 */

	siteorigin_settings_add_field('blog', 'layout', 'select', __('Blog Layout', 'toothpaste'), array(
		'options' => array(
			'' => __('Full Post', 'toothpaste'),
			'summary' => __('Post Summary', 'toothpaste'),
		)
	));
}
add_action('admin_init', 'toothpaste_theme_settings');

function toothpaste_theme_setting_defaults($defaults){
	$defaults['general_logo'] = '';
	$defaults['general_ajax_comments'] = false;
	$defaults['general_site_description'] = true;
	$defaults['general_footer_copyright'] = __('Copyright {site-title} {year}', 'toothpaste');
	
	$defaults['layout_responsive'] = true;
	$defaults['layout_responsive_menu'] = true;
	
	$defaults['blog_layout'] = 'summary';

	return $defaults;
}
add_filter('siteorigin_theme_default_settings', 'toothpaste_theme_setting_defaults');