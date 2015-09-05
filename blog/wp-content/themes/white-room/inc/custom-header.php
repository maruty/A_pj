<?php
/**
 * @author NetBusinessAgent
 * @version 1.0.0
 */

/**
 * Setup the WordPress core custom header feature.
 */
function whiteroom_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'whiteroom_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/images/headers/main.jpg',
		//'default-text-color'     => '000000',
		'width'                  => 1280,
		'height'                 => 560,
		'flex-height'            => true,
		'header-text'            => false,
		'wp-head-callback'       => 'whiteroom_header_style',
		'admin-head-callback'    => 'whiteroom_admin_header_style',
		'admin-preview-callback' => 'whiteroom_admin_header_image',
	) ) );

	register_default_headers( array(
		'main' => array(
			'url' 			=>	'%s/images/headers/main.jpg',
			'thumbnail_url'	=>	'%s/images/headers/main-thumbnail.jpg'
		),
	) );
}
add_action( 'after_setup_theme', 'whiteroom_custom_header_setup' );

/**
 * Styles the header image and text displayed on the blog
 */
if ( ! function_exists( 'whiteroom_header_style' ) ) :
function whiteroom_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 */
if ( ! function_exists( 'whiteroom_admin_header_style' ) ) :
function whiteroom_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg img {
			max-width: 100%;
		}
	</style>
<?php
}
endif;

/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 */
if ( ! function_exists( 'whiteroom_admin_header_image' ) ) :
function whiteroom_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif;
