<?php
function tallybuilder_get_RAW_file($file, $alt_file = NULL ){
	$child = get_stylesheet_directory().'/inc/tb-raw/'.$file;
	$parent = get_template_directory().'/inc/tb-raw/'.$file;
	$plugin = TALLYBUILDER__RAW_DIR.$file;
	
	if(file_exists($child)){
		return $child;
	}elseif(file_exists($parent)){
		return $parent;
	}elseif(file_exists($plugin)){
		return $plugin;	
	}else{
		return $alt_file.$file;
	}
}


function tallybuilder_raw_alt_file_dri($name){
	$files = apply_filters('tallybuilder_raw_alt_file_dri', NULL);
	
	if(isset($files[$name])){
		return $files[$name];
	}
}




/*	Button
-----------------------------------*/
add_shortcode('tb_button', 'tallybuilder_raw_button');
function tallybuilder_raw_button($atts , $content = NULL){
	$args = shortcode_atts(array(
		'link' => '#',
		'text' => 'Button',
		'target' => '_self',
		'size' => 'lg', //lg, sm, xs
		'type' => 'primary', //default, primary, success, info, warning, danger, link
		'block' => '', //yes, no
		'class' => '',
		'div_id' => '',
		'rel' => '',
		'title' => '',
		'css' => '', //inline css style
	), $atts );
	
	$file_path = tallybuilder_get_RAW_file('button.php', tallybuilder_raw_alt_file_dri('button'));
	if(file_exists($file_path)){
		ob_start();
			include($file_path);
		return ob_get_clean();
	}
}




/*	Alert
-----------------------------------*/
add_shortcode('tb_alert', 'tallybuilder_raw_alert');
function tallybuilder_raw_alert($atts , $content = NULL){
	$args = shortcode_atts(array(
		'type' => 'success', //success, info, warning, danger
		'class' => '',
		'div_id' => '',
		'rel' => '',
		'css' => '', //inline css style
		'dismissible' => 'yes',
		'content' =>'',
	), $atts );
	
	if($content != NULL){
		$args['content'] = $content;
	}
	
	$file_path = tallybuilder_get_RAW_file('alert.php', tallybuilder_raw_alt_file_dri('alert'));
	if(file_exists($file_path)){
		ob_start();
			include($file_path);
		return ob_get_clean();
	}
}




/*	Progress Bar
-----------------------------------*/
add_shortcode('tb_progress_bar', 'tallybuilder_raw_progress_bar');
function tallybuilder_raw_progress_bar($atts , $content = NULL){
	$args = shortcode_atts(array(
		'type' => 'success', //success, info, warning, danger
		'class' => '',
		'div_id' => '',
		'rel' => '',
		'width' => '70',
		'css' => '', //inline css style
		'content' =>'',
		'striped' =>'yes',
		'animated' =>'yes',
	), $atts );
	
	if($content != NULL){
		$args['content'] = $content;
	}
	
	$file_path = tallybuilder_get_RAW_file('progress_bar.php', tallybuilder_raw_alt_file_dri('progress_bar'));
	if(file_exists($file_path)){
		ob_start();
			include($file_path);
		return ob_get_clean();
	}
}




/*	Grid
-----------------------------------*/
add_shortcode('tb_grid', 'tallybuilder_raw_grid');
function tallybuilder_raw_grid($atts , $content = NULL){
	$args = shortcode_atts(array(
		'slug' => '',
		'div_class' => '', 
	), $atts );
	
	$post_id = tallybuilder_post_id_by_slug($args['slug'], 'tt_grid');
	$style_type = get_post_meta($post_id, 'type_tt', true);
	
	$file_path = tallybuilder_get_RAW_file('grid-'.$style_type.'.php', tallybuilder_raw_alt_file_dri('grid_'.$style_type) ); 
	if(file_exists($file_path)){
		ob_start();
			include($file_path);
		return ob_get_clean();
	}else{
		return $style_type.' only available in PRO version';	
	}
}