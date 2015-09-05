<?php
/**
 * @author NetBusinessAgent
 * @version 1.0.3
 */

function whiteroom_add_tinymce_plugin() {
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) )
		return;
	if ( get_user_option( 'rich_editing' ) == 'true' ) {
		add_filter( 'mce_external_plugins', 'whiteroom_mce_external_plugins' );
	}
}
function whiteroom_mce_external_plugins( $plugin_array ) {
	$plugin_array['whiteroom_section'] = get_template_directory_uri() . '/js/editor_plugin.js';
	return $plugin_array;
}
add_action( 'admin_init', 'whiteroom_add_tinymce_plugin' );

/**
 * whiteroom_shortcode_empty_paragraph_fix
 */
function whiteroom_shortcode_empty_paragraph_fix( $content ) {
	$patterns = array(
		'/<p>\[col /',
		'/\[\/col\]<\/p>/',
		'/<p>\[row\]/',
		'/\[\/row\]<\/p>/',
		'/\]<br \/>/',
		'/<p>([^(<\/p>)]+?)(\n|\r|\n\r)<\/div>/',
	);
	$replacements = array(
		'[col ',
		'[/col]',
		'[row]',
		'[/row]',
		']',
		'<p>$1</p></div>',
	);
	$content = preg_replace( $patterns, $replacements, $content );
	return $content;
}
add_filter( 'the_content', 'whiteroom_shortcode_empty_paragraph_fix' );

/**
 * whiteroom_section
 */
function whiteroom_section( $atts, $content = '' ) {
	$atts = shortcode_atts( array(
		'title' => '',
		'bgcolor' => 'transparent',
		'id' => '',
		'class' => '',
	), $atts );

	$styles = array();
	$bgcolor = 'transparent';
	if ( preg_match( '/^#([\da-fA-F]{6}|[\da-fA-F]{3})$/', $atts['bgcolor'] ) ) {
		$bgcolor = $atts['bgcolor'];
	}
	$styles[] = 'background-color:' . $bgcolor;

	$id = '';
	if ( $atts['id'] ) {
		$id = sprintf( 'id="%s"', esc_attr( $atts['id'] ) );
	}

	$title = '';
	$wrapper = 'div';
	if ( $atts['title'] ) {
		$title = sprintf( '<h1>%s</h1>', esc_html( $atts['title'] ) );
		$wrapper = 'section';
	}

	$content = sprintf('
		<%s class="full-back %s" style="%s" %s>%s%s</%1$s>
		',
		esc_html( $wrapper ),
		esc_attr( $atts['class'] ),
		implode( ';', $styles ),
		$id,
		$title,
		$content
	);
	return apply_filters( 'the_content', $content );
}
add_shortcode( 'section', 'whiteroom_section' );

/**
 * whiteroom_row
 */
function whiteroom_row( $atts, $content = '' ) {
	$content = sprintf( '<div class="row">%s</div>', $content );
	return apply_filters( 'the_content', $content );
}
add_shortcode( 'row', 'whiteroom_row' );

/**
 * whiteroom_col
 */
function whiteroom_col( $atts, $content = '' ) {
	$atts = shortcode_atts( array(
		'size' => '',
		'xs' => '',
		'offset' => '',
		'margintop' => 'true',
	), $atts );

	$classes = array();
	if ( preg_match( '/^\d+$/', $atts['size'] ) && $atts['size'] <= 12 ) {
		$classes[] = 'col-' . $atts['size'];
	}
	if ( preg_match( '/^\d+$/', $atts['xs'] ) && $atts['xs'] <= 12 ) {
		$classes[] = 'col-xs-' . $atts['xs'];
	}
	if ( preg_match( '/^\d+$/', $atts['offset'] ) && $atts['offset'] <= 11 ) {
		$classes[] = 'offset-' . $atts['offset'];
	}
	if ( $atts['margintop'] === 'false' ) {
		$classes[] = 'remove-col-margin-top';
	}
	if ( $classes ) {
		$content = sprintf( '<div class="%s">%s</div>',
			esc_attr( implode( ' ', $classes ) ),
			$content
		);
	}
	return apply_filters( 'the_content', $content );
}
add_shortcode( 'col', 'whiteroom_col' );

function whiteroom_thumbnail_text( $atts, $content ) {
	$atts = shortcode_atts( array(
		'title' => '',
		'src' => '',
		'content' => '',
		'link' => '',
		'border' => 'true',
		'title_position' => 'bottom',
	), $atts );

	$thumbnail = '';
	if ( $atts['src'] ) {
		if ( $atts['link'] ) {
			$image = sprintf( '<a href="%s"><img src="%s" alt="%s" /></a>',
				esc_url( $atts['link'] ),
				esc_url( $atts['src'] ),
				esc_attr( $atts['title'] )
			);
		} else {
			$image = sprintf( '<img src="%s" alt="%s" />',
				esc_url( $atts['src'] ),
				esc_attr( $atts['title'] )
			);
		}
		$thumbnail_style = '';
		if ( $atts['title_position'] === 'top' ) {
			$thumbnail_style = 'style="margin-bottom: 0"';
		}
		$thumbnail = sprintf( '<dt class="thumbnail" %s>%s</dt>',
			$thumbnail_style,
			$image
		);
	}
	$link = '';
	if ( $atts['link'] ) {
		$atts['content'] = sprintf( '<a href="%s">%s<span class="read-more">Read more</span></a>',
			esc_url( $atts['link'] ),
			$atts['content']
		);
	}

	$border = '';
	if ( $atts['border'] === 'false' ) {
		$border = 'class="noborder"';
	}

	if ( $atts['title_position'] === 'top' ) {
		$content = sprintf( '<div class="dl-top-image"><dl %s><dt class="title" style="margin-bottom: 5px">%s</dt>%s<dd>%s</dd></dl></div>',
			$border,
			esc_html( $atts['title'] ),
			$thumbnail,
			$atts['content']
		);
	} else {
		$content = sprintf( '<div class="dl-top-image"><dl %s>%s<dt class="title">%s</dt><dd>%s</dd></dl></div>',
			$border,
			$thumbnail,
			esc_html( $atts['title'] ),
			$atts['content']
		);
	}
	return $content;
}
add_shortcode( 'thumbnail_text', 'whiteroom_thumbnail_text' );
