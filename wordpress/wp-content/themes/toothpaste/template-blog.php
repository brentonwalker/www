<?php
/**
 * This page just renders our blog archive. Mainly useful if we've created a custom home page and still want to make use of the blog archive.
 *
 * @package toothpaste
 * @since toothpaste 1.0
 *
 * Template Name: Blog Archive
 */

add_filter('option_show_on_front', '__return_false');
global $wp_query;
query_posts(array(
	'paged' => $wp_query->get('paged'),
));
get_template_part('index');
remove_filter('option_show_on_front', '__return_false');

wp_reset_query();
wp_reset_postdata();