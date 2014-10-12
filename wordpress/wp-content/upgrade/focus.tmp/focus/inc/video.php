<?php

/**
 * Add the video metabox.
 */
function focus_add_metabox(){
	if(function_exists('siteorigin_focus_video_save')) return;
	add_meta_box('focus-video', __('Video', 'focus'), 'focus_video_metabox_render', 'post');
}
add_action('add_meta_boxes', 'focus_add_metabox');

/**
 * Render the video metabox.
 */
function focus_video_metabox_render(){
	$install_url = siteorigin_plugin_activation_install_url(
		'focus-videos',
		__('Focus Videos', 'focus'),
		'http://gpriday.s3.amazonaws.com/plugins/focus-videos.zip'
	)
	?>
	<p><?php printf(__('Please <a href="%s">install</a> the focus video plugin to edit this video setting.', 'focus'), $install_url) ?></p>
	<?php
}

/**
 * Return true if the post has the given video type
 *
 * @param null $id
 * @param null|string $type
 * @return bool
 */
function focus_post_has_video($id = null, $type = 'public'){
	if(empty($id)) $id = get_the_ID();
	if(empty($type)) $type = 'public';

	$video = get_post_meta(get_the_ID(), 'focus_video', true);
	if(empty($video[$type])) return;

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

		case 'custom' :
			if(!empty($video[$type]['custom'])) {
				echo apply_filters('focus_video_embed_code', $video[$type]['custom']);
			}
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