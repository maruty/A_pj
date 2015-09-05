/**
 * @author NetBusinessAgen
 * @version 1.0.1
 */
jQuery( function( $ ) {
	var custom_uploader;
	$( '#whiteroom-header-image-media' ).click( function( e ) {
		e.preventDefault();
		if ( custom_uploader ) {
			custom_uploader.open();
			return;
		}
		custom_uploader = wp.media( {
			title: whiteroom_header_image.title,
			library: {
				type: 'image'
			},
			button: {
				text: whiteroom_header_image.title
			},
			multiple: false
		} );

		custom_uploader.on( 'select', function() {
			var images = custom_uploader.state().get( 'selection' );
			images.each( function( file ){
				$( '#whiteroom-header-image' ).append( '<img src="' + file.toJSON().url + '" />' );
				$( '#whiteroom-header-image-hidden' ).val( file.toJSON().id );
				$( '#whiteroom-header-image-media' ).removeClass().addClass( 'whiteroom-header-image-hide' );
				$( '#whiteroom-header-image-delete' ).removeClass().addClass( 'whiteroom-header-image-show' );
			} );
		} );

		custom_uploader.open();
	} );

	$( '#whiteroom-header-image-delete' ).click( function() {
		$( '#whiteroom-header-image' ).text( '' );
		$( '#whiteroom-header-image-hidden' ).val( '' );
		$( '#whiteroom-header-image-media' ).removeClass().addClass( 'whiteroom-header-image-show' );
		$( this ).removeClass().addClass( 'whiteroom-header-image-hide' );
	} );
} );