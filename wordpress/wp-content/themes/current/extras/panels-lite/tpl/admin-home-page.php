<?php
$install_url = siteorigin_plugin_activation_install_url(
	'siteorigin-panels',
	__('Page Builder', 'siteorigin'),
	'http://downloads.wordpress.org/plugin/siteorigin-panels.zip'
);
?>
<div class="wrap" id="panels-home-page">
	<div id="icon-index" class="icon32"><br></div>
	<h2>
		<?php esc_html_e('Custom Home Page', 'siteorigin') ?>

		<a id="panels-toggle-switch" href="<?php echo esc_url($install_url) ?>" class="state-off subtle-move">
			<div class="on-text"><?php _e('ON', 'siteorigin') ?></div>
			<div class="off-text"><?php _e('OFF', 'siteorigin') ?></div>
			<img src="<?php echo get_template_directory_uri() ?>/extras/panels-lite/css/images/handle.png" class="handle" />
		</a>
	</h2>
	
	<p>
		<?php _e("This theme is compatible with SiteOrigin's powerful drag and drop page builder.", 'siteorigin') ?>
		<?php _e('It allows you to build responsive columnized pages, populated with the widgets you know and love.', 'siteorigin') ?>
		<?php _e("It's a <strong>free plugin</strong> that works well with most WordPress themes.", 'siteorigin') ?>
	</p>
	
	<p class="install-container">
		<a href="<?php echo esc_url($install_url) ?>" class="install"><?php _e('Install Page Builder', 'siteorigin') ?></a>
	</p>
	
	<p>
		<a href="http://player.vimeo.com/video/59561067?autoplay=1" target="_blank">
			<img src="<?php echo get_template_directory_uri() ?>/extras/panels-lite/images/video.png" width="680" height="383" />
		</a>
	</p>
</div> 