/**
 * @author NetBusinessAgent
 * @version 1.0.0
 */
jQuery( function( $ ) {

	var cnt = $( '#whiteroom-front-page-widget-areas tbody tr' ).length;
	$( '#whiteroom-front-page-widget-areas tbody' ).sortable();

	$( '.whiteroom-delete' ).on( 'click', function() {
		cnt ++;
		$( this ).closest( 'tr' ).fadeOut( function() {
			$( this ).remove();
		} );
	} );


	$( '.whiteroom-add-field' ).click( function() {
		cnt ++;
		var clone = $( this ).closest( 'form' ).find( 'table tbody tr:first' ).clone( true );
		clone.find( 'input, select' ).each( function() {
			$( this ).attr( 'name', $( this ).attr( 'name' ).replace( /\[\d+\]/, '[' + cnt + ']' ) );
		} );
		$( this ).closest( 'form' ).find( 'table tbody tr:last' ).after( clone.fadeIn() );
	} );

} );