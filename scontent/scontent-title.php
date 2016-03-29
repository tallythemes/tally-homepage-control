<?php
/*
	Title
--------------------------------------------------*/
function tallybuilder_SContent_HTML__title($meta_data, $meta_id, $post_id, $prefix){
	$h1 = ( isset($meta_data[$prefix.'h1']) ) ? $meta_data[$prefix.'h1'] : '';
	$h2 = ( isset($meta_data[$prefix.'h2']) ) ? $meta_data[$prefix.'h2'] : '';
	$class = ( isset($meta_data[$prefix.'class']) ) ? $meta_data[$prefix.'class'] : '';
	$id = ( isset($meta_data[$prefix.'id']) ) ? $meta_data[$prefix.'id'] : '';
	$id = ( $id == '' ) ? '' : 'id="'.$id.'"';
	$alignment = ( isset($meta_data[$prefix.'alignment']) ) ? $meta_data[$prefix.'alignment'] : '';
	$alignment = ( $alignment == '' ) ? '' : 'text-'.$alignment;
	$unique_class = $prefix.'title'.$post_id;
	
	$animation1_class = tallybuilder_meta_animation_content($meta_id, $prefix.'h1_animation', true, $post_id);
	$animation1_content = tallybuilder_meta_animation_content($meta_id, $prefix.'h1_animation', false, $post_id);
	$animation2_class = tallybuilder_meta_animation_content($meta_id, $prefix.'h2_animation', true, $post_id);
	$animation2_content = tallybuilder_meta_animation_content($meta_id, $prefix.'h2_animation', false, $post_id);
	
	echo '<div class="tbhtml_title '.$class.' '.$alignment.' '.$unique_class.'" '.$id.'>';
		echo (($h1 == '') ? '' : '<h2 class="'.$animation1_class.'" '.$animation1_content.'>'.$h1.'</h2>');
		echo (($h2 == '') ? '' : '<h4 class="'.$animation2_class.'" '.$animation2_content.'>'.$h2.'</h4>');
	echo '</div>';
}
function tallybuilder_SContent_CSS__title($meta_data, $meta_id, $post_id, $prefix){
	
	$unique_class = '.'.$prefix.'title'.$post_id;
		
	echo tallybuilder_meta_fontStyle_css($unique_class.' h2', $meta_id, $prefix.'h1_fontstyle', $post_id);
	echo tallybuilder_meta_fontStyle_css($unique_class.' h4', $meta_id, $prefix.'h2_fontstyle', $post_id);
	echo tallybuilder_meta_linkColor_css($unique_class.' a', $meta_id, $prefix.'linkcolor', $post_id);
	echo tallybuilder_meta_margin_css($unique_class, $meta_id, $prefix.'margin', $post_id);
}
function tallybuilder_SContent_MB__title($meta_data, $meta_id, $post_id, $prefix){
	
	$settings = array(
		'key' => $prefix.'h1',
		'title' => 'Main Title',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
	);
	tallybuilder_metabox_form_text($settings);
	
	$settings = array(
		'key' => $prefix.'h2',
		'title' => 'Sub Title',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
	);
	tallybuilder_metabox_form_text($settings);
	
	$select_items = array(
		array('title' => 'Left', 'value' => 'left'),
		array('title' => 'Right', 'value' => 'Right'),
		array('title' => 'Center', 'value' => 'center'),
	);
	$settings = array(
		'key' => $prefix.'alignment',
		'title' => 'Alignment',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'y',
		'select_items' => $select_items,
	);
	tallybuilder_metabox_form_select($settings);
	
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
	
	
	$settings = array(		
		'base_id' => $prefix.'h1_fontstyle',
		'title' => 'Main Title Font Style',
		'value' => '',
		'meta_id' => $meta_id,
		'data' => $meta_data,
	);
	tallybuilder_metabox_form_fontStyle($settings);
	
	$settings = array(		
		'base_id' => $prefix.'h2_fontstyle',
		'title' => 'Sub Title Font Style',
		'value' => '',
		'meta_id' => $meta_id,
		'data' => $meta_data,
	);
	tallybuilder_metabox_form_fontStyle($settings);
	
	
	$settings = array(		
		'base_id' => $prefix.'linkcolor',
		'title' => 'Link Colors',
		'value' => '',
		'meta_id' => $meta_id,
		'data' => $meta_data,
	);
	tallybuilder_metabox_form_linkColor($settings);
	
	$settings = array(		
		'base_id' => $prefix.'h1_animation',
		'title' => 'Main Title Animation',
		'value' => '',
		'meta_id' => $meta_id,
		'data' => $meta_data,
	);
	tallybuilder_metabox_form_animation2($settings);
	
	$settings = array(		
		'base_id' => $prefix.'h2_animation',
		'title' => 'Sub Title Animation',
		'value' => '',
		'meta_id' => $meta_id,
		'data' => $meta_data,
	);
	tallybuilder_metabox_form_animation2($settings);
	
	$settings = array(		
		'base_id' => $prefix.'margin',
		'title' => 'Margin',
		'value' => '',
		'meta_id' => $meta_id,
		'data' => $meta_data,
	);
	tallybuilder_metabox_form_margin($settings);
}
