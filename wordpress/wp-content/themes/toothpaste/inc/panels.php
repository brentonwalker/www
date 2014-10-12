<?php
/**
 * Integrates this theme with SiteOrigin panels page builder.
 * 
 * @package toothpaste
 * @since 1.0
 */

/**
 * Adds default page layouts
 *
 * @param $layouts
 */
function toothpaste_prebuilt_page_layouts($layouts){
	return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts', 'toothpaste_prebuilt_page_layouts');

function toothpaste_panels_settings($settings){
	$settings['home-page'] = true;
	$settings['responsive'] = true;
	$settings['margin-bottom'] = 40;
	$settings['margin-sides'] = 40;
	return $settings;
}
add_filter('sitesiteorigin_panels_settings', 'toothpaste_panels_settings');