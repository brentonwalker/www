<?php

function siteorigin_plugin_activation_page(){
	if(!isset( $_GET[sanitize_key( 'siteorigin-pa-install' )])) return;
	
	add_theme_page(
		__('Install Theme Plugin', 'siteorigin'),
		__('Install Theme Plugin', 'siteorigin'),
		'install_plugins',
		'siteorigin_plugin_activation',
		'siteorigin_plugin_activation_render_page'
	);
}
add_action('admin_menu', 'siteorigin_plugin_activation_page');

function siteorigin_plugin_activation_render_page(){
	?>
	<div class="wrap">
		<?php siteorigin_plugin_activation_do_plugin_install() ?>
	</div>
	<?php
}

/**
 * Install a plugin
 */
function siteorigin_plugin_activation_do_plugin_install(){
	/** All plugin information will be stored in an array for processing */
	$plugin = array();

	/** Checks for actions from hover links to process the installation */
	if ( isset( $_GET[sanitize_key( 'plugin' )] ) && ( isset( $_GET[sanitize_key( 'siteorigin-pa-install' )] ) && 'install-plugin' == $_GET[sanitize_key( 'siteorigin-pa-install' )] ) && current_user_can('install_plugins') ) {
		check_admin_referer( 'siteorigin-pa-install' );

		$plugin['name']   = $_GET[sanitize_key( 'plugin_name' )]; // Plugin name
		$plugin['slug']   = $_GET[sanitize_key( 'plugin' )]; // Plugin slug
		$plugin['source'] = $_GET[sanitize_key( 'plugin_source' )]; // Plugin source

		/** Pass all necessary information via URL if WP_Filesystem is needed */
		$url = wp_nonce_url(
			add_query_arg(
				array(
					'page'          => 'siteorigin_plugin_activation',
					'plugin'        => $plugin['slug'],
					'plugin_name'   => $plugin['name'],
					'plugin_source' => $plugin['source'],
					'siteorigin-pa-install' => 'install-plugin',
				),
				admin_url( 'themes.php' )
			),
			'siteorigin-pa-install'
		);
		$method = ''; // Leave blank so WP_Filesystem can populate it as necessary
		$fields = array( sanitize_key( 'siteorigin-pa-install' ) ); // Extra fields to pass to WP_Filesystem

		if ( false === ( $creds = request_filesystem_credentials( $url, $method, false, false, $fields ) ) )
			return true;

		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( $url, $method, true, false, $fields ); // Setup WP_Filesystem
			return true;
		}

		require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // Need for plugins_api
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // Need for upgrade classes

		/** Prep variables for Plugin_Installer_Skin class */
		$title = sprintf( __('Installing %s', 'siteorigin'), $plugin['name'] );
		$url   = add_query_arg( array( 'action' => 'install-plugin', 'plugin' => $plugin['slug'] ), 'update.php' );
		if ( isset( $_GET['from'] ) )
			$url .= add_query_arg( 'from', urlencode( stripslashes( $_GET['from'] ) ), $url );

		$nonce = 'install-plugin_' . $plugin['slug'];

		/** Prefix a default path to pre-packaged plugins */
		$source = $plugin['source'];
		
		/** Create a new instance of Plugin_Upgrader */
		$upgrader = new Plugin_Upgrader( $skin = new Plugin_Installer_Skin( compact( 'type', 'title', 'url', 'nonce', 'plugin', 'api' ) ) );

		/** Perform the action and install the plugin from the $source urldecode() */
		$upgrader->install( $source );

		/** Flush plugins cache so we can make sure that the installed plugins list is always up to date */
		wp_cache_flush();
	}
}

function siteorigin_plugin_activation_install_url($plugin, $plugin_name, $source){
	$plugins = get_plugins();
	$plugins = array_keys($plugins);
	
	$installed = false;
	foreach($plugins as $plugin_path){
		if(strpos($plugin_path, $plugin.'/') === 0) {
			$installed = true;
			break;
		}
	}
	
	if($installed && !is_plugin_active($plugin)){
		return wp_nonce_url(self_admin_url('plugins.php?action=activate&plugin='.$plugin_path), 'activate-plugin_'.$plugin_path);
	}
	elseif($installed && is_plugin_active($plugin)){
		return '#';
	}
	else{
		return wp_nonce_url(
			add_query_arg(
				array(
					'page'          => 'siteorigin_plugin_activation',
					'plugin'        => $plugin,
					'plugin_name'   => $plugin_name,
					'plugin_source' => $source,
					'siteorigin-pa-install' => 'install-plugin',
				),
				admin_url( 'themes.php' )
			),
			'siteorigin-pa-install'
		);
	}
}

function siteorigin_plugin_activation_is_activating($plugin){
	if(!is_admin()) return false;
	return (
		basename($_SERVER['PHP_SELF']) == 'plugins.php'
		&& isset($_GET['action'])
		&& $_GET['action'] == 'activate'
		&& isset($_GET['plugin'])
		&& $_GET['plugin'] == $plugin.'/'.$plugin.'.php'
	);
}