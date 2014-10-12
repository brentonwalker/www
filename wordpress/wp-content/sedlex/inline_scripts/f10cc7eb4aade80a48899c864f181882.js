		jQuery(document).ready(function () {
			jQuery('a.gallery_colorbox').colorbox({ 
				slideshow: true,
								title: function(){ 
					if (typeof jQuery(this).children("img:first").attr('title') !== "undefined") {
						return "<h2>"+jQuery(this).children("img:first").attr('title')+"</h2>" ; 
					} else {
						return "" ; 
					}
				},
								slideshowAuto:false,
								slideshowSpeed: 5000 ,
				slideshowStart: 'Play',
				slideshowStop :  'Pause',
				current : 'Image {current} of {total}', 
				scalePhotos : true , 
				previous: 'Previous',	
				next:'Next',
				close:'Close',
				maxWidth: 640, 
				maxHeight : 900,
				opacity:0.8 , 
				onComplete : function(){ 
									jQuery("#cboxPrevious").hide();
					jQuery("#cboxNext").hide();
								},
				rel:'group1' 
			});
		});	
						
		