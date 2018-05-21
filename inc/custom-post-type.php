<?php

/*
	
@package pktechietheme
	
	========================
		THEME CUSTOM POST TYPES
	========================
*/

$contact = get_option( 'activate_contact' );
if( @$contact == 1 ){
	
	add_action( 'init', 'pktechie_contact_custom_post_type' );
	
	add_filter( 'manage_pktechie-contact_posts_columns', 'pktechie_set_contact_columns' );
	add_action( 'manage_pktechie-contact_posts_custom_column', 'pktechie_contact_custom_column', 10, 2 );
	
	add_action( 'add_meta_boxes', 'pktechie_contact_add_meta_box' );
	add_action( 'save_post', 'pktechie_save_contact_email_data' );


	
}

/* CONTACT CPT */
function pktechie_contact_custom_post_type() {
	$labels = array(
		'name' 				=> 'Messages',
		'singular_name' 	=> 'Message',
		'menu_name'			=> 'Messages',
		'name_admin_bar'	=> 'Message'
	);
	
	$args = array(
		'labels'			=> $labels,
		'show_ui'			=> true,
		'show_in_menu'		=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'menu_position'		=> 26,
		'menu_icon'			=> 'dashicons-email-alt',
		'supports'			=> array( 'title', 'editor', 'author' )
	);
	
	register_post_type( 'pktechie-contact', $args );
	
}

function pktechie_set_contact_columns( $columns ) {
	$newColumns = array();
	$newColumns['title'] = 'Full Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email';
	$newColumns['date'] = 'Date';
	return $newColumns;
	
}

function pktechie_contact_custom_column( $column, $post_id ) {
	
	switch( $column ){
		
		case 'message' :
			echo get_the_excerpt();
			break;
			
		case 'email' :
			//email column
			$email = get_post_meta( $post_id, '_contact_email_value_key', true );
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
	}
	
}

/* CONTACT META BOXES */

function pktechie_contact_add_meta_box() {
	
	add_meta_box( 'contact_email', 'User Email', 'pktechie_contact_email_callback', 'pktechie-contact', 'side' );
	
}

function pktechie_contact_email_callback( $post ) {
	
	wp_nonce_field( 'pktechie_save_contact_email_data', 'pktechie_contact_email_meta_box_nonce' );
	$value = get_post_meta( $post->ID, '_contact_email_value_key', true );
	
	echo '<label for="pktechie_contact_email_field">User Email Address: </label>';
	echo '<input type="email" id="pktechie_contact_email_field" name="pktechie_contact_email_field" value="' . esc_attr( $value ) . '" size="25" />';

}

function pktechie_save_contact_email_data( $post_id ) {
	
	if( ! isset( $_POST['pktechie_contact_email_meta_box_nonce'] ) ){
		return;
	}
	
	if( ! wp_verify_nonce( $_POST['pktechie_contact_email_meta_box_nonce'], 'pktechie_save_contact_email_data') ) {
		return;
	}
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return;
	}
	
	if( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	if( ! isset( $_POST['pktechie_contact_email_field'] ) ) {
		return;
	}
	
	$my_data = sanitize_text_field( $_POST['pktechie_contact_email_field'] );
	
	update_post_meta( $post_id, '_contact_email_value_key', $my_data );
	
}

