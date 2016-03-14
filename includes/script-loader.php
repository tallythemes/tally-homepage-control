<?php
function tallybuilder_load_admin_script() {
	wp_enqueue_style( 'tallybuilder-admin', TALLYBUILDER__PLUGIN_URL . '/assets/css/tallybuilder-admin.css');
	wp_enqueue_style('wp-color-picker');
	
	wp_enqueue_script( 'tallybuilder-admin', TALLYBUILDER__PLUGIN_URL.'/assets/js/tallybuilder-admin.js', array( 'wp-color-picker', 'jquery-ui-core', 'jquery-ui-sortable',
	"jquery-ui-tabs" ), false, true ); 
	
	wp_enqueue_media();
}

add_action( 'admin_enqueue_scripts', 'tallybuilder_load_admin_script' );




function tallybuilder_load_script() {
	wp_enqueue_style( 'bootstrap', TALLYBUILDER__PLUGIN_URL . '/assets/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style( 'animate', TALLYBUILDER__PLUGIN_URL . '/assets/css/animate.css');
	wp_enqueue_style( 'tallybuilder', TALLYBUILDER__PLUGIN_URL . '/assets/css/tallybuilder.css');
	wp_enqueue_script( 'bootstrap', TALLYBUILDER__PLUGIN_URL.'/assets/bootstrap/js/bootstrap.min.js', array('jquery'), false, true ); 
	
	wp_enqueue_script( 'wow', TALLYBUILDER__PLUGIN_URL.'/assets/js/wow.min.js', array('jquery'), false, true ); 
	wp_enqueue_script( 'tallybuilder', TALLYBUILDER__PLUGIN_URL.'/assets/js/tallybuilder.js', array('jquery'), false, true ); 
}

add_action( 'wp_enqueue_scripts', 'tallybuilder_load_script' );