<?php

if( !class_exists('SiteOrigin_WPUpdatesThemeUpdater') ) {
	class SiteOrigin_WPUpdatesThemeUpdater {

		var $api_url;
		var $theme_id;
		var $theme_slug;

		function __construct( $api_url, $theme_id, $theme_slug ) {
			$this->api_url = $api_url;
			$this->theme_id = $theme_id;
			$this->theme_slug = $theme_slug;

			// Only run this if we don't have an order number set
			$theme = basename( get_template_directory() );
			if(get_option( 'siteorigin_order_number_' . $theme, false ) === false) {
				//
				add_filter( 'pre_set_site_transient_update_themes', array(&$this, 'check_for_update') );
			}

			// This is for testing only!
			//set_site_transient('update_themes', null);
		}

		function check_for_update( $transient ) {
			if (empty($transient->checked)) return $transient;

			$request_args = array(
				'id' => $this->theme_id,
				'slug' => $this->theme_slug,
				'version' => $transient->checked[$this->theme_slug]
			);
			$request_string = $this->prepare_request( 'theme_update', $request_args );
			$raw_response = wp_remote_post( $this->api_url, $request_string );

			$response = null;
			if( !is_wp_error($raw_response) && ($raw_response['response']['code'] == 200) )
				$response = unserialize($raw_response['body']);

			if( !empty($response) ) // Feed the update data into WP updater
				$transient->response[$this->theme_slug] = $response;

			return $transient;
		}

		function prepare_request( $action, $args ) {
			global $wp_version;

			return array(
				'body' => array(
					'action' => $action,
					'request' => serialize($args),
					'api-key' => md5(home_url())
				),
				'user-agent' => 'WordPress/'. $wp_version .'; '. home_url()
			);
		}

	}
}

if(defined('SITEORIGIN_THEME_UPDATE_ID')) {
	new SiteOrigin_WPUpdatesThemeUpdater( 'http://wp-updates.com/api/1/theme', SITEORIGIN_THEME_UPDATE_ID, basename(get_template_directory()) );
}
