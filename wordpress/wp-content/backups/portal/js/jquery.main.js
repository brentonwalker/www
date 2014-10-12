/**
 * Main theme Javascript - (c) Greg Priday, freely distributable under the terms of the GPL 2.0 license.
 */
jQuery(function($){
    // Initialize the flex slider
    $('.flexslider').flexslider({});
    
    /* Setup fitvids for entry content and panels */
    $('.entry-content, .entry-content .panel, .entry-thumbnail' ).fitVids();

    // Scale the navigation float to fit the site logo
    $('.main-navigation-float').height($('#masthead hgroup').height()/2);

    // Fade in loader for the thumbnail images
    if($('.entry-thumbnail > img').length){

        // Resize the thumbnails
        var resizeThumbs = function(){
            $('.entry-thumbnail > img').each(function(){
                var $$ = $(this);
                var $p = $$.parent();
                $p.css('height', $$.width() / Number($$.attr('width')) * Number($$.attr('height')));
            });
        }
        $(window).resize(resizeThumbs);
        resizeThumbs();

        $('.entry-thumbnail > img').hide().each(function(){
            var $$ = $(this);
            if($$.get(0).complete) {
                // Ignore this if it's already complete
                $$.show();
                return;
            }

            $$.parent().addClass('loading');
            var temp = $('<img />').attr('src', $$.attr('src')).load(function(){
                $$.fadeIn('slow');
                $$.parent().removeClass('loading');
            });
        });
    }
});

// Preload the loader image
jQuery('<img />').attr('src', portalSettings.loader);