<?php
function skebggallery_backend_menu(){
$skebg_options = get_option('skebggallery_options'); 
$options = skebg_checkgetOptions($skebg_options);                                                            
?>
<div id="skebg_wrapper">
	<div class="skebg_head"><div class="skebg_title"></div> </div>
	<div class="skebg_cont">
		<div class="skebg_leftbox">
			<div class="skebg_topbox skebg_mn">
				<a class="skebg_expCol" title="Expand/Collapse" href="Javascript:void(0);"></a>
				<div class="skebg_clear"></div>
			</div>
		
			<div id="skebg_settsaved"></div>
			<img id="skebg_ajaxloader" src="<?php echo SKETCHBGSURL; ?>ajax-loader.gif" />
			<form method="post" action="/" class="skebggallery_form" id="skebg_saveform">
				<div class="skebg_block">
					<div class="skebg_settings">
						<div class="skebg_distxt"><?php _e('DISPLAY SETTINGS','bizstudio'); ?></div>
						<div class="skebg_savebox"><input name="skebg_saves" type="submit" value="Save" /><a class="skebg_plus_minus" href="Javascript:void(0);"></a><div class="skebg_clear"></div></div><div class="skebg_clear"></div>
					</div>
					<div class="skebg_extendbox">
						<div class="skebg_topbdr"></div>
						<div class="skebg_midbdr">
							<table border="0">
								<tr><th colspan="2"><?php _e('Where to show default Sketch BG-Gallery:','bizstudio') ?></th></tr>
								<tr><th><?php _e("All Page:",'bizstudio'); ?></th>								<th><label class="skebg_setchk <?php if($options['skebg_frontPg']){ ?> checked<?php } ?>" for="skebg_frontPg"></label><input type="checkbox" class="skebg_onoff_chkbox" id="skebg_frontPg" value="1" name="skebggallery_options[skebg_frontPg]" <?php checked('1', $options['skebg_frontPg']); ?> />
								<a class="skebg_tooltip" title="<?php _e("Enable/Disable Sketch Gallery for the Front page.",'bizstudio'); ?>"></a></th></tr>							</table>							<table class="pro">									<tr><td>									<tr><th colspan="2" class="bizstudio_notify"></th></tr>									<tr><th><?php _e("Blog Page:",'bizstudio'); ?></th><td><label class="skebg_setchk" for="skebg_blogPg"></label><input type="checkbox" class="skebg_onoff_chkbox" id="skebg_blogPg" value="" name=""/>										<a class="skebg_tooltip" title="<?php _e("Enable/Disable Sketch Gallery for the Blog page.",'bizstudio'); ?>"></a></td></tr>									<tr><th><?php _e("Categories:",'bizstudio'); ?></th><td><label class="skebg_setchk  checked" for="skebg_cats"></label><input type="checkbox" class="skebg_onoff_chkbox" id="skebg_cats" value="" name=""  />										<a class="skebg_tooltip" title="<?php _e("Enable/Disable Sketch Gallery for the Category Pages.",'bizstudio'); ?>"></a></td></tr>									<tr><th><?php _e("Custom Taxonomies:",'bizstudio'); ?></th><td><label class="skebg_setchk  checked" for="skebg_ctaxs"></label><input type="checkbox" class="skebg_onoff_chkbox" id="skebg_ctaxs" value="" name="" />										<a class="skebg_tooltip" title="<?php _e("Enable/Disable Sketch Gallery for the Custom Taxonomy Pages.",'bizstudio'); ?>"></a></td></tr>									<tr><th><?php _e("Tags:",'bizstudio'); ?></th><td><label class="skebg_setchk checked" for="skebg_tags"></label><input type="checkbox" class="skebg_onoff_chkbox" id="skebg_tags" value="" name=""  />										<a class="skebg_tooltip" title="<?php _e("Enable/Disable Sketch Gallery for the Tag Pages.",'bizstudio'); ?>"></a></td></tr>									<tr><th><?php _e("Date Archive:",'bizstudio'); ?></th><td><label class="skebg_setchk  checked" for="skebg_archives"></label><input type="checkbox" class="skebg_onoff_chkbox" id="skebg_archives" value="" name="" />										<a class="skebg_tooltip" title="<?php _e("Enable/Disable Sketch Gallery for the Archive Pages.",'bizstudio'); ?>"></a></td></tr>									<tr><th><?php _e("Author Page:",'bizstudio'); ?></th><td><label class="skebg_setchk checked" for="skebg_authors"></label><input type="checkbox" class="skebg_onoff_chkbox" id="skebg_authors" value="" name=""  />										<a class="skebg_tooltip" title="<?php _e("Enable/Disable Sketch Gallery for the Author Pages.",'bizstudio'); ?>"></a></td></tr>									</td></tr>							</table>
							<div class="skebg_clear"></div>
						</div>
						<div class="skebg_btmbdr"></div>
					</div>
				</div>
			
				<div class="skebg_block">
					<div class="skebg_settings">
						<div class="skebg_distxt"><?php _e('APPEARANCE SETTINGS','bizstudio'); ?></div>
						<div class="skebg_savebox"><input name="skebg_saves" type="submit" value="Save" /><a class="skebg_plus_minus" href="Javascript:void(0);"></a><div class="skebg_clear"></div></div><div class="skebg_clear"></div>
					</div>
					<div class="skebg_extendbox">
						<div class="skebg_topbdr"></div>
						<div class="skebg_midbdr">
							<table border="0">
								<tr><th><label><?php _e('Slide Duration:','bizstudio'); ?></label> </th><td><input type="text" name="skebggallery_options[skebg_time]" value="<?php echo $options['skebg_time'] ?>" /> <small>(<b><?php _e('in Seconds','bizstudio'); ?></b>)</small>
									<a class="skebg_tooltip" title="<?php _e("How many seconds an image must stay.",'bizstudio'); ?>"></a></td></tr>
								<tr><th><label><?php _e('Transition Speed:','bizstudio'); ?></label> </th><td><input type="text" name="skebggallery_options[skebg_transition]" value="<?php echo $options['skebg_transition'] ?>" /> <small>(<b><?php _e('in Seconds','bizstudio'); ?></b>)</small>
									<a class="skebg_tooltip" title="<?php _e("How many seconds for the transition from one image to another.",'bizstudio'); ?>"></a></td></tr>
								<tr><th><?php _e("Show Navigation:",'bizstudio'); ?></th><td><label class="skebg_setchk <?php if($options['skebg_nav']){ ?> checked <?php } ?>" for="skebg_nav"></label><input value="1" type="checkbox" class="skebg_onoff_chkbox" id="skebg_nav" name="skebggallery_options[skebg_nav]" <?php checked('1', $options['skebg_nav']); ?> />
									<a class="skebg_tooltip" title="<?php _e("Enable/Disable Navigation for the slideshow.",'bizstudio'); ?>"></a></td></tr>
								<tr><th><?php _e("Show Play/Pause Key:",'bizstudio'); ?></th><td><label class="skebg_setchk <?php if($options['skebg_playpause']){ ?> checked <?php } ?>" for="skebg_playpause"></label><input value="1" type="checkbox" class="skebg_onoff_chkbox" id="skebg_playpause" name="skebggallery_options[skebg_playpause]" <?php checked('1', $options['skebg_playpause']); ?> />
									<a class="skebg_tooltip" title="<?php _e("Enable/Disable Play/Pause button.",'bizstudio'); ?>"></a></td></tr>
								<tr><th><?php _e("Show Thumbnails:",'bizstudio'); ?></th><td><label class="skebg_setchk <?php if($options['skebg_thumbs']){ ?> checked <?php } ?>" for="skebg_thumbs"></label><input value="1" type="checkbox" class="skebg_onoff_chkbox" id="skebg_thumbs" name="skebggallery_options[skebg_thumbs]" <?php checked('1', $options['skebg_thumbs']); ?> />
									<a class="skebg_tooltip" title="<?php _e("Enable/Disable Thumbnails.",'bizstudio'); ?>"></a></td></tr> 
								<tr><th><?php _e("Thumbnails Display:",'bizstudio'); ?></th>
								<td><div>
									<label class="skebg_td skebg_thumbs_square <?php if($options['skebg_thumbs_display'] == "square"){ ?> checked <?php } ?>" for="skebg_thumbs_square"><input type="radio" id="skebg_thumbs_square" value="square" name="skebggallery_options[skebg_thumbs_display]" <?php checked('square', $options['skebg_thumbs_display']); ?> /></label>
									<label class="skebg_td skebg_thumbs_circle <?php if($options['skebg_thumbs_display'] == "circle" ){ ?> checked <?php } ?>" for="skebg_thumbs_circle"><input type="radio" id="skebg_thumbs_circle" value="circle" name="skebggallery_options[skebg_thumbs_display]" <?php checked('circle', $options['skebg_thumbs_display']); ?> /></label>	
									<div class="skebg_clear"></div>
									</div></td></tr> 
									
								<tr><th><?php _e("Random Images:",'bizstudio'); ?></th><td><label class="skebg_setchk <?php if($options['skebg_random']){ ?> checked <?php } ?>" for="skebg_random"></label><input value="1" type="checkbox" class="skebg_onoff_chkbox" id="skebg_random" name="skebggallery_options[skebg_random]" <?php checked('1', $options['skebg_random']); ?> />
									<a class="skebg_tooltip" title="<?php _e("Set to 'ON' if you want to show the images in a Random Order.",'bizstudio'); ?>"></a></td></tr>
							</table>
							<div class="skebg_clear"></div>
						</div>
						<div class="skebg_btmbdr"></div>
					</div>
				</div>
				
				<div class="skebg_block">
					<div class="skebg_settings">
						<div class="skebg_distxt"><?php _e('OVERLAY SETTINGS','bizstudio'); ?></div>
						<div class="skebg_savebox"><input name="skebg_saves" type="submit" value="Save" /><a class="skebg_plus_minus" href="Javascript:void(0);"></a><div class="skebg_clear"></div></div><div class="skebg_clear"></div>
					</div>
					<div class="skebg_extendbox">
						<div class="skebg_topbdr"></div>
						<div class="skebg_midbdr">
							<table border="0">
								<tr><th><?php _e('Display Overlay:','bizstudio'); ?></th><td>&nbsp;<label class="skebg_mkchk <?php if($options['skebg_overlay']){ ?>checked<?php } ?>" for="alloverlay"></label><input id="alloverlay" class="skebg_chkbox skebg_wrap_chkbox" type="checkbox" name="skebggallery_options[skebg_overlay]" value="1" <?php checked('1', $options['skebg_overlay']); ?> />&nbsp;<span class="skebg_fBitter"><?php _e('Check it, if you want "<i>Overlay Effect</i>".','bizstudio') ?></span>
									<a class="skebg_tooltip" title="<?php _e("Check if you want to use the overlay effect and select one of the following overlay effects.",'bizstudio'); ?>"></a></td></tr>		
								<tr><th><label><?php _e('Set Overlay Effect:','bizstudio'); ?></label></th>
								<td>
									<label class="skebg_rdlb <?php if($options['skebg_oveffect'] == "overlay/01.png"){ echo "active";} ?>" for="skebg1" style="background:#e7e7e7 url('<?php echo SKETCHBGSURL ?>overlay/01.png');"><input type="radio" name="skebggallery_options[skebg_oveffect]" <?php if($options['skebg_oveffect'] == "overlay/01.png"){ echo "checked";} ?> value="overlay/01.png" id="skebg1" ></label>
									<div class="skebg_clear"></div>
								</td>
							</table>	
							<div class="skebg_clear"></div>							<div class="pro skebg_fBitter" ><?php _e('More Overlay Effect In Pro Version.','bizstudio'); ?></div>							
						</div>
						<div class="skebg_btmbdr"></div>
					</div>
				</div>
				
				<div class="skebg_block">
					<div class="skebg_settings">
						<div class="skebg_distxt"><?php _e('BACKGROUND COLOR SETTINGS','bizstudio'); ?></div>
						<div class="skebg_savebox"><input name="skebg_saves" type="submit" value="Save" /><a class="skebg_plus_minus" href="Javascript:void(0);"></a><div class="skebg_clear"></div></div><div class="skebg_clear"></div>
					</div>
					<div class="skebg_extendbox">
						<div class="skebg_topbdr"></div>
						<div class="skebg_midbdr">
							<table border="0">
								<tr><th><?php _e('Enable BG-Color:','bizstudio'); ?></th><td><div><label class="skebg_mkchk <?php if($options['skebg_bgchkbox']){ ?> checked <?php } ?>" for="skebg_bgchkbox"></label><input type="checkbox" class="skebg_chkbox skebg_wrap_chkbox" id="skebg_bgchkbox" value="1"  <?php checked('1', $options['skebg_bgchkbox']); ?> name="skebggallery_options[skebg_bgchkbox]" />&nbsp;<span class="skebg_fBitter" style="margin-left: 4px;"><?php _e('Check it, if you want to use <i>"Background Color instead of gallery images"</i>.','bizstudio'); ?></span></div></td></tr>
								<tr><th><?php _e("Background Color:",'bizstudio'); ?></th><td><div class="skebg_colwrap"><input style="background-image: none;" type="text" id="skebg_bgcolor" class="skebg_color_inp" value="<?php if($options['skebg_bgcolor']) echo $options['skebg_bgcolor']; else echo "#111"; ?>" name="skebggallery_options[skebg_bgcolor]" /><div class="skebg_colsel skebg_bgcolor"></div></div>
									<a class="skebg_tooltip" title="<?php _e("Check if you want to use background color instead of images and select what color you want to use.",'bizstudio'); ?>"></a></td></tr>
							</table>	
							<div class="skebg_clear"></div>
						</div>
						<div class="skebg_btmbdr"></div>
					</div>
				</div>
				
				<div class="skebg_block">
					<div class="skebg_settings">
						<div class="skebg_distxt"><?php _e('BACKGROUNDS SETTINGS','bizstudio'); ?></div>
						<div class="skebg_savebox"><input type="submit" name="skebg_saves" value="Save" /><a class="skebg_plus_minus" href="Javascript:void(0);"></a><div class="skebg_clear"></div></div><div class="skebg_clear"></div>
					</div>
					<div class="skebg_extendbox">
						<div class="skebg_topbdr"></div>
						<div class="skebg_midbdr">
							<table border="0">
								<tr><th><label><?php _e('BG-Image 1 URL/Path:','bizstudio'); ?></label></th><td><input class="skebg_uploadimg"  type="text" name="skebggallery_options[skebg_slide1]" value="<?php echo $options['skebg_slide1'] ?>" /> <input class="skebg_uploadbtn" type="button" /></td></tr>
								<tr><th><label><?php _e('BG-Image 2 URL/Path:','bizstudio'); ?></label></th><td><input class="skebg_uploadimg" type="text" name="skebggallery_options[skebg_slide2]" value="<?php echo $options['skebg_slide2'] ?>" /> <input class="skebg_uploadbtn" type="button" /></td></tr>
							</table>
							<div class="skebg_clear"></div>
						</div>
						<div class="skebg_btmbdr"></div>						
					</div>
				</div>
				<input type="hidden" name="action" value="skebg_saved" />
				<input type="hidden" name="security" value="<?php echo wp_create_nonce('skebggallery-options-data'); ?>" />
				<p class="button-controls">
					<input type="submit" value=""  name="skebg_saves">	
				</p>
			</form>
		</div>
		<div class="skebg_clear"></div>
	</div>
	<div class="skebg_overlay"></div>
</div>
<?php
}
//--------------------------------------------------------------------------------------------------------------------------------------
?>