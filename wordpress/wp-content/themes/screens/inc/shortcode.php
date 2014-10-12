<?php
add_filter('widget_text', 'do_shortcode');
/*********************/
if(!function_exists('sketchbook_remove_p')) {
	function sketchbook_remove_p($content) {
		$content = do_shortcode(shortcode_unautop($content));
		$content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}
/*-----------------------------------------------------------------------------------*/
/* 1. Toggle List - [toggle][/toggle]
/*-----------------------------------------------------------------------------------*/
function sketchbook_toggle_shortcode($atts, $content = null) {
	return '<div class="s_toggle">'. do_shortcode(sketchbook_remove_p($content)) . '</div>';
}
add_shortcode('toggle', 'sketchbook_toggle_shortcode');
/*-----------------------------------------------------------------------------------*/
function sketchbook_toggle_js() {
wp_enqueue_script('jquery');
echo '<script type="text/javascript">jQuery(document).ready(function($){
$(".s_toggle p").hide();
$(".s_toggle h4").addClass("s_plus");
//$(".s_toggle p:first").show();
$("h4").click(function(){$(this).next(".s_toggle p").slideToggle("normal");return true;
});});
</script>';
}
add_action('wp_footer', 'sketchbook_toggle_js');
/*-----------------------------------------------------------------------------------*/
/* 2. Columns Styles - 1/3 1/3 1/3 - [columns_111][/columns_111]
/*-----------------------------------------------------------------------------------*/
function sketchbook_columns_1_1_1($atts, $content = null) {
	return '<div class="sketchbook_columns_111">'. do_shortcode(sketchbook_remove_p($content)) . '</div>';
}
add_shortcode('columns_111', 'sketchbook_columns_1_1_1');
/*-----------------------------------------------------------------------------------*/
/* 3. Columns Styles - 1/3 - [columns_12][/columns_12]
/*-----------------------------------------------------------------------------------*/
function sketchbook_columns_1_2($atts, $content = null) {
	return '<div class="sketchbook_columns_12">'. do_shortcode(sketchbook_remove_p($content)) . '</div>';
}
add_shortcode('columns_12', 'sketchbook_columns_1_2');
/*-----------------------------------------------------------------------------------*/
/* 4. Columns Styles - 2/3 - [columns_21][/columns_21]
/*-----------------------------------------------------------------------------------*/
function sketchbook_columns_2_1($atts, $content = null) {
	return '<div class="sketchbook_columns_21">'. do_shortcode(sketchbook_remove_p($content)) . '</div>';
}
add_shortcode('columns_21', 'sketchbook_columns_2_1');
/*-----------------------------------------------------------------------------------*/
/* 5. Columns Styles - 1/1 - [columns_11][/columns_11]
/*-----------------------------------------------------------------------------------*/
function sketchbook_columns_1_1($atts, $content = null) {
	return '<div class="sketchbook_columns_11">'. do_shortcode(sketchbook_remove_p($content)) . '</div>';
}
add_shortcode('columns_11', 'sketchbook_columns_1_1');
/*-----------------------------------------------------------------------------------*/
/* 6. Columns Styles - 1/2 - [col_1][/col_1]
/*-----------------------------------------------------------------------------------*/
function sketchbook_columns1_shortcode($atts, $content = null) {
	return '<div class="sketchbook_col_1">'. do_shortcode(sketchbook_remove_p($content)) . '</div>';
}
add_shortcode('col_1', 'sketchbook_columns1_shortcode');
/*-----------------------------------------------------------------------------------*/
/* 7. Columns Styles - 2/1 - [col_2][/col_2]
/*-----------------------------------------------------------------------------------*/
function sketchbook_columns2_shortcode($atts, $content = null) {
	return '<div class="sketchbook_col_2">'. do_shortcode(sketchbook_remove_p($content)) . '</div>';
}
add_shortcode('col_2', 'sketchbook_columns2_shortcode');
/*-----------------------------------------------------------------------------------*/
/* 8. Columns Styles - 1 1 - [col_1_1][/col_1_1]
/*-----------------------------------------------------------------------------------*/
function sketchbook_columns1_1_shortcode($atts, $content = null) {
	return '<div class="sketchbook_col_1_1">'. do_shortcode(sketchbook_remove_p($content)) . '</div>';
}
add_shortcode('col_1_1', 'sketchbook_columns1_1_shortcode');

/*-----------------------------------------------------------------------------------*/
/* Functions
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'sketchbook_add_css_button') ) :
function sketchbook_add_css_button() {
if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages')) {
        return;
    }
    if ( get_user_option('rich_editing') == 'true' ) {
        add_filter( 'mce_external_plugins', 'add_new_plugin' );
        add_filter( 'mce_buttons_3','register_new_button');
		add_filter('tiny_mce_before_init', 'sketchbook_add_css_class' );
    }
}
endif;
add_action('init', 'sketchbook_add_css_button');
/*********************/
if ( ! function_exists( 'sketchbook_add_css_class') ) :
function sketchbook_add_css_class($init) {
$init['theme_advanced_buttons3_add_before'] = 'styleselect'; 
$init['theme_advanced_styles'] = 'Float Left=alignleft,Float Right=alignright,List style: Tick=s_tick,List style: Arrow=s_arrow,Frame: Alert=s_alert,Frame: Warning=s_warning,Frame: Info=s_info,Frame: Border=s_border,Frame: Border dotted=s_border_dotted,Frame: Border top/bottom=s_border_top_bottom,Buttons=s_button,Buttons: alignleft=s_button_left,Buttons: alignright=s_button_right,Buttons: Full width=s_button_full,Width 1/3=s_width_1_3,Width 1/2=s_width_1_2,Width 2/3=s_width_2_3,Background color: Black=s_b_black,Background color: Grey=s_b_grey';
return $init;
}
endif;
/*********************/
function add_new_plugin($plugin_array) {
   $plugin_array['toggle'] = get_template_directory_uri().'/inc/js/plugins.js';
   $plugin_array['columns_111'] = get_template_directory_uri().'/inc/js/plugins.js';
   $plugin_array['columns_12'] = get_template_directory_uri().'/inc/js/plugins.js';
   $plugin_array['columns_21'] = get_template_directory_uri().'/inc/js/plugins.js';
   $plugin_array['columns_11'] = get_template_directory_uri().'/inc/js/plugins.js';
   return $plugin_array;
}
/*********************/
function register_new_button($buttons) {
   array_push($buttons, "toggle");
   array_push($buttons, "columns_111");
   array_push($buttons, "columns_12");
   array_push($buttons, "columns_21");
   array_push($buttons, "columns_11");
   return $buttons;
}
/*********************/
?>