<?php
$skebg_options = get_option('skebggallery_options'); 
$options = skebg_checkgetOptions($skebg_options);

$skebgg_frontPg = $options["skebg_frontPg"];
$skebgg_time = $options["skebg_time"]*1000;
$skebgg_transition = $options["skebg_transition"]*1000;

$skebgg_nav = $options["skebg_nav"];
$skebgg_playpause = $options["skebg_playpause"];
$skebgg_thumbs = $options["skebg_thumbs"];	
$skebgg_thumbs_display = $options["skebg_thumbs_display"];
$skebgg_random = $options["skebg_random"];

$skebgg_overlay = $options["skebg_overlay"];
$skebgg_oveffect = $options["skebg_oveffect"];
$skebgg_BgChkbox = $options["skebg_bgchkbox"];
$skebgg_Bgcolor = $options["skebg_bgcolor"];

if($skebgg_time=="" || $skebgg_time=="0"){$skebgg_time=6000;}
if($skebgg_transition=="" || $skebgg_transition=="0"){$skebgg_transition=1000;}

for($skebgi=1;$skebgi < 3;$skebgi++){
	$skebgg_slideUrl = $options["skebg_slide$skebgi"];
	if($skebgg_slideUrl){
		$skebgg_slidesArr[] = $skebgg_slideUrl; 
	}
}

if($skebgg_random && !empty($skebgg_slidesArr))
shuffle($skebgg_slidesArr);

$skebgg_frontPg = (empty($skebgg_frontPg)) ? 0 : $skebgg_frontPg;
$skebgg_nav = (empty($skebgg_nav)) ? 'false' : $skebgg_nav;
$skebgg_playpause = (empty($skebgg_playpause)) ? 'false' : $skebgg_playpause;
$skebgg_thumbs = (empty($skebgg_thumbs)) ? 'false' : $skebgg_thumbs;
?>