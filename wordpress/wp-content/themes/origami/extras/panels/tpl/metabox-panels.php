<?php

$panel_widgets = array();
global $wp_widget_factory;

$i = 0;
foreach($wp_widget_factory->widgets as $class => $info){

	$widget = new $class();
	$widget->id = 'temp';
	$widget->number = $i++;

	ob_start();
	$widget->form(array());
	$form = ob_get_clean();

	// Convert the widget field naming into ones that panels uses
	$exp = preg_quote($widget->get_field_name('____'));
	$exp = str_replace('____', '(.*?)', $exp);
	$form = preg_replace('/'.$exp.'/', 'widgets[{$id}][$1]', $form);

	// Add all the extra fields
	$form .= '<input type="hidden" data-info-field="order" name="panel_order[]" value="{$id}" />';
	$form .= '<input type="hidden" data-info-field="class" name="widgets[{$id}][info][class]" value="'.$class.'" />';
	$form .= '<input type="hidden" data-info-field="id" name="widgets[{$id}][info][id]" value="{$id}" />';
	$form .= '<input type="hidden" data-info-field="grid" name="widgets[{$id}][info][grid]" value="" />';
	$form .= '<input type="hidden" data-info-field="cell" name="widgets[{$id}][info][cell]" value="" />';

	$widget->form = $form;

	$panel_widgets[] = $widget;
}

$layouts = apply_filters('siteorigin_panels_prebuilt_layouts', array());

?>

<div id="panels">
	<div id="message" class="updated below-h2">
		<p>
			<?php
			$install_url = siteorigin_plugin_activation_install_url(
				'siteorigin-panels',
				__('Page Builder', 'origami')
			);
			printf(__('Please <a href="%s">update</a> to the latest version of Page Builder.', 'origami'), $install_url);
			?>
		</p>
	</div>

	<div id="panels-container">
	</div>

	<div id="add-to-panels">
		<button class="panels-add tooltip" data-tooltip="<?php esc_attr_e('Add Widget','origami') ?>"><?php _e('Add Widget', 'origami') ?></button>
		<button class="grid-add tooltip" data-tooltip="<?php esc_attr_e('Add Columns','origami') ?>"><?php _e('Add Columns', 'origami') ?></button>
		<?php if(!empty($layouts)) : ?>
			<button class="prebuilt-set tooltip" data-tooltip="<?php esc_attr_e('Prebuilt Layouts','origami') ?>"><?php _e('Prebuilt Layouts', 'origami') ?></button>
		<?php endif; ?>
		<div class="clear"></div>
	</div>

	<!-- The dialogs -->

	<div id="panels-dialog" data-title="<?php esc_attr_e('Add New Widget','origami') ?>" class="panels-admin-dialog">
		<div id="panels-dialog-inner">
			<div class="panels-text-filter">
				<input type="search" class="widefat" placeholder="Filter" id="panels-text-filter-input" />
			</div>

			<ul class="panel-type-list">
				<?php $i = 0; foreach($panel_widgets as $widget) : $i++; ?>
					<li class="panel-type"
						data-class="<?php echo esc_attr(get_class($widget)) ?>"
						data-form="<?php echo esc_attr($widget->form) ?>"
						data-title="<?php echo esc_attr($widget->name) ?>"
						>
						<div class="panel-type-wrapper">
							<h3><?php echo esc_html($widget->name) ?></h3>
							<?php if(!empty($widget->widget_options['description'])) : ?>
								<small class="description"><?php echo esc_html($widget->widget_options['description']) ?></small>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>

				<div class="clear"></div>
			</ul>

			<?php do_action('siteorigin_panels_after_widgets'); ?>

			<div id="siteorigin-widgets-link-wrapper">
				<?php $siteorigin_url = 'http://siteorigin.com/product-tag/widget/'; ?>
				<a href="<?php echo esc_url($siteorigin_url) ?>" data-original="<?php echo esc_url($siteorigin_url) ?>" data-search="<?php echo add_query_arg('search', '{search}', $siteorigin_url) ?>" id="siteorigin-widgets-link" target="_blank">
					<?php _e('Find More Page Builder Widgets', 'origami') ?>
				</a>
			</div>
		</div>

	</div>

	<div id="grid-add-dialog" data-title="<?php esc_attr_e('Add Columns','origami') ?>" class="panels-admin-dialog">
		<p><label><strong><?php _e('Columns', 'origami') ?></strong></label></p>
		<p><input type="text" id="grid-add-dialog-input" name="column_count" class="small-text" value="3" /></p>
	</div>

	<?php if(!empty($layouts)) : ?>
		<div id="grid-prebuilt-dialog" data-title="<?php esc_attr_e('Insert Prebuilt Page Layout','origami') ?>" class="panels-admin-dialog">
			<p><label><strong><?php _e('Page Layout', 'origami') ?></strong></label></p>
			<p>
				<select type="text" id="grid-prebuilt-input" name="prebuilt_layout" style="width:580px;" placeholder="<?php esc_attr_e('Select Layout', 'origami') ?>" >
					<option class="empty" <?php selected(true) ?> value=""></option>
					<?php foreach($layouts as $id => $data) : ?>
						<option id="panel-prebuilt-<?php echo esc_attr($id) ?>" data-layout-id="<?php echo esc_attr($id) ?>" class="prebuilt-layout">
							<?php echo isset($data['name']) ? $data['name'] : __('Untitled Layout', 'origami') ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
	<?php endif; ?>

	<?php wp_nonce_field('save', '_sopanels_nonce') ?>

	<?php if(defined('WP_DEBUG') && WP_DEBUG && !empty($GLOBALS['post'])) : ?>
		<!--
		// <?php echo esc_html($GLOBALS['post']->post_title) ?> Panels Data Array
		<?php var_export( get_post_meta($GLOBALS['post']->ID, 'panels_data', true)) ?>
		-->
	<?php endif; ?>
</div>