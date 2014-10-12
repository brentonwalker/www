/*-- Sketch BG-Gallery Admin script
---------------------------------------*/
jQuery(document).ready(function(){

	if(jQuery("#skebg_wrapper #skebg_disable").is(':checked')){jQuery('#skebg_wrapper .skebg_disable').hide();}
	if(!jQuery("#skebg_wrapper #skebg_check").is(':checked')){jQuery('#skebg_wrapper .skebg_table').hide();}

	jQuery("#skebg_wrapper #skebg_check").click(function(){
		if(jQuery("#skebg_wrapper #skebg_check").is(':checked')){jQuery('#skebg_wrapper .skebg_table').stop(true,true).slideDown();jQuery('#skebg_wrapper #skebg_addchk').addClass('checked');}
		else{jQuery('#skebg_wrapper .skebg_table').stop(true,true).slideUp();jQuery('#skebg_wrapper #skebg_addchk').removeClass('checked');}
	});
	
	jQuery('#skebg_wrapper .skebg_onoff_chkbox,#skebg_wrapper .skebg_wrap_chkbox').click(function(){
		if(jQuery(this).is(':checked')){jQuery(this).prev('label').addClass('checked');}
		else{jQuery(this).prev('label').removeClass('checked');}
	
	});

	jQuery("#skebg_wrapper #skebg_disable").click(function(){
		if(jQuery("#skebg_wrapper #skebg_disable").is(':checked')){jQuery('#skebg_wrapper .skebg_disable').stop(true,true).slideUp();jQuery(this).prev('label.skebg_mkchk').addClass('checked');jQuery("#skebg_wrapper #skebg_check").prop("checked", false);jQuery('#skebg_addchk').removeClass('checked');}
		else{jQuery('#skebg_wrapper .skebg_disable').stop(true,true).slideDown();jQuery(this).prev('label.skebg_mkchk').removeClass('checked');}
	});
	
	jQuery('#skebg_wrapper .skebg_rdlb').click(function(){
		jQuery('#skebg_wrapper .skebg_rdlb').removeClass('active');
		jQuery(this).addClass('active');
	}); 
	
	jQuery('#skebg_wrapper .skebg_td').click(function(){
		jQuery('#skebg_wrapper .skebg_td').removeClass('checked');
		jQuery(this).addClass('checked');
	}); 

	jQuery('#skebg_wrapper .skebg_settings').click(function(){
		jQuery(this).find('.skebg_plus_minus').toggleClass('active');
		jQuery('#skebg_wrapper .skebg_expCol').addClass('active')
		jQuery(this).next('.skebg_extendbox').stop(true,true).slideToggle('fast');
	});
	
	jQuery('#skebg_wrapper .skebg_settings .skebg_savebox input').click(function(e) {
        e.stopPropagation();
    });
	
	jQuery('#skebg_wrapper .skebg_expCol').click(function(){
		var skebg_expcol = jQuery(this);
		if(jQuery(this).is('.active')){
			jQuery('#skebg_wrapper .skebg_extendbox').slideUp('fast',function(){
				jQuery('#skebg_wrapper .skebg_plus_minus').removeClass('active');
				jQuery(skebg_expcol).removeClass('active');
			});
			
		}else{
			jQuery('#skebg_wrapper .skebg_extendbox').slideDown('fast',function(){
				jQuery('#skebg_wrapper .skebg_plus_minus').addClass('active');
				jQuery(skebg_expcol).addClass('active');
			});
		}
	});


/*-- Upload image jquery start 
--------------------------------------------*/
	var targetfield= '';
	var skebg_send_to_editor = window.send_to_editor;
	jQuery('.skebg_uploadbtn').click(function(){
		targetfield = jQuery(this).prev('.skebg_uploadimg');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery(targetfield).val(imgurl);
			tb_remove();
			window.send_to_editor = skebg_send_to_editor;
		}
		return false;
	});	
/*-------------------------------------------*/

/*color picker jquery start*/
	if (jQuery("#skebg_wrapper").length){
		jQuery('#skebg_wrapper .skebg_bgcolor').farbtastic('#skebg_bgcolor');
	}
	
	jQuery('html').click(function() {jQuery("#skebg_wrapper .farbtastic").fadeOut('fast');});
	
	jQuery('#skebg_wrapper .skebg_colsel').click(function(event){
		jQuery("#skebg_wrapper .farbtastic").hide();
		jQuery(this).find(".farbtastic").fadeIn('fast');event.stopPropagation();
	});
/*color picker jquery end*/

});


/*-- Sketch BG-Gallery Tooltip jquery script 
---------------------------------------------------*/
skebg_ShowTooltip = function(e){
	var text = jQuery(this).find('.skebg_tooltip_txt');
	if (text.attr('class') != 'skebg_tooltip_txt')
		return false;
	text.stop(true,true).fadeIn('fast')
	return false;
}
skebg_HideTooltip = function(e){
	var text = jQuery(this).find('.skebg_tooltip_txt');
	if (text.attr('class') != 'skebg_tooltip_txt')
	return false;
	text.stop(true,true).fadeOut('fast');
}

skebg_SetupTooltips = function(){
	jQuery('.skebg_tooltip')
		.each(function(){
			jQuery(this).append('.');
			jQuery(this)
				.append(jQuery('<span/>')
					.attr('class', 'skebg_tooltip_txt')
					.html(jQuery(this).attr('title')))
				.attr('title', '');
		})
		.hover(skebg_ShowTooltip, skebg_HideTooltip);
}
jQuery(document).ready(function() {
	skebg_SetupTooltips();
	jQuery('span.skebg_tooltip_txt').prepend('<div class="skebg_tarr"></div>');
});
/*---------------------------------------------------*/
jQuery(document).ready(function($) {
	jQuery("form#skebg_saveform").submit(function(event){
		var data = jQuery(this).serializeArray();
		
		jQuery.ajax({	
			url:ajaxurl,
			data:data,
			type: "POST",
			beforeSend: function(){
				jQuery('#skebg_ajaxloader').fadeIn('fast');
				jQuery('.skebg_overlay').fadeIn('fast');
				jQuery('#skebg_settsaved').html('');
			},
			success: function(response) {
				if(response == 1){
					jQuery('#skebg_ajaxloader').fadeOut('fast');
					skebg_show_message(1);
					t = setTimeout('skebg_fade_message()', 1000);
				}else{
					jQuery('#skebg_ajaxloader').fadeOut('fast');
					skebg_show_message(0);
					t = setTimeout('skebg_fade_message()', 2700);
				}    
			}
		});
		return false;
	});
});
function skebg_show_message(n){
	if(n == 1){ jQuery('#skebg_settsaved').html('<div class="updated_msg"></div>').fadeIn(500);} 
	else if(n == 0){
		jQuery('#skebg_settsaved').html('<div class="info_msg"></div>').fadeIn(500);
	}
}
function skebg_fade_message(){jQuery('#skebg_settsaved').fadeOut(1000);jQuery('.skebg_overlay').fadeOut(1000);	clearTimeout(t);}