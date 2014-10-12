<?php
$panels_support = get_theme_support( 'siteorigin-panels' );
if ( empty( $panels_support ) ) return;
$panels_support = $panels_support[0];
?>

<div class="wrap" id="panels-home-page">
	<form action="<?php echo add_query_arg('page', 'so_panels_home_page') ?>" class="hide-if-no-js" method="post">
		<div id="icon-index" class="icon32"><br></div>
		<h2>
			<?php esc_html_e('Custom Home Page', 'origami') ?>

			<div id="panels-toggle-switch" class="<?php echo (!get_theme_mod('panels_home_page_enabled', $panels_support['home-page-default'])) ? 'state-off' : 'state-on'; ?>">
				<div class="on-text"><?php _e('ON', 'origami') ?></div>
				<div class="off-text"><?php _e('OFF', 'origami') ?></div>
				<img src="<?php echo get_template_directory_uri() ?>/extras/panels/css/images/handle.png" class="handle" />
			</div>
		</h2>
		
		<?php if(isset($_POST['_sopanels_home_nonce']) && wp_verify_nonce($_POST['_sopanels_home_nonce'], 'save')) : ?>
			<div id="message" class="updated">
				<p><?php printf(__('Home page updated. <a href="%s">View page</a>', 'origami'), get_home_url()) ?></p>
			</div>
		<?php endif; ?>
		
		<div id="post-body-wrapper">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content" style="position: relative">
					<a href="#" class="preview button" id="post-preview"><?php _e('Preview Changes', 'origami') ?></a>
					
					<?php wp_editor('', 'content') ?>
					<?php do_meta_boxes('appearance_page_so_panels_home_page', 'advanced', false) ?>
					
					<p><input type="submit" class="button button-primary" value="<?php esc_attr_e('Save Home Page', 'origami') ?>" /></p>
				</div>
			</div>
		</div>
		
		<input type="hidden" id="panels-home-enabled" name="panels_home_enabled" value="<?php echo esc_attr( get_theme_mod('panels_home_page_enabled', $panels_support['home-page-default']) ? 'true' : 'false' ); ?>" />
		<?php wp_nonce_field('save', '_sopanels_home_nonce') ?>
	</form>
	<noscript><p><?php _e('This interface requires Javascript', 'origami') ?></p></noscript>
</div> 