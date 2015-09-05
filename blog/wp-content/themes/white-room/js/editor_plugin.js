/*
tinymce.PluginManager.add( 'whiteroom_section', function( editor ) {
	function getProperty( regex, content ) {
		var value = '';
		var match = content.match( regex );
		if ( match !== null && 1 in match ) {
			value = match[1];
		}
		return value;
	}

	editor.on( 'BeforeSetContent', function( event ) {
		function replaceWhiteroomSectionShortcodes( content ) {
			return content.replace( /\[section([^\]]*?)\]([\s\S]+?)\[\/section\]/g, function( match, attr, _content ) {
				_content = _content.replace( /^<\/p>/g, '' );
				_content = _content.replace( /([\s\S]*)<p>$/g, '$1' );

				var title = getProperty( /title="(.+?)"/, attr );
				if ( title )
					title = '<h1>' + title + '</h1>';

				var bgcolor = getProperty( /bgcolor="(#[\da-fA-F]{6}|#[\da-fA-F]{3})"/, attr );
				if ( bgcolor )
					bgcolor = 'background-color: ' + bgcolor;

				var id = getProperty( /id="(.+?)"/, attr );
				if ( id )
					id = 'id="' + id + '"';

				var htmlclass = getProperty( /class="(.+?)"/, attr );

				return '<section class="full-back ' + htmlclass + '" ' + id + ' style="' + bgcolor + '">' + title + _content + '</section>';
			} );
		}

		function replaceWhiteroomRowShortcodes( content ) {
			return content.replace( /\[row\]([\s\S]+?)\[\/row\]/g, function( match, _content ) {
				_content = _content.replace( /^<\/p>/g, '' );
				_content = _content.replace( /([\s\S]*)<p>$/g, '$1' );
				return '<div class="row">' + _content + '<!-- end .row --></div>';
			} );
		}

		function replaceWhiteroomColShortcodes( content ) {
			return content.replace( /\[col([^\]]*?)\]([\s\S]+?)\[\/col\]/g, function( match, attr, _content ) {
				_content = _content.replace( /^<\/p>/g, '' );
				_content = _content.replace( /([\s\S]*)<p>$/g, '$1' );

				var size = getProperty( /size="(\d+?)"/, attr );
				if ( !size )
					size = 12;

				var xs = getProperty( /xs="(\d+?)"/, attr );
				if ( xs )
					xs = ' col-xs-' + xs;
				return '<div class="col-' + size + xs + '">' + _content + '<!-- end .col --></div>';
			} );
		}

		console.log( event.content );
		event.content = replaceWhiteroomSectionShortcodes( event.content );
		event.content = replaceWhiteroomRowShortcodes( event.content );
		event.content = replaceWhiteroomColShortcodes( event.content );
		console.log( event.content );
		return event.content;
	} );

	editor.on( 'PostProcess', function( event ) {
		function restoreWhiteroomSectionShortcodes( content ) {
			return content.replace( /<section([^>]*?)>([\s\S]+?)<\/section>/g, function( match, attr, _content ) {
				var heading = getProperty( /^<h1>(.+?)<\/h1>/, _content );
				if ( heading ) {
					_content = _content.replace( '<h1>' + heading + '</h1>', '' );
					heading = ' title="' + heading + '"';
				}

				var bgcolor = getProperty( /background-color: (#[\da-fA-F]{6}|#[\da-fA-F]{3})/, attr );
				if ( bgcolor )
					bgcolor = ' bgcolor="' + bgcolor + '"';

				var id = getProperty( /(id="(.+?)")/, attr );
				if ( id )
					id = ' ' + id;

				var htmlclass = getProperty( /class="full-back ([^\"]+?)"/, attr );
				if ( htmlclass )
					htmlclass = ' class="' + htmlclass + '"';

				return '[section' + heading + bgcolor + id + htmlclass + ']' + "</p>" + _content + '<p>[/section]';
			} );
		}

		function restoreWhiteroomRowShortcodes( content ) {
			return content.replace( /<div class="row">([\s\S]+?)<!-- end .row --><\/div>/g, function( match, _content ) {
				return '[row]' + "</p>" + _content + '<p>[/row]';
			} );
		}

		function restoreWhiteroomColShortcodes( content ) {
			return content.replace( /<div class="col-([^>]*?)">([\s\S]+?)<!-- end .col --><\/div>/g, function( match, attr, _content ) {
				var size = getProperty( /(\d+?)[^\d]*?/, attr );
				var xs = getProperty( /col-xs-(\d+?)/, attr );
				if ( xs ) {
					xs = ' xs=' + xs;
				}

				return '[col size="' + size + '"' + xs + ']' + "</p>" + _content + '<p>[/col]';
			} );
		}

		console.log( event.content );
		event.content = restoreWhiteroomSectionShortcodes( event.content );
		event.content = restoreWhiteroomRowShortcodes( event.content );
		event.content = restoreWhiteroomColShortcodes( event.content );
		console.log( event.content );
		return event.content;
	} );
} );
*/