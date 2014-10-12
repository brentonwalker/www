<?php

/**
 * Enqueue the video scripts.
 * 
 * @param $prefix
 */
function focus_admin_scripts($prefix){
	$screen = get_current_screen();
	
	if($prefix == 'post.php' || $prefix == 'post-new.php' && $screen->id == 'post'){
		wp_enqueue_script('focus-admin-video', get_template_directory_uri() . '/js/focus.admin.video.min.js', array('jquery'), SITEORIGIN_THEME_VERSION);
		wp_localize_script('focus-admin-video', 'focusVideoSettings', array(
			'button' => __('Set Video', 'focus')
		));
	}
}
add_action('admin_enqueue_scripts', 'focus_admin_scripts');

/**
 * Set which post types we'll display the premium teaser on.
 */
function focus_admin_init(){
	siteorigin_premium_teaser_post_types('post');
}
add_action('admin_init', 'focus_admin_init');

/**
 * Add the video metabox.
 */
function focus_add_metabox(){
	add_meta_box('focus-video', __('Video', 'focus'), 'focus_video_metabox_render', 'post');
}
add_action('add_meta_boxes', 'focus_add_metabox');

/**
 * Render the video metabox.
 */
function focus_video_metabox_render(){
	locate_template(array('admin/metabox-video.php'), true);
}

/**
 * Render a single video field.
 * 
 * @param $type
 * @param $title
 */
function focus_video_field($type, $title){
	global $post;
	$video = get_post_meta($post->ID, 'focus_video', true);
	$video = !empty($video[$type]) ? $video[$type] : array();
	$video = wp_parse_args($video, array(
		'type' => '',
		'external' => '',
		'self' => '',
		'remote' => '',
		'custom' => '',
	));
	$self = !empty($video['self']) ? get_post($video['self']) : null;
	
	?>
	<h4><?php printf(__('%s Video', 'focus'), $title) ?></h4>
	<table class="form-table focus-video-table">
		<tbody>
		<tr>
			<th scope="row" valign="top"><?php _e('Video Type', 'focus') ?></th>
			<td>
				<select name="focus_video[<?php echo esc_attr($type) ?>][type]" class="focus-video-type-select">
					<option value="external" <?php selected('external', $video['type']) ?>><?php esc_html_e('External (YouTube, Vimeo, etc)', 'focus') ?></option>
					<option value="self" <?php selected('self', $video['type']) ?>><?php esc_html_e('Self Hosted', 'focus') ?></option>
					<option value="remote" <?php selected('remote', $video['type']) ?>><?php esc_html_e('Remote Video File', 'focus') ?></option>
					<option value="custom" <?php selected('custom', $video['type']) ?>><?php esc_html_e('Custom Embed Code', 'focus') ?></option>
				</select>
			</td>
		</tr>
		
		<tr class="field-<?php echo esc_attr($type) ?>-external field-external field">
			<th scope="row" valign="top"><?php _e('External Video URL', 'focus') ?></th>
			<td><input type="text" name="focus_video[<?php echo esc_attr($type) ?>][external]" class="regular-text" value="<?php echo esc_attr($video['external']) ?>" /></td>
		</tr>
		<tr class="field-<?php echo esc_attr($type) ?>-self  field-self field">
			<th scope="row" valign="top"><?php _e('Self Hosted Video', 'focus') ?></th>
			<td class="wp-media-buttons">
				<strong style="margin-right: 10px" class="video-name"><?php if(!empty($self)) echo $self->post_title ?></strong>

				<a href="#" class="button add_media focus-add-video" data-video-type="<?php echo esc_attr($type) ?>" title="Add Media" data-choose="<?php esc_attr_e('Select Video File', 'focus') ?>" data-update="<?php esc_attr_e('Set Video', 'focus') ?>">
					<span class="wp-media-buttons-icon"></span> <?php printf(__('Add %s Video', 'focus'), $title) ?>
				</a>
				<a href="#" class="focus-remove-video"><?php printf(__('Remove %s Video', 'focus'), $title) ?></a>

				<input type="hidden" name="focus_video[<?php echo esc_attr($type) ?>][self]" class="regular-text field-video-self" value="<?php if(!empty($self)) echo $self->ID ?>" />
			</td>
		</tr>
		<tr class="field-<?php echo esc_attr($type) ?>-remote field-remote field">
			<th scope="row" valign="top"><?php _e('MP4 File URL', 'focus') ?></th>
			<td><input type="text" name="focus_video[<?php echo esc_attr($type) ?>][remote]" class="regular-text" value="<?php echo esc_attr($video['remote']) ?>" /></td>
		</tr>
		<tr class="field-<?php echo esc_attr($type) ?>-custom field-custom field">
			<th scope="row" valign="top"><?php _e('Custom Embed Code', 'focus') ?></th>
			<td>
				<textarea name="focus_video[<?php echo esc_attr($type) ?>][custom]" class="widefat"><?php echo esc_textarea($video['custom']) ?></textarea>
			</td>
		</tr>
		</tbody>
	</table>
	<?php
}

/**
 * Save the post videos.
 * 
 * @param $post_id
 */
function focus_video_save($post_id){
	if(empty($_POST['_focusnonce']) || !wp_verify_nonce($_POST['_focusnonce'], 'save')) return;
	if(!current_user_can('edit_post', $post_id)) return;
	if(defined('DOING_AUTOSAVE')) return;
	
	$video = array_map('stripslashes_deep', $_POST['focus_video']);
	update_post_meta($post_id, 'focus_video', $video);
}
add_action('save_post', 'focus_video_save');

/**
 * Return true if the post has the given video type
 * 
 * @param null $id
 * @param null $type
 * @return bool
 */
function focus_post_has_video($id = null, $type = 'public'){
	if(empty($id)) $id = get_the_ID();
	if(empty($type)) $type = 'public';

	$video = get_post_meta(get_the_ID(), 'focus_video', true);

	// Gives child themes a chance to change the video type being displayed
	$type = apply_filters('focus_video_type', $type, $video, $id);

	if(empty($video[$type]['type'])) return false;
	if(empty($video[$type][$video[$type]['type']])) return false;
	return true;
}

/**
 * 
 * 
 * @param null $id
 * @param null $type
 */
function focus_post_video($id = null, $type = null){
	if(empty($id)) $id = get_the_ID();
	if(empty($type)) $type = 'public';
	
	$video = get_post_meta(get_the_ID(), 'focus_video', true);
	
	// Gives child themes a chance to change the video type being displayed
	$type = apply_filters('focus_video_type', $type, $video, $id);
	
	if(empty($video[$type]['type'])) return;
	if(empty($video[$type][$video[$type]['type']])) return;
	
	switch($video[$type]['type']){
		case 'self' :
		case 'remote' :
			$file = $video[$type]['type'] == 'self' ? wp_get_attachment_url($video[$type]['self']) : esc_url($video[$type]['remote']);
			?>

			<div class="jp-video">
				<div class="jp-type-single" id="jp_interface_1">
					<div id="jquery_jplayer_1" class="jp-jplayer" data-video="<?php echo esc_attr($file) ?>" <?php do_action('focus_video_selfhosted_attrs') ?>></div>

					<?php do_action('focus_video_play_button') ?>
					<div class="jp-gui">
						<ul class="jp-controls">
							<li><a href="#" class="jp-play" tabindex="1"><?php esc_html_e('play', 'focus') ?></a></li>
							<li><a href="#" class="jp-pause" tabindex="1"><?php esc_html_e('pause', 'focus') ?></a></li>
							<li><a href="#" class="jp-stop" tabindex="1"><?php esc_html_e('stop', 'focus') ?></a></li>
							
							<li><a href="#" class="jp-full-screen" tabindex="1"><?php esc_html_e('full screen', 'focus') ?></a></li>
							<li><a href="#" class="jp-restore-screen" tabindex="1"><?php esc_html_e('restore screen', 'focus') ?></a></li>
							
							<li><a href="#" class="jp-mute" tabindex="1"><?php esc_html_e('mute', 'focus') ?></a></li>
							<li><a href="#" class="jp-unmute" tabindex="1"><?php esc_html_e('unmute', 'focus') ?></a></li>
						</ul>
						
						<div class="sep jp-controls-sep"></div>
						
						<div class="jp-progress">
							<div class="jp-seek-bar">
								<div class="jp-play-bar"><div class="jp-play-bar-marker"></div></div>
							</div>
						</div>
						
						<div class="jp-time-info">
							<div class="jp-current-time"></div> /
							<div class="jp-duration"></div>
						</div>

						<div class="sep jp-time-sep"></div>
						
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>

						<div class="sep jp-full-sep"></div>
					</div>
				</div>
			</div>


			<?php
			break;
		
		case 'external' :
			$embed = new WP_Embed();
			$code = $embed->shortcode(array('autoplay' => 1, 'width' => 960), $video[$type]['external']);
			$code = apply_filters('focus_video_embed_code', $code);
			echo $code;
			
			break;
	}
}

/**
 * Enqueue scripts for the video player.
 */
function focus_video_enqueue_scripts(){
	if(is_single()){
		
		global $post;
		if(has_post_thumbnail($post->ID)){
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider' );
		}
		
		wp_enqueue_script('jplayer', get_template_directory_uri() . '/jplayer/jquery.jplayer.min.js', array('jquery'), '2.1.0');
		wp_localize_script('jplayer', 'jplayerSettings', array(
			'swfPath' => get_template_directory_uri().'/jplayer/',
			'videoPoster' => !empty($thumb) ? $thumb[0] : '',
		));
		wp_enqueue_style('focus-siteorigin-jplayer-skin', get_template_directory_uri().'/jplayer/skins/siteorigin/jplayer.siteorigin.css');
	}
}
add_action('wp_enqueue_scripts', 'focus_video_enqueue_scripts');

if(!function_exists('focus_video_action_play_button')):
/**
 * Display the video play button. 
 */
function focus_video_action_play_button(){
	?>
	<div class="jp-play jp-play-default">
		<img src="<?php echo get_template_directory_uri() ?>/images/play.png" width="97" height="97" />
	</div>
	<?php
}
endif;
add_action('focus_video_play_button', 'focus_video_action_play_button');