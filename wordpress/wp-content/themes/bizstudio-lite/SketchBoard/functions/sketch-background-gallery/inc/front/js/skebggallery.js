(function($){
    $.skebggallery = function(selector, settings){
        //-- default settings --------------------------------------
        var config = 
		{
            'delay'            : 2000,       // Length between transitions
            'fadeSpeed'        : 500,        // Speed of transition
			'autoplay'		   : 1,	         // Slideshow starts playing automatically on/off(1/0)
			'navigation'       : 1,          // Gallery navigation on/off(1/0) 
			'playPause'        : 1,          // Gallery playPause on/off(1/0) 
			'thumbnails'       : 1,          // Gallery thumbnails on/off(1/0) 
			'fit_always'	   : 0,	         // Image will never exceed browser width or height (Ignores min. dimensions)
			'fit_landscape'	   : 0,	         // Landscape images will not exceed browser width
			'fit_portrait'     : 0,	         // Portrait images will not exceed browser height  			   
			'min_width'		   : 0,	         // Min width allowed (in pixels)
			'min_height'       : 0,          // Min height allowed (in pixels)
			'horizontal_center': 1,	         // Horizontally center background
			'vertical_center'  : 1,          // Vertically center background (in this case must 'bottom_crop'=0)
			'bottom_crop'      : 0,          // Start image cropping from bottom (in this case must 'vertical_center'=0)
			'thumb_style'      : 'square',   // Thumbnails style circle/square (circle/square)
			'nav_position'     : 'right'     // Navigation Position left/right (left/right)
        };
		
        if ( settings ){$.extend(config, settings);}
 
        //-- variables ----------------------------------
        var obj = jQuery(selector);
        var slide = obj.find('.skebg_bg');
        var count = slide.length;
		var controlloop = true;
        var i = 0;
		var j;
		var cycleTimer;
		var base = this;
		var subfn = this;
		var slides = false;
		var domobj,domobjscroll,dom_thumb,bullet,navObj;
		var thumb_style,nav_pos;
		
		//-- Resize slides -----------------------------
		//----------------------------------------------
		base.resizeSlideNow = function()
		{
			return obj.each(function() {
		  		//  Resize each image seperately
		  		jQuery('img',obj).each(function(){
		  			
					thisSlide = jQuery(this);
					var ratio = (thisSlide.height()/thisSlide.width()).toFixed(2);	// Define image ratio
					
					// Gather browser size
					var browserwidth = obj.width(),
						browserheight = obj.height(),
						offset;
					
					/*-----Resize Image-----*/
					if (config.fit_always) // Fit always is enabled
					{	
						thisSlide.addClass('fit_always');
					}
					else
					{	// Normal Resize
						if ((browserheight <= config.min_height) && (browserwidth <= config.min_width)){	// If window smaller than minimum width and height
						
							if ((browserheight/browserwidth) > ratio){
								config.fit_landscape && ratio < 1 ? resizeWidth(true) : resizeHeight(true);	// If landscapes are set to fit
							} else {
								config.fit_portrait && ratio >= 1 ? resizeHeight(true) : resizeWidth(true);		// If portraits are set to fit
							}
						
						} else if (browserwidth <= config.min_width){		// If window only smaller than minimum width
						
							if ((browserheight/browserwidth) > ratio){
								config.fit_landscape && ratio < 1 ? resizeWidth(true) : resizeHeight();	// If landscapes are set to fit
							} else {
								config.fit_portrait && ratio >= 1 ? resizeHeight() : resizeWidth(true);		// If portraits are set to fit
							}
							
						} else if (browserheight <= config.min_height){	// If window only smaller than minimum height
						
							if ((browserheight/browserwidth) > ratio){
								config.fit_landscape && ratio < 1 ? resizeWidth() : resizeHeight(true);	// If landscapes are set to fit
							} else {
								config.fit_portrait && ratio >= 1 ? resizeHeight(true) : resizeWidth();		// If portraits are set to fit
							}
						
						} else {// If larger than minimums
							
							if ((browserheight/browserwidth) > ratio){
								config.fit_landscape && ratio < 1 ? resizeWidth() : resizeHeight();	// If landscapes are set to fit
							} else {
								config.fit_portrait && ratio >= 1 ? resizeHeight() : resizeWidth();		// If portraits are set to fit
							}
							
						}
					}
					/*-----End Image Resize-----*/
					
					/*-----Resize Functions-----*/
					function resizeWidth(minimum){
						if (minimum){	// If minimum height needs to be considered
							if(thisSlide.width() < browserwidth || thisSlide.width() < config.min_width ){
								if (thisSlide.width() * ratio >= config.min_height){
									thisSlide.width(config.min_width);
						    		thisSlide.height(thisSlide.width() * ratio);
						    	}else{
						    		resizeHeight();
						    	}
						    }
						}else{
							if (config.min_height >= browserheight && !config.fit_landscape){	// If minimum height needs to be considered
								if (browserwidth * ratio >= config.min_height || (browserwidth * ratio >= config.min_height && ratio <= 1)){	// If resizing would push below minimum height or image is a landscape
									thisSlide.width(browserwidth);
									thisSlide.height(browserwidth * ratio);
								} else if (ratio > 1){		// Else the image is portrait
									thisSlide.height(config.min_height);
									thisSlide.width(thisSlide.height() / ratio);
								} else if (thisSlide.width() < browserwidth) {
									thisSlide.width(browserwidth);
						    		thisSlide.height(thisSlide.width() * ratio);
								}
							}else{	// Otherwise, resize as normal
								thisSlide.width(browserwidth);
								thisSlide.height(browserwidth * ratio);
							}
						}
					};
					
					function resizeHeight(minimum){
						if (minimum){	// If minimum height needs to be considered
							if(thisSlide.height() < browserheight){
								if (thisSlide.height() / ratio >= config.min_width){
									thisSlide.height(config.min_height);
									thisSlide.width(thisSlide.height() / ratio);
								}else{
									resizeWidth(true);
								}
							}
						}else{	// Otherwise, resized as normal
							if (config.min_width >= browserwidth){	// If minimum width needs to be considered
								if (browserheight / ratio >= config.min_width || ratio > 1){	// If resizing would push below minimum width or image is a portrait
									thisSlide.height(browserheight);
									thisSlide.width(browserheight / ratio);
								} else if (ratio <= 1){		// Else the image is landscape
									thisSlide.width(config.min_width);
						    		thisSlide.height(thisSlide.width() * ratio);
								}
							}else{	// Otherwise, resize as normal
								thisSlide.height(browserheight);
								thisSlide.width(browserheight / ratio);
							}
						}
					};
					/*-----End Resize Functions-----*/
					
					// Horizontally Center
					if (config.horizontal_center && !config.fit_always){
						jQuery(this).css('left', (browserwidth - jQuery(this).width())/2);
					}
					
					// Vertically Center
					if (config.vertical_center && !config.fit_always){
						jQuery(this).css('top', (browserheight - jQuery(this).height())/2);
					}

					// Crop start from bottom
					if (config.bottom_crop && !config.fit_always){
						jQuery(this).css('bottom','0');
						jQuery(this).css('top','auto');
					}
					
				});
				return false;
			});
			
		};
		//-------- end resizing slide functions -------
			
		//-- call window resizing function ------------
		//---------------------------------------------

		if (!config.fit_always){
			jQuery(window).resize(function(){
				base.resizeSlideNow();
			});
		}
		
		jQuery('html').resize(function(eventObj) {
			//alert('xcvzxc');
			base.resizeSlideNow();
		});
		
		//-- check and build the gallery elements -----
		//---------------------------------------------
		base.buildgallery = function()
		{
			jQuery('body').append('<div id="skebggallery-loader">Loading Gallery...</div>');

			if(count > 1)
			{
				nav_pos = config.nav_position;
				obj.after('<div class="skebg_nav '+nav_pos+'"></div>');
				navObj = $('.skebg_nav');
			
				// build navigation
				if(config.navigation){
					navObj.append('<a class="skebg_next" href="javascript:void(0)"></a><a class="skebg_prev" href="javascript:void(0)"></a>');
				}
				
				if(config.playPause){
					navObj.append('<div class="skebg_controls"><a href="javascript:void(0);" title="play/pause Gallery" class="skebg_playpause"></a></div>');
				}
				
				if(config.thumbnails){
					thumb_style = config.thumb_style;
					navObj.append('<a href="javascript:void(0);" title="show/hide thumbnails" class="skebg_showthumbs"></a><div class="skebg_thumbnails"></div>');
					obj.find('.skebg_bg').each(function(){
						skebg_imgsrc = $(this).attr('src');
						navObj.find('.skebg_thumbnails').append('<a href="javascript:void(0);" class="dom_thumb '+thumb_style+'"><img src="'+skebg_imgsrc+'" /></a>');
					});
				}
				
				navObj_ht = navObj.height();
				navObj.css('margin-top',-navObj_ht/2);
				
				slides = true;
			}
			obj.css('visibility','hidden');
			jQuery('.skebg_nav,#skebg_bottom').css('visibility','hidden');
		}
		
		// creating gallery elements 
		base.buildgallery();
	
		//-- declaring the gallery sub functions ----
		//-------------------------------------------
		winWidth = obj.width();	
		subfn.startCycle = function()
		{
			cycleTimer = setInterval(function()
			{
				slide.eq(i).fadeOut(config.fadeSpeed);
				i = ( i+1 == count ) ? 0 : i+1;
				j = i;
				slide.eq(i).fadeIn(config.fadeSpeed);
			}, config.delay);
		}
		
		subfn.control_loop = function(){
			if(controlloop){
				if(config.autoplay){
					clearInterval(cycleTimer);
					setTimeout(subfn.startCycle,0);
				}
			}
		}
		//------------------------------------------

		//-- running gallery ------------------------
		//------------------------------------------
		base.startGallery= function()
		{
			// show first slide
			slide.eq(0).show();
			
			if(slides)
			{
				navObj = $('.skebg_nav');

				// automatically cycle slides
				if(config.autoplay){
					subfn.startCycle();
				}
				// thumbnail key click
				jQuery('a.skebg_showthumbs').click(function(){
					if(!$(this).hasClass('active')){
						$(this).addClass('active');
						navObj.find('.skebg_thumbnails').css('display','block').animate({'bottom': '50px'},250);
					}
					else{
						$(this).removeClass('active');
						navObj.find('.skebg_thumbnails').animate({'bottom': '-50px'},250,function(){ navObj.find('.skebg_thumbnails').hide(); });
					}
				});
				
								
				// thumbnail key click
				jQuery('body.ls_top a.skebg_showthumbs').click(function(){
				
					var wht = jQuery(window).height();
					var thisht = jQuery('.skebg_thumbnails').height();
					var diffht = wht - thisht;
					var half_ht = diffht / 2;
					
					if(!$(this).hasClass('active')){
						$(this).addClass('active');
						navObj.find('.skebg_thumbnails').css('display','block').animate({'bottom': half_ht},250);
					}
					else{
						$(this).removeClass('active');
						navObj.find('.skebg_thumbnails').animate({'bottom': '-500px'},250,function(){ navObj.find('.skebg_thumbnails').hide(); });
					}
				});
				
				
				
				// play-pause key click
				navObj.find('a.skebg_playpause').click(function(){
					if(!$(this).hasClass('active')){
						$(this).addClass('active');
						controlloop = false;
						clearInterval(cycleTimer);
					}
					else{
						$(this).removeClass('active');
						if(config.autoplay){
							setTimeout(subfn.startCycle,0);
						}
						controlloop = true;
					}
				});
						
				// goto next slide
				jQuery('a.skebg_next').click(function(){
					slide.eq(i).fadeOut(config.fadeSpeed);
					i = ( i+1 == count ) ? 0 : i+1;
					slide.eq(i).fadeIn(config.fadeSpeed);
					subfn.control_loop();
				});

				// goto previous slide
				jQuery('a.skebg_prev').click(function(){
					slide.eq(i).fadeOut(config.fadeSpeed);
					j = ( i <= 0 ) ? count-1 : i-1;
					i = j;
					slide.eq(j).fadeIn(config.fadeSpeed);
					subfn.control_loop();
				});
				
				// switch to particular slide
				jQuery(bullet).click(function(){
					slide.eq(i).fadeOut(config.fadeSpeed);
					jQuery(bullet).removeClass('active');
					jQuery(this).addClass('active');
					var k = jQuery(this).index();
					slide.eq(k).fadeIn(config.fadeSpeed);
					i = k;
					subfn.control_loop();
				});
				
				// switch to particular thumbs
				jQuery('.skebg_thumbnails .dom_thumb').click(function(){
					slide.eq(i).fadeOut(config.fadeSpeed);
					var k = jQuery(this).index();
					slide.eq(k).fadeIn(config.fadeSpeed);
					i = k;
					subfn.control_loop();
				});
			}
		}
		//------------------------------------------------
		
		//-- load gallery all elements --------
		jQuery(window).load(function(){
		   	base.resizeSlideNow();
			base.skebggallerylaunch();
		});
		
		//-- launch the gallery ---------------
		//-------------------------------------
		base.skebggallerylaunch = function(){
			obj.css('visibility','visible');
			jQuery('.skebg_nav,#skebg_bottom').css('visibility','visible');
			jQuery('#skebggallery-loader').remove();
			base.startGallery();
		}
		
        return this;
    };
})(jQuery);