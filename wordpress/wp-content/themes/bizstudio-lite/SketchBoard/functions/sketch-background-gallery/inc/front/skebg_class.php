<?php
Class skebg_front
{
	function skebg_callJSfunc($skebgg_time,$skebgg_transition,$skebgg_nav,$skebgg_playpause,$skebgg_thumbs,$skebgg_thumbs_display)
	{
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery.skebggallery('#skebggallery',{
					'delay':<?php echo $skebgg_time; ?>, 
					'fadeSpeed': <?php echo $skebgg_transition; ?>,
					'navigation':<?php echo $skebgg_nav; ?>,
					'playPause':<?php echo $skebgg_playpause; ?>,
					'thumbnails':<?php echo $skebgg_thumbs; ?>,
					'thumb_style':'<?php echo $skebgg_thumbs_display; ?>'
				});
			});
		</script>
		<?php
	}
	
	function skebg_global_sldr($skebgg_time,$skebgg_transition,$skebgg_nav,$skebgg_playpause,$skebgg_thumbs,$skebgg_thumbs_display,$skebgg_BgChkbox,$skebgg_Bgcolor,$skebgg_overlay,$skebgg_oveffect,$skebgg_slidesArr)
	{
		if(!$skebgg_BgChkbox){
			$this->skebg_callJSfunc($skebgg_time,$skebgg_transition,$skebgg_nav,$skebgg_playpause,$skebgg_thumbs,$skebgg_thumbs_display);
		}
		?><div id="skebggallery" class="skebg_global"><?php
			if($skebgg_BgChkbox){ ?><div class="skebg_bgcolor" style="background:<?php echo $skebgg_Bgcolor; ?>;"></div><?php }
			else{
				if(!empty($skebgg_slidesArr)){
					foreach($skebgg_slidesArr as $skebg_slide){
						?><img class="skebg_bg" src="<?php echo $skebg_slide; ?>" /><?php
					}
				}
			}
			if($skebgg_overlay){ ?><div class="skebg_overlay" style="background:url('<?php echo SKETCHBGSURL.$skebgg_oveffect; ?>')"></div><?php }
			?>
		  </div>
		<?php
	}
	
	function skebg_single_sldr($skebgg_time,$skebgg_transition,$skebgg_nav,$skebgg_playpause,$skebgg_thumbs,$skebgg_thumbs_display,$skebgg_BgChkbox,$skebgg_Bgcolor,$skebgg_overlay,$skebgg_oveffect,$skebgg_slidesArr)
	{
		if(!$skebgg_BgChkbox){
			$this->skebg_callJSfunc($skebgg_time,$skebgg_transition,$skebgg_nav,$skebgg_playpause,$skebgg_thumbs,$skebgg_thumbs_display);
		}
		?><div id="skebggallery" class="skebg_single"><?php
			if($skebgg_BgChkbox){ ?><div class="skebg_bgcolor" style="background:<?php echo $skebgg_Bgcolor; ?>;"></div><?php }
			else{
				if(!empty($skebgg_slidesArr)){
					foreach($skebgg_slidesArr as $skebg_slide){
						?><img class="skebg_bg" src="<?php echo $skebg_slide; ?>" /><?php
					}
				}
			}
			if($skebgg_overlay){ ?><div class="skebg_overlay" style="background:url('<?php echo SKETCHBGSURL.$skebgg_oveffect; ?>')"></div><?php }
			?>
		  </div>
		<?php
	}
	
	function skebg_gallery_display()
	{
		include('skebg_global_s.php');
		
		if((is_page() && $skebgg_frontPg) || (is_front_page() && $skebgg_frontPg) || (is_home() && $skebgg_frontPg) || (is_category() && $skebgg_frontPg) || (is_tax() && $skebgg_frontPg) || (is_tag() && $skebgg_frontPg) || (is_date() && $skebgg_frontPg) || (is_author() && $skebgg_frontPg) || (is_single() && $skebgg_frontPg) || (is_search() && $skebgg_frontPg) || (is_404() && $skebgg_frontPg))
		{
			$this->skebg_global_sldr($skebgg_time,$skebgg_transition,$skebgg_nav,$skebgg_playpause,$skebgg_thumbs,$skebgg_thumbs_display,$skebgg_BgChkbox,$skebgg_Bgcolor,$skebgg_overlay,$skebgg_oveffect,$skebgg_slidesArr);
		}
	}
}
?>