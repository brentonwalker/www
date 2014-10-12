<?php
/**
 * Integrates this theme with SiteOrigin panels page builder.
 * 
 * @package so-current
 * @since 1.0
 * @license GPL 2.0
 */

/**
 * Adds default page layouts
 *
 * @param $layouts
 */
function so_current_prebuilt_page_layouts($layouts){
	return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts', 'so_current_prebuilt_page_layouts');

/**
 * Configure the SiteOrigin page builder settings.
 * 
 * @param $settings
 * @return mixed
 */
function so_current_panels_settings($settings){
	$settings['home-page'] = true;
	return $settings;
}
add_filter('sitesiteorigin_panels_settings', 'so_current_panels_settings');