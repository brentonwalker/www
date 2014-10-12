<?php

/**
 * Initialize the panels extra
 */
function siteorigin_panels_init(){
}
add_action('after_setup_theme', 'siteorigin_panels_init');

/**
 * Add the admin menu entries
 */
function siteorigin_panels_admin_menu(){
	$panels_support = get_theme_support( 'siteorigin-panels' );
	if ( $panels_support === false || empty($panels_support[0]['home-page']) ) return;
	
	add_theme_page(
		__('Custom Home Page', 'origami'),
		__('Home Page', 'origami'),
		'edit_theme_options',
		'so_panels_home_page',
		'siteorigin_panels_render_admin_home_page'
	);
}
add_action('admin_menu', 'siteorigin_panels_admin_menu');

/**
 * Render the page used to build the custom home page.
 */
function siteorigin_panels_render_admin_home_page(){
	add_meta_box( 'so-panels-panels', __( 'Page Builder', 'origami' ), 'siteorigin_panels_metabox_render', 'appearance_page_so_panels_home_page', 'advanced', 'high', array( 'panels' ) );
	get_template_part('extras/panels/tpl/admin', 'home-page');
}

/**
 * Callback to register the Panels Metaboxes
 */
function siteorigin_panels_metaboxes() {
	if ( get_theme_support( 'siteorigin-panels' ) === false ) return;
	
	add_meta_box( 'so-panels-panels', __( 'Page Builder', 'origami' ), 'siteorigin_panels_metabox_render', 'page', 'advanced', 'high', array( 'panels' ) );
}

add_action( 'add_meta_boxes', 'siteorigin_panels_metaboxes' );

function siteorigin_panels_save_home_page(){
	if(!isset($_POST['_sopanels_home_nonce']) || !wp_verify_nonce($_POST['_sopanels_home_nonce'], 'save')) return;
	if(!current_user_can('edit_theme_options')) return;
	
	// Check that we support the home page
	$panels_support = get_theme_support( 'siteorigin-panels' );
	if ( $panels_support === false || empty($panels_support[0]['home-page']) ) return;
	
	set_theme_mod('panels_home_page', siteorigin_panels_get_panels_data_from_post($_POST));
	set_theme_mod('panels_home_page_enabled', $_POST['panels_home_enabled'] == 'true' ? true : false);
	
	// If we've enabled the panels home page, change show_on_front to posts, this is reqired for the home page to work properly
	if($_POST['panels_home_enabled'] == 'true') update_option('show_on_front', 'posts');
}
add_action('admin_init', 'siteorigin_panels_save_home_page');

/**
 * Modify the front page template
 * 
 * @param $template
 * @return string
 */
function siteorigin_panels_filter_home_template($template){
	$panels_support = get_theme_support( 'siteorigin-panels' );
	if ( empty( $panels_support ) ) return $template;
	$panels_support = $panels_support[0];
	
	if(empty($panels_support['home-page'])) return $template;
	if(empty($panels_support['home-page-default'])) $panels_support['home-page-default'] = false;
	if(!get_theme_mod('panels_home_page_enabled', $panels_support['home-page-default'])) return $template;
	
	$GLOBALS['siteorigin_panels_is_panels_home'] = true;
	return locate_template(array(
		'home-panels.php',
		$template
	));
}
add_filter('home_template', 'siteorigin_panels_filter_home_template');

function siteorigin_panels_is_home(){
	return !empty($GLOBALS['siteorigin_panels_is_panels_home']);
}

/**
 * Disable home page panels when we change show_on_front to something other than posts.
 * @param $option
 * @param $old
 * @param $new
 */
function siteorigin_panels_disable_on_front_page_change($old, $new){
	if($new != 'posts'){
		// Disable panels home page
		set_theme_mod('panels_home_page_enabled', false);
	}
}
add_action('update_option_show_on_front', 'siteorigin_panels_disable_on_front_page_change', 10, 2);


/**
 * Check if we're currently viewing a panel.
 *
 * @param bool $can_edit Also check if the user can edit this page
 * @return bool
 */
function siteorigin_panels_is_panel($can_edit = false){
	// Check if this is a panel
	$is_panel =  (siteorigin_panels_is_home() || ( is_singular() && get_post_meta(get_the_ID(), 'panels_data', false) != '' ));
	return $is_panel && (!$can_edit || ( (is_singular() && current_user_can('edit_post', get_the_ID())) || ( siteorigin_panels_is_home() && current_user_can('edit_theme_options') ) ));
}

/**
 * Render a panel metabox.
 *
 * @param $post
 * @param $args
 */
function siteorigin_panels_metabox_render( $post, $args ) {
	if($args['args'][0] == 'settings') {
		siteorigin_premium_call_function(
			'siteorigin_panels_premium_settings_metabox',
			array(),
			array(
				'description' => __( 'Advanced functionality like the ability to create post type and page templates', 'origami' )
			)
		);
	}
	else{
		get_template_part( 'extras/panels/tpl/metabox', $args['args'][0] );
	}
}


/**
 * Enqueue the panels admin scripts
 *
 * @action admin_print_scripts-post-new.php
 * @action admin_print_scripts-post.php
 */
function siteorigin_panels_admin_enqueue_scripts($prefix) {
	if(get_theme_support( 'siteorigin-panels' ) === false) return;

	$screen = get_current_screen();
	if ( $screen->id == 'page' || $screen->base == 'appearance_page_so_panels_home_page') {
		wp_enqueue_script( 'jquery-ui-resizable' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'jquery-ui-button' );
		
		wp_enqueue_script( 'so-undomanager', get_template_directory_uri() . '/extras/panels/js/undomanager.min.js', array( ), 'fb30d7f' );

		wp_enqueue_script( 'so-panels-admin', get_template_directory_uri() . '/extras/panels/js/panels.admin.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		wp_enqueue_script( 'so-panels-admin-panels', get_template_directory_uri() . '/extras/panels/js/panels.admin.panels.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		wp_enqueue_script( 'so-panels-admin-grid', get_template_directory_uri() . '/extras/panels/js/panels.admin.grid.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		wp_enqueue_script( 'so-panels-admin-prebuilt', get_template_directory_uri() . '/extras/panels/js/panels.admin.prebuilt.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		wp_enqueue_script( 'so-panels-admin-tooltip', get_template_directory_uri() . '/extras/panels/js/panels.admin.tooltip.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );
		wp_enqueue_script( 'so-panels-admin-media', get_template_directory_uri() . '/extras/panels/js/panels.admin.media.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );

		wp_enqueue_script( 'so-panels-chosen', get_template_directory_uri() . '/extras/panels/js/chosen/chosen.jquery.min.min.js', array( 'jquery' ), SITEORIGIN_THEME_VERSION );

		wp_localize_script( 'so-panels-admin', 'panels', array(
			'previewUrl' => wp_nonce_url(add_query_arg('siteorigin_panels_preview', 'true', get_home_url()), 'siteorigin-panels-preview'),
			'i10n' => array(
				'buttons' => array(
					'insert' => __( 'Insert', 'origami' ),
					'cancel' => __( 'cancel', 'origami' ),
					'delete' => __( 'Delete', 'origami' ),
					'done' => __( 'Done', 'origami' ),
					'undo' => __( 'Undo', 'origami' ),
					'add' => __( 'Add', 'origami' ),
				),
				'messages' => array(
					'deleteColumns' => __( 'Columns deleted', 'origami' ),
					'deleteWidget' => __( 'Widget deleted', 'origami' ),
					'confirmLayout' => __( 'Are you sure you want to load this layout? It will overwrite your current page.', 'origami' ),
					'editWidget' => __('Edit %s Widget', 'origami')
				),
			),
		) );

		$layouts = apply_filters('siteorigin_panels_prebuilt_layouts', array());
		wp_localize_script('so-panels-admin-prebuilt', 'panelsPrebuiltLayouts', $layouts);

		// Localize the panels with the panels data
		if($screen->base == 'appearance_page_so_panels_home_page'){
			$panels_data = get_theme_mod('panels_home_page', null);
			if(is_null($panels_data)){
				// Load the default layout
				$panels_data = !empty($layouts['home']) ? $layouts['home'] : current($layouts);
			}
		}
		else{
			global $post;
			$panels_data = get_post_meta( $post->ID, 'panels_data', true );
		}
		
		if ( empty( $panels_data ) ) $panels_data = array();

		// Remove any panels that no longer exist.
		if ( !empty( $panels_data['panels'] ) ) {
			foreach ( $panels_data['panels'] as $i => $panel ) {
				if ( !class_exists( $panel['info']['class'] ) ) unset( $panels_data['panels'][$i] );
			}
		}

		if ( !empty( $panels_data ) ) {
			wp_localize_script( 'so-panels-admin', 'panelsData', $panels_data );
		}

		// This gives panels a chance to enqueue scripts too, without having to check the screen ID.
		do_action( 'siteorigin_panel_enqueue_admin_scripts' );
		
		// Incase any widgets have special scripts
		do_action( 'admin_enqueue_scripts' , 'widgets.php');
	}
}
add_action( 'admin_print_scripts-post-new.php', 'siteorigin_panels_admin_enqueue_scripts' );
add_action( 'admin_print_scripts-post.php', 'siteorigin_panels_admin_enqueue_scripts' );
add_action( 'admin_print_scripts-appearance_page_so_panels_home_page', 'siteorigin_panels_admin_enqueue_scripts' );


/**
 * Enqueue the admin panel styles
 *
 * @action admin_print_styles-post-new.php
 * @action admin_print_styles-post.php
 */
function siteorigin_panels_admin_enqueue_styles() {
	if(get_theme_support( 'siteorigin-panels' ) === false) return;

	$screen = get_current_screen();
	if ( $screen->id == 'page' || $screen->base == 'appearance_page_so_panels_home_page') {
		wp_enqueue_style( 'so-panels-jquery-ui', get_template_directory_uri() . '/extras/panels/css/jquery-ui-theme.css' );
		wp_enqueue_style( 'so-panels-admin', get_template_directory_uri() . '/extras/panels/css/panels-admin.css' );
		wp_enqueue_style( 'so-panels-chosen', get_template_directory_uri() . '/extras/panels/js/chosen/chosen.css' );
	
		do_action( 'siteorigin_panel_enqueue_admin_styles' );
	}
}
add_action( 'admin_print_styles-post-new.php', 'siteorigin_panels_admin_enqueue_styles' );
add_action( 'admin_print_styles-post.php', 'siteorigin_panels_admin_enqueue_styles' );
add_action( 'admin_print_styles-appearance_page_so_panels_home_page', 'siteorigin_panels_admin_enqueue_styles' );

/**
 * Add a help tab to pages with panels.
 */
function siteorigin_panels_add_help_tab($prefix) {
	if ( get_theme_support( 'siteorigin-panels' ) === false ) return;
	
	$screen = get_current_screen();
	if(
		($screen->base == 'post' && ($screen->id == 'page' || $screen->id == ''))
		|| ($screen->id == 'appearance_page_so_panels_home_page')
	) {
		$screen->add_help_tab( array(
			'id' => 'panels-help-tab', //unique id for the tab
			'title' => __( 'Page Builder', 'origami' ), //unique visible title for the tab
			'callback' => 'siteorigin_panels_add_help_tab_content'
		) );
	}
}
add_action('load-page.php', 'siteorigin_panels_add_help_tab');
add_action('load-post-new.php', 'siteorigin_panels_add_help_tab');
add_action('load-appearance_page_so_panels_home_page', 'siteorigin_panels_add_help_tab');

/**
 * Display the content for the help tab.
 */
function siteorigin_panels_add_help_tab_content(){
	get_template_part('extras/panels/tpl/help');
}

/**
 * Save the panels data
 *
 * @param $post_id
 *
 * @action save_post
 */
function siteorigin_panels_save_post( $post_id ) {
	if ( get_theme_support( 'siteorigin-panels' ) === false ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( empty( $_POST['_sopanels_nonce'] ) || !wp_verify_nonce( $_POST['_sopanels_nonce'], 'save' ) ) return;
	if ( !current_user_can( 'edit_post', $post_id ) ) return;
	
	update_post_meta( $post_id, 'panels_data', siteorigin_panels_get_panels_data_from_post($_POST) );
}

add_action( 'save_post', 'siteorigin_panels_save_post' );

function siteorigin_panels_get_panels_data_from_post($form_post){
	$panels_data = array();

	$panels_data['widgets'] = array_map( 'stripslashes_deep', isset( $form_post['widgets'] ) ? $form_post['widgets'] : array() );
	$panels_data['widgets'] = array_values( $panels_data['widgets'] );

	if ( empty( $panels_data['widgets'] ) ) {
		return array();
	}

	foreach ( $panels_data['widgets'] as $i => $widget ) {
		$info = $widget['info'];
		if ( !class_exists( $widget['info']['class'] ) ) continue;

		$the_widget = new $widget['info']['class'];
		if ( method_exists( $the_widget, 'update' ) ) {
			unset( $widget['info'] );
			$widget = $the_widget->update( $widget, $widget );
		}
		$widget['info'] = $info;
		$panels_data['widgets'][$i] = $widget;
	}

	$panels_data['grids'] = array_map( 'stripslashes_deep', isset( $form_post['grids'] ) ? $form_post['grids'] : array() );
	$panels_data['grids'] = array_values( $panels_data['grids'] );

	$panels_data['grid_cells'] = array_map( 'stripslashes_deep', isset( $form_post['grid_cells'] ) ? $form_post['grid_cells'] : array() );
	$panels_data['grid_cells'] = array_values( $panels_data['grid_cells'] );
	
	return $panels_data;
}

function siteorigin_panels_get_home_page_data(){
	$panels_data = get_theme_mod('panels_home_page', null);
	if(is_null($panels_data)){
		// Load the default layout
		$layouts = apply_filters('siteorigin_panels_prebuilt_layouts', array());
		$panels_data = !empty($layouts['default_home']) ? $layouts['default_home'] : current($layouts);
	}
	
	return $panels_data;
}

/**
 * Echo the CSS for the current panel
 *
 * @action wp_print_styles
 */
function siteorigin_panels_css() {
	global $post;

	$panels_support = get_theme_support( 'siteorigin-panels' );
	if ( empty( $panels_support ) ) return;
	$panels_support = $panels_support[0];
	
	if(!siteorigin_panels_is_panel()) return;
	
	if ( !siteorigin_panels_is_home() ) {
		$panels_data = get_post_meta( $post->ID, 'panels_data', true );
	}
	else {
		$panels_data = siteorigin_panels_get_home_page_data();
	}
	
	// Exit if we don't have panels data
	if ( empty( $panels_data ) ) return;

	$panels_margin_bottom = empty($panels_support['margin-bottom']) ? 30 : $panels_support['margin-bottom'];

	$css = array();
	$css[1920] = array();
	$css[767] = array(); // This is a mobile resolution

	// Add the grid sizing
	$ci = 0;
	foreach ( $panels_data['grids'] as $gi => $grid ) {
		$cell_count = intval( $grid['cells'] );
		for ( $i = 0; $i < $cell_count; $i++ ) {
			$cell = $panels_data['grid_cells'][$ci++];

			if ( $cell_count > 1 ) {
				$css_new = 'width:' . round( $cell['weight'] * 100, 3 ) . '%';
				if ( empty( $css[1920][$css_new] ) ) $css[1920][$css_new] = array();
				$css[1920][$css_new][] = '#pgc-' . $gi . '-' . $i;
			}
		}

		if ( $cell_count > 1 ) {
			if ( empty( $css[1920]['float:left'] ) ) $css[1920]['float:left'] = array();
			$css[1920]['float:left'][] = '#pg-' . $gi . ' .panel-grid-cell';
		}

		if ( $panels_support['responsive'] ) {
			// Mobile Responsive
			$mobile_css = array( 'float:none', 'width:auto', 'margin-bottom:' . $panels_margin_bottom . 'px' );
			foreach ( $mobile_css as $c ) {
				if ( empty( $css[767][$c] ) ) $css[767][$c] = array();
				$css[767][$c][] = '#pg-' . $gi . ' .panel-grid-cell';
			}
		}
	}

	/**
	 * Filter the unprocessed CSS array
	 */
	$css = apply_filters( 'siteorigin_panels_css', $css );

	// Build the CSS
	$css_text = '';
	krsort( $css );
	foreach ( $css as $res => $def ) {
		if ( empty( $def ) ) continue;

		if ( $res < 1920 ) {
			$css_text .= '@media (max-width:' . $res . 'px)';
			$css_text .= ' { ';
		}

		foreach ( $def as $property => $selector ) {
			$selector = array_unique( $selector );
			$css_text .= implode( ' , ', $selector ) . ' { ' . $property . ' } ';
		}

		if ( $res < 1920 ) $css_text .= ' } ';
	}

	echo '<style type="text/css">';
	echo $css_text;
	echo '</style>';
}

add_action( 'wp_print_styles', 'siteorigin_panels_css' );


/**
 * Filter the content of the panel, adding all the widgets.
 *
 * @param $content
 *
 * @filter the_content
 */
function siteorigin_panels_filter_content( $content ) {
	global $post;
	if ( $post->post_type == 'page' ) {
		$panel_content = siteorigin_panels_render( $post->ID );
		if ( !empty( $panel_content ) ) $content = $panel_content;
	}

	return $content;
}

add_filter( 'the_content', 'siteorigin_panels_filter_content' );


/**
 * Render the panels
 *
 * @param bool $post_id
 * @return string
 */
function siteorigin_panels_render( $post_id = false ) {
	if($post_id == 'home'){
		$panels_data = get_theme_mod('panels_home_page', null);
		if(is_null($panels_data)){
			// Load the default layout
			$layouts = apply_filters('siteorigin_panels_prebuilt_layouts', array());
			$panels_data = !empty($layouts['home']) ? $layouts['home'] : current($layouts);
		}
	}
	else{
		if ( empty( $post_id ) ) {
			global $post;
		}
		else $post = get_post( $post_id );
		$panels_data = get_post_meta( $post->ID, 'panels_data', true );
	}
	
	if ( empty( $panels_data ) ) return '';

	$panels_data = apply_filters( 'siteorigin_panels_data', $panels_data, $post_id );

	// Create the skeleton of the grids
	$grids = array();
	foreach ( $panels_data['grids'] as $gi => $grid ) {
		$gi = intval( $gi );
		$grids[$gi] = array();
		for ( $i = 0; $i < $grid['cells']; $i++ ) {
			$grids[$gi][$i] = array();
		}
	}

	foreach ( $panels_data['widgets'] as $widget ) {
		$grids[intval( $widget['info']['grid'] )][intval( $widget['info']['cell'] )][] = $widget;
	}

	ob_start();
	foreach ( $grids as $gi => $cells ) {
		?><div class="panel-grid" id="pg-<?php echo $gi ?>"><?php
		foreach ( $cells as $ci => $widgets ) {
			?><div class="panel-grid-cell" id="pgc-<?php echo $gi . '-' . $ci ?>"><?php
			foreach ( $widgets as $pi => $widget_info ) {
				$data = $widget_info;
				unset( $data['info'] );

				siteorigin_panels_the_widget( $widget_info['info']['class'], $data, $gi, $ci, $pi, $pi == 0, $pi == count( $widgets ) - 1 );
			}
			if ( empty( $widgets ) ) echo '&nbsp;';
			?></div><?php
		}
		?>
	<div class="clear"></div></div><?php
	}
	$html = ob_get_clean();

	return apply_filters( 'panels_render', $html, $post_id, !empty($post) ? $post : null );
}

/**
 * Render the widget. 
 * 
 * @param $widget
 * @param $instance
 * @param $grid
 * @param $cell
 * @param $panel
 * @param $is_first
 * @param $is_last
 */
function siteorigin_panels_the_widget( $widget, $instance, $grid, $cell, $panel, $is_first, $is_last ) {
	if ( !class_exists( $widget ) ) return;

	$the_widget = new $widget;

	$classes = array( 'panel', 'widget' );
	if ( !empty( $the_widget->id_base ) ) $classes[] = 'widget_' . $the_widget->id_base;
	if ( $is_first ) $classes[] = 'panel-first-child';
	if ( $is_last ) $classes[] = 'panel-last-child';

	$the_widget->widget( array(
		'before_widget' => '<div class="' . esc_attr( implode( ' ', $classes ) ) . '" id="panel-' . $grid . '-' . $cell . '-' . $panel . '">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'widget_id' => 'widget-' . $grid . '-' . $cell . '-' . $panel
	), $instance );
}

/**
 * Add the Edit Home Page item to the admin bar.
 * 
 * @param WP_Admin_Bar $admin_bar
 * @return WP_Admin_Bar
 */
function siteorigin_panels_admin_bar_menu($admin_bar){
	/**
	 * @var WP_Query $wp_query
	 */
	global $wp_query;
	
	if( ( $wp_query->is_home() && $wp_query->is_main_query() ) || siteorigin_panels_is_home() ){
		// Check that we support the home page
		$panels_support = get_theme_support( 'siteorigin-panels' );
		if ( $panels_support === false || empty($panels_support[0]['home-page']) || !current_user_can('edit_theme_options') ) return $admin_bar;
		
		$admin_bar->add_node(array(
			'id' => 'edit-home-page',
			'title' => __('Edit Home Page', 'origami'),
			'href' => admin_url('themes.php?page=so_panels_home_page')
		));
	}
	
	return $admin_bar;
}
add_action('admin_bar_menu', 'siteorigin_panels_admin_bar_menu', 100);

/**
 * Handles creating the preview.
 */
function siteorigin_panels_preview(){
	if(isset($_GET['siteorigin_panels_preview']) && wp_verify_nonce($_GET['_wpnonce'], 'siteorigin-panels-preview')){
		// Set the panels home state to true
		if(empty($_POST['post_id'])) $GLOBALS['siteorigin_panels_is_panels_home'] = true;
		
		add_action('theme_mod_panels_home_page', 'siteorigin_panels_preview_load_data');
		get_template_part('home', 'panels');
		exit();
	}
}
add_action('template_redirect', 'siteorigin_panels_preview');

/**
 * This is a way to show previews of panels, especially for the home page.
 * 
 * @param $mod
 * @return array
 */
function siteorigin_panels_preview_load_data($mod){
	if(isset($_GET['siteorigin_panels_preview'])){
		$mod = siteorigin_panels_get_panels_data_from_post($_POST);
	}
	
	return $mod;
}