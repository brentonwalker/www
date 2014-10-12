/**
 * A simple tooltip for the panel interface.
 *
 * @copyright Greg Priday 2013
 * @license GPL 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 */

jQuery( function ( $ ) {
    $( '[data-tooltip]' )
        .live( 'mouseenter', function () {
            $( this ).showTooltip();
        } )
        .live( 'mouseleave', function () {
            $( this ).removeTooltip();
        } );

    $.fn.showTooltip = function () {
        this.each( function () {
            var $$ = $( this );
            var tooltip = $( '<div class="panels-tooltip"></div>' ).appendTo( 'body' ).html( $$.attr( 'data-tooltip' ) ).append( $( '<div class="pointer"></div>' ) );

            tooltip.css( {
                top: $$.offset().top - 12 - $$.outerHeight(),
                left:$$.offset().left - tooltip.outerWidth() / 2 + $$.outerWidth() / 2
            } ).hide().fadeIn( 100 );

            $$.data( 'tooltip', tooltip );
        } );
        return this;
    }

    $.fn.removeTooltip = function () {
        this.each( function () {
            var $$ = $( this );
            var tooltip = $$.data( 'tooltip' );
            if ( tooltip != undefined ) {
                $$.data( 'tooltip', undefined );
                tooltip.fadeOut( 100, function () {
                    tooltip.remove();
                } );
            }
        } );
        return this;
    }
} );