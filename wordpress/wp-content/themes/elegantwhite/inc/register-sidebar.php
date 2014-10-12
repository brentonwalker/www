<?php

function elegantwhite_sidebar() {
register_sidebar(array(
'name' => __('Sidebar', 'elegantwhite'),
'before_widget' => '<div id="sidebar-widget">',
'after_widget' => '</div>',
'before_title' => '<div class="sidebar-heading">',
'after_title' => '</div></p>',
));
}
add_action('widgets_init', 'elegantwhite_sidebar')

?>