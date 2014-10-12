jQuery( function ( $ ) {
    var paymentWindow;
    $( '#theme-upgrade .buy-button' ).not('.has-support-choices').click( function () {
        var $$ = $( this );

        paymentWindow = window.open( $$.attr( 'href' ), 'payment', 'height=800,width=1024' );
        $( '#theme-upgrade-info' ).slideDown();
        $( 'html, body' ).animate( {'scrollTop':0} );
        $('#support-choice, #support-choice-overlay' ).fadeOut();

        return false;
    } );

    $( '#theme-upgrade .buy-button.has-support-choices' ).click(function(){
        $('#support-choice, #support-choice-overlay' ).fadeIn();
        return false;
    });

    $('#support-choice-overlay' ).click(function(){
        $('#support-choice, #support-choice-overlay' ).fadeOut();
    });

    // Toggle the key entry data
    $( '#theme-upgrade-already-paid' ).click( function () {
        $( '#theme-upgrade-info' ).slideToggle();
        return false;
    } );
    
    $('#theme-upgrade .feature-image' ).click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
    })
    
    // Set up the testimonial cycle
    $('#theme-upgrade .testimonials' ).cycle({
        fx: 'fade',
        random: true,
        timeout : 5000
    });
} );