<?php
/*
	Grid
--------------------------------------------------*/
function tallybuilder_SContent_HTML__grid($meta_data, $meta_id, $post_id, $prefix){
	$class =  tallybuilder_meta($meta_id, $prefix.'class', $post_id);
	$id =  tallybuilder_meta($meta_id, $prefix.'id', $post_id);
	$grid =  tallybuilder_meta($meta_id, $prefix.'grid', $post_id);
	$unique_class = $prefix.'grid'.$post_id;
	
	$animation_class = tallybuilder_meta_animation_content($meta_id, $prefix.'animation', true, $post_id);
	$animation_content = tallybuilder_meta_animation_content($meta_id, $prefix.'animation', false, $post_id);
	
	if($grid != ''){
		if(function_exists('tallybuilder_raw_grid')){
			echo '<div class="tbhtml_button '.$class.' '.$unique_class.' '.$animation_class.'" '.$id.' '.$animation_content.'>';
				echo tallybuilder_raw_grid(array('slug' => $grid));
			echo '</div>';
		}
	}
}
function tallybuilder_SContent_CSS__grid($meta_data, $meta_id, $post_id, $prefix){
	$unique_class = '.'.$prefix.'grid'.$post_id;
	
	echo tallybuilder_meta_margin_css($unique_class, $meta_id, $prefix.'margin', $post_id);	
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
