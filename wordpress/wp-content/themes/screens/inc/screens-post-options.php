<?php
/*
 * Plugin Name: Post Options API Example
 * Description: This plugin demonstrates the usage of the Post Options API
 * Author: Konstantin Kovshenin
 * Version 1.0.1
 * License: GPLv2
 */

// We'll do everything inside init.
add_action('init', 'post_options_api_example');

// Let's test out the above
function post_options_api_example() {

	// Include the Post Options API Library bundled with this plugin
	get_template_part('inc/post-options-api.1.0.1');

	// Initialize the Post Options API and Fields
	$post_options = get_post_options_api('1.0.1');
	$post_fields = get_post_options_api_fields('1.0.1');

	// Register two sections and add them both to the 'post' post type
	$post_options -> register_post_options_section('post-f', __('Post formats options', 'screens'), 1);
	$post_options -> add_section_to_post_type('post-f', 'post');

	$post_options -> register_post_options_section('portfolio-o', __('Portfolio options', 'screens'), 1);
	$post_options -> add_section_to_post_type('portfolio-o', 'page-portfolio');

	$post_options -> register_post_options_section('portfolio-f', __('Gallery options', 'screens'), 1);
	$post_options -> add_section_to_post_type('portfolio-f', 'page-portfolio');

	// The showing off section

	/*    Post Format - Link  */
	$post_options -> register_post_option(array('id' => 'pgallery', 'title' => __('Gallery options', 'screens'), 'section' => 'portfolio-f', 'std' => 'option-1', 'callback' => $post_fields -> select(array('description' => __('You can use the three kinds of presentation of the gallery.', 'screens'), 'select_data' => array('option-1' => __('One column', 'screens'), 'option-2' => __('Two columns (lightbox)', 'screens'), 'option-3' => __('Slideshow', 'screens'))))));

	$post_options -> register_post_option(array('id' => 'pvideo', 'title' => __('Post format - Video', 'screens'), 'section' => 'portfolio-f', 'callback' => $post_fields -> text(array('description' => __('If you want to add a video, you must be sure that you insert the option in Settings>Media> When possible, embed the media content from a URL directly onto the page. For example: links to Flickr and YouTube. Then past the link to the website of the film in the field above e.g. http://vimeo.com/33420937. The list of the services from which you can add films are at the following address http://codex.wordpress.org/Embeds', 'screens')))));

	$post_options -> register_post_option(array('id' => 'portfolio-live', 'title' => __('Live preview', 'screens'), 'section' => 'portfolio-o', 'callback' => $post_fields -> text(array('description' => __('Paste link', 'screens')))));

	$post_options -> register_post_option(array('id' => 'portfolio-client', 'title' => __('Client', 'screens'), 'section' => 'portfolio-o', 'callback' => $post_fields -> text(array('description' => __('Client name', 'screens')))));

	$post_options -> register_post_option(array('id' => 'portfolio-c-link', 'title' => __('Client', 'screens'), 'section' => 'portfolio-o', 'callback' => $post_fields -> text(array('description' => __('Paste client link', 'screens')))));

	/*    Post Format - Link  */
	$post_options -> register_post_option(array('id' => 'pf-link', 'title' => __('Post format - Link', 'screens'), 'section' => 'post-f', 'callback' => $post_fields -> text(array('description' => __('Paste link', 'screens')))));
	/*    Post Format - Quote Author  */
	$post_options -> register_post_option(array('id' => 'pf-quote-title', 'title' => __('Post format - Quote - Author', 'screens'), 'section' => 'post-f', 'callback' => $post_fields -> text(array('description' => __('If you choose the format of the post - quotation - and you want to add the author you must write his name.', 'screens')))));
	/*    Post Format - Quote link  */
	$post_options -> register_post_option(array('id' => 'pf-quote', 'title' => __('Post format - Quote - Link', 'screens'), 'section' => 'post-f', 'callback' => $post_fields -> text(array('description' => __('Past the link into the source of quotation. The author of the quotation will be the link to the source, to make the link available fill in \"the Author quotation\" field.', 'screens')))));
	/*    Post Format - Gallery  */
	$post_options -> register_post_option(array('id' => 'pf-quote-text', 'title' => __('Post Format - Quote - text', 'screens'), 'section' => 'post-f', 'std' => 'option-1', 'callback' => $post_fields -> textarea(array('description' => __('Past quote text.', 'screens')))));
	/*    Post Format - Video  */
	$post_options -> register_post_option(array('id' => 'pf-video', 'title' => __('Post format - Video', 'screens'), 'section' => 'post-f', 'callback' => $post_fields -> text(array('description' => __('If you choose the video post format, you must be sure that you insert the option in Settings>Media> When possible, embed the media content from a URL directly onto the page. For example: links to Flickr and YouTube. Then past the link to the website of the film in the field above e.g. http://vimeo.com/33420937, the same link past in the visual editor field and. The list of the services from which you can add films are at the following address http://codex.wordpress.org/Embeds', 'screens')))));
}

/*----------*/
/*    Post Format - Link  */
/*----------*/
if (!function_exists('screens_link_format')) {
	function screens_link_format() {
		global $post;
		$post_options = get_post_options_api('1.0.1');
		$link = $post_options -> get_post_option($post -> ID, 'pf-link');
		if (!empty($link)) :
			return esc_url_raw($link);
		elseif (preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches)) :
			return esc_url_raw($matches[1]);
		else :
			return esc_url_raw(get_permalink());
		endif;
	}
}
/*----------*/
/*    Post Format - Quote  */
/*----------*/
function screens_post_quote() {
	global $post;
	$post_options = get_post_options_api('1.0.1');
	$quote = $post_options -> get_post_option($post -> ID, 'pf-quote');
	$quoteauthor = $post_options -> get_post_option($post -> ID, 'pf-quote-title');
	$quotetext = $post_options -> get_post_option($post -> ID, 'pf-quote-text');

	if (!empty($quotetext)) {
		echo '<blockquote class="quote_post">' . $quotetext . '';

		if (!empty($quoteauthor) && empty($quote))
			echo '<cite class="title_headers">&mdash; ' . $quoteauthor . '</cite>';
		elseif (!empty($quoteauthor) && !empty($quote))
			echo '<cite>&mdash; <a href="' . $quote . '" title="' . esc_attr(sprintf(__('%s', 'screens'), the_title_attribute('echo=0'))) . '" rel="bookmark">' . $quoteauthor . '</a></cite>';
		echo '</blockquote>';
	}
}
?>