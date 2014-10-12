//mobile menu

jQuery(document).ready(function(){

	jQuery('#nav').prepend('<div id="menu-icon" class="close">Navigation Menu<ul id="mini-menu"></ul></div>');

	jQuery('#menu-main>li').clone().appendTo('#mini-menu');

	//jQuery('#main-menu').clone().appendTo('#mini-menu');

	jQuery("#menu-icon").on("click", function(){

		jQuery(this).toggleClass("close", "open").toggleClass("open");

		jQuery("#mini-menu").slideToggle();

		//jQuery(this).toggleClass("open");

	});

})



// Fancy Box Script with Style 

jQuery(document).ready(function() {





				var fancy_box = "a[rel=home_group],"+

								"a[rel=recent_project],"+

								"a[rel=portfolio_col1],"+

								"a[rel=portfolio_col2],"+

								"a[rel=portfolio_col3],"+

								"a[rel=about_user],"+

								"a[rel=blog_posts],"+

								"a[rel=img_gallery]";



				jQuery(fancy_box).fancybox({

					'transitionIn'		: 'elastic',

					'transitionOut'		: 'elastic',

					'titlePosition' 	: 'over',

					'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {

						return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';

					}

				});





			});	// Fancy Box Script with Style 

			

			

			//Image hover script

			

			jQuery(document).ready(function(){



				var gallery_fade_speed = 400;



				jQuery('a').has('.fade').hover( function(){



					jQuery(this).find('.fade').css( { 'display' : 'block', 'opacity' : 0 } ).stop(true,true).fadeTo( gallery_fade_speed,.8);

				}, function(){

					jQuery(this).find('.fade').stop(true,true).fadeTo( gallery_fade_speed, 0 );

				});



				jQuery('.front-page-box a').hover( function(){



					jQuery(this).stop(true,true).fadeTo( gallery_fade_speed, 0.7 );

				}, function(){

					jQuery(this).stop(true,true).fadeTo( gallery_fade_speed, 1 );

				}); 





			});//Image hover script

			

			

			//	 Jcaruosel Slider Script 

			

			jQuery(document).ready(function() {

			    jQuery('#mycarousel').jcarousel({

			    	wrap: 'circular',

					auto:5,

					scroll:1

			    });



			});

			

				//Footer Social icons fade effect 

			

			jQuery(document).ready(function() {



				jQuery('.social li a').hover(

							function () {

								jQuery(this).stop(true, true).animate({opacity:0.5},500).css({'backgroundPosition':'right bottom'}).stop(true, true).animate({opacity: 1},1000);

									}, 

							function () {

								jQuery(this).stop(true, true).animate({opacity:0.5},500).css({'backgroundPosition':'right top'}).stop(true, true).animate({opacity: 1},1000);

				    });



			});

	

	

	//Footer Latest Post easing effect 

	

	jQuery(document).ready(function() {

				jQuery("#footer-widget-area ul ul,#siderbar .widget-container ul ").simple_lianimate();

				jQuery("#site_map .sitemap-rows ul").simple_lianimate();

				});

				

				(function($)

				{

				    $.fn.simple_lianimate = function(options){

						var defaults = 

				        {

						   speed:200, /*speed of animation, default is 200 milisecond*/

						   easing:""

				        };

						var options = $.extend(defaults, options);

						

						return this.each(function(){

							

							var opts = options,

							obj = $(this),			

							anim = $("> li",obj),

							currentPadding = $(anim).outerWidth() -  $(anim).width();



							anim.hover(function() {

								$(this).stop().animate({paddingLeft:currentPadding + 6},opts.speed,opts.easing);

							

							},function(){

								$(this).stop().animate({paddingLeft:currentPadding},opts.speed*2,opts.easing);

							});			

				        	

						});

					}

				})(jQuery);									