<?php

$elegantwhite_headeroptions = array(
    'header-text'   => false,
    'default-image' => get_template_directory_uri() . '/img/clouds.jpg',
    'random-default' => false,
	'uploads'       => true,
	'height'        => 350,
	'width'         => 1100,
);
add_theme_support( 'custom-header', $elegantwhite_headeroptions );

  $elegantwhite_customHeaders = array (   
                'Blue Sky' => array (
                'url' => '%s/img/clouds.jpg',
                'thumbnail_url' => '%s/img/clouds_thumbnail.png',
                'description' => __( 'Blue Sky', 'elegantWhite' )
            ),

        );
        
      register_default_headers($elegantwhite_customHeaders);
        
?>