<?php
function tallybuilder_SContent_HTML__button($meta_data, $meta_id, $post_id, $prefix){

	$class =  tallybuilder_meta($meta_id, $prefix.'class', $post_id);
	$id =  tallybuilder_meta($meta_id, $prefix.'id', $post_id);
	
	$button_1_text = tallybuilder_meta($meta_id, $prefix.'button_1_text', $post_id);
	$button_1_link = tallybuilder_meta($meta_id, $prefix.'button_1_link', $post_id);
	$button_1_type = tallybuilder_meta($meta_id, $prefix.'button_1_type', $post_id);
	$button_1_target = tallybuilder_meta($meta_id, $prefix.'button_1_target', $post_id);
	$button_1_size = tallybuilder_meta($meta_id, $prefix.'button_1_size', $post_id);
	
	$button_2_text = tallybuilder_meta($meta_id, $prefix.'button_2_text', $post_id);
	$button_2_link = tallybuilder_meta($meta_id, $prefix.'button_2_link', $post_id);
	$button_2_type = tallybuilder_meta($meta_id, $prefix.'button_2_type', $post_id);
	$button_2_target = tallybuilder_meta($meta_id, $prefix.'button_2_target', $post_id);
	$button_2_size = tallybuilder_meta($meta_id, $prefix.'button_2_size', $post_id);
	
	$animation_class = tallybuilder_meta_animation_content($meta_id, $prefix.'animation', true, $post_id);
	$animation_content = tallybuilder_meta_animation_content($meta_id, $prefix.'animation', false, $post_id);

	$unique_class = $prefix.'button'.$post_id;
	
	echo '<div class="tbhtml_button '.$class.' '.$unique_class.' '.$animation_class.'" '.$id.' '.$animation_content.'>';
		if($button_1_link != ''){ 
			echo '<a href="'.$button_1_link.'" class="btn btn-'.$button_1_type.' btn-'.$button_1_size.' target="'.$button_1_target.'">'.$button_1_text.'</a>'; 
		}
		if($button_2_link != ''){ 
			echo '<a href="'.$button_2_link.'" class="btn btn-'.$button_2_type.' btn-'.$button_2_size.' target="'.$button_2_target.'">'.$button_2_text.'</a>'; 
		}
	echo '</div>';
}
function tallybuilder_SContent_CSS__button($meta_data, $meta_id, $post_id, $prefix){
	$unique_class = '.'.$prefix.'text'.$post_id;
	
	echo tallybuilder_meta_margin_css($unique_class, $meta_id, $prefix.'margin', $post_id);
	
}
function tallybuilder_SContent_MB__button($meta_data, $meta_id, $post_id, $prefix){
	
	$settings = array(
		'key' => $prefix.'button_1_text',
		'title' => '1st Button Text',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
	);
	tallybuilder_metabox_form_text($settings);
	
	$settings = array(
		'key' => $prefix.'button_1_link',
		'title' => '1st Button Link',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
	);
	tallybuilder_metabox_form_text($settings);
	
	$select_items = array(
		array('title' => 'Normal', 'value' => ''),
		array('title' => 'Small', 'value' => 'sm'),
		array('title' => 'Large', 'value' => 'lg'),
		array('title' => 'Extra Small', 'value' => 'xs'),
	);
	$settings = array(
		'key' => $prefix.'button_1_size',
		'title' => '1st Button Size',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'y',
		'select_items' => $select_items,
	);
	tallybuilder_metabox_form_select($settings);
	
	$select_items = array(
		array('title' => '_self', 'value' => '_self'),
		array('title' => '_blank', 'value' => '_blank'),
	);
	$settings = array(
		'key' => $prefix.'button_1_target',
		'title' => '1st Button Target',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'y',
		'select_items' => $select_items,
	);
	tallybuilder_metabox_form_select($settings);
	
	$select_items = array(
		array('title' => 'white', 'value' => 'white'),
		array('title' => 'black', 'value' => 'black'),
		array('title' => 'primary', 'value' => 'primary'),
		array('title' => 'success', 'value' => 'success'),
		array('title' => 'info', 'value' => 'info'),
		array('title' => 'warning', 'value' => 'warning'),
		array('title' => 'danger', 'value' => 'danger'),
		array('title' => 'link', 'value' => 'link'),
	);
	$settings = array(
		'key' => $prefix.'button_1_type',
		'title' => '1st Button Type',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'y',
		'select_items' => $select_items,
	);
	tallybuilder_metabox_form_select($settings);
	
	echo '<hr /><hr /><hr /><hr />';
	
	$settings = array(
		'key' => $prefix.'button_2_text',
		'title' => '2nd Button Text',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
	);
	tallybuilder_metabox_form_text($settings);
	
	$settings = array(
		'key' => $prefix.'button_2_link',
		'title' => '2nd Button Link',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
	);
	tallybuilder_metabox_form_text($settings);
	
	$select_items = array(
		array('title' => 'Normal', 'value' => ''),
		array('title' => 'Small', 'value' => 'sm'),
		array('title' => 'Large', 'value' => 'lg'),
		array('title' => 'Extra Small', 'value' => 'xs'),
	);
	$settings = array(
		'key' => $prefix.'button_2_size',
		'title' => '2nd Button Size',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'y',
		'select_items' => $select_items,
	);
	tallybuilder_metabox_form_select($settings);
	
	$select_items = array(
		array('title' => '_self', 'value' => '_self'),
		array('title' => '_blank', 'value' => '_blank'),
	);
	$settings = array(
		'key' => $prefix.'button_2_target',
		'title' => '2nd Button Target',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'y',
		'select_items' => $select_items,
	);
	tallybuilder_metabox_form_select($settings);
	
	$select_items = array(
		array('title' => 'primary', 'value' => 'primary'),
		array('title' => 'success', 'value' => 'success'),
		array('title' => 'info', 'value' => 'info'),
		array('title' => 'warning', 'value' => 'warning'),
		array('title' => 'danger', 'value' => 'danger'),
		array('title' => 'link', 'value' => 'link'),
	);
	$settings = array(
		'key' => $prefix.'button_2_type',
		'title' => '2nd Button Type',
		'meta_id' => $meta_id,
		'data' => $meta_data,
		'value' => '',
		'sanitize' => 'sanitize_text_field',
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
		'base_id' => $prefix.'animation',
		'title' => 'Animation',
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