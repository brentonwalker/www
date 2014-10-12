<!DOCTYPE html>
<html <?php	language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<title><?php wp_title('|', true, 'right'); ?></title>
		<meta name="viewport" content="width=device-width" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_head(); ?>		
	</head>
	<body <?php	body_class(); ?>>
<header id="header">
			<div class="container">
				<?php screens_header(); ?>			
				<nav id="nav" class="eleven columns">
					<?php wp_nav_menu(array('sort_column' => 'menu_order', 'Primary Navigation', 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'primery_nav', 'depth' => '3', 'fallback_cb' => false)); ?>
				</nav>
			</div>
</header>