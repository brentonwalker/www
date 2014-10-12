/**
 * Main theme Javascript - (c) Greg Priday, freely distributable under the terms of the GPL license.
 */
jQuery(function($){
    // Initialize the flex slider
    $('.flexslider').flexslider({});
    
    // Set up fitVids
    $('.entry-content, .entry-content .panel' ).fitVids();
    
    // Use modernizer to fall back to PNG versions of the header images
    if(!Modernizr.svg){
        $('hgroup img.header-decoration' ).each(function(){
            var $$ = $(this);
            $$.attr('src', $$.attr('src' ).replace('.svg', '.png'));
        })
    }
});