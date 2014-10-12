<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package so-current
 * @since so-current 1.0
 * @license GPL 2.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<nav role="navigation" class="site-navigation main-navigation primary">
				<h1 class="assistive-text"><?php _e( 'Menu', 'so-current' ); ?></h1>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'so-current' ); ?>"><?php _e( 'Skip to content', 'so-current' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 1 ) ); ?>
			</nav><!-- .site-navigation .main-navigation -->

			<hgroup>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php so_current_display_logo(); ?>
					</a>
				</h1>
			</hgroup>
		</div>
	</header><!-- #masthead .site-header -->


	<?php so_current_page_header(); ?>

	<div id="main" class="site-main">
