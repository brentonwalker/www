<?php
// ADD Styles and Script in head section
add_action('admin_init', 'skebggallery_backend_scripts');
add_action('wp_enqueue_scripts', 'skebggallery_frontend_scripts');
function skebggallery_backend_scripts() {
	if(is_admin()){
		wp_enqueue_script ('jquery');
		wp_enqueue_script( 'skebggallery_backend_scripts',SKETCHBGSSCRIPT.'admin/js/skebggallery_admin.js', array('jquery'));
		wp_enqueue_style( 'skebggallery_backend_scripts',SKETCHBGSSCRIPT.'admin/css/skebggallery_admin.css', false, '1.0.0' );
		wp_enqueue_script('farbtastic');
		wp_enqueue_style('farbtastic');	
		if(isset($_GET['page']) && $_GET['page']=="skebggallery"){
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');	
		}
	}
}
function skebggallery_frontend_scripts() {	
	if(!is_admin()){
		wp_enqueue_script('jquery');
		wp_enqueue_script('skebggallery',SKETCHBGSSCRIPT.'front/js/skebggallery.js', array('jquery'));
		wp_enqueue_style('skebggallery',SKETCHBGSSCRIPT.'front/css/skebggallery.css');
	}
}
//--------------------------------------------------------------------------------------------------------------------------------------
?>