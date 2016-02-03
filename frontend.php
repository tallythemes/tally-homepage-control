<?php
function tallybuilder_html($this_page_id){
	//echo '<textarea style="height:400px;">'.tallybuilder_get_page_in_array(86).'</textarea>';
	wp_reset_postdata();
	$page_slug = get_post_meta($this_page_id, 'tallybuilder', true);
	$tpost_query_args = array(
		'post_type' => 'tally_builder_c',
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key'     => 'tallybuilder_parent_page',
				'value'   => $page_slug,
				'compare' => 'LIKE',
			),
		),
	);
	$tpost_query = new WP_Query( $tpost_query_args );	
	
	if ( $tpost_query->have_posts() ){
		 while ( $tpost_query->have_posts() ){ $tpost_query->the_post();
			$section_function = 'tallytbs_'.get_post_meta(get_the_ID(), 'section_type', true).'_html';
			if(function_exists($section_function)){
				$section_function();
			}
		 }
	}
	wp_reset_postdata();
	
	
}


function tallybuilder_css($this_page_id){
	
	wp_reset_postdata();
	$page_slug = get_post_meta($this_page_id, 'tallybuilder', true);
	$tpost_query_args = array(
		'post_type' => 'tally_builder_c',
		'meta_query' => array(
			array(
				'key'     => 'tallybuilder_parent_page',
				'value'   => $page_slug,
				'compare' => 'LIKE',
			),
		),
	);
	$tpost_query = new WP_Query( $tpost_query_args );	
	
	if ( $tpost_query->have_posts() ){
		 while ( $tpost_query->have_posts() ){ $tpost_query->the_post();
			$section_function = 'tallytbs_'.get_post_meta(get_the_ID(), 'section_type', true).'_css';
			if(function_exists($section_function)){
				$section_function();
			}
			 
		 }
		
	}
	wp_reset_postdata();
}



add_action('wp_head', 'tallybuilder_css_on_head');
function tallybuilder_css_on_head(){
	echo '<style type="text/css">';	
		tallybuilder_css(get_the_ID());
	echo '</style>';
}