<?php
global $post;
$skebg_custom = get_post_custom($post->ID);
$custom = skebg_checkMataValues($skebg_custom);

$skebgg_disable_s = $custom["skebg_disable"][0];
$skebgg_check_s = $custom["skebg_check"][0];
$skebgg_time_s = $custom["skebg_time"][0]*1000;
$skebgg_transition_s = $custom["skebg_transition"][0]*1000;

$skebgg_nav_s = $custom["skebg_nav"][0];
$skebgg_playpause_s = $custom["skebg_playpause"][0];
$skebgg_thumbs_s = $custom["skebg_thumbs"][0];
$skebgg_thumbs_display_s = $custom["skebg_thumbs_display"][0];	
$skebgg_random_s = $custom["skebg_random"][0];

$skebgg_overlay_s = $custom["skebg_overlay"][0];
$skebgg_oveffect_s = $custom["skebg_oveffect"][0];
$skebgg_BgChkbox_s = $custom["skebg_bgchkbox"][0];
$skebgg_Bgcolor_s = $custom["skebg_bgcolor"][0];

if($skebgg_time_s=="" || $skebgg_time_s=="0"){$skebgg_time_s=6000;}
if($skebgg_transition_s=="" || $skebgg_transition_s=="0"){$skebgg_transition_s=1000;}

for($skebgi_s=1;$skebgi_s < 11;$skebgi_s++){
	$skebgg_slideUrl_s = $custom["skebg_slide$skebgi_s"][0];
	if($skebgg_slideUrl_s){
		$skebgg_slidesArr_s[] = $skebgg_slideUrl_s; 
	}
}

if($skebgg_random_s && !empty($skebgg_slidesArr_s))
shuffle($skebgg_slidesArr_s);

$skebgg_nav_s = (empty($skebgg_nav_s)) ? 'false' : $skebgg_nav_s;
$skebgg_playpause_s = (empty($skebgg_playpause_s)) ? 'false' : $skebgg_playpause_s;
$skebgg_thumbs_s = (empty($skebgg_thumbs_s)) ? 'false' : $skebgg_thumbs_s;
?>