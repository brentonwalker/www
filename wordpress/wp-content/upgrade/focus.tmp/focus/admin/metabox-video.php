<?php focus_video_field('public', __('Public', 'focus')) ?>

<?php
	siteorigin_premium_call_function(
		'focus_video_field',
		array('premium', __('Premium', 'focus')),
		array(
			'before' => '<h4>'.__('Premium Video', 'focus').'</h4>',
			'description' => __('Allows you to set a premium version of a video, and only show that video to paying members of your site using membership plugins like S2Member', 'focus')
		)
		
	)
?>

<?php do_action('focus_admin_after_video_metabox') ?>

<?php wp_nonce_field('save', '_focusnonce') ?>