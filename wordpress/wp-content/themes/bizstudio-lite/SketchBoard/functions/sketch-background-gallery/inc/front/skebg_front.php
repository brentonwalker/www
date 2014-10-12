<?php
//-- FUNCTION TO CALL GALLERY ------------
//----------------------------------------
require_once('skebg_class.php');
function skebg_gallery(){
	$skebg_obj = new skebg_front;
	?><!-- Sketch BG-Gallery Starts Here --><?php
	$skebg_obj->skebg_gallery_display();
	?><!-- Sketch BG-Gallery Ends Here --><?php
}
add_action('wp_footer','skebg_gallery');
?>