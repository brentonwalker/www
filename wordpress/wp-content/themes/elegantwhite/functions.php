<?php

$theme_data = wp_get_theme();

/*
 * Core Settings 
 */
add_action( 'after_setup_theme', 'elegantwhite_theme_setup' );
function elegantwhite_theme_setup() {

/*
 * Editor Style 
 */
add_editor_style();

/*
 * Post Thumbnails 
 */
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 760, 250, true );

/*
 * Custom Background
 */
$bg_args = array(
	'default-color' => 'fffff',
);
add_theme_support( 'custom-background', $bg_args );

/*
 * Post Formats
 */
add_theme_support( 'post-formats', array( 'aside', 'link', 'quote', 'image' ) );

/*
 * Feed Links 
 */
add_theme_support( 'automatic-feed-links' );

/*
 * Languages 
 */
load_theme_textdomain( 'elegantwhite', get_template_directory() . '/languages' );

/*
 * Content Width
 */
if ( ! isset( $content_width ) ) $content_width = 700;

/*
 * Menus
 */	
register_nav_menus(array(
   'header-nav' => 'Header Menu',
   'footer-nav' => 'Footer Menu',
));
}

/*
 * Header 
 */
locate_template( array( '/inc/custom-header.php' ), true );

/*
 * Sidebar
 */
locate_template( array( '/inc/register-sidebar.php' ), true );

/*
 * Password Form
 */
add_filter( 'the_password_form', 'elegantwhite_password_form' );
locate_template( array( '/inc/password-form.php' ), true );


/*
 * Footer Settings 
 */ 
function elegantwhite_footer_text() {
global $elegantwhiteFrom;
echo $elegantwhiteFrom;
}

/*
 * Output Date 
 */

function elegantwhite_get_date() {
$date_format = get_option( 'date_format' );
the_time($date_format);
}

/*
 * wp_title filter 
 */
function elegantwhite_filter_wp_title( $title ) {
 $elegantwhite_site_name = get_bloginfo( 'name' );
 $elegantwhite_filtered_title = $elegantwhite_site_name . $title;
 return $elegantwhite_filtered_title;
}
add_filter( 'wp_title', 'elegantwhite_filter_wp_title' );        
        
/*
 * Untitled Posts
 */      
add_filter('the_title', 'elegantwhite_title');
function elegantwhite_title($title) {
	if ( $title == '' ) {
		return __( 'Untitled', 'elegantwhite');
	} else {
		return $title;
	}
}

/*
 * Styles
 */
function elegantwhite_style() {
 wp_register_style('elegantwhite_style', get_stylesheet_uri(), array(), 1.1, 'all'); 
 wp_enqueue_style('elegantwhite_style');	 
 wp_enqueue_style('opensansfont', 'http://fonts.googleapis.com/css?family=Open+Sans' );
}
add_action('wp_enqueue_scripts', 'elegantwhite_style');

/*
 * Admin Styles
 */
function elegantwhite_admin_enqueue() {
   wp_enqueue_style( 'admin_style', get_template_directory_uri() . '/css/options.css', array(), null, 'all' );
}
add_action( 'admin_enqueue_scripts', 'elegantwhite_admin_enqueue' );

$elegantwhiteFrom = 'Theme: '.$theme_data->get('Name').' by <a href="'.$theme_data->get('ThemeURI').'">'.$theme_data->get('Author').'</a>';

/*
 * Text Fields
 */
function elegantwhite_fields($elegantwhite_fields) {
  locate_template( array( '/inc/comments-form.php' ), true );
 return $elegantwhite_fields;
}
add_filter('comment_form_default_fields','elegantwhite_fields');

/*
 * Comment Form
 */
function elegantwhite_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);

		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'div';
			$add_below = 'div-comment';
		}
?>
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div class="comment">
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		
	
		
		<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		<div class="comment-box">
		<div class="comment-name"><?php printf(__('%s', 'elegantwhite'), get_comment_author_link()) ?> </div>
		<div class="comment-date"><?php
				/* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s', 'elegantwhite'), get_comment_date(),  get_comment_time()) ?></div>
				<div class="comment-line"></div>


		<div class="comment-text">
		<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'elegantwhite') ?></em></br>
		<?php endif; ?>
		
		<?php comment_text() ?>
		
		<div class="comment-reply">
		<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?> <?php edit_comment_link( __('[Edit]', 'elegantwhite'),'','' );
			?></div>


		</div></div></div></div>

				<?php if ( 'div' != $args['style'] ) : ?>
		</div><div style="clear:both;"></div>
		<?php endif; 
}

/*
 * Theme Options
 */
add_action('admin_menu', 'elegantwhite_create_menu');

function elegantwhite_create_menu() {
  add_theme_page('elegantWhite Settings', 'elegantWhite Options', 'edit_theme_options', 'themeoptions', 'elegantwhite_settings_page');
  add_theme_page('<div class="elegantwhite-upgrade"><b>Ready to go Pro?</b></div>', '<div class="elegantwhite-upgrade"><b>Ready to go Pro?</b></div>', 'edit_theme_options', 'fimplyupgrade', 'elegantwhite_upgrade');
  add_action( 'admin_init', 'elegantwhite_register_settings' );
}
if ( $elegantwhiteFrom !== 'Theme: elegantWhite by <a href="http://fimply.de/?page_id=7">Fimply</a>' OR !function_exists('elegantwhite_footer_text') ) { exit; }

function elegantwhite_upgrade () {
	locate_template( array( '/inc/upgrade.php' ), true );
}

function elegantwhite_register_settings() {
	register_setting( 'elegantwhite-settings-group', 'new_option_name' );
	register_setting( 'elegantwhite-settings-group', 'some_other_option' );
	register_setting( 'elegantwhite-settings-group', 'option_etc' );
}

add_action( 'admin_init', 'elegantwhite_theme_options' );

function elegantwhite_theme_options(){
	register_setting( 'elegantwhite_options', 'elegantwhite_options', 'elegantwhite_validate_options' );
}

function elegantwhite_settings_page() {
	global $select_options, $radio_options;
if ( ! isset( $_REQUEST['settings-updated'] ) )
	$_REQUEST['settings-updated'] = false;
?>

<?php locate_template( array( '/inc/theme-options.php' ), true ); ?>

<?php } ?>