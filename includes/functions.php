<?php
function tallybuilder_css_style($selector, $option, $style){
	if($option != ''){
		echo $selector.'{'.str_replace("%s%", $option, $style).'}'."\n";
	}
}

/*
	Get Post SLUG by a post ID
-----------------------------------------------------------*/
function tallybuilder_post_slug($post_id) {
    $post_data = get_post($post_id, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug; 
}


/*
	Change post status by post ID
-----------------------------------------------------------*/
function tallybuilder_change_post_status($post_id,$status){
    $current_post = get_post( $post_id, 'ARRAY_A' );
    $current_post['post_status'] = $status;
    wp_update_post($current_post);
}



/*
	Get post ID by post SLUG
-----------------------------------------------------------*/
function tallybuilder_post_id_by_slug($slug, $post_type) {
    $data = get_page_by_path(  $slug  , OBJECT, $post_type);
	if ($data) {
		return $data->ID;
	} 
	else {
		return NULL;
	}
}


/*
	Get menu_order by post ID
-----------------------------------------------------------*/
function tallybuilder_get_menu_order_by_id($id) {
	global $wpdb;
    $menu_o = $wpdb->get_var( "SELECT menu_order FROM $wpdb->posts WHERE ID=" . $id  );
	return $menu_o;
}



/**
 * Helper function to return encoded strings
 *
 * @return    string
 *
 * @access    public
 * @since     0.8.3
 */
function tallybuilder_encode( $value ) {

  $func = 'base64' . '_encode';
  return $func( $value );
  
}

/**
 * Helper function to return decoded strings
 *
 * @return    string
 *
 * @access    public
 * @since     0.8.3
 */
function tallybuilder_decode( $value ) {

  $func = 'base64' . '_decode';
  return $func( $value );
  
}



/*
	Check if a SLUG exists of a post, post type or page
-----------------------------------------------------------*/
function tallybuilder_slug_exists($post_name, $post_type = 'post', $parent = NULL) {
    global $wpdb;
	
	$post_type = (!empty($post_type) ? " AND post_type = '".$post_type."'" : NULL);
	$parent = (!empty($parent) ? " AND post_parent = '".$parent."'" : NULL);
	
	$query = $wpdb->get_row("SELECT post_name FROM ".$wpdb->posts." WHERE post_name = '" . $post_name . "' ".$post_type. $parent, 'ARRAY_A');
    if($query) {
        return true;
    } else {
        return false;
    }
}




function tallybuilder_tc(){
	$tn = apply_filters('tallybuilder_tc', NULL);
	$tc = md5(TALLYTHEME_SLUG.'3dev-b');
	
	if($tn == $tc){
		return true;
	}else{
		return false;	
	}
}



/*
	Show CSS padding and margin
-----------------------------------------------------------*/
function tallybuilder_css_margin_padding($option, $m_or_p, $operator = '/', $amount = 2) {
	$output = NULL;
    if($option != ''){
		$option_pe = str_replace("%", "", $option, $count_pe);
		$option_px = str_replace("px", "", $option, $count_px);
		if($count_pe > 0){
			if($operator == '/'){
				$value = $option_pe / $amount;
			}elseif($operator == '*'){
				$value = $option_pe * $amount;
			}
			return $m_or_p.':'.$value.'%;';
			
		}elseif($count_px > 0){
			if($operator == '/'){
				$value = $option_pe / $amount;
			}elseif($operator == '*'){
				$value = $option_pe * $amount;
			}
			return $m_or_p.':'.$value.'px;';
		}
	}
}