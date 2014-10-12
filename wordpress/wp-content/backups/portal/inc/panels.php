<?php
/**
 * Integrates this theme with SiteOrigin panels page builder.
 * 
 * @package portal
 * @since 1.0
 * @license GPL 2.0
 */

/**
 * Adds default page layouts
 *
 * @param $layouts
 */
function portal_prebuilt_page_layouts($layouts){
	return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts', 'portal_prebuilt_page_layouts');

/**
 * Configure the SiteOrigin page builder settings.
 * 
 * @param $settings
 * @return mixed
 */
function portal_panels_settings($settings){
	$settings['home-page'] = true;
	$settings['margin-bottom'] = 40;
	return $settings;
}
add_filter('sitesiteorigin_panels_settings', 'portal_panels_settings');

/**
 * Set the default gallery type for Page Builder
 * 
 * @return string
 */
function portal_default_gallery_type(){
	return 'slider';
}
add_action('siteorigin_panels_gallery_default_type', 'portal_default_gallery_type');