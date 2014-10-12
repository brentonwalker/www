		jQuery(document).ready(function () {
			jQuery('a.gallery_colorbox').colorbox({ 
				slideshow: true,
								title: false,
								slideshowAuto:false,
								slideshowSpeed: 5000 ,
				slideshowStart: 'Play',
				slideshowStop :  'Pause',
				current : 'Image {current} of {total}', 
				scalePhotos : true , 
				previous: 'Previous',	
				next:'Next',
				close:'Close',
				maxWidth: 1024, 
				maxHeight : 768,
				opacity:0.8 , 
				onComplete : function(){ 
									jQuery("#cboxPrevious").hide();
					jQuery("#cboxNext").hide();
				    				jQuery('.cboxPhoto').unbind().click(jQuery('a.gallery_colorbox').colorbox.close); 
									jQuery("#cboxSlideshow").hide();
								},
				rel:'group1' 
			});
		});	
						
		