<?php
/*
Plugin Name: Image Zoom
Plugin Name: zoom, highslide, image, panorama
Description: <p>Allow to dynamically zoom on images in posts/pages/... </p><p>When clicked, the image will dynamically scale-up. Please note that you have to insert image normally with the wordpress embedded editor.</p><p>You may configure:</p><ul><li>The max width/height of the image; </li><li>The transition delay; </li><li>The position of the buttons; </li><li>The auto-start of the slideshow; </li><li>the opacity of the background; </li><li>the pages to be excluded. </li></ul><p>If the image does not scale-up, please verify that the HTML looks like the following : &lt;a href=' '&gt;&lt;img src=' '&gt;&lt;/a&gt;.</p><p>This plugin implements the colorbox javascript library. </p><p>This plugin is under GPL licence.</p>
Version: 1.6.6
Author: SedLex
Author Email: sedlex@sedlex.fr
Framework Email: sedlex@sedlex.fr
Author URI: http://www.sedlex.fr/
Plugin URI: http://wordpress.org/plugins/image-zoom/
License: GPL3
*/

require_once('core.php') ; 

class imagezoom extends pluginSedLex {
	/** ====================================================================================================================================================
	* Initialisation du plugin
	* 
	* @return void
	*/
	static $instance = false;
	var $path = false;
	
	var $image_type ;

	protected function _init() {
		global $wpdb ; 
		// Configuration
		$this->pluginName = 'Image Zoom' ; 
		$this->tableSQL = "" ; 
		$this->table_name = $wpdb->prefix . "pluginSL_" . get_class() ; 
		
		$this->path = __FILE__ ; 
		$this->pluginID = get_class() ; 
		
		//Init et des-init
		register_activation_hook(__FILE__, array($this,'install'));
		register_deactivation_hook(__FILE__, array($this,'deactivate'));
		register_uninstall_hook(__FILE__, array('imagezoom','uninstall'));
		
		//Parametres supplementaires		
		$this->image_type = "(bmp|gif|jpeg|jpg|png)" ;
		
	}
	
	/**
	 * Function to instantiate our class and make it a singleton
	 */
	 
	public static function getInstance() {
		if ( !self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/** ====================================================================================================================================================
	* In order to uninstall the plugin, few things are to be done ... 
	* (do not modify this function)
	* 
	* @return void
	*/
	
	public function uninstall_removedata () {
		global $wpdb ;
		// DELETE OPTIONS
		delete_option('imagezoom'.'_options') ;
		if (is_multisite()) {
			delete_site_option('imagezoom'.'_options') ;
		}
		
		// DELETE SQL
		if (function_exists('is_multisite') && is_multisite()){
			$old_blog = $wpdb->blogid;
			$old_prefix = $wpdb->prefix ; 
			// Get all blog ids
			$blogids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM ".$wpdb->blogs));
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				$wpdb->query("DROP TABLE ".str_replace($old_prefix, $wpdb->prefix, $wpdb->prefix . "pluginSL_" . 'imagezoom')) ; 
			}
			switch_to_blog($old_blog);
		} else {
			$wpdb->query("DROP TABLE ".$wpdb->prefix . "pluginSL_" . 'imagezoom' ) ; 
		}
	}	


	/** ====================================================================================================================================================
	* Define the default option value of the plugin
	* 
	* @return variant of the option
	*/
	function get_default_option($option) {
		switch ($option) {
			case 'widthRestriction'		 	: return 640 	; break ; 
			case 'heightRestriction'		: return 900 	; break ; 
			case 'show_interval'		 	: return 5000 	; break ; 
			case 'show_alt'		 			: return false 	; break ; 
			case 'show_title'		 		: return false 	; break ; 
			case 'background_opacity'		: return "0.8" ; break ; 
			case 'slideshow_autostart'		: return false ; break ; 
			case 'disable_nav_buttons'		: return false ; break ; 
			case 'disable_next_on_click'		: return false ; break ; 
			case 'disable_slide_buttons'	: return false ; break ; 
			case 'tra_image'		: return "Image {current} of {total}" ; break ; 
			case 'tra_previous'		: return "Previous" ; break ; 
			case 'tra_next'			: return "Next" ; break ; 
			case 'tra_close'		: return "Close" ; break ; 
			case 'tra_play'			: return "Play" ; break ; 
			case 'tra_pause'		: return "Pause" ; break ; 
			case 'exclu'		: return "*" ; break ; 

			case 'theme'		: return array(		array("*".__("Theme 01", $this->pluginID), "th01"), 
											array(__("Theme 02", $this->pluginID), "th02"),											
											array(__("Theme 03", $this->pluginID), "th03"),
											array(__("Theme 04", $this->pluginID), "th04")
									   ) ; break ; 
		}
		return null ;
	}
	
	/**====================================================================================================================================================
	* Function called when the plugin is activated
	* For instance, you can do stuff regarding the update of the format of the database if needed
	* If you do not need this function, you may delete it.
	*
	* @return void
	*/
	
	public function _update() {
		$theme = $this->get_param('theme') ; 
		$is_theme4 = false ; 
		foreach ($theme as $val) {
			if ($val[1]=="th04") {
				$is_theme4 = true ; 
			}
		}
		if (!$is_theme4) {
			$theme = array_merge($theme, array(array(__("Theme 04", $this->pluginID), "th04"))) ; 
		}
		$this->set_param('theme', $theme) ; 
	}
	

	/** ====================================================================================================================================================
	* Init javascript for the public side
	* If you want to load a script, please type :
	* 	<code>wp_enqueue_script( 'jsapi', 'https://www.google.com/jsapi');</code> or 
	*	<code>wp_enqueue_script('my_plugin_script', plugins_url('/script.js', __FILE__));</code>
	*	<code>$this->add_inline_js($js_text);</code>
	*	<code>$this->add_js($js_url_file);</code>
	*
	* @return void
	*/
	
	function _public_js_load() {	
		wp_enqueue_script('jquery');   
		
		// We check whether there is an exclusion
		$exclu = $this->get_param('exclu') ;
		$exclu = explode("\n", $exclu) ;
		foreach ($exclu as $e) {
			$e = trim(str_replace("\r", "", $e)) ; 
			if ($e!="") {
				$e = "@".$e."@i"; 
				if (preg_match($e, $_SERVER['REQUEST_URI'])) {
					return ; 
				}
			}
		}
	
		ob_start() ; 
		?>
		jQuery(document).ready(function () {
			jQuery('a.gallery_colorbox').colorbox({ 
				slideshow: true,
				<?php if (($this->get_param('show_alt'))&&(!$this->get_param('show_title'))) { ?>
				title: function(){ 
					if (typeof jQuery(this).children("img:first").attr('alt') !== "undefined") {
						return jQuery(this).children("img:first").attr('alt'); 
					} else {
						return "" ; 
					}
				},
				<?php } else if ((!$this->get_param('show_alt'))&&($this->get_param('show_title'))) { ?>
				title: function(){ 
					if (typeof jQuery(this).children("img:first").attr('title') !== "undefined") {
						return "<h2>"+jQuery(this).children("img:first").attr('title')+"</h2>" ; 
					} else {
						return "" ; 
					}
				},
				<?php } else if (($this->get_param('show_alt'))&&($this->get_param('show_title'))) { ?>
				title: function(){ 
					var out = "" ; 
					if (typeof jQuery(this).children("img:first").attr('title') !== "undefined") {
						out = out + "<h2>"+jQuery(this).children("img:first").attr('title')+"</h2>" ; 
					} else {
						out = out + "" ; 
					}
					if (typeof jQuery(this).children("img:first").attr('alt') !== "undefined") {
						out = out + jQuery(this).children("img:first").attr('alt'); 
					} else {
						out = out + "" ; 
					}
					return out; 
				},
				<?php 				
				} else {
				?>
				title: false,
				<?php }
				if ($this->get_param('slideshow_autostart')) { ?>
				slideshowAuto:true,
				<?php } else { ?>
				slideshowAuto:false,
				<?php } ?>
				slideshowSpeed: <?php echo $this->get_param('show_interval');?> ,
				slideshowStart: '<?php echo $this->get_param('tra_play') ; ?>',
				slideshowStop :  '<?php echo $this->get_param('tra_pause') ; ?>',
				current : '<?php echo $this->get_param('tra_image') ; ?>', 
				scalePhotos : true , 
				previous: '<?php echo $this->get_param('tra_previous') ; ?>',	
				next:'<?php echo $this->get_param('tra_next') ; ?>',
				close:'<?php echo $this->get_param('tra_close') ; ?>',
				maxWidth: <?php echo $this->get_param('widthRestriction') ; ?>, 
				maxHeight : <?php echo $this->get_param('heightRestriction') ; ?>,
				opacity:<?php echo $this->get_param('background_opacity');?> , 
				onComplete : function(){ 
					jQuery("#cboxLoadedContent").css({overflow:'hidden'});
				<?php
				if ($this->get_param('disable_nav_buttons')) {
				?>
					jQuery("#cboxPrevious").hide();
					jQuery("#cboxNext").hide();
				<?php
				}
				if ($this->get_param('disable_next_on_click')) {
				?>
    				jQuery('.cboxPhoto').unbind().click(jQuery('a.gallery_colorbox').colorbox.close); 
				<?php
				}
				if ($this->get_param('disable_slide_buttons')) {
				?>
					jQuery("#cboxSlideshow").hide();
				<?php
				}
				?>
				},
				rel:'group1' 
			});
		});	
						
		<?php 
		$content = ob_get_clean() ; 
		$this->add_inline_js($content) ; 
	}
	
	
	/** ====================================================================================================================================================
	* Init css for the public side
	* If you want to load a style sheet, please type :
	*	<code>$this->add_inline_css($css_text);</code>
	*	<code>$this->add_css($css_url_file);</code>
	*
	* @return void
	*/
	
	function _public_css_load() {	
		// We check whether there is an exclusion
		$exclu = $this->get_param('exclu') ;
		$exclu = explode("\n", $exclu) ;
		foreach ($exclu as $e) {
			$e = trim(str_replace("\r", "", $e)) ; 
			if ($e!="") {
				$e = "@".$e."@i"; 
				if (preg_match($e, $_SERVER['REQUEST_URI'])) {
					return ; 
				}
			}
		}
		
		$theme = $this->get_param('theme') ; 
		foreach ($theme as $t) {
			if (substr($t[0], 0, 1) == "*") {
				if ($t[1]=="th01") {
					$this->add_css(WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."css/theme1.css") ; 
				}
				if ($t[1]=="th02") {
					$this->add_css(WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."css/theme2.css") ; 
				}
				if ($t[1]=="th03") {
					$this->add_css(WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."css/theme3.css") ; 
				}
				if ($t[1]=="th04") {
					$this->add_css(WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."css/theme4.css") ; 
				}
			}
		}
	}

	/** ====================================================================================================================================================
	* Called when the content is displayed
	*
	* @param string $content the content which will be displayed
	* @param string $type the type of the article (e.g. post, page, custom_type1, etc.)
	* @param boolean $excerpt if the display is performed during the loop
	* @return string the new content
	*/
	
	function _modify_content($string, $type, $excerpt) {	
		// We check whether there is an exclusion
		$exclu = $this->get_param('exclu') ;
		$exclu = explode("\n", $exclu) ;
		foreach ($exclu as $e) {
			$e = trim(str_replace("\r", "", $e)) ; 
			if ($e!="") {
				$e = "@".$e."@i"; 
				if (preg_match($e, $_SERVER['REQUEST_URI'])) {
					return $string ; 
				}
			}
		}
				
		$pattern = '/(<a([^>]*?)href=["\']([^"\']*)["\']([^>]*?)>((?:[^<]|<br)*)<img([^>]*?)src=["\']([^"\']*[.])'.$this->image_type.'["\']([^>]*?)>([^<]|<br)*<\/a>)/iu';
		$out = preg_replace_callback($pattern, array($this,"_modify_content_callback"), $string);
		
		return $out ; 
	}
	
	/** ====================================================================================================================================================
	* Called when the content is displayed
	*
	* @param string $content the content which will be displayed
	* @param string $type the type of the article (e.g. post, page, custom_type1, etc.)
	* @param boolean $excerpt if the display is performed during the loop
	* @return string the new content
	*/
	
	function _modify_content_callback($matches) {
  		// comme d'habitude : $matches[0] represente la valeur totale
  		// $matches[1] represente la première parenthèse capturante

		$pattern_img = '/(<a([^>]*?)href=["\']([^"\']*[.])'.$this->image_type.'["\']([^>]*?)>((?:[^<]|<br)*)<img([^>]*?)src=["\']([^"\']*[.])'.$this->image_type.'["\']([^>]*?)>([^<]|<br)*<\/a>)/iesU';
  		$replacement_img = 'stripslashes("<a\2href=\"\3\4\" class=\"gallery_colorbox\"\5>\6<img\7src=\"\8\9\" \10>\11</a>")';
		
		if (preg_match($pattern_img, $matches[0])) {
			return preg_replace($pattern_img, $replacement_img, $matches[0]);
		}
		
		$id_attach = url_to_postid($matches[3]) ; 
		if (($id_attach!=0)&&(wp_attachment_is_image($id_attach))) {
			$pattern = '/(<a([^>]*?)href=["\']([^"\']*)["\']([^>]*?)>((?:[^<]|<br)*)<img([^>]*?)src=["\']([^"\']*[.])'.$this->image_type.'["\']([^>]*?)>([^<]|<br)*<\/a>)/iesU';
  			$image = wp_get_attachment_image_src( $id_attach , 'full');
			$replacement = 'stripslashes("<a\2href=\"'.$image[0].'\" class=\"gallery_colorbox\"\4>\5<img\6src=\"\7\8\" \9>\10</a>")';
			
			return preg_replace($pattern, $replacement, $matches[0]);
		}
		
  		return $matches[0];
	}
	
	/** ====================================================================================================================================================
	* The configuration page
	* 
	* @return void
	*/
	function configuration_page() {
		global $wpdb;
	
		?>
		<div class="wrap">
			<div id="icon-themes" class="icon32"><br></div>
			<h2><?php echo $this->pluginName ?></h2>
		</div>
		<div style="padding:20px;">
			<?php echo $this->signature ; ?>
			
			<!--debut de personnalisation-->
		<?php
		
			// On verifie que les droits sont corrects
			$this->check_folder_rights( array() ) ; 	
			
			// On verifie que le header.php du theme ne contient pas de jquery
			
			$header = @file_get_contents(TEMPLATEPATH."/header.php") ; 
			
			if (preg_match("/jquery/i", $header)) {
				echo "<div class='error fade'><p>".sprintf(__("Your theme contains (i.e. in %s file) a hardcoded reference to the jQuery javascript library.", $this->pluginID), "<code>".TEMPLATEPATH."/header.php</code>")."</p><p>".sprintf(__("This reference may break the plugin. So, if the plugin does not work, please either delete this reference or move it just after the %s declaration.", $this->pluginID), "<code>&lt;head&gt;</code>")."</p></div>" ; 
			}
			
			//==========================================================================================
			//
			// Mise en place du systeme d'onglet
			//		(bien mettre a jour les liens contenu dans les <li> qui suivent)
			//
			//==========================================================================================
			
			
			$tabs = new adminTabs() ; 
			echo "<p>".__('This plugin allows a dynamic zoom on the images (based on the colorbox javascript library)', $this->pluginID)."</p>" ; 
			ob_start() ; 
				$params = new parametersSedLex($this, 'tab-parameters') ; 
				$params->add_title(__('What are the clipped dimensions of the zoomed image?',$this->pluginID)) ; 
				$params->add_param('widthRestriction', __('Max width:',$this->pluginID)) ; 
				$params->add_param('heightRestriction', __('Max height:',$this->pluginID)) ; 
				
				$params->add_title(__('What is the text for the frontend?',$this->pluginID)) ; 
				$params->add_param('tra_previous', __('Previous:',$this->pluginID)) ; 
				$params->add_param('tra_next', __('Next:',$this->pluginID)) ; 
				$params->add_param('tra_close', __('Close:',$this->pluginID)) ; 
				$params->add_param('tra_play', __('Play:',$this->pluginID)) ; 
				$params->add_param('tra_pause', __('Pause:',$this->pluginID)) ; 
				$params->add_param('tra_image', __('The image counter:',$this->pluginID)) ; 
				$params->add_comment(sprintf(__('The %s will be replace with the index of the image and %s with the total number of images in the page.',$this->pluginID), "<code>{current}</code>", "<code>{total}</code>")) ; 
				
				$params->add_title(__('What is the theme?',$this->pluginID)) ; 
				$params->add_param('theme', __('Choose the theme:',$this->pluginID)) ; 
				$params->add_comment(sprintf(__('Theme 01 is : %s.',$this->pluginID), "<img src='".WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."img/theme1_illustr.jpg"."'/>")) ; 
				$params->add_comment(sprintf(__('Theme 02 is : %s.',$this->pluginID), "<img src='".WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."img/theme2_illustr.jpg"."'/>")) ; 
				$params->add_comment(sprintf(__('Theme 03 is : %s.',$this->pluginID), "<img src='".WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."img/theme3_illustr.jpg"."'/>")) ; 
				$params->add_comment(sprintf(__('Theme 04 is : %s (created by %s).',$this->pluginID), "<img src='".WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."img/theme4_illustr.jpg"."'/>", "Andreas Amundin")) ; 
				
				$params->add_title(__('Show description text',$this->pluginID)) ; 
				$params->add_param('show_title', __('Show the title of the image:',$this->pluginID)) ; 
				$params->add_param('show_alt', __('Show the alternative text of the image:',$this->pluginID)) ; 
				
				$params->add_title(__('What are the other parameters?',$this->pluginID)) ; 
				$params->add_param('show_interval', __('Transition time if the slideshow is on:',$this->pluginID)) ; 
				$params->add_param('slideshow_autostart', __('Auto-start the slideshow when launched:',$this->pluginID)) ; 
				$params->add_param('background_opacity', __('The opacity of the background:',$this->pluginID)) ; 
				
				$params->add_title(__('Advanced parameters?',$this->pluginID)) ; 
				$params->add_param('disable_nav_buttons', __('Disable the navigation buttons on images:',$this->pluginID)) ; 
				$params->add_param('disable_next_on_click', __('Disable click on the image for next (it will then close the slideshow):',$this->pluginID)) ; 
				$params->add_param('disable_slide_buttons', __('Disable the slideshow buttons on images:',$this->pluginID)) ; 
				
				$params->add_param('exclu', __('List of page exclusions:',$this->pluginID)) ; 
				$params->add_comment(sprintf(__('For instance, you may exclude page with URL like %s by setting this option to %s. Please add one regular expressions by line',$this->pluginID), "<code>http://yourdomain.tld/portfolio/</code>", "<code>portfolio</code>")) ; 
				$params->add_comment(sprintf(__('In addition, you may set this option to %s and to %s to exclude the home page',$this->pluginID), "<code>^/$</code>", "<code>^$</code>")) ; 
				
				$params->flush() ; 
			$tabs->add_tab(__('Parameters',  $this->pluginID), ob_get_clean() , WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."core/img/tab_param.png") ; 	

						
			ob_start() ; 
				$plugin = str_replace("/","",str_replace(basename(__FILE__),"",plugin_basename( __FILE__))) ; 
				$trans = new translationSL($this->pluginID, $plugin) ; 
				$trans->enable_translation() ; 
			$tabs->add_tab(__('Manage translations',  $this->pluginID), ob_get_clean() , WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."core/img/tab_trad.png") ; 	

			ob_start() ; 
				$plugin = str_replace("/","",str_replace(basename(__FILE__),"",plugin_basename( __FILE__))) ; 
				$trans = new feedbackSL($plugin,  $this->pluginID) ; 
				$trans->enable_feedback() ; 
			$tabs->add_tab(__('Give feedback',  $this->pluginID), ob_get_clean() , WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."core/img/tab_mail.png") ; 	
			
			ob_start() ; 
				$trans = new otherPlugins("sedLex", array('wp-pirates-search')) ; 
				$trans->list_plugins() ; 
			$tabs->add_tab(__('Other plugins',  $this->pluginID), ob_get_clean() , WP_PLUGIN_URL.'/'.str_replace(basename(__FILE__),"",plugin_basename(__FILE__))."core/img/tab_plug.png") ; 	
			

			echo $tabs->flush() ; 
			
			echo $this->signature ; ?>
		</div>
		<?php
	}
}

$updatemessage = imagezoom::getInstance();

?>