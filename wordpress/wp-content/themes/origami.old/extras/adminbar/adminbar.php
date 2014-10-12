<?php

/**
 * Active the First Run extra. This will just display a bar in the admin after a user first installs this theme
 *
 * @action after_switch_theme
 */
function siteorigin_adminbar_first_run_activate() {
	define( 'SITEORIGIN_FIRST_RUN_ACTIVE', true );
}
add_action( 'after_switch_theme', 'siteorigin_adminbar_first_run_activate' );


/**
 * Initialize the default admin bars.
 */
function siteorigin_adminbar_init() {
	if ( !is_admin() ) return;

	$bar = null;
	$bar = apply_filters( 'siteorigin_adminbar', $bar );

	if ( !empty( $bar ) ) {
		$dismissed = get_user_meta( get_current_user_id(), 'siteorigin_admin_bars_dismissed', true );
		if ( !empty( $dismissed ) && !empty( $dismissed[ $bar->id ] ) ) $bar = null;
	}

	if ( !empty( $bar ) ) {
		if ( empty( $bar->icon ) ) $bar->icon = 'http://www.gravatar.com/avatar/' . md5( 'greg@siteorigin.com' ) . '?s=44';
	}

	$GLOBALS['siteorigin_adminbar_active'] = $bar;
}
add_action( 'current_screen', 'siteorigin_adminbar_init' );


/**
 * Set up the default admin bars.
 *
 * @param $bar
 * @return object
 */
function siteorigin_adminbar_defaults( $bar ) {
	$screen = get_current_screen();

	if ( $screen->id == 'themes' && defined( 'SITEORIGIN_FIRST_RUN_ACTIVE' ) )
		$bar = (object)array( 'id' => 'firstrun', 'message' => array( 'extras/adminbar/messages/message', 'firstrun' ) );
	
	if($screen->id == 'appearance_page_custom-background')
		$bar = (object)array( 'id' => 'custom-background', 'message' => array( 'extras/adminbar/messages/message', 'background' ) );
	
	return $bar;
}
add_filter( 'siteorigin_adminbar', 'siteorigin_adminbar_defaults' );


/**
 * Enqueue admin bar scripts if there's an admin bar active.
 *
 * @param $suffix
 * @return mixed
 */
function siteorigin_adminbar_enqueue( $suffix ) {
	// This adds an extra tab to the theme pages
	if(($suffix == 'theme-install.php' || $suffix == 'themes.php') && !wp_script_is('siteorigin-themes-tab')){
		wp_enqueue_script('siteorigin-themes-tab', get_template_directory_uri() . '/extras/adminbar/assets/tab.min.js', array('jquery'), SITEORIGIN_THEME_VERSION);
		wp_localize_script('siteorigin-themes-tab', 'siteoriginAdminTab', array(
			'text' => __('SiteOrigin Themes', 'siteorigin'),
			'url' => admin_url('theme-install.php?tab=search&type=author&s=gpriday')
		));
	}
	
	// Only enqueue these if there's an active admin bar
	if ( !empty( $GLOBALS['siteorigin_adminbar_active'] ) ) {
		wp_enqueue_script( 'siteorigin-admin-bar', get_template_directory_uri() . '/extras/adminbar/assets/bar.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		wp_enqueue_style( 'siteorigin-admin-bar', get_template_directory_uri() . '/extras/adminbar/assets/bar.css', array(), SITEORIGIN_THEME_VERSION );
	}
}
add_action( 'admin_enqueue_scripts', 'siteorigin_adminbar_enqueue' );


/**
 * Display the admin bar
 *
 * @action in_admin_header
 */
function siteorigin_adminbar_render() {
	if ( empty( $GLOBALS['siteorigin_adminbar_active'] ) ) return;

	?>
	<div id="siteorigin-admin-bar" data-type="<?php echo esc_attr( $GLOBALS['siteorigin_adminbar_active']->id ) ?>">
		<div class="inner">
			<img src="<?php echo esc_url( $GLOBALS['siteorigin_adminbar_active']->icon ) ?>" class="icon" width="44" height="44" />
			<a href="#dismiss" class="dismiss"><?php _e( 'dismiss', 'siteorigin' ) ?></a>
			<strong><?php call_user_func_array( 'get_template_part', $GLOBALS['siteorigin_adminbar_active']->message ) ?></strong>
		</div>
	</div>
	<?php
}
add_action( 'in_admin_header', 'siteorigin_adminbar_render' );


/**
 * An ajax callback to dismiss the admin bar.
 */
function siteorigin_adminbar_dismiss_bar() {
	$dismiss = $previous = get_user_meta( get_current_user_id(), 'siteorigin_admin_bars_dismissed', true );
	if ( empty( $dismiss ) ) $dismiss = array();

	$bar = stripslashes( $_POST['bar'] );
	$dismiss[ $bar ] = true;

	update_user_meta( get_current_user_id(), 'siteorigin_admin_bars_dismissed', $dismiss, $previous );

	exit();
}
add_action( 'wp_ajax_siteorigin_admin_dismiss_bar', 'siteorigin_adminbar_dismiss_bar' );

/**
 * Add the SiteOrigin news dashboard widget.
 */
function siteorigin_adminbar_dashboard_widgets_setup() {
	// add a custom dashboard widget
	wp_add_dashboard_widget( 'dashboard_siteorigin_feed', __('SiteOrigin Theme News', 'siteorigin'), 'siteorigin_adminbar_dashboard_widgets_output' ); //add new RSS feed output

	// We don't want the widget showing up in the core column
	global $wp_meta_boxes;

	// Save the widget
	$my_widget = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_siteorigin_feed'];
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_siteorigin_feed']);

	$wp_meta_boxes['dashboard']['side']['core'] = array_merge(
		array('dashboard_siteorigin_feed' => $my_widget),
		$wp_meta_boxes['dashboard']['side']['core']
	);
}
add_action('wp_dashboard_setup', 'siteorigin_adminbar_dashboard_widgets_setup');

/**
 * Render the SiteOrigin news dashboard widget
 */
function siteorigin_adminbar_dashboard_widgets_output() {
	echo '<div class="rss-widget">';
	wp_widget_rss_output(array(
		'url' => 'http://siteorigin.com/feed/',
		'title' => __('SiteOrigin Theme News', 'siteorigin'),
		'items' => 4,
		'show_summary' => 1,
		'show_author' => 0,
		'show_date' => 1
	));
	echo "</div>";
}