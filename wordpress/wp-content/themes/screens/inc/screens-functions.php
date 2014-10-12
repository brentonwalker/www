<?php
/*----------*/
/*	 1.	Social Media  */
/*----------*/
/*
Plugin Name:  Pinterest Pin It Button
Plugin URI:   http://pleer.co.uk/wordpress/plugins/pinterest-pin-it-button/
Description:  A simple plugin that lets you output a Pinterest "Pin It" button via shortcode
Version:      1.0
Author:       Alex Moss
Author URI:   http://alex-moss.co.uk/
Contributors: pleer, ShaneJones

Copyright (C) 2010-2010, Alex Moss
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of Alex Moss or pleer nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/
function pinterestJS(){
echo  <<<EOT
<script type="text/javascript">
(function() {
    window.PinIt = window.PinIt || { loaded:false };
    if (window.PinIt.loaded) return;
    window.PinIt.loaded = true;
    function async_load(){
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        if (window.location.protocol == "https:")
            s.src = "https://assets.pinterest.com/js/pinit.js";
        else
            s.src = "http://assets.pinterest.com/js/pinit.js";
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    }
    if (window.attachEvent)
        window.attachEvent("onload", async_load);
    else
        window.addEventListener("load", async_load, false);
})();
</script>
<script>
function exec_pinmarklet() {
    var e=document.createElement('script');
    e.setAttribute('type','text/javascript');
    e.setAttribute('charset','UTF-8');
    e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r=' + Math.random()*99999999);
    document.body.appendChild(e);
}
</script>
EOT;
}

/*----------*/
function pinterestCSS(){
echo "<link rel=\"stylesheet\" href=\"".get_template_directory_uri( )."/css/pin-it.css\" type=\"text/css\" />";
}
add_action('wp_head', 'pinterestCSS');
add_filter('the_content', 'screens_social',90);
		
function screens_social($content) {
global $NHP_Options;
$social = $NHP_Options->get('blog4');
if ($social && is_singular('post') ) {
$content .='<ul class="screens_social">
<li><em>'.__('Share', 'screens').'</em></li>
<li><a href="'.esc_url('https://twitter.com/share').'" class="twitter-share-button" data-related="@'.get_the_author().'">'.__('Tweet', 'screens').'</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</li>
<li>
<div class="plusone"><g:plusone  href="'.get_permalink().'"></g:plusone></div>
<script src="'.esc_url('https://apis.google.com/js/plusone.js').'" type="text/javascript" charset="utf-8"></script><div class="clear"></div></li> 
<li><!-- Place this tag where you want the su badge to render --><su:badge layout="2"></su:badge>
<!-- Place this snippet wherever appropriate --> 
 <script type="text/javascript"> 
 (function() { 
     var li = document.createElement(\'script\'); li.type = \'text/javascript\'; li.async = true; 
      li.src =\''.esc_url('https://platform.stumbleupon.com/1/widgets.js').'\'; 
      var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(li, s); 
 })(); 
 </script></li>
 <li class="pinterest-btn">
	<a href="javascript:exec_pinmarklet();" class="pin-it-btn" title="Pin It on Pinterest"></a>
<li>
</ul><div class="clear"></div>';
add_action('wp_footer', 'pinterestJS', 100);
}
return $content;
}

/*----------*/
/*	 2.	Logo  */
/*----------*/
		if ( ! function_exists( 'screens_header' ) ) :
function screens_header(){
		global $NHP_Options;
	$logo = $NHP_Options->get('primary1');
			if ($logo) :	
	$typo_heading_tag = (is_home() || is_front_page()) ?'h1' : 'h2';
?>
<<?php echo $typo_heading_tag; ?>
 class="five columns"> <a id="logo" href="<?php	echo site_url(); ?>"> <img src="<?php echo $logo; ?>" alt="<?php	bloginfo('name'); ?>" title="<?php	bloginfo('name'); ?>" /></a></<?php	echo $typo_heading_tag; ?>>

<?php else :
	$typo_heading_tag = (is_home() || is_front_page()) ? 'h1' : 'h2';
?>
<<?php echo $typo_heading_tag; ?>
 class="five columns"> <a id="logo" href="<?php	echo site_url(); ?>"><?php bloginfo('name'); ?></a></<?php echo $typo_heading_tag; ?>>
<?php endif;
	}
	endif;
	/*----------*/
	/*	 3.	Login  */
	/*----------*/
	if ( ! function_exists( 'screens_login_head' ) ) :
	function screens_login_head() {
	global $NHP_Options;
	$logo = $NHP_Options->get('primary1');
	if ($logo ) :
?>
<style>
	body.login #login h1 a {
	background: url("<?php echo esc_url($logo); ?>") no-repeat scroll center top transparent;
	}
</style>
<?php

endif;
}
endif;
add_action('login_head', 'screens_login_head');

function screens_login_url () { return site_url();}
add_filter('login_headerurl', 'screens_login_url');
/*----------*/
/*	 4.	Favicon  */
/*----------*/
if ( ! function_exists( 'screens_favicon_head' ) ) :
function screens_favicon_head() {
global $NHP_Options;
$favicon = $NHP_Options->get('primary2');
if ($favicon) :
?>
<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" />
<?php
endif;
}
endif;
add_action('wp_head', 'screens_favicon_head');
/*----------*/
/*	 5. Author info */
/*----------*/
function screens_desc(){
global $NHP_Options;
$about = $NHP_Options->get('blog5');
if ($about && get_the_author_meta( 'description' ) ) :
			?>
			<div class="author-info vcard">
<?php	echo get_avatar(get_the_author_meta('user_email')); ?>
				<?php	printf(__('<h2 class="fn">%s</h2>', 'screens'), get_the_author()); ?>
				<p>
					<span class="desc"><?php	the_author_meta('description'); ?></span>
					<?php	if(!is_author()) :?>				
<a class="alignright url" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author"> <?php printf(__('View all posts by %s &rarr;', 'screens'), get_the_author()); ?></a>	
				<?php endif; ?>
				</p>
</div>
<?php	endif;
	}
/*----------*/
/*	 6. Link to documentation */
/*----------*/
function screens_admin_bar_render() {
	global $wp_admin_bar;
	     $wp_admin_bar->add_menu( array(
        'parent' => false,
        'id' => 'sketchbook_docs',
        'title' => __('Screens documentation', 'screens'),
        'href' => get_template_directory_uri() . '/doc/index.html'
    ) );
}
add_action( 'wp_before_admin_bar_render', 'screens_admin_bar_render' );

	/*----------*/
	/*	 7. Custom Avatar */
	/*----------*/
	add_filter( 'avatar_defaults', 'screens_avatar' );
	function screens_avatar($avatar_defaults){
	global $NHP_Options;
	$avatar = $NHP_Options->get('primary3');
	if ($avatar) {
	$new_avatar = esc_url($avatar);
	$avatar_defaults[$new_avatar] = "Screens Avatar";
	}
	return $avatar_defaults;
	}
	/*----------*/
	/*	 8. Color schemat */
	/*----------*/
	function screens_color_schemat() {
	global $NHP_Options;
	$color = $NHP_Options->get('primary5');
	if ($color =='2') :
	wp_register_style('dark', get_template_directory_uri() . '/css/dark.css', '', '1.0');
	wp_enqueue_style('dark');
	elseif ($color =='3') :
	wp_register_style('orange', get_template_directory_uri() . '/css/orange.css', '', '1.0');
	wp_enqueue_style('orange');
	endif;
	}
	add_action('wp_print_styles', 'screens_color_schemat' );
	/*----------*/
	/*	 9. Custom css */
	/*----------*/
	function screens_custom_css() {
	global $NHP_Options;
	$code = $NHP_Options->get('code2');
	if ($code ) :
	echo '<style>';
	echo $code;
	echo '</style>';
	endif;
	}
	add_action('wp_head', 'screens_custom_css' );
	/*----------*/
	/*	 10. CSS Class */
	/*----------*/
	function screens_fonts() {
	global $NHP_Options;
	$link = $NHP_Options->get('font1');
	$header = $NHP_Options->get('font2');
	$text = $NHP_Options->get('font3');
	$size = $NHP_Options->get('font5');
	$g_font = $NHP_Options->get('font4');
	$bodycolor = $NHP_Options->get('primary6');
	$bodyprimary = $NHP_Options->get('primary7');
	$bodyimg = $NHP_Options->get('primary8');
	$bodycustomimg = $NHP_Options->get('primary9');
	$desccolor = $NHP_Options->get('desc4');
	$descbg = $NHP_Options->get('desc5');
	$portfoliobg = $NHP_Options->get('portfolio3');
	$blogbg = $NHP_Options->get('blog6');
	$contactbg = $NHP_Options->get('contact4');

	$img_links = get_template_directory_uri().'/images/bg/';

	echo '<style>';
	if ($link) : echo 'a{color:'.$link.'}';   endif;
	if ($header) : echo 'h1, h2, h3, h4, h5, h6 {color:'.$header.'}';   endif;
	echo "body {"; // Body options

	if($size=='2'): echo 'font-size: 13px; ';
	elseif($size=='3'): echo 'font-size: 12px; line-height:1.7; ';
	elseif($size=='4'): echo 'font-size: 16px; ';
	else : echo 'font-size: 14px; '; endif;

	if($text=='2'): echo 'font-family: Verdana, \'Bitstream Vera Sans\',\'DejaVu Sans\',\'Liberation Sans\',Kalimati,Geneva,sans-serif; ';
	elseif($text=='3'): echo 'font-family: Georgia,\'Bitstream Charter\',\'Century Schoolbook L\',\'Liberation Serif\',Times,serif; ';
	elseif($text=='4'): echo 'font-family: \'Palatino Linotype\', Palatino, \'URW Palladio L\',Palladio,\'Book Antiqua\',\'Liberation Serif\',Times,serif; ';
	elseif($text=='5'): echo 'font-family: Consolas, "Courier New", Courier, monospace; ';
	elseif($text=='6'): echo 'font-family: \'PT Serif\', serif; ';
	elseif($text=='9'): echo 'font-family: \'PT Sens\', Arial, Helvetica, sans-serif; ';
	elseif($text=='7'): echo 'font-family: \'Droid Sans\', Arial, Helvetica, sans-serif; ';
	elseif($text=='8'): echo 'font-family: \'Droid Serif\', Arial, Helvetica, sans-serif; ';
	endif;
	if ($bodycolor) : echo 'background:'.$bodycolor.'; ';   endif;

	if($bodycustomimg) : echo 'background-image: url('.$bodycustomimg.');'; else :
	if (($bodyimg)=='2') : echo 'background-image: url('.$img_links.'/bg-1.jpg)';
	elseif (($bodyimg)=='3') : echo 'background-image: url('.$img_links.'/bg-2.jpg)';
	elseif (($bodyimg)=='4') : echo 'background-image: url('.$img_links.'/bg-3.jpg)';
	elseif (($bodyimg)=='5') : echo 'background-image: url('.$img_links.'/bg-4.jpg)';
	elseif (($bodyimg)=='6') : echo 'background-image: url('.$img_links.'/bg-5.jpg)';
	elseif (($bodyimg)=='7') : echo 'background-image: url('.$img_links.'/bg-6.jpg)';
	elseif (($bodyimg)=='8') : echo 'background-image: url('.$img_links.'/bg-7.jpg)';
	elseif (($bodyimg)=='9') : echo 'background-image: url('.$img_links.'/bg-8.jpg)';
	elseif (($bodyimg)=='10') : echo 'background-image: url('.$img_links.'/bg-9.jpg)';
	elseif (($bodyimg)=='11') : echo 'background-image: url('.$img_links.'/bg-10.jpg)';
	elseif (($bodyimg)=='12') : echo 'background-image: url('.$img_links.'/bg-11.jpg)';
	endif;
	endif;

	echo "}";

	if($g_font=='2' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;}';
	elseif($g_font=='3' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Verdana, sans-serif;}';
	elseif($g_font=='4' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Georgia, serif;}';
	elseif($g_font=='5' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: "Palatino Linotype", serif;}';
	elseif($g_font=='6' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: "Open Sans", sans-serif;}';
	elseif($g_font=='7' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: "Droid Sans", sans-serif;}';
	elseif($g_font=='8' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Oswald, serif;}';
	elseif($g_font=='9' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Vollkorn, serif;}';
	elseif($g_font=='10' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: "Old Standard TT", serif;}';
	elseif($g_font=='11' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: "Maven Pro", serif;}';
	elseif($g_font=='12' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Bevan, serif;}';
	elseif($g_font=='13' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Poly;}';
	elseif($g_font=='14' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Lato, sans-serif;}';
	elseif($g_font=='15' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: "PT Serif", serif;}';
	elseif($g_font=='16' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Ubuntu, sans-serif;}';
	elseif($g_font=='17' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: "Playfair Display, serif";}';
	elseif($g_font=='18' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: "Abril Fatface", serif;}';
	elseif($g_font=='19' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: "Hammersmith One", sans-serif;}';
	elseif($g_font=='20' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Raleway, serif;}';
	elseif($g_font=='21' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: Cabin, serif;}';
	elseif($g_font=='22' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: \'Josefin Sans\', sans-serif}';
	elseif($g_font=='23' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: \'Droid Sans Mono\', sans-serif;}';
	elseif($g_font=='24' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: \'Droid Serif\', serif}';
	elseif($g_font=='25' && $g_font): echo 'h1, h2, h3, h4, h5, h6{font-family: \'PT Sans\', sans-serif;}';
	endif;
	if ($bodyprimary) :
	echo '.flickr_badge_image a{background:'.$bodyprimary.'; }';
	echo '.time_meta, #header, #footer, .border_bottom, .blog article, article, .meta_post, #breadcrumbs, #sidebar li, .toggle_header, #sidebar .widget li li, #searchform, .page-link a, .wp-pagenavi a, .wp-pagenavi .alignright, .bypostauthor, .sidebar_meta, .title_headers, .author-info, #comments .comment, .s_tabs .ui-state-active, #home_list{border-color:'.$bodyprimary.'!important; }';
	endif;
	if($descbg): echo '#home_desc .sixteen{background: url('.$descbg.') no-repeat 0 0!important} '; endif;
	if($desccolor): echo '#home_desc {background-color:'.$desccolor.'!important} '; endif;
	echo '
	</style>';
	}
	add_action('wp_head', 'screens_fonts');
	/*----------*/
	/*	 10. Google Fonts */
	/*----------*/

	
		function screens_google_link() {
	global $NHP_Options;
	$header_font = $NHP_Options->get('font4');
	$g_font = $NHP_Options->get('font4');
	$text = $NHP_Options->get('font3');

	if (!is_admin()) {
	if($g_font=='6' ){ wp_register_style('css_open', 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic&subset=latin,latin-ext');
	wp_enqueue_style('css_open');

	} elseif($g_font=='7' || $text=='7'){
	wp_register_style('css_droid', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700');
	wp_enqueue_style('css_droid');

	} elseif($g_font=='8' ){
	wp_register_style('css_oswald', 'http://fonts.googleapis.com/css?family=Oswald');
	wp_enqueue_style('css_oswald');

	} elseif($g_font=='9' ){
	wp_register_style('css_vollkorn', 'http://fonts.googleapis.com/css?family=Vollkorn:400,400italic,700');
	wp_enqueue_style('css_vollkorn');

	} elseif($g_font=='10' ){
	wp_register_style('css_old', 'http://fonts.googleapis.com/css?family=Old+Standard+TT:400,700,400italic');
	wp_enqueue_style('css_old');

	} elseif($g_font=='11' ){
	wp_register_style('css_maven', 'http://fonts.googleapis.com/css?family=Maven+Pro');
	wp_enqueue_style('css_maven');

	} elseif($g_font=='12' ){
	wp_register_style('css_bevan', 'http://fonts.googleapis.com/css?family=Bevan');
	wp_enqueue_style('css_bevan');

	} elseif($g_font=='13' ){
	wp_register_style('css_covered', 'http://fonts.googleapis.com/css?family=Poly:400,400italic');
	wp_enqueue_style('css_covered');

	} elseif($g_font=='14' ){
	wp_register_style('css_lato', 'http://fonts.googleapis.com/css?family=Lato:400italic,400,900');
	wp_enqueue_style('css_lato');

	} elseif($g_font=='15' || $text=='5'){
	wp_register_style('css_pt', 'http://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700');
	wp_enqueue_style('css_pt');

	} elseif($g_font=='16' ){
	wp_register_style('css_ubuntu', 'http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,700&subset=latin,latin-ext');
	wp_enqueue_style('css_ubuntu');

	} elseif($g_font=='17' ){
	wp_register_style('css_play', 'http://fonts.googleapis.com/css?family=Playfair+Display:400,400italic&subset=latin,latin-ext');
	wp_enqueue_style('css_play');

	} elseif($g_font=='18' ){
	wp_register_style('css_abril', 'http://fonts.googleapis.com/css?family=Abril+Fatface&subset=latin,latin-ext');
	wp_enqueue_style('css_abril');

	} elseif($g_font=='19' ){
	wp_register_style('css_hammer', 'http://fonts.googleapis.com/css?family=Hammersmith+One');
	wp_enqueue_style('css_hammer');

	} elseif($g_font=='20' ){
	wp_register_style('css_uni', 'http://fonts.googleapis.com/css?family=Raleway:100');
	wp_enqueue_style('css_uni');

	} elseif($g_font=='21' ){
	wp_register_style('css_cabin', 'http://fonts.googleapis.com/css?family=Cabin:400');
	wp_enqueue_style('css_cabin');

	} elseif($g_font=='22' ){
	wp_register_style('css_Josefin', 'http://fonts.googleapis.com/css?family=Josefin+Sans:400,400italic,700,700italic');
	wp_enqueue_style('css_Josefin');

	} elseif($g_font=='23' ){
	wp_register_style('css_droidmono', 'http://fonts.googleapis.com/css?family=Droid+Sans+Mono');
	wp_enqueue_style('css_droidmono');

	} elseif($g_font=='24' || $text=='8'){
	wp_register_style('css_droidserif', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic');
	wp_enqueue_style('css_droidserif');

	} elseif($g_font=='25' || $text=='9'){
	wp_register_style('css_ptsens', 'http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700');
	wp_enqueue_style('css_ptsens');
}
	}
	}
	add_action('wp_print_styles', 'screens_google_link'); 
?>