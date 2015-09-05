<?php
/**
 * @author NetBusinessAgent
 * @version 1.0.0
 */
add_image_size( 'whiteroom-header-image', 1280, 280, true );

function whiteroom_add_header_image_metabox() {
	global $post;
	if ( !is_admin() )
		return;
	$post_types = array( 'page' );
	foreach ( $post_types as $post_type ) {
		if ( current_theme_supports( 'post-thumbnails' ) && post_type_supports( $post_type, 'thumbnail' ) ) {
			add_meta_box(
				'whiteroom_add_header_image_metabox',
				'ヘッダー画像',
				'whiteroom_upload_header_image',
				$post_type,
				'side',
				'low'
			);
		}
	}
}
add_action( 'admin_head', 'whiteroom_add_header_image_metabox' );

function whiteroom_upload_header_image() {
	global $post;
	$meta_key = 'whiteroom-header-image';
	$header_image_id_key = 'whiteroom_header_image_id';
	$size_key = 'whiteroom-header-image';

	$post_meta = get_post_meta( $post->ID, $meta_key, true );
	$whiteroom_header_image_id = '';
	if ( !empty( $post_meta[$header_image_id_key] ) ) {
		$whiteroom_header_image_id = $post_meta[$header_image_id_key];
	}

	$add_button_class = 'whiteroom-header-image-hide';
	$delete_button_class = 'whiteroom-header-image-hide';
	if ( !empty( $post_meta[$header_image_id_key] ) ) {
		$delete_button_class = 'whiteroom-header-image-show';
	} else {
		$add_button_class = 'whiteroom-header-image-show';
	}
	?>
	<a id="whiteroom-header-image-media" href="javascript:void( 0 )" class="<?php echo esc_attr( $add_button_class ); ?>">ヘッダー画像を設定</a>
	<div id="whiteroom-header-image">
		<?php
		if ( !empty( $whiteroom_header_image_id ) ) {
			$whiteroom_header_image = wp_get_attachment_image( $whiteroom_header_image_id, $size_key );
			echo $whiteroom_header_image;
		}
		?>
	</div>
	<a id="whiteroom-header-image-delete" href="javascript:void( 0 )" class="<?php echo esc_attr( $delete_button_class ); ?>">
		ヘッダー画像を削除
	</a>
	<input type="hidden" id="whiteroom-header-image-hidden" name="<?php echo $meta_key; ?>[<?php echo $header_image_id_key; ?>]" value="<?php echo esc_attr( $whiteroom_header_image_id ); ?>" />
	<p class="howto">
		推奨サイズ 1280 &times; 280<br />
		小さい場合は表示時に自動的に拡大されます。子ページにヘッダー画像が設定されていない場合、親ページのヘッダー画像が使用されます。
	</p>
	<?php
}

function whiteroom_header_image_admin_scripts( $hook ) {
	if ( !in_array( $hook, array( 'post-new.php', 'post.php' ) ) )
		return;

	wp_enqueue_media();
	wp_enqueue_script(
		'whiteroom_header_image',
		get_template_directory_uri() . '/inc/header-image/js/header-image.js',
		array( 'jquery' ),
		false,
		true
	);
	wp_localize_script( 'whiteroom_header_image', 'whiteroom_header_image', array(
		'title' => 'ヘッダー画像を設定',
	) );
}
add_action( 'admin_enqueue_scripts', 'whiteroom_header_image_admin_scripts' );

function whiteroom_header_image_save( $post_ID ) {
	$meta_key = 'whiteroom-header-image';

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_ID;
	if ( !current_user_can( 'edit_posts' ) )
		return $post_ID;
	if ( !isset( $_POST[$meta_key] ) )
		return $post_ID;

	$accepts = array(
		'whiteroom_header_image_id',
	);
	$data = array();
	foreach ( $accepts as $accept ) {
		if ( isset( $_POST[$meta_key][$accept] ) )
			$data[$accept] = $_POST[$meta_key][$accept];
	}
	$old_data = get_post_meta( $post_ID, $meta_key, true );
	update_post_meta( $post_ID, $meta_key, $data, $old_data );
}
add_action( 'save_post', 'whiteroom_header_image_save' );
