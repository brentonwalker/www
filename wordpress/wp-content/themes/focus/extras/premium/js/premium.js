jQuery( function ( $ ) {
    var paymentWindow;
    $( '#theme-upgrade .buy-button' ).click( function () {
        var $$ = $( this );

        paymentWindow = window.open( $$.attr( 'href' ), 'payment', 'height=800,width=1024' );
        $( '#theme-upgrade-info' ).slideDown();
        $( 'html, body' ).animate( {'scrollTop':0} );

        return false;
    } );

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