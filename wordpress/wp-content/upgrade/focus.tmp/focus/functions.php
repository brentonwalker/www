<?php
/**
 * focus functions and definitions
 *
 * @package focus
 * @since focus 1.0
 */

define( 'SITEORIGIN_THEME_VERSION' , '1.1.10' );
define( 'SITEORIGIN_THEME_ENDPOINT' , 'http://updates.siteorigin.com' );

if( file_exists(get_template_directory().'/premium/functions.php') ){
	include get_template_directory().'/premium/functions.php';
}

if(!defined('SITEORIGIN_IS_PREMIUM')){
	include get_template_directory().'/upgrade/upgrade.php';
}

include get_template_directory().'/inc/video.php';
include get_template_directory().'/inc/settings.php';
include get_template_directory().'/inc/widgets.php';

// Include SiteOrigin extras
include get_template_directory().'/extras/adminbar/adminbar.php';
include get_template_directory().'/extras/settings/settings.php';
include get_template_directory().'/extras/premium/premium.php';
include get_template_directory().'/extras/widgets/widgets.php';
include get_template_directory().'/extras/update/update.php';
include get_template_directory().'/extras/plugin-activation/plugin-activation.php';

add_action('widgets_init', 'siteorigin_widgets_init');

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 648; /* pixels */

if ( ! function_exists( 'focus_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since focus 1.0
 */
function focus_setup() {
	// Use SiteOrigin theme settings
	siteorigin_settings_init();

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on focus, use a find and replace
	 * to change 'focus' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'focus', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'custom-background' , array(
		'default-color'          => '#F6F4F2',
	));

	/**
	 * Support panels
	 */
	add_theme_support( 'siteorigin-panels', array(
		'margin-bottom' => 30,
		'responsive' => siteorigin_setting('layout_responsive'),
	) );

	add_theme_support( 'siteorigin-premium-teaser', array(
		'post-type' => array('post')
	) );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'focus' ),
	) );
	
	/**
	 * Add custom image sizes
	 */
	add_image_size('slider', 1280, 768, true);
	
	set_post_thumbnail_size(297, 160, true);

	// Include the lite version of the page builder
	if( !defined('SITEORIGIN_PANELS_VERSION') && !siteorigin_plugin_activation_is_activating('siteorigin-panels') ){
		include get_template_directory().'/extras/panels-lite/panels-lite.php';
	}
}
endif; // focus_setup
add_action( 'after_setup_theme', 'focus_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since focus 1.0
 */
function focus_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Post Sidebar', 'focus' ),
		'id' => 'sidebar-post',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Page Sidebar', 'focus' ),
		'id' => 'sidebar-page',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'focus' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'focus_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function focus_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() , array() , SITEORIGIN_THEME_VERSION);
	
	wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array('jquery'), '2.1');
	
	wp_enqueue_script('focus', get_template_directory_uri() . '/js/focus.min.js', array('jquery'), SITEORIGIN_THEME_VERSION);
	wp_localize_script('focus', 'focus', array(
		'mobile' => wp_is_mobile(),
	));
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'focus_scripts' );

/**
 * @return WP_Query
 */
function focus_get_slider_posts(){
	return new WP_Query(apply_filters('focus_slider_posts_query', array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'numberposts' => siteorigin_setting('slider_post_count'),
		'orderby' => 'post_date',
		'order' => 'DESC',
	)));
}

/**
 * Change the footer text.
 * @param $text
 * @return string
 */
function focus_admin_footer_text($text){
	return '<span id="footer-thankyou">' . __( 'Thank you for creating with <a href="http://wordpress.org/">WordPress</a> and <a href="http://siteorigin.com/theme/focus/">Focus</a>.', 'focus' ) . '</span>';
}
add_filter('admin_footer_text', 'focus_admin_footer_text');

/**
 * Display the footer call to action
 */
function focus_display_footer_cta(){
	$args = array(
		'text' => siteorigin_setting('cta_text'),
		'button_text' => siteorigin_setting('cta_button_text'),
		'button_url' => siteorigin_setting('cta_button_url'),
	);
	$args['button_url'] = do_shortcode($args['button_url']);
	$args = apply_filters('focus_cta_args', $args);
	
	if(empty($args['text']) && empty($args['button_text']) && empty($args['button_url'])) return;
	
	?>
	<div id="footer-cta">
		<div class="container">
			<?php if(!empty($args['text'])) : ?><h3><?php echo $args['text'] ?></h3><?php endif ?>
			<?php if(!empty($args['button_text'])) : ?>
				<a href="<?php echo esc_url($args['button_url']) ?>" class="button">
					<?php echo esc_html($args['button_text']) ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<?php
}
add_action('before_footer', 'focus_display_footer_cta');

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since focus 1.0
 */
function focus_page_menu_args( $args ) {
	$args['show_home'] = siteorigin_setting('menu_home');
	return $args;
}
add_filter( 'wp_page_menu_args', 'focus_page_menu_args' );

/**
 * Display the post author information in the sidebar.
 * 
 * @return bool
 */
function focus_post_author_info(){
	if(!is_single()) return false;
	if(!siteorigin_setting('general_display_author')) return;
	if(get_post_type() != 'post') return;
	
	the_widget('Focus_Post_Author_Widget');
}
add_action('before_sidebar', 'focus_post_author_info');

/**
 * Add the styles to set the size of the footer widgets
 */
function focus_footer_widget_style(){
	$widgets = wp_get_sidebars_widgets();
	if(empty($widgets['sidebar-footer'])) return;
	
	$count = count($widgets['sidebar-footer']);
	?> <style type="text/css"> #footer-widgets aside { width : <?php echo round(100/$count,3) ?>%; } </style> <?php
}
add_action('wp_head', 'focus_footer_widget_style', 15);

/**
 * Filter the comment form.
 * 
 * @param $defaults
 * @return mixed
 */
function focus_comment_form_defaults($defaults){
	if(siteorigin_setting('comments_hide_allowed_tags')){
		$defaults['comment_notes_after'] = null;
	}
	
	return $defaults;
}
add_filter('comment_form_defaults', 'focus_comment_form_defaults', 5);

/**
 * Display the focus footer information
 */
function focus_credits(){
	echo wp_kses_post( siteorigin_setting('text_footer_copyright') );
}
add_action('focus_credits', 'focus_credits');

/**
 * Display the theme credits
 */
function focus_theme_credit(){
	if ( !siteorigin_setting('general_siteorigin_credits') ) return;
	if (siteorigin_setting('text_footer_copyright')) echo ' - ';
	printf(__('Theme By <a href="%s">SiteOrigin</a>', 'focus'), 'http://siteorigin.com');
}
add_action('focus_credits', 'focus_theme_credit');

/**
 * Display the default post thumbnail
 * 
 * @return string
 */
function focus_default_post_thumbnail(){
	return '<img src="'.get_template_directory_uri().'/images/thumbnail.jpg" width="297" height="160" class="attachment-post-thumbnail wp-post-image" />';
}

/**
 * Add the HTML shiv to the header.
 */
function focus_html5_shiv(){
	?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php
}
add_action('wp_head', 'focus_html5_shiv');

/**
 * Render the theme logo.
 */
function focus_display_logo(){
	$logo = siteorigin_setting('general_logo');
	
	if(empty($logo)) {
		// Just display the site title
		bloginfo( 'name' );
		return;
	}
	
	$image = wp_get_attachment_image_src($logo, 'full');
	
	if(siteorigin_setting('general_logo_scale')){
		$height = min($image[2], 26);
		$width = $height/$image[1] * $image[2];
	}
	else{
		$height = $image[2];
		$width = $image[1];
	}
	
	// echo $image;
	?><img src="<?php echo $image[0] ?>" width="<?php echo round($width) ?>" height="<?php echo round($height) ?>" /><?php
}