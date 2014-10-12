jQuery(function($){
    // Show and hide the teaser images
    $('.siteorigin-premium-teaser' ).has('.teaser-image')
        .each(function(){
            
        })
        .mouseenter(function(){
            var $$ = $(this ).find('.teaser-image' );
            if($$.is(':hover')) return;
            $$.fadeIn(100);
        })
        .mouseleave(function(){
            $(this ).find('.teaser-image' ).clearQueue().fadeOut(100);
        })
        
    
})