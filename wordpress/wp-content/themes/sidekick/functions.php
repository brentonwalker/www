<?php
/**
 * @package Sidekick
 * @since Sidekick 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 610;


function sidekick_widgets_uninit() {
	unregister_sidebar( 'sidebar-1' );
}
add_action( 'widgets_init', 'sidekick_widgets_uninit', 11 );


/**
 * Set up Sidekick specific setting.
 */
function sidekick_setup() {
	/**
	 * Declare textdomain for this child theme.
	 */
	load_child_theme_textdomain( 'sidekick', get_stylesheet_directory() . '/languages' );

	/**
	 * Remove Featured Content
	 */
	remove_theme_support( 'featured-content' );

	/**
	 * Add Panoramic image size
	 */
	add_image_size( 'sidekick-panoramic', 5000, 500, false );
}
add_action( 'after_setup_theme', 'sidekick_setup', 11 );


/**
 * Enqueue scripts and styles
 */
function sidekick_scripts() {
	wp_dequeue_script( 'superhero-script' );
	wp_dequeue_script( 'superhero-flex-slider' );
	wp_dequeue_style( 'superhero-flex-slider-style' );

	wp_enqueue_script( 'sidekick-script', get_stylesheet_directory_uri() . '/js/sidekick.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'sidekick_scripts', 11 );
