<?php

function elegantwhite_password_form() {

global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$elegantwhite_o = '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
	' . __( 'This post is password protected. To view it please enter your password below:', 'elegantwhite' ) . '
	<p><input name="post_password" id="' . $label . '" type="password" size="20" />&nbsp;&nbsp;<input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'elegantwhite' ) . '" /></p>
	</form>
	';
	return $elegantwhite_o;
	
}

?>