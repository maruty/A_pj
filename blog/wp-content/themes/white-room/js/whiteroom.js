/**
 * @author NetBusinessAgent
 * @version 1.0.1
 */
( function( $ ) {

	function change_global_nav() {
		var header = $( '#header .col-12' );
		var logo = header.find( '.site-branding' );
		var gnav = header.find( '.global-nav' );
		var btn  = header.find( '#responsive-btn' );
		if ( header.width() - logo.width() - gnav.width() <= 0 ) {
			gnav.css( 'display', 'none' );
			btn.css( 'display', 'block' );
		} else {
			gnav.css( 'display', 'block' );
			btn.css( 'display', 'none' );
		}
	}

	$( 'body' ).scrollButton();

	$( '.front-page-widget-column .col-6:nth-child(2n+1)' ).css( 'clear', 'both' );
	$( '.front-page-widget-column .col-3:nth-child(4n+1)' ).css( 'clear', 'both' );
	$( '.front-page-widget-column .col-4:nth-child(3n+1)' ).css( 'clear', 'both' );

	$( '.sub-pages .sub-page:nth-child(3n+1)' ).css( 'clear', 'both' );

	$( window ).resize( function() {
		change_global_nav();
	} );

	$( window ).load( function() {
		var site_branding = $( '.site-branding' ).outerHeight();
		$( '#responsive-btn' ).css( 'top', ( site_branding - $( '#responsive-btn' ).height() ) / 2 );

		change_global_nav();

		$( '.global-nav' ).responsive_nav();
	} );

} )( jQuery );
