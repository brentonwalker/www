( function( $ ) {

	function adjustPostHeight() {
		var browserWidth = $( window ).width();

		if ( browserWidth > 600 ) {
			$( '.hentry-wrap.featured' ).each( function( index ) {
				var newImgHeight = $( this ).children( 'img.wp-post-image' ).height() - 25;

				$(this).css( 'padding-top', parseInt( newImgHeight ) + 'px' );
			} );
		} else {
			$( '.hentry-wrap.featured' ).css( 'padding-top', '0' );
		}
	};

	$( window ).bind( "load resize", function() {
		adjustPostHeight();
	} );

	$( document ).bind( "post-load", function() {
		adjustPostHeight();
	} );

} )( jQuery );