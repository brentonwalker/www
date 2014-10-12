<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package toothpaste
 * @since toothpaste 1.0
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
		<nav role="navigation" class="site-navigation main-navigation primary container">
			
			<h1 class="assistive-text"><?php _e( 'Menu', 'toothpaste' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'toothpaste' ); ?>"><?php _e( 'Skip to content', 'toothpaste' ); ?></a></div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			
		</nav><!-- .site-navigation .main-navigation -->
		
		<hgroup>
			<img class="header-decoration dark dark-<?php echo intval(get_theme_mod('header_bg_dark_image', 1)) ?>" src="<?php echo get_template_directory_uri() ?>/images/headers/dark-<?php echo intval(get_theme_mod('header_bg_dark_image', 1)) ?>.svg" />
			<img class="header-decoration light light-<?php echo intval(get_theme_mod('header_bg_light_image', 1)) ?>" src="<?php echo get_template_directory_uri() ?>/images/headers/light-<?php echo intval(get_theme_mod('header_bg_light_image', 1)) ?>.svg" />
			
			<div class="container">
				<div class="table-wrapper">
					<div class="cell-wrapper">
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<?php toothpaste_display_logo(); ?>
							</a>
						</h1>
						<?php if(siteorigin_setting('general_site_description')) : ?>
							<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
						<?php endif ?>
					</div>
				</div>
			</div>
			
		</hgroup>
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">
