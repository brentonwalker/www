<?php

/**
 * Add some custom SiteOrigin update information to the update_themes transient.
 *
 * @param $current
 * @return mixed
 */
function siteorigin_theme_update_filter( $current ) {
	$theme = basename( get_template_directory() );
	$order_number = get_option( 'siteorigin_order_number_' . $theme, false );
	if ( empty( $order_number ) ) return $current;

	// Updates are not compatible with the old child theme system
	if ( basename( get_stylesheet_directory() ) == basename( get_template_directory() ) . '-premium' ) return $current;

	$request = wp_remote_post(
		SITEORIGIN_THEME_ENDPOINT . '/premium/' . $theme . '/?rand=' . rand( 0, getrandmax() ),
		array(
			'body' => array(
				'action' => 'update_info',
				'version' => SITEORIGIN_THEME_VERSION,
				'order_number' => $order_number
			)
		)
	);

	if ( !is_wp_error( $request ) && $request['response']['code'] == 200 && !empty( $request['body'] ) ) {
		$data = unserialize( $request['body'] );
		if ( empty( $current ) )  $current = new stdClass();
		if ( empty( $current->response ) ) $current->response = array();
		if ( !empty( $data ) ) $current->response[ $theme ] = $data;
	}

	return $current;
}

add_filter( 'pre_set_site_transient_update_themes', 'siteorigin_theme_update_filter' );

/**
 * Add the order number setting.
 *
 * @action admin_init
 */
function siteorigin_theme_update_settings() {
	$theme = basename( get_template_directory() );
	$name = 'siteorigin_order_number_' . $theme;

	add_settings_section(
		'so-order-code',
		sprintf( __( '%s Order Code', 'siteorigin' ), ucfirst( $theme ) ),
		'__return_false',
		'general'
	);

	add_settings_field(
		'so-order-code-field',
		__( 'Order Code', 'siteorigin' ),
		'siteorigin_theme_update_settings_order_field',
		'general',
		'so-order-code'
	);

	register_setting( 'general', $name, 'siteorigin_theme_update_refresh' );
}

add_action( 'admin_init', 'siteorigin_theme_update_settings' );

/**
 * Render the order field
 */
function siteorigin_theme_update_settings_order_field() {
	$theme = basename( get_template_directory() );
	$name = 'siteorigin_order_number_' . $theme;

	?>
	<input type="text" class="regular-text code" name="<?php echo esc_attr( $name ) ?>" value="<?php echo esc_attr( get_option( $name, false ) ) ?>" />
	<p class="description"><?php _e( 'Find your order code in your original download email from SiteOrigin', 'siteorigin' ); ?></p>
	<?php
}

function siteorigin_theme_update_refresh( $code ) {
	// This tells the theme update to recheck
	set_site_transient( 'update_themes', null );
	return $code;
}