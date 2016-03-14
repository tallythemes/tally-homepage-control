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
		return $alt_file;
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
	
	$file_path = tallybuilder_get_RAW_file('button.php');
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
	
	$file_path = tallybuilder_get_RAW_file('alert.php');
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
	
	$file_path = tallybuilder_get_RAW_file('progress_bar.php');
	if(file_exists($file_path)){
		ob_start();
			include($file_path);
		return ob_get_clean();
	}
}