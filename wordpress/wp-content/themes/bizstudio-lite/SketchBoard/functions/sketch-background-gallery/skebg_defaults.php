<?php
function skebg_checkgetOptions($options)
{
	if(!isset($options['skebg_frontPg'])){$options['skebg_frontPg']=1;}
	if(!isset($options['skebg_random'])){$options['skebg_random']=0;}
	if(!isset($options['skebg_bgchkbox'])){$options['skebg_bgchkbox']=0;}
	if(!isset($options['skebg_bgcolor'])){$options['skebg_bgcolor']='#111';}

return $options;
}


function skebg_validate_options($skebg_input)
{
	if(!isset($skebg_input['skebg_frontPg'])){$skebg_input['skebg_frontPg']=0;}	if(!isset($skebg_input['skebg_time'])){$skebg_input['skebg_time']=null;}
	if(!isset($skebg_input['skebg_transition'])){$skebg_input['skebg_transition']=null;}
	if(!isset($skebg_input['skebg_nav'])){$skebg_input['skebg_nav']=0;}
	if(!isset($skebg_input['skebg_playpause'])){$skebg_input['skebg_playpause']=0;}
	if(!isset($skebg_input['skebg_thumbs'])){$skebg_input['skebg_thumbs']=0;}
	if(!isset($skebg_input['skebg_random'])){$skebg_input['skebg_random']=0;}
	if(!isset($skebg_input['skebg_overlay'])){$skebg_input['skebg_overlay']=0;}
	if(!isset($skebg_input['skebg_bgchkbox'])){$skebg_input['skebg_bgchkbox']=0;}  
	if(!isset($skebg_input['skebg_slide1'])){$skebg_input['skebg_slide1']=null;}  
	if(!isset($skebg_input['skebg_slide2'])){$skebg_input['skebg_slide2']=null;}  
return $skebg_input;
}


?>