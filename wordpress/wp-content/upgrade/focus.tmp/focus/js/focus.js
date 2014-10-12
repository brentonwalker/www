/**
 * Focus Theme Javascript.
 * 
 * Copyright 2013, Greg Priday
 * Released under GPL 2.0 - see http://www.gnu.org/licenses/gpl-2.0.html
 */

jQuery(function($){

    // Set up fitvids
    if( typeof $.fn.fitVids != 'undefined') {
        $('#single-header .video, .entry-content' ).fitVids();
    }
    if( typeof $.fn.fitText != 'undefined') {
        $('.post-heading h1' ).fitText(1.2, {
            minFontSize: '26px', maxFontSize: '48px'
        });
    }
    
    // Set up the flexslider
    var flexslider = $('.slider' ).flexslider({
        directionNav : false
    } ).find('.flex-control-nav' ).wrapInner('<div class="container"></div>');
    
    // Resize the images
    var resizeSlideImages = function(){
        $('.slider .wp-post-image, #single-header .wp-post-image' ).each(function(){
            var $$ = $(this);
            
            var c = $$.closest('.slider, #single-header' );
            var cHeight = c.width() * Number($$.attr('height')) /  Number($$.attr('width'));
            
            $$.css('margin-top', -((cHeight - c.height()) / 2) + "px"   );
        })
    };
    resizeSlideImages();
    $(window ).resize(resizeSlideImages);
    
    // Hovering over the play buttons of a slider
    $('.slider .slide a.play' ).each(function(){
        var $$ = $(this);
        var originalOpacity = $$.closest('.slide' ).find('.overlay' ).css('opacity');
        $$
            .mouseover(function(){
                $$.closest('.slide' ).find('.overlay' ).clearQueue().animate({'opacity' : 0.35}, 450);
            })
            .mouseout(function(){
                $$.closest('.slide' ).find('.overlay' ).clearQueue().animate({'opacity' : originalOpacity}, 450);
            })
    });
    
    // Load the jPlayer
    if($("#jquery_jplayer_1" ).length){
        $("#jquery_jplayer_1").jPlayer({
            ready: function(){
                var $$ = $(this);
                
                $$.jPlayer("setMedia", {
                    m4v : $("#jquery_jplayer_1" ).attr('data-video'),
                    poster: jplayerSettings.videoPoster
                } );
                if(focus.mobile){
                    $$.find('jp-gui' ).hide();
                }

                if($$.attr('data-autoplay') == 1){
                    $$.jPlayer("play");
                }
                
                $(window ).resize();
            },
            solution: "flash, html",
            supplied : "m4v",
            swfPath : jplayerSettings.swfPath,
            autohide : {
                restored: !focus.mobile
            },
            size: {
                width: "100%",
                height: "100%"
            },
            cssSelectorAncestor: "#jp_interface_1"
        });
        $(window ).resize();
    }
}); 