<?php
/**
 * so-current functions and definitions
 *
 * @package so-current
 * @since so-current 1.0
 * @license GPL 2.0
 */

define( 'SITEORIGIN_THEME_VERSION' , '1.0.2' );
define('SITEORIGIN_THEME_UPDATE_ID', false);
define( 'SITEORIGIN_THEME_ENDPOINT' , 'http://siteorigin.com' );

if( file_exists( get_template_directory() . '/premium/functions.php' ) ){
	include get_template_directory() . '/premium/functions.php';
}

// Include all the SiteOrigin extras
include get_template_directory() . '/extras/settings/settings.php';

include get_template_directory() . '/extras/adminbar/adminbar.php';
include get_template_directory() . '/extras/plugin-activation/plugin-activation.php';

// Load the theme specific files
include get_template_directory() . '/inc/panels.php';
include get_template_directory() . '/inc/settings.php';
include get_template_directory() . '/inc/extras.php';
include get_template_directory() . '/inc/template-tags.php';
include get_template_directory() . '/inc/gallery.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since so-current 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 600; /* pixels */

if ( ! function_exists( 'so_current_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since so-current 1.0
 */
function so_current_setup() {
	// Initialize SiteOrigin settings
	siteorigin_settings_init();
	
	// Make the theme translatable
	load_theme_textdomain( 'so-current', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add support for custom backgrounds.
	add_theme_support( 'custom-background' , array(
		'default-color' => '#FFFFFF',
		'default-image' => get_template_directory_uri().'/images/bg.png'
	));
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'so-current' ),
		'footer' => __( 'Footer Menu', 'so-current' ),
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	add_image_size('so-current-slide', 960, 480, true);
	add_image_size('so-current-single', 650, 950, false);

	set_post_thumbnail_size(320, 156, true);

	add_post_type_support( 'page', 'excerpt' );

	if( !defined('SITEORIGIN_PANELS_VERSION') ){
		// Only include panels lite if the panels plugin doesn't exist
		include get_template_directory() . '/extras/panels-lite/panels-lite.php';
	}
}
endif; // so_current_setup
add_action( 'after_setup_theme', 'so_current_setup' );

/**
 * Setup the WordPress core custom background feature.
 * 
 * @since so-current 1.0
 */
function so_current_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'so_current_custom_background_args', $args );
	add_theme_support( 'custom-background', $args );
}
add_action( 'after_setup_theme', 'so_current_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since so-current 1.0
 */
function so_current_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'so-current' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

}
add_action( 'widgets_init', 'so_current_widgets_init' );

/**
 * Register all the bundled scripts
 */
function so_current_register_scripts(){
	wp_register_script( 'so-current-flexslider' , get_template_directory_uri().'/js/jquery.flexslider.js' , array('jquery'), '2.1' );
	wp_register_script( 'so-current-fitvids' , get_template_directory_uri().'/js/jquery.fitvids.js' , array('jquery'), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'so_current_register_scripts' , 5);

/**
 * Enqueue scripts and styles
 */
function so_current_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'so-current-main' , get_template_directory_uri().'/js/jquery.theme-main.js' , array('jquery', 'so-current-flexslider', 'so-current-fitvids'), SITEORIGIN_THEME_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20120202' );
	}

	wp_enqueue_script('so-current-fontawesome', get_template_directory_uri().'/css/fontawesome/css/font-awesome.css', array(), SITEORIGIN_THEME_VERSION);
}
add_action( 'wp_enqueue_scripts', 'so_current_scripts' );

/**
 * Add custom body classes.
 * 
 * @param $classes
 * @package so-current
 * @since 1.0
 */
function so_current_body_class($classes){
	if(siteorigin_setting('layout_responsive')) $classes[] = 'responsive';
	return $classes;
}
add_filter('body_class', 'so_current_body_class');

function so_current_wp_head(){
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js"></script>
	<![endif]-->
	<?php
}
add_action('wp_head', 'so_current_wp_head');

function so_current_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'so_current_excerpt_length', 999 );

function so_current_comment_form($defaults){
	$commenter = wp_get_current_commenter();
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$defaults['fields']['author'] = '<p class="field"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="'.__('Your Name', 'so-current').'" /></p>';
	$defaults['fields']['email'] = '<p class="field"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="'.__('Your Email', 'so-current').'" /></p>';
	$defaults['fields']['url'] = '<p class="field"><input id="url" name="url"  type="url" pattern="" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'.__('Website', 'so-current').'" /></p>';
	$defaults['comment_field'] = '<div class="clear"></div><p class="comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.__('Comment', 'so-current').'"></textarea></p>';

	if(!empty($defaults['fields']['url'])) unset($defaults['fields']['url']);
	if(!empty($defaults['comment_notes_before'])) $defaults['comment_notes_before'] = '';
	if(!empty($defaults['comment_notes_after'])) $defaults['comment_notes_after'] = '';

	return $defaults;
}
add_filter('comment_form_defaults', 'so_current_comment_form');