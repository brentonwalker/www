<?php $elegantwhite_options = get_option('elegantwhite_options'); ?>
<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<meta name="viewport" content="width=1150">
<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>;chartset=<?php bloginfo('charset'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(); ?></title>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="line">

<div id="container">
	
	<div id="blogtitle"><a class="heading" href="<?php echo esc_url( home_url() ); ?>"><?php echo bloginfo('name'); ?></a></div>
	<div id="blogdescription"><?php echo bloginfo('description'); ?></div>
	
	<div id="button"><textbutton>Show Menu</textbutton><textbutton style="display:none;">Hide Menu</textbutton></div>
	
	<div class="naviline-one"></div>
	<div id="nav">
	<ul class="nav">
	<?php wp_nav_menu( array('theme_location' => 'header-nav', 'depth' => 1, 'menu_class' => 'nav' )); ?>
	</ul>
	</div><div id="clear"></div>
	<div class="naviline-two"></div>


	<div id="clear"></div>
	
	<div id="header-settings"><?php $header_image = get_header_image();
				if ( $header_image ) : ?>
	<img class="header" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt=""><div class="space2"></div>
	</div><?php endif; ?>