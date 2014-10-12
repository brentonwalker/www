<?php
/**
 * Book functions and definitions
 *
 * @package Book Lite
 * @since Book Lite 100
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Book Lite 100
 */
if ( ! isset( $content_width ) )
	$content_width = 750; /* pixels */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Book Lite 100
 */
function book_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Book, use a find and replace
	 * to change 'booklite' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'booklite', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'featured', 1440, 500, true ); //(cropped)

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'booklite' ),
	) );

	/**
	 * Enable custom background support
	 */
	add_theme_support( 'custom-background' );

}
add_action( 'after_setup_theme', 'book_setup' );

/**
 * Add support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Register widgetized area and update footer with default widgets
 *
 * @since Book Lite 100
 */
function book_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Footer Left', 'booklite' ),
		'id' => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Center', 'booklite' ),
		'id' => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Footer Right', 'booklite' ),
		'id' => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'book_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function book_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'book-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'book_scripts' );

// Remove default gallery styling
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Add upgrade option
 * @since Book Lite 106
 */
add_action('admin_menu', 'book_upgrade_option');

function book_upgrade_option() {
   add_theme_page( __( 'Upgrade', 'booklite' ), __( 'Upgrade', 'booklite' ), 'manage_options', 'book-upgrade', 'book_upgrade_content' );
}

/**
 * Return upgrade content
 */
function book_upgrade_content() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php _e( 'Upgrade to Premium version&ndash;Book', 'booklite' ); ?></h2>
		<?php settings_errors(); ?>

		<?php echo __( '<h3>Missing Theme Options?</h3><p>Only Premium version of this theme&ndash;Book has Theme Options. You can upload a logo, select from over 300 Google Fonts, select different color themes and also write your own custom CSS if you need.</p>', 'booklite' ) ?>
		<p><img alt="Book Options" src="<?php echo get_template_directory_uri(); ?>/images/theme-options.png" /></p>
		<p><strong><a class="button-primary" href="http://www.wpshoppe.com/shop/book/"><?php echo __( 'Upgrade to Book Now!', 'booklite' ) ?></a></strong></p>
	</div>
	<?php
}