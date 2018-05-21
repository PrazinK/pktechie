<?php

/*
	
@package pktechietheme
	
	========================
		ADMIN PAGE
	========================
*/

function pktechie_add_admin_page() {
	
	//Generate pktechie Admin Page
	add_menu_page( 'PK Techie Theme options', 'pktechie', 'manage_options', 'pk_techie', 'pktechie_theme_create_page', 'dashicons-admin-customizer', 110 );
	
	//Generate pktechie Admin Sub Pages
	add_submenu_page( 'pk_techie', 'pk techie sidebar options', 'Sidebar', 'manage_options', 'pk_techie', 'pktechie_theme_create_page' );
	add_submenu_page( 'pk_techie', 'pk techie theme options', 'Theme Options', 'manage_options', 'pk_techie_theme', 'pktechie_theme_support_page' );
	add_submenu_page( 'pk_techie', 'pktechie Contact Form', 'Contact Form', 'manage_options', 'pk_techie_theme_contact', 'pktechie_contact_form_page' );
	add_submenu_page( 'pk_techie', 'pk techie css options', 'Custom CSS', 'manage_options', 'pk_techie_css', 'pktechie_theme_settings_page' );
	
	
	
	
	
	//Activate custom settings
	add_action( 'admin_init', 'pktechie_custom_settings' );
}

add_action( 'admin_menu', 'pktechie_add_admin_page' );

function pktechie_custom_settings() {
	//Sidebar Options
	//Register Setting
	register_setting( 'pktechie-settings-group', 'profile_picture' );
	register_setting( 'pktechie-settings-group', 'first_name' );
	register_setting( 'pktechie-settings-group', 'last_name' );
	register_setting( 'pktechie-settings-group', 'user_description' );
	register_setting( 'pktechie-settings-group', 'twitter_handler', 'pktechie_sanitize_twitter_handler' );
	register_setting( 'pktechie-settings-group', 'facebook_handler' );
	register_setting( 'pktechie-settings-group', 'gplus_handler' );
	
	
	//Add settings section
	add_settings_section( 'pktechie-sidebar-options', 'Sidebar Options', 'pktechie_sidebar_options', 'pk_techie');
	
	add_settings_field( 'sidebar-profile-picture', 'Profile picture', 'pktechie_sidebar_profile', 'pk_techie', 'pktechie-sidebar-options');
	add_settings_field( 'sidebar-name', 'Full Name', 'pktechie_sidebar_name', 'pk_techie', 'pktechie-sidebar-options');
	add_settings_field( 'sidebar-description', 'Description', 'pktechie_sidebar_description', 'pk_techie', 'pktechie-sidebar-options');
	add_settings_field( 'sidebar-twitter', 'Twitter Handler', 'pktechie_sidebar_twitter', 'pk_techie', 'pktechie-sidebar-options');
	add_settings_field( 'sidebar-facebook', 'Facebook Handler', 'pktechie_sidebar_facebook', 'pk_techie', 'pktechie-sidebar-options');
	add_settings_field( 'sidebar-gplus', 'Google Plus Handler', 'pktechie_sidebar_gplus', 'pk_techie', 'pktechie-sidebar-options');
	
	//Theme Support Options
	register_setting( 'pktechie-theme-support', 'post_formats' );
	register_setting( 'pktechie-theme-support', 'custom_header' );
	register_setting( 'pktechie-theme-support', 'custom_background' );

	
	add_settings_section( 'pktechie-theme-options', 'Theme Options', 'pktechie_theme_options', 'pk_techie_theme');
	add_settings_field( 'post-formats', 'Post Formats', 'pktechie_post_formats', 'pk_techie_theme', 'pktechie-theme-options');
	add_settings_field( 'custom-header', 'Custom Header', 'pktechie_custom_header', 'pk_techie_theme', 'pktechie-theme-options');
	add_settings_field( 'custom-background', 'Custom Background', 'pktechie_custom_background', 'pk_techie_theme', 'pktechie-theme-options');
	
	//Contact Form Options
	register_setting( 'pktechie-contact-options', 'activate_contact' );
	
	add_settings_section( 'pktechie-contact-section', 'Contact Form', 'pktechie_contact_section', 'pk_techie_theme_contact');
	add_settings_field( 'activate-form', 'Activate Contact Form', 'pktechie_activate_contact', 'pk_techie_theme_contact', 'pktechie-contact-section' );
	
	//Custom CSS Options
	register_setting( 'pktechie-custom-css-options', 'pktechie_css', 'pktechie_sanitize_custom_css' );
	
	add_settings_section( 'pktechie-custom-css-section', 'Custom CSS', 'pktechie_custom_css_section_callback', 'pk_techie_css');
	add_settings_field( 'custom-css', 'Insert your custom css', 'pktechie_custom_css_callback', 'pk_techie_css', 'pktechie-custom-css-section' );
	
	
}

function pktechie_custom_css_section_callback() {
	echo 'Customise your pktechie theme with your own CSS';
}

function pktechie_custom_css_callback() {
	$css = get_option( 'pktechie_css' );
	$css = ( empty($css) ? '/* pktechie Theme Custom CSS */' : $css );

	echo '<div id="customCss">'.$css.'</div><textarea id="pktechie_css" name="pktechie_css" style="display:none;visibility:hidden;">'.$css.'</textarea>';

}


function pktechie_theme_options() {
	echo 'Activate and Deactivate specific Theme Support Options';
}

function pktechie_contact_section() {
	echo 'Activate and Deactivate the built-in Contact Form';
}

//Theme Support Options Function
function pktechie_post_formats() {
	$options = get_option( 'post_formats' );
	$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output = '';
	foreach ( $formats as $format ){
		$checked = ( @$options[$format] == 1 ? 'checked' : '' );
		$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
	}
	echo $output;
}

//Activate Custom Header Function
function pktechie_custom_header() {
	$options = get_option( 'custom_header' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate Custom Header </label>';
}

//Activate Custom Background Function
function pktechie_custom_background() {
	$options = get_option( 'custom_background' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate Custom Background </label>';
}

//Activate Contact Form  Function
function pktechie_activate_contact() {
	$options = get_option( 'activate_contact' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="activate_contact" value="1" '.$checked.' /></label>';
}

// Sidebar Options Functions
function pktechie_sidebar_options() {
	echo 'Customise your Sidebar Information';
}

function pktechie_sidebar_profile() {
	$picture = esc_attr ( get_option( 'profile_picture' ) );
		if( empty($picture) ){
		echo '<input type="button" class="button button-secondary" value="Upload profile picture" id="upload-button" ><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
	} else {
		echo '<input type="button" class="button button-secondary" value="Change profile picture" id="upload-button" ><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /> <input type="button" class="button button-secondary" value="Remove" id="remove-picture">';
	}
	
}

function pktechie_sidebar_name() {
	$firstName = esc_attr ( get_option( 'first_name' ) );
	$lastName = esc_attr ( get_option( 'last_name' ) );
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" />
			<input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />
			';
}


function pktechie_sidebar_description() {
	$description = esc_attr( get_option( 'user_description' ) );
	echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p class="description">Write something smart.</p>';
}
function pktechie_sidebar_twitter() {
	$twitter = esc_attr ( get_option( 'twitter_handler' ) );
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler" /><p class="description">Input your Twitter username without the @ character.</p>';
}

function pktechie_sidebar_facebook() {
	$facebook = esc_attr ( get_option( 'facebook_handler' ) );
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler" />';
}

function pktechie_sidebar_gplus() {
	$gplus = esc_attr ( get_option( 'gplus_handler' ) );
	echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Google Plus Handler" />';
}

//Sanitization settings
function pktechie_sanitize_twitter_handler( $input ){
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
}

function pktechie_sanitize_custom_css( $input ){
	$output = esc_textarea( $input );
	return $output;
}

//Template submenu functions
function pktechie_theme_support_page() {
	require_once (get_template_directory() . '/inc/templates/pktechie-theme-support.php' );
}

function pktechie_contact_form_page() {
	require_once (get_template_directory() . '/inc/templates/pktechie-contact-form.php' );
}

function pktechie_theme_create_page() {
	// Generation of admin page
	require_once (get_template_directory() . '/inc/templates/pktechie-admin.php' );
}

//Custom CSS submenu functions
function pktechie_theme_settings_page() {
	// Generation of admin page
	require_once (get_template_directory() . '/inc/templates/pktechie-custom-css.php' );
}
