<?php
/**
 * @author NetBusinessAgent
 * @version 1.0.2
 */

/**
 * add meta box
 */
function whiteroom_add_voice_meta_box() {
	add_meta_box(
		'whiteroom_voice_meta_box',
		'カスタムフィールド',
		'whiteroom_voice_meta_box',
		'voice',
		'normal'
	);
}
add_action( 'admin_head', 'whiteroom_add_voice_meta_box' );

function whiteroom_voice_meta_box() {
	global $post;
	?>
	<p>
		<strong>お客様名</strong><br />
		<input type="text" name="whiteroom_staff_name" value="<?php echo esc_attr( get_post_meta( $post->ID, 'whiteroom_staff_name', true ) ); ?>" />
	</p>
	<p>
		<strong>URL</strong><br />
		<input type="text" name="whiteroom_url" value="<?php echo esc_attr( get_post_meta( $post->ID, 'whiteroom_url', true ) ); ?>" class="widefat" />
	</p>
	<?php
}

function whiteroom_voice_save_post( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
	if ( !isset( $_POST['post_type'] )|| 'voice' !== $_POST['post_type'] )
		return $post_id;
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	if ( isset( $_POST['whiteroom_staff_name'] ) ) {
		update_post_meta( $post_id, 'whiteroom_staff_name', $_POST['whiteroom_staff_name'] );
	}
	if ( isset( $_POST['whiteroom_url'] ) ) {
		update_post_meta( $post_id, 'whiteroom_url', $_POST['whiteroom_url'] );
	}
}
add_action( 'save_post', 'whiteroom_voice_save_post' );
