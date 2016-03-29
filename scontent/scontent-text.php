<?php
function tallybuilder_SContent_HTML__text($meta_data, $meta_id, $post_id, $prefix){
	$content = ( isset($meta_data[$prefix.'content']) ) ? $meta_data[$prefix.'content'] : '';
	$class = ( isset($meta_data[$prefix.'class']) ) ? $meta_data[$prefix.'class'] : '';
	$id = ( isset($meta_data[$prefix.'id']) ) ? $meta_data[$prefix.'id'] : '';
	$id = ( $id == '' ) ? '' : 'id="'.$id.'"';
	
	$animation_class = tallybuilder_meta_animation_content($meta_id, $prefix.'h1_animation', true, $post_id);
	$animation_content = tallybuilder_meta_animation_content($meta_id, $prefix.'h1_animation', false, $post_id);

	$unique_class = $prefix.'text'.$post_id;
	
	echo '<div class="tbhtml_text '.$class.' '.$unique_class.' '.$animation_class.'" '.$id.' '.$animation_content.'>';
		echo do_shortcode($content);
	echo '</div>';
}
function tallybuilder_SContent_CSS__text($meta_data, $meta_id, $post_id, $prefix){
	$unique_class = '.'.$prefix.'text'.$post_id;
	
	echo tallybuilder_meta_fontStyle_css($unique_class, $meta_id, $prefix.'fontstyle', $post_id);
	echo tallybuilder_meta_linkColor_css($unique_class.' a', $meta_id, $prefix.'linkcolor', $post_id);
	echo tallybuilder_meta_margin_css($unique_class, $meta_id, $prefix.'margin', $post_id);
	
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
	
	
	$settings = array(		
		'base_id' => $prefix.'fontstyle',
		'title' => 'Font Style',
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
