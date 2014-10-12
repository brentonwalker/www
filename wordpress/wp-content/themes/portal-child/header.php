<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package portal
 * @since portal 1.0
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

<?php if(siteorigin_setting('general_search_bar') || siteorigin_setting('general_contact_text')) : ?>
	<div id="top-information">
		<?php if(siteorigin_setting('general_contact_text')): ?>
			<div id="contact-text" <?php siteorigin_setting_editable('general_contact_text') ?>>
				<?php echo wp_kses_post(siteorigin_setting('general_contact_text')); ?>
			</div>
		<?php endif; ?>
		<?php if(siteorigin_setting('general_search_bar')) get_search_form(); ?>
	</div>
<?php endif; ?>

<div id="page" class="hfeed site <?php if(siteorigin_setting('layout_page_margin')) echo 'top-margin'; ?>">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title" <?php siteorigin_setting_editable('general_logo') ?>>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php portal_display_logo(); ?>
				</a>
			</h1>
			<?php if(siteorigin_setting('general_site_description')) : ?>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif ?>
		</hgroup>

		<div class="main-navigation-float"></div>
		<nav role="navigation" class="site-navigation main-navigation primary">
			<h1 class="assistive-text"><?php _e( 'Menu', 'portal' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'portal' ); ?>"><?php _e( 'Skip to content', 'portal' ); ?></a></div>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- .site-navigation .main-navigation -->

	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">
