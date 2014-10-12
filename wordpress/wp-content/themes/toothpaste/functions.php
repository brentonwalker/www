<?php
/**
 * toothpaste functions and definitions
 *
 * @package toothpaste
 * @since toothpaste 1.0
 */

define( 'SITEORIGIN_THEME_VERSION' , '1.0.3' );
define( 'SITEORIGIN_THEME_ENDPOINT' , 'http://siteorigin.com' );
define('SITEORIGIN_THEME_UPDATE_ID', 288);

include get_template_directory() . '/extras/settings/settings.php';
include get_template_directory() . '/extras/adminbar/adminbar.php';
include get_template_directory() . '/extras/widgets/widgets.php';
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
 * @since toothpaste 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 733; /* pixels */

if ( ! function_exists( 'toothpaste_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since toothpaste 1.0
 */
function toothpaste_setup() {
	// Initialize SiteOrigin settings
	siteorigin_settings_init();
	
	// Make the theme translatable
	load_theme_textdomain( 'toothpaste', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add support for custom backgrounds.
	add_theme_support( 'custom-background' , array(
		'default-color' => '#FFFFFF',
	));
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'toothpaste' ),
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
	
	// We want to use all of SiteOrigin's widgets.
	add_action('widgets_init', 'siteorigin_widgets_init');
	
	add_image_size('toothpaste-slide', 960, 480, true);
	
	set_post_thumbnail_size( $GLOBALS['content_width'], 220, true );
	
	if(!defined('SITEORIGIN_PANELS_VERSION')){
		include get_template_directory() . '/extras/panels-lite/panels-lite.php';
	}
}
endif; // toothpaste_setup
add_action( 'after_setup_theme', 'toothpaste_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 */
function toothpaste_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'toothpaste_custom_background_args', $args );
	add_theme_support( 'custom-background', $args );
}
add_action( 'after_setup_theme', 'toothpaste_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since toothpaste 1.0
 */
function toothpaste_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'toothpaste' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer', 'toothpaste' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'toothpaste_widgets_init' );

/**
 * Register all the bundled scripts
 */
function toothpaste_register_scripts(){
	wp_register_script( 'toothpaste-flexslider' , get_template_directory_uri().'/js/jquery.flexslider.js' , array('jquery'), '2.1' );
	wp_register_script( 'toothpaste-fitvids' , get_template_directory_uri().'/js/jquery.fitvids.js' , array('jquery'), '2.1' );
}
add_action( 'wp_enqueue_scripts', 'toothpaste_register_scripts' , 5);

/**
 * Enqueue scripts and styles
 */
function toothpaste_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_script( 'toothpaste-modernizr' , get_template_directory_uri().'/js/modernizr.custom.js' , array('jquery', 'toothpaste-flexslider', 'toothpaste-fitvids'), SITEORIGIN_THEME_VERSION );
	wp_enqueue_script( 'toothpaste-main' , get_template_directory_uri().'/js/jquery.main.js' , array('jquery', 'toothpaste-flexslider', 'toothpaste-fitvids', 'toothpaste-modernizr'), SITEORIGIN_THEME_VERSION );
	
	if(!defined('SITEORIGIN_IS_PREMIUM')){
		// Only enqueue for free version, premium handles it's own enqueueing
		wp_enqueue_style('toothpaste-webfont-muli', 'http://fonts.googleapis.com/css?family=Muli:300,400');
	}
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.min.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'toothpaste_scripts' );

/**
 * Add custom body classes.
 * 
 * @param $classes
 * @package toothpaste
 * @since 1.0
 */
function toothpaste_premium_body_class($classes){
	if(siteorigin_setting('layout_responsive')) $classes[] = 'responsive';
	return $classes;
}
add_filter('body_class', 'toothpaste_premium_body_class');

function toothpaste_wp_head(){
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/selectivizr.js"></script>
	<![endif]-->
	<?php
}
add_action('wp_head', 'toothpaste_wp_head');

function toothpaste_siteorigin_credit($copyright){
	if(!empty($copyright)) $copyright .= ' - ';
	$copyright .= sprintf( __( 'Designed by %1$s.', 'toothpaste' ), '<a href="http://siteorigin.com/" rel="designer">SiteOrigin</a>' );
	
	return $copyright;
}
add_filter('toothpaste_site_info', 'toothpaste_siteorigin_credit');

function toothpaste_footer_site_info_sub($copyright){
	return str_replace(
		array('{site-title}', '{year}'),
		array(get_bloginfo('name'), date('Y')),
		$copyright
	);
}
add_filter('toothpaste_site_info', 'toothpaste_footer_site_info_sub');

function toothpaste_siteorigin_button_styles($styles){
	$styles['blue'] = __('Blue', 'toothpaste'); 
	$styles['green'] = __('Green', 'toothpaste'); 
	$styles['grey'] = __('Grey', 'toothpaste');
	$styles['purple'] = __('Purple', 'toothpaste');
	return $styles;
}
add_filter('siteorigin_button_styles', 'toothpaste_siteorigin_button_styles');

function toothpaste_siteorigin_panels_after_widgets(){
	siteorigin_premium_teaser(
		sprintf( __( 'Additional widgets are available in %s Premium', 'siteorigin' ), ucfirst( get_option( 'stylesheet' ) ) )
	);
}