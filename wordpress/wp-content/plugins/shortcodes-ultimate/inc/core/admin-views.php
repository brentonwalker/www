<?php
class Su_Admin_Views {
	function __construct() {}

	public static function about( $field, $config ) {
		ob_start();
?>
<div id="su-about-screen">
	<h1><?php _e( 'Welcome to Shortcodes Ultimate', 'su' ); ?> <small><?php _e( 'A real swiss army knife for WordPress', 'su' ); ?></small></h1>
	<div class="sunrise-inline-menu">
		<a href="http://gndev.info/shortcodes-ultimate/" target="_blank"><strong><?php _e( 'Project homepage', 'su' ); ?></strong></a>
		<a href="http://gndev.info/kb/" target="_blank"><?php _e( 'Documentation', 'su' ); ?></a>
		<a href="http://wordpress.org/support/plugin/shortcodes-ultimate/" target="_blank"><?php _e( 'Support forum', 'su' ); ?></a>
		<a href="http://wordpress.org/extend/plugins/shortcodes-ultimate/changelog/" target="_blank"><?php _e( 'Changelog', 'su' ); ?></a>
		<a href="https://github.com/gndev/shortcodes-ultimate" target="_blank"><?php _e( 'Fork on GitHub', 'su' ); ?></a>
	</div>
	<div class="su-clearfix">
		<div class="su-about-column">
			<h3><?php _e( 'Plugin features', 'su' ); ?></h3>
			<ul>
				<li><?php _e( '40+ amazing shortcodes', 'su' ); ?></li>
				<li><?php _e( 'Power of CSS3 transitions', 'su' ); ?></li>
				<li><?php _e( 'Handy shortcodes generator', 'su' ) ?></li>
				<li><?php _e( 'International', 'su' ); ?></li>
				<li><?php _e( 'Documented API', 'su' ); ?></li>
			</ul>
		</div>
		<div class="su-about-column">
			<h3><?php _e( 'What is a shortcode?', 'su' ); ?></h3>
			<p><?php _e( '<strong>Shortcode</strong> is a WordPress-specific code that lets you do nifty things with very little effort.', 'su' ); ?></p>
			<p><?php _e( 'Shortcodes can embed files or create objects that would normally require lots of complicated, ugly code in just one line. Shortcode = shortcut.', 'su' ); ?></p>
		</div>
	</div>
	<div class="su-clearfix">
		<div class="su-about-column">
			<h3><?php _e( 'How does it works', 'su' ); ?></h3>
			<a href="http://www.youtube.com/watch?v=DR2c266yWEA?autoplay=1&amp;showinfo=0&amp;rel=0&amp;theme=light#" target="_blank" class="su-demo-video"><img src="<?php echo plugins_url( 'assets/images/banners/how-it-works.jpg', SU_PLUGIN_FILE ); ?>" alt=""></a>
		</div>
		<div class="su-about-column">
			<h3><?php _e( 'More videos', 'su' ); ?></h3>
			<ul>
				<li><a href="http://www.youtube.com/watch?v=IjmaXz-b55I" target="_blank"><?php _e( 'Shortcodes Ultimate Tutorial', 'su' ); ?></a></li>
				<li><a href="http://www.youtube.com/watch?v=YU3Zu6C5ZfA" target="_blank"><?php _e( 'How to use special widget', 'su' ); ?></a></li>
				<li><a href="http://www.screenr.com/BK0H" target="_blank"><?php _e( 'How to create Carousel', 'su' ); ?></a></li>
				<li><a href="http://www.youtube.com/watch?v=kCWyO2F7jTw" target="_blank"><?php _e( 'How to create image gallery', 'su' ); ?></a></li>
			</ul>
		</div>
	</div>
</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		su_query_asset( 'css', array( 'magnific-popup', 'su-options-page' ) );
		su_query_asset( 'js', array( 'jquery', 'magnific-popup', 'su-options-page' ) );
		return $output;
	}

	public static function custom_css( $field, $config ) {
		ob_start();
?>
<div id="su-custom-css-screen">
	<div class="su-custom-css-originals">
		<p><strong><?php _e( 'You can overview the original styles to override it', $config['textdomain'] ); ?></strong></p>
		<div class="sunrise-inline-menu">
			<a href="<?php echo su_skin_url( 'content-shortcodes.css' ); ?>">content-shortcodes.css</a>
			<a href="<?php echo su_skin_url( 'box-shortcodes.css' ); ?>">box-shortcodes.css</a>
			<a href="<?php echo su_skin_url( 'media-shortcodes.css' ); ?>">media-shortcodes.css</a>
			<a href="<?php echo su_skin_url( 'galleries-shortcodes.css' ); ?>">galleries-shortcodes.css</a>
			<a href="<?php echo su_skin_url( 'players-shortcodes.css' ); ?>">players-shortcodes.css</a>
			<a href="<?php echo su_skin_url( 'other-shortcodes.css' ); ?>">other-shortcodes.css</a>
		</div>
	</div>
	<div class="su-custom-css-vars">
		<p><strong><?php _e( 'You can use next variables in your custom CSS', $config['textdomain'] ); ?></strong></p>
		<code>%home_url%</code> - <?php _e( 'home url', $config['textdomain'] ); ?><br/>
		<code>%theme_url%</code> - <?php _e( 'theme url', $config['textdomain'] ); ?><br/>
		<code>%plugin_url%</code> - <?php _e( 'plugin url', $config['textdomain'] ); ?>
	</div>
	<div id="su-custom-css-editor">
		<div id="sunrise-field-<?php echo $field['id']; ?>-editor"></div>
		<textarea name="sunrise[<?php echo $field['id']; ?>]" id="sunrise-field-<?php echo $field['id']; ?>" class="regular-text" rows="10"><?php echo stripslashes( get_option( $config['prefix'] . $field['id'] ) ); ?></textarea>
	</div>
</div>
			<?php
		$output = ob_get_contents();
		ob_end_clean();
		su_query_asset( 'css', array( 'magnific-popup', 'su-options-page' ) );
		su_query_asset( 'js', array( 'jquery', 'magnific-popup', 'ace', 'su-options-page' ) );
		return $output;
	}

	public static function examples( $field, $config ) {
		$output = array();
		$examples = Su_Data::examples();
		$preview = '<div style="display:none"><div id="su-examples-window"><div id="su-examples-preview"></div></div></div>';
		foreach ( $examples as $group ) {
			$items = array();
			if ( isset( $group['items'] ) ) foreach ( $group['items'] as $item ) {
					$code = ( isset( $item['code'] ) ) ? $item['code'] : plugins_url( 'inc/examples/' . $item['id'] . '.example', SU_PLUGIN_FILE );
					$id = ( isset( $item['id'] ) ) ? $item['id'] : '';
					$items[] = '<div class="su-examples-item" data-code="' . $code . '" data-id="' . $id . '" data-mfp-src="#su-examples-window" style="visibility:hidden"><i class="fa fa-' . $item['icon'] . '"></i> ' . $item['name'] . '</div>';
				}
			$output[] = '<div class="su-examples-group su-clearfix"><h2 class="su-examples-group-title" style="visibility:hidden">' . $group['title'] . '</h2>' . implode( '', $items ) . '</div>';
		}
		su_query_asset( 'css', array( 'magnific-popup', 'animate', 'font-awesome', 'su-options-page' ) );
		su_query_asset( 'js', array( 'jquery', 'magnific-popup', 'su-options-page' ) );
		return '<div id="su-examples-screen">' . implode( '', $output ) . '</div>' . $preview;
	}

	public static function addons( $field, $config ) {
		$output = array();
		$addons = array(
			array(
				'name' => __( 'Maker', 'su' ),
				'desc' => __( 'This add-on allows you to create custom shortcodes. You can easily create any shortcode with different parameters or even override default shortcodes', 'su' ),
				'url' => 'http://gndev.info/shortcodes-ultimate/maker/',
				'image' => plugins_url( 'assets/images/banners/maker.png', SU_PLUGIN_FILE )
			),
			array(
				'name' => __( 'Skins', 'su' ),
				'desc' => __( 'Set of additional skins for Shrtcodes Ultimate. It includes skins for accordeons/spoilers, tabs and some other shortcodes', 'su' ),
				'url' => 'http://gndev.info/shortcodes-ultimate/skins/',
				'image' => plugins_url( 'assets/images/banners/skins.png', SU_PLUGIN_FILE )
			),
		);
		$plugins = array();
		$output[] = '<h2>' . __( 'Shortcodes Ultimate Add-ons', 'su' ) . '</h2>';
		$output[] = '<div class="su-addons-loop su-clearfix">';
		foreach ( $addons as $addon ) {
			$output[] = '<div class="su-addons-item" style="visibility:hidden" data-url="' . $addon['url'] . '"><img src="' . $addon['image'] . '" alt="' . $addon['image'] . '" /><div class="su-addons-item-content"><h4>' . $addon['name'] . '</h4><p>' . $addon['desc'] . '</p><div class="su-addons-item-button"><a href="' . $addon['url'] . '" class="button button-primary" target="_blank">' . __( 'Learn more', 'su' ) . '</a></div></div></div>';
		}
		$output[] = '</div>';
		if ( count( $plugins ) ) {
			$output[] = '<h2>' . __( 'Other WordPress Plugins', 'su' ) . '</h2>';
			$output[] = '<div class="su-addons-loop su-clearfix">';
			foreach ( $plugins as $plugin ) {
				$output[] = '<div class="su-addons-item" style="visibility:hidden" data-url="' . $plugin['url'] . '"><img src="' . $plugin['image'] . '" alt="' . $plugin['image'] . '" /><div class="su-addons-item-content"><h4>' . $plugin['name'] . '</h4><p>' . $plugin['desc'] . '</p>' . Su_Shortcodes::button( array( 'url' => $plugin['url'], 'target' => 'blank', 'style' => 'flat', 'background' => '#FF7654', 'wide' => 'yes', 'radius' => '0' ), __( 'Learn more', 'su' ) ) . '</div></div>';
			}
			$output[] = '</div>';
		}
		su_query_asset( 'css', array( 'animate', 'su-options-page' ) );
		su_query_asset( 'js', array( 'jquery', 'su-options-page' ) );
		return '<div id="su-addons-screen">' . implode( '', $output ) . '</div>';
	}
}
