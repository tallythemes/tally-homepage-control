<?php
/*
	Prefix: tallybuilder_
*/


add_action( 'init', 'tallybuilder_register_post_type' );
function tallybuilder_register_post_type() {
	$labels = array(
		'name'               => __( 'Builder Pages', 'tally-builder' ),
		'singular_name'      => __( 'Tally Builder', 'tally-builder' ),
		'menu_name'          => __( 'Tally Builder', 'tally-builder' ),
		'name_admin_bar'     => __( 'Builder', 'tally-builder' ),
		'add_new'            => __( 'Add New', 'tally-builder' ),
		'add_new_item'       => __( 'Add New Builder Page', 'tally-builder' ),
		'new_item'           => __( 'New Builder Page', 'tally-builder' ),
		'edit_item'          => __( 'Edit Builder Page', 'tally-builder' ),
		'view_item'          => __( 'View Builder Page', 'tally-builder' ),
		'all_items'          => __( 'All Builder Pages', 'tally-builder' ),
		'search_items'       => __( 'Search Builder Pages', 'tally-builder' ),
		'parent_item_colon'  => __( 'Parent Builder Pages:', 'tally-builder' ),
		'not_found'          => __( 'No Builder Pages found.', 'tally-builder' ),
		'not_found_in_trash' => __( 'No Builder Pages found in Trash.', 'tally-builder' )
	);
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tally-builder' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'can_export'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor')
	);
	register_post_type( 'tally_builder', $args );
	
	
	$labels = array(
		'name'               => __( 'Builder Content', 'tally-builder' ),
		'singular_name'      => __( 'Tally Builder Content', 'tally-builder' ),
		'menu_name'          => __( 'Tally Builder Content', 'tally-builder' ),
		'name_admin_bar'     => __( 'Builder Content', 'tally-builder' ),
		'add_new'            => __( 'Add New', 'tally-builder' ),
		'add_new_item'       => __( 'Add New Builder Content', 'tally-builder' ),
		'new_item'           => __( 'New Builder Content', 'tally-builder' ),
		'edit_item'          => __( 'Edit Builder Content', 'tally-builder' ),
		'view_item'          => __( 'View Builder Content', 'tally-builder' ),
		'all_items'          => __( 'All Builder Content', 'tally-builder' ),
		'search_items'       => __( 'Search Builder Content', 'tally-builder' ),
		'parent_item_colon'  => __( 'Parent Builder Content:', 'tally-builder' ),
		'not_found'          => __( 'No Builder Content found.', 'tally-builder' ),
		'not_found_in_trash' => __( 'No Builder Content found in Trash.', 'tally-builder' )
	);
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => 'admin.php?page=tallybuilder',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'tally-builder-content' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => NULL,
		'can_export'       => false,
		'supports'           => array( 'title')
	);
	register_post_type( 'tally_builder_c', $args );
}




add_filter( 'gettext', 'tallybuilder_section_publish_button_text', 10, 2 );
function tallybuilder_section_publish_button_text( $translation, $text ) {
	if ( 'tally_builder_c' == get_post_type()){
		if ( $text == 'Publish' ){
			return 'Save Section';
		}elseif($text == 'Update'){
			return 'Save Section';
		}
	}
	
	return $translation;
}


function tallybuilder_section_edit_notice() {
	$post_id = (isset($_GET['post']) ? $_GET['post'] : NULL);
	$tallybuilder_page_id = tallybuilder_post_id_by_slug(get_post_meta($post_id,'tallybuilder_parent_page', true), 'tally_builder');
	$action = (isset($_GET['action']) ? $_GET['action'] : NULL);
	$post_type = (isset($_GET['post_type']) ? $_GET['post_type'] : NULL);
	$text = '';
	$page_url = '#';
	
    if ( 'tally_builder_c' == get_post_type()){
		if($tallybuilder_page_id != NULL){
			$page_url = esc_url(admin_url('admin.php?page=tallybuilder&view=sections&tallybuilder_page_id='.$tallybuilder_page_id));
		}
		
		$text .= 'Page: <a href="'.$page_url.'">'.get_the_title($tallybuilder_page_id).'</a> / ';
		if($action == 'edit'){
			$text .= get_the_title($post_id);
		}else{
			$text .= 'Add New Section';
		}
		$text .= '<a class="page-title-action" href="'.$page_url.'">See All Sections</a>';
		
		echo '<div class="tallybuilder-wrap">';
			echo '<h1>';
				echo $text;
			echo '</h1>';
		echo '</div>';
	}
}
add_action( 'admin_notices', 'tallybuilder_section_edit_notice' );