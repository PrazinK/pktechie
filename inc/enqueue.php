<?php

/*
	
@package pktechietheme
	
	========================
		ADMIN ENQUEUE FUNCTIONS
	========================
*/

function pktechie_load_admin_scripts( $hook ) {
	
	//echo $hook;
	if( 'toplevel_page_pk_techie' == $hook ){

	wp_register_style('pktechie_admin', get_template_directory_uri() . '/css/pktechie.admin.css', array(), '1.0.0', 'all');
	wp_enqueue_style( 'pktechie_admin' );
	
	wp_enqueue_media();
	
	wp_register_script('pktechie-admin-script', get_template_directory_uri() . '/js/pktechie.admin.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'pktechie-admin-script' );
	
	} else if ( 'pktechie_page_pk_techie_css' == $hook ) {
		
		wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/pktechie.ace.css', array(), '1.0.0', 'all' );
		
		wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array('jquery'), '1.2.1', true );
		wp_enqueue_script( 'pktechie-custom-css-script', get_template_directory_uri() . '/js/pktechie.custom_css.js', array('jquery'), '1.0.0', true );
	
	
	} else { return; }
}
add_action( 'admin_enqueue_scripts', 'pktechie_load_admin_scripts' );

/*
	
	========================
		FRONT-END ENQUEUE FUNCTIONS
	========================
*/

function pktechie_load_scripts(){
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6', 'all' );
    wp_enqueue_style( 'pktechie', get_template_directory_uri() . '/css/pktechie.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,400' );
    
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery' , get_template_directory_uri() . '/js/jquery.js', false, '3.3.1', true );
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
	wp_enqueue_script( 'pktechie', get_template_directory_uri() . '/js/pktechie.js', array('jquery'), '1.0.0', true );
	
}
add_action( 'wp_enqueue_scripts', 'pktechie_load_scripts' );