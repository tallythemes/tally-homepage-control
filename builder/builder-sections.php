<?php
$sections = tallybuilder_registered_sections();
if(is_array($sections)){
	foreach($sections as $name => $location){
		
		$metabox_file_name = $name.'/'.$name.'-config.php';
		$metabox_file = tallybuilder_get_section_file($metabox_file_name , $location.$metabox_file_name );
		if( file_exists($metabox_file) ){ include($metabox_file); }
		
		$metabox_file_name = $name.'/'.$name.'-metabox.php';
		$metabox_file = tallybuilder_get_section_file($metabox_file_name , $location.$metabox_file_name );
		if( file_exists($metabox_file) ){ include($metabox_file); }
	}
}


function tallybuilder_single_section_html($n){
	$sections = tallybuilder_registered_sections();
	
	if(is_array($sections)){
		foreach($sections as $name => $location){
			if($name == $n){
				$file_name = $name.'/'.$name.'-config.php';
				$file = tallybuilder_get_section_file($file_name , $location.$file_name );
				if( file_exists($file) ){ include($file); }
				
				$file_name = $name.'/'.$name.'-html.php';
				$file = tallybuilder_get_section_file($file_name , $location.$file_name );
				if( file_exists($file) ){ include($file); }
			}
		}
	}
}


function tallybuilder_single_section_css($n){
	$sections = tallybuilder_registered_sections();
	
	if(is_array($sections)){
		foreach($sections as $name => $location){
			if($name == $n){
				$file_name = $name.'/'.$name.'-config.php';
				$file = tallybuilder_get_section_file($file_name , $location.$file_name );
				if( file_exists($file) ){ include($file); }
				
				$file_name = $name.'/'.$name.'-css.php';
				$file = tallybuilder_get_section_file($file_name , $location.$file_name );
				if( file_exists($file) ){ include($file); }
			}
		}
	}
}