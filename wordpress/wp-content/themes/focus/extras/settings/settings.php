<?php
/**
 * Handle the SiteOrigin theme settings panel.
 *
 * @package SiteOrigin Extras
 */


/**
 * Intialize the theme settings page
 *
 * @param $theme_name
 */
function siteorigin_settings_init( $theme_name = null ) {
	if ( empty( $theme_name ) ) {
		$theme_name = basename( get_template_directory() );
	}

	$GLOBALS['siteorigin_settings_theme_name'] = $theme_name;
	$GLOBALS['siteorigin_settings_name'] = $theme_name . '_theme_settings';
	$GLOBALS['siteorigin_settings_defaults'] = apply_filters( 'siteorigin_theme_default_settings', array() );
	$GLOBALS['siteorigin_settings'] = wp_parse_args( get_option( $theme_name . '_theme_settings', array() ), $GLOBALS['siteorigin_settings_defaults'] );

	// Register all the actions for the settings page
	add_action( 'admin_menu', 'siteorigin_settings_admin_menu' );
	add_action( 'admin_init', 'siteorigin_settings_admin_init', 8 );
	add_action( 'siteorigin_adminbar', 'siteorigin_settings_adminbar' );

	add_action( 'admin_enqueue_scripts', 'siteorigin_settings_enqueue_scripts' );
}

/**
 * Initialize admin settings in the admin
 *
 * @action admin_init
 */
function siteorigin_settings_admin_init() {
	register_setting( 'theme_settings', $GLOBALS['siteorigin_settings_name'], 'siteorigin_settings_validate' );
}

/**
 * Set up the theme settings page.
 *
 * @action admin_menu
 */
function siteorigin_settings_admin_menu() {
	$page = add_theme_page( __( 'Theme Settings', 'siteorigin' ), __( 'Theme Settings', 'siteorigin' ), 'edit_theme_options', 'theme_settings_page', 'siteorigin_settings_render' );

	add_action( 'load-' . $page, 'siteorigin_settings_theme_help' );
}

/**
 * Render the theme settings page
 */
function siteorigin_settings_render() {
	locate_template( 'extras/settings/page.php', true, false );
}

/**
 * Enqueue all the settings scripts.
 *
 * @param $prefix
 */
function siteorigin_settings_enqueue_scripts( $prefix ) {
	if ( $prefix != 'appearance_page_theme_settings_page' ) return;

	wp_enqueue_script( 'siteorigin-settings', get_template_directory_uri() . '/extras/settings/settings.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
	wp_enqueue_style( 'siteorigin-settings', get_template_directory_uri() . '/extras/settings/settings.css', array(), SITEORIGIN_THEME_VERSION );

	if(wp_script_is('wp-color-picker', 'registered')){
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}
	else{
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );
	}
	
	// This is for the media uploader
	if ( function_exists( 'wp_enqueue_media' ) ) wp_enqueue_media();
}

/**
 * Add the admin bar to the settings page
 *
 * @param $bar
 * @return object|null
 */
function siteorigin_settings_adminbar( $bar ) {
	$screen = get_current_screen();
	if ( $screen->id == 'appearance_page_theme_settings_page' ) {
		$bar = (object)array( 'id' => $GLOBALS['siteorigin_settings_name'], 'message' => array( 'extras/settings/message' ) );
	}

	return $bar;
}

/**
 * Add a settings section.
 *
 * @param $id
 * @param $name
 */
function siteorigin_settings_add_section( $id, $name ) {
	add_settings_section( $id, $name, '__return_false', 'theme_settings' );
}

/**
 * Add a setting
 *
 * @param string $section
 * @param string $id
 * @param string $type
 * @param string $title
 * @param array $args
 */
function siteorigin_settings_add_field( $section, $id, $type, $title = null, $args = array() ) {
	global $wp_settings_fields;
	if ( isset( $wp_settings_fields[ 'theme_settings' ][ $section ][ $id ] ) ) {
		if ( isset( $wp_settings_fields[ 'theme_settings' ][ $section ][ $id ][ 'args' ][ 'type' ] ) && $wp_settings_fields[ 'theme_settings' ][ $section ][ $id ][ 'args' ][ 'type' ] == 'teaser' ) {
			if ( empty( $args[ 'description' ] ) && !empty( $wp_settings_fields[ 'theme_settings' ][ $section ][ $id ][ 'args' ][ 'description' ] ) ) {
				// Copy across the description field from the teaser
				$args[ 'description' ] = $wp_settings_fields[ 'theme_settings' ][ $section ][ $id ][ 'args' ][ 'description' ];
			}
			if ( empty( $name ) && !empty( $wp_settings_fields[ 'theme_settings' ][ $section ][ $id ][ 'title' ] ) ) {
				// Copy across the title field
				$title = $wp_settings_fields[ 'theme_settings' ][ $section ][ $id ][ 'title' ];
			}
			
			// Replace the teaser field with the actual setting
			$wp_settings_fields[ 'theme_settings' ][ $section ][ $id ] = array(
				'id' => $id,
				'title' => $title,
				'callback' => 'siteorigin_settings_field',
				'args' => $args
			);
		}
		else return;
	}

	$args = wp_parse_args( $args, array(
		'section' => $section,
		'field' => $id,
		'type' => $type,
	) );

	add_settings_field( $id, $title, 'siteorigin_settings_field', 'theme_settings', $section, $args );
}

/**
 * Adds a field that might only be available in another version of the theme.
 *
 * @param $section
 * @param $id
 * @param $name
 * @param array $args
 */
function siteorigin_settings_add_teaser( $section, $id, $name, $args = array() ) {
	global $wp_settings_fields;
	if ( isset( $wp_settings_fields['theme_settings'][ $section ][ $id ] ) ) return;

	$args = wp_parse_args( $args, array(
		'section' => $section,
		'field' => $id,
		'type' => 'teaser',
	) );

	add_settings_field( $id, $name, 'siteorigin_settings_field', 'theme_settings', $section, $args );
}

/**
 * Get the value of a setting, or the default value.
 *
 * @param string $name The setting name
 * @param mixed $default The default setting
 * @return mixed
 */
function siteorigin_setting( $name , $default = null) {
	if ( !is_null( $default ) && empty( $GLOBALS[ 'siteorigin_settings' ][ $name ] ) ) return $default;

	if ( !isset( $GLOBALS[ 'siteorigin_settings' ][ $name ] ) ) {
		trigger_error( sprintf( __( 'Calling undefined setting [%s]', 'siteorigin' ), $name ) );
		return null;
	}
	else return $GLOBALS['siteorigin_settings'][ $name ];
}

/**
 * Render a settings field.
 *
 * @param $args
 */
function siteorigin_settings_field( $args ) {
	$field_name = $GLOBALS['siteorigin_settings_name'] . '[' . $args['section'] . '_' . $args['field'] . ']';
	$field_id = $args['section'] . '_' . $args['field'];
	$current = isset( $GLOBALS['siteorigin_settings'][ $field_id ] ) ? $GLOBALS['siteorigin_settings'][ $field_id ] : null;

	switch ( $args['type'] ) {
		case 'checkbox' :
			?>
			<input id="<?php echo esc_attr( $field_id ) ?>" name="<?php echo esc_attr( $field_name ) ?>" type="checkbox" <?php checked( $current ) ?> />
			<label for="<?php echo esc_attr( $field_id ) ?>"><?php echo esc_attr( !empty( $args['label'] ) ? $args['label'] : __( 'Enabled', 'siteorigin' ) ) ?></label>
			<?php
			break;
		case 'text' :
		case 'number' :
			?>
			<input
				id="<?php echo esc_attr( $field_id ) ?>"
				name="<?php echo esc_attr( $field_name ) ?>"
				class="<?php echo esc_attr( $args['type'] == 'number' ? 'small-text' : 'regular-text' ) ?>"
				size="25"
				type="<?php echo esc_attr( $args['type'] ) ?>"
				value="<?php echo esc_attr( $current ) ?>" />
			<?php if(!empty($args['options'])) : ?>
				<select class="input-field-select">
					<option></option>
					<?php foreach($args['options'] as $value => $label) : ?>
						<option value="<?php echo esc_attr($value) ?>"><?php echo esc_html($label) ?></option>
					<?php endforeach; ?>
				</select>
			<?php endif;
			break;

		case 'select' :
			?>
			<select id="<?php echo esc_attr( $field_id ) ?>" name="<?php echo esc_attr( $field_name ) ?>">
				<?php foreach ( $args['options'] as $option_id => $label ) : ?>
					<option value="<?php echo esc_attr( $option_id ) ?>" <?php selected( $option_id, $current ) ?>><?php echo esc_attr( $label ) ?></option>
				<?php endforeach ?>
			</select>
			<?php
			break;

		case 'textarea' :
			?><textarea id="<?php echo esc_attr( $field_id ) ?>" name="<?php echo esc_attr( $field_name ) ?>" class="large-text" rows="3"><?php echo esc_textarea( $current ) ?></textarea><?php
			break;

		case 'color' :
			if(wp_script_is('wp-color-picker', 'registered')){
				?><input type="text" value="<?php echo esc_attr( $current ) ?>" class="color-field" name="<?php echo esc_attr( $field_name ) ?>" /><?php
			}
			else{
				?>
				<div class="colorpicker-wrapper">
					<div class="color-indicator" style="background-color: <?php echo esc_attr( $current ) ?>"></div>
					<input type="text" id="<?php echo esc_attr( $field_id ) ?>" value="<?php echo esc_attr( $current ) ?>" name="<?php echo esc_attr( $field_name ) ?>" />

					<div class="farbtastic-container"></div>
				</div>
				<?php
			}
			break;
		
		case 'media':
			if(version_compare(get_bloginfo('version'), '3.5', '<')){
				printf(__('You need to <a href="%s">upgrade</a> to WordPress 3.5 to use media fields', 'siteorigin'), admin_url('update-core.php'));
				break;
			}
			
			if(!empty($current)) {
				$post = get_post($current);
				$src = wp_get_attachment_image_src($current, 'thumbnail');
				if(empty($src)) $src = wp_get_attachment_image_src($current, 'thumbnail', true);
			}
			else{
				$src = array('', 0, 0);
			}
			
			$choose_title = empty($args['choose']) ? __('Choose Media', 'siteorigin') : $args['choose'];
			$update_button = empty($args['update']) ? __('Set Media', 'siteorigin') : $args['update'];
			
			?>
				<div class="media-field-wrapper">
					<div class="current">
						<div class="thumbnail-wrapper">
							<img src="<?php echo esc_url($src[0]) ?>" class="thumbnail" <?php if(empty($post)) echo "style='display:none'" ?> />
						</div>
						<div class="title"><?php if(!empty($post)) echo esc_attr($post->post_title) ?></div>
					</div>
					<a href="#" class="media-upload-button" data-choose="<?php echo esc_attr($choose_title) ?>" data-update="<?php echo esc_attr($update_button) ?>">
						<?php echo esc_html($choose_title) ?>
					</a>

					<a href="#" class="media-remove-button"><?php _e('Remove', 'siteorigin') ?></a>
				</div>

				<input type="hidden" id="<?php echo esc_attr( $field_id ) ?>" value="<?php echo esc_attr( $current ) ?>" name="<?php echo esc_attr( $field_name ) ?>" />
			<?php
			break;
		
		case 'teaser' :
			$theme = basename( get_template_directory() );
			?>
			<a class="premium-teaser siteorigin-premium-teaser" href="<?php echo admin_url( 'themes.php?page=premium_upgrade' ) ?>" target="_blank">
				<em></em>
				<?php printf( __( 'Only available in <strong>%s Premium</strong> - <strong class="upgrade">Upgrade Now</strong>', 'siteorigin' ), ucfirst($theme) ) ?>
				<?php if(!empty($args['teaser-image'])) : ?>
					<div class="teaser-image"><img src="<?php echo esc_url($args['teaser-image']) ?>" width="220" height="120" /><div class="pointer"></div></div>
				<?php endif; ?>
			</a>
			<?php
			break;

		default :
			_e( 'Unknown Field Type', 'siteorigin' );
			break;
	}

	if ( !empty( $args['description'] ) ) echo '<p class="description">' . $args['description'] . '</p>';
}

/**
 * Validate the settings values
 *
 * @param $values
 * @return array
 */
function siteorigin_settings_validate( $values ) {
	global $wp_settings_fields;

	$theme_name = basename( get_template_directory() );
	$current = get_option( $theme_name . '_theme_settings', array() );

	set_theme_mod( '_theme_settings_current_tab', isset( $_REQUEST['theme_settings_current_tab'] ) ? $_REQUEST['theme_settings_current_tab'] : 0 );

	$changed = false;
	foreach ( $wp_settings_fields['theme_settings'] as $section_id => $fields ) {
		foreach ( $fields as $field_id => $field ) {
			$name = $section_id . '_' . $field_id;

			if ( $field['args']['type'] == 'checkbox' ) {
				$values[ $name ] = !empty( $values[ $name ] );
			} elseif ( $field['args']['type'] == 'number' ) {
				$values[ $name ] = isset( $values[ $name ] ) ? intval( $values[ $name ] ) : $GLOBALS['siteorigin_settings_defaults'][ $name ];
			}

			if ( !isset( $current[ $name ] ) || ( isset( $values[ $name ] ) && isset( $current[ $name ] ) && $values[ $name ] != $current[ $name ] ) ) $changed = true;

			// See if this needs any special validation
			if ( !empty( $field['args']['validator'] ) && method_exists( 'SiteOrigin_Settings_Validator', $field['args']['validator'] ) ) {
				$values[ $name ] = call_user_func( array( 'SiteOrigin_Settings_Validator', $field['args']['validator'] ), $values[ $name ] );
			}
		}
	}

	if ( $changed ) {
		do_action( 'siteorigin_settings_changed' );

		/**
		 * An action triggered when the theme settings have changed.
		 */
		set_theme_mod( 'siteorigin_settings_changed', true );
	}

	return $values;
}

/**
 * Display a message when the settings have been changed
 */
function siteorigin_settings_change_message() {
	if ( get_theme_mod( 'siteorigin_settings_changed' ) ) {
		remove_theme_mod( 'siteorigin_settings_changed' );

		?>
		<div id="setting-updated" class="updated">
			<p><strong><?php _e( 'Settings saved.', 'siteorigin' ) ?></strong></p>
		</div>
		<?php

		/**
		 * This is an action that the theme can use to display a settings changed message.
		 */
		do_action( 'siteorigin_settings_changed_message' );
	}
}

function siteorigin_settings_theme_help(){
	$screen = get_current_screen();
	$theme_name = basename( get_template_directory() );
	
	$text = sprintf(
		__( "Read %s's <a href='%s'>theme documentation</a> for help with these settings.", 'siteorigin' ),
		ucfirst($theme_name),
		'http://support.siteorigin.com/'.$theme_name.'/'
	); 
	
	$screen->add_help_tab( array(
		'id' => 'siteorigin_settings_help_tab',
		'title' => __( 'Settings Help', 'siteorigin' ),
		'content' => '<p>' . $text . '</p>',
	) );
}

function siteorigin_settings_media_view_strings($strings, $post){
	if(!empty($post)) return $strings;
	$screen = get_current_screen();
	if($screen->id != 'appearance_page_theme_settings_page') return $strings;
	
	// Remove these strings, to remove the tabs
	// Luckily the JS gracefully handles these being unset
	unset($strings['createNewGallery']);
	unset($strings['createGalleryTitle']);
	unset($strings['insertFromUrlTitle']);
	
	$strings['insertIntoPost'] = __('Set Media File', 'siteorigin');
	
	//var_dump($strings);
	//die();
	
	
	return $strings;
}
add_filter('media_view_strings', 'siteorigin_settings_media_view_strings', 10, 2);

/**
 * Settings validators.
 */
class SiteOrigin_Settings_Validator {
	/**
	 * Extracts the twitter username from the string.
	 *
	 * @static
	 * @param $twitter
	 * @return bool|mixed|string
	 */
	static function twitter( $twitter ) {
		$twitter = trim( $twitter );
		if ( empty( $twitter ) ) return false;
		if ( $twitter[ 0 ] == '@' ) return preg_replace( '/^@+/', '', $twitter );

		$url = parse_url( $twitter );

		// Check if this is a twitter URL
		if ( isset( $url['host'] ) && !in_array( $url['host'], array( 'twitter.com', 'www.twitter.com' ) ) ) return false;

		// Check if this is a fragment URL
		if ( isset( $url['fragment'] ) && $url['fragment'][ 0 ] == '!' )
			return substr( $url['fragment'], 2 );

		// And our very last attempt... take it that the username is on the end of the path
		if ( isset( $url['path'] ) ) {
			$parts = explode( '/', $url['path'] );
			$username = array_pop( $parts );
			return $username;
		}

		return false;
	}
}