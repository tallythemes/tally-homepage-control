<?php
function tallybuilder_SContent_HTML__text($meta_data, $meta_id, $post_id, $prefix){
	$content = ( isset($meta_data[$prefix.'content']) ) ? $meta_data[$prefix.'content'] : '';
	$class = ( isset($meta_data[$prefix.'class']) ) ? $meta_data[$prefix.'class'] : '';
	$id = ( isset($meta_data[$prefix.'id']) ) ? $meta_data[$prefix.'id'] : '';
	$id = ( $id == '' ) ? '' : 'id="'.$id.'"';
	
	echo '<div class="tbhtml_text '.$class.'" '.$id.'>';
		echo $content;
	echo '</div>';
}
function tallybuilder_SContent_CSS__text(){
	
}
function tallybuilder_SContent_MB__text($meta_data, $meta_id, $post_id, $prefix){
	
	$settings = array(
		'key' => $prefix.'content',
		'title' => 'Content',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
	);
	tallybuilder_metabox_form_editor($settings);
	
	$settings = array(
		'key' => $prefix.'class',
		'title' => 'Div Class',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'y',
	);
	tallybuilder_metabox_form_text($settings);
	
	$settings = array(
		'key' => $prefix.'id',
		'title' => 'Div ID',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'y',
	);
	tallybuilder_metabox_form_text($settings);
}



/*
	Image
--------------------------------------------------*/
function tallybuilder_SContent_HTML__image($meta_data, $meta_id, $post_id, $prefix){
	$image_src = ( isset($meta_data[$prefix.'image']) ) ? $meta_data[$prefix.'image'] : '';
	$alt_text = ( isset($meta_data[$prefix.'alt']) ) ? $meta_data[$prefix.'alt'] : '';
	$class = ( isset($meta_data[$prefix.'class']) ) ? $meta_data[$prefix.'class'] : '';
	$id = ( isset($meta_data[$prefix.'id']) ) ? $meta_data[$prefix.'id'] : '';
	$id = ( $id == '' ) ? '' : 'id="'.$id.'"';
	
	echo '<img src="'.$image_src.'" alt="'.$alt_text.'" class="tbhtml_image '.$class.'" '.$id.' >' ;
}
function tallybuilder_SContent_CSS__image( $meta_data, $meta_id, $post_id, $prefix ){
	
}
function tallybuilder_SContent_MB__image( $meta_data, $meta_id, $post_id, $prefix ){
	
	$settings = array(
		'key' => $prefix.'image',
		'title' => 'Image',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
	);
	tallybuilder_metabox_form_image($settings);
	
	$settings = array(
		'key' => $prefix.'alt',
		'title' => 'Alt Text',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'y',
	);
	tallybuilder_metabox_form_text($settings);
	
	$settings = array(
		'key' => $prefix.'class',
		'title' => 'Div Class',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'y',
	);
	tallybuilder_metabox_form_text($settings);
	
	$settings = array(
		'key' => $prefix.'id',
		'title' => 'Div ID',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'y',
	);
	tallybuilder_metabox_form_text($settings);
}



/*
	Grid
--------------------------------------------------*/
function tallybuilder_SContent_HTML__grid(){
	
}
function tallybuilder_SContent_CSS__grid(){
	
}
function tallybuilder_SContent_MB__grid($meta_data, $meta_id, $post_id, $prefix){
		
	$settings = array(
		'key' => $prefix.'grid',
		'title' => 'Select a Grid',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
		'post_type' => 'tt_grid'
	);
	tallybuilder_metabox_form_post_select($settings);
	
	$settings = array(
		'key' => $prefix.'class',
		'title' => 'Div Class',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'y',
	);
	tallybuilder_metabox_form_text($settings);
	
	$settings = array(
		'key' => $prefix.'id',
		'title' => 'Div ID',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'y',
	);
	tallybuilder_metabox_form_text($settings);

}