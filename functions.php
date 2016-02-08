<?php
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


function tallybuilder_get_section_file($file, $alt_file = NULL ){
	$child = get_stylesheet_directory().'/inc/tallybuilder/sections//'.$file;
	$parent = get_template_directory().'/inc/tallybuilder/sections/'.$file;
	$plugin = TALLYBUILDER__SECTIONS_DIR.$file;
	
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



/*
	Import a Page data from array
-----------------------------------------------------------*/
function tallybuilder_import_page_from_array($page_data){
	$insert_page = NULL;
	if(is_array($page_data)){
		$data = array(
			'post_title' => wp_strip_all_tags($page_data['title']),
			'post_content' => $page_data['content'],
			'post_status' => 'publish',
			'post_type' => 'tally_builder'
		);
		$insert_page = wp_insert_post($data);
		$page_slug = tallybuilder_post_slug($insert_page);
		
		if(is_array($page_data['sections'])){
			foreach($page_data['sections'] as $section){
				$data = array(
					'post_title' => wp_strip_all_tags($section['title']),
					'post_content' => $section['content'],
					'post_status' => 'publish',
					'post_type' => 'tally_builder_c'
				);
				$insert_section = wp_insert_post($data);
				
				update_post_meta($insert_section, 'tallybuilder_parent_page', $page_slug);
				update_post_meta($insert_section, 'section_type', $section['section_type']);
				update_post_meta($insert_section, 'tbsf_'.$section['section_type'], $section['meta']);
			}
		}
	}
	return $insert_page;
}




/*
	Show PRE-Built pages import button above the page list
-----------------------------------------------------------*/
function tallybuilder_prebuild_pages(){
	$pages_list = apply_filters('tallybuilder_prebuild_pages', NULL);
	
	if(is_array($pages_list)){
		echo '<div class="clear" style="height: 20px;"></div>';
		echo '<h4 style="margin-bottom: 5px; margin-top: 0;">Pre-Built Pages</h4>';
		foreach($pages_list as $page){
			if(file_exists($page['file'])){
				include($page['file']);
				$link = esc_url(admin_url('admin.php?page=tallybuilder&action=import_page&page_slug='.$page['slug']));
				$title = "Click to Import";
				$disabled = '';
				
				if(tallybuilder_slug_exists($page['slug'], 'tally_builder')){
					$link = "#";
					$title = "Already Imported";
					$disabled = "disabled";
				}
				echo '<a href="'.$link.'" class="button '.$disabled.'" title="'.$title.'">'.$page_data['title'].'</a>';
			}
		}
	}
}


/*
	Get a page data in a ARRAY
-----------------------------------------------------------*/
function tallybuilder_get_page_array_by_id($page_id){
	global $wpdb;
	$page_data = array();
	
	$page = $wpdb->get_row( 'SELECT * FROM '.$wpdb->posts.' WHERE `ID` = "'.$page_id.'"', OBJECT );
	$page_slug = $page->post_name;
	
	$page_data['title'] = $page->post_title;
	$page_data['content'] = $page->post_content;
	$page_data['sections'] = array();
	
	$sections_db = $wpdb->get_results( 'SELECT * FROM '.$wpdb->postmeta.' WHERE `meta_key` = "tallybuilder_parent_page" AND `meta_value`="'.$page_slug.'"', ARRAY_A  );
	
	if ( is_array($sections_db) ){
		foreach($sections_db as $section_db){
			$section_id = $section_db['post_id'];
			$section_type = get_post_meta( $section_id, 'section_type', true );
			$section_array = array(
				'title' => get_the_title($section_id),
				'content' => get_the_content($section_id),
				'section_type' => $section_type,
				'meta' => get_post_meta( $section_id, 'tbsf_'.$section_type, true ),
			);
			$page_data['sections'][] = $section_array;
		}
	}
	
	return $page_data;
}



/*
	Generate an ARRY from a page. This array will help to import a page
-----------------------------------------------------------*/
function tallybuilder_get_page_text_array($page_id){
	$output = '';
	global $wpdb;
	
	$page = $wpdb->get_row( 'SELECT * FROM '.$wpdb->posts.' WHERE `ID` = "'.$page_id.'"', OBJECT );
	
	$page_tiltle = $page->post_title;
	$page_content = $page->post_content;
	$page_slug = $page->post_name;
	
	$sections_db = $wpdb->get_results( 'SELECT * FROM '.$wpdb->postmeta.' WHERE `meta_key` = "tallybuilder_parent_page" AND `meta_value`="'.$page_slug.'"', ARRAY_A  );
	
	//print_r($section_ids);
	
	$output .= '<?php'."\n" . '$page_data = array('. "\n";
		$output .= "\t" . "'title' => '".str_replace("'","\'",$page_tiltle)."'," . "\n";
		$output .= "\t" . "'content' => '".str_replace("'","\'",$page_content)."'," . "\n";
		$output .= "\t" . "'sections' => array(". "\n";
				if ( is_array($sections_db) ):
					 foreach($sections_db as $section_db):
					 	$section_id = $section_db['post_id'];
					 	$output .= "\t" . "\t" .'array('. "\n";
						$output .= "\t" . "\t" . "\t" . "'title' => '".str_replace("'","\'",get_the_title($section_id))."'," . "\n";
						$output .= "\t" . "\t" . "\t" . "'content' => '".str_replace("'","\'",get_the_content($section_id))."'," . "\n";
						$output .= "\t" . "\t" . "\t" . "'section_type' => '".get_post_meta( $section_id, 'section_type', true )."'," . "\n";
						$output .= "\t" . "\t" . "\t" . "'meta' => array(" . "\n";
							$section_type = get_post_meta( $section_id, 'section_type', true );
							$metas = get_post_meta( $section_id, 'tbsf_'.$section_type, true );
							if(is_array($metas)){
								foreach($metas as $key => $meta){
									if(is_array($meta)){
										$output .= "\t" . "\t" . "\t" . "\t" . "'".$key."' => array" . "\n";
											foreach($meta as $key_in => $meta_in){
												$output .= "\t" . "\t" . "\t" . "\t" . "\t" . "\t" . "'".$key_in."' => '".str_replace("'","\'",$key_in)."'," . "\n";
											}
										$output .= "\t" . "\t" . "\t" . "\t" . ")," . "\n";
									}else{
										$output .= "\t" . "\t" . "\t" . "\t" . "'".$key."' => '".str_replace("'","\'",$meta)."'," . "\n";
									}
								}
							}
						$output .= "\t" . "\t" . "\t" . ")," . "\n";
						$output .= "\t" . "\t" .")," . "\n";
					 endforeach;
				 endif;
		$output .= "\t" . ")," . "\n";
	$output .= ');';
	return $output;
}




function tallybuilder_get_prebuild_php_code_in_admin($id){
	if(defined('TALLYBUILDER__DEBUG')){
		add_thickbox();
		echo '<a href="#TB_inline?width=600&height=550&inlineId=prebuild_php_code_'.$id.'" class="thickbox">Get PHP Code</a>';
		echo '<div id="prebuild_php_code_'.$id.'" style="display:none;">';
			echo '<p><textarea style="height: 500px; width: 100%;">'.tallybuilder_get_page_text_array($id).'</textarea></p>';
		echo '</div>';
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




/*
	Ajax request processing for Section Ordering
-----------------------------------------------------------*/
add_action( 'wp_ajax_tallybuilder_section_order', 'tallybuilder_section_ajax_order' );
function tallybuilder_section_ajax_order(){
	global $wpdb;             
	parse_str($_POST['order'], $data);
	if (is_array($data)){
		foreach($data as $key => $values ){
			if ( $key == 'item' ){
				foreach( $values as $position => $id ){
					$data = array('menu_order' => $position);
					//$data = apply_filters('post-types-order_save-ajax-order', $data, $key, $id);
					$wpdb->update( $wpdb->posts, $data, array('ID' => $id) );
				} 
			}else{
				foreach( $values as $position => $id ){
					$data = array('menu_order' => $position, 'post_parent' => str_replace('item_', '', $key));
					$data = apply_filters('post-types-order_save-ajax-order', $data, $key, $id);
					$wpdb->update( $wpdb->posts, $data, array('ID' => $id) );
				}
			}
		} 
	}
	exit;
}


/*
	Seup front page in one click Action
-----------------------------------------------------------*/
function tallybuilder_admin_action_set_as_home_page(){
	$action = (isset($_GET['action']) ? $_GET['action'] : NULL);
	$tallybuilder_page_id = (isset($_GET['tallybuilder_page_id']) ? $_GET['tallybuilder_page_id'] : NULL);
	$is_page = false;
	$page_id = tallybuilder_post_id_by_slug('builder-home-page', 'page');
	
	if(($action == 'set_as_home_page') && ($tallybuilder_page_id > 0)){
		if(!tallybuilder_slug_exists('builder-home-page', 'page')){
			$post_data = array(
				'post_title' => 'Builder Home Page',
				'post_content' => 'Content will show from page builder',
				'post_status' => 'publish',	
				'post_type' => 'page'
			);
			$page_id = wp_insert_post($post_data);
		}
		if($page_id > 0){
			update_post_meta($page_id, 'tallybuilder', tallybuilder_post_slug($tallybuilder_page_id));
			update_post_meta($page_id, '_wp_page_template', 'template-builder.php');
			update_option('show_on_front', 'page');
			update_option('page_on_front', $page_id);
			echo '<div id="message" class="updated notice notice-success is-dismissible">';
				echo '<p>'.__('Home page is ready', 'tally-builder').' <a href="'.home_url('/').'">'.__('See it Now', 'tally-builder').'</a></p>';
				echo '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';
			echo '</div>';
		}
	}
}


/*
	Action for Import Prebuild page
-----------------------------------------------------------*/
function tallybuilder_admin_action_import_prebuild_page(){
	$pages_list = apply_filters('tallybuilder_prebuild_pages', NULL);
	$action = (isset($_GET['action']) ? $_GET['action'] : NULL);
	$page_slug = (isset($_GET['page_slug']) ? $_GET['page_slug'] : NULL);
	
	if(is_array($pages_list)){
		foreach($pages_list as $page){
			if($page['slug'] == $page_slug){
				if(file_exists($page['file'])){
					include($page['file']);
					tallybuilder_import_page_from_array($page_data);
				}
			}
		}
	}
}


/*
	Action for Create a New page
-----------------------------------------------------------*/
function tallybuilder_admin_action_newPage(){
	if(isset( $_POST['tallybuilder_new_page_field'] )){
		if(wp_verify_nonce( $_POST['tallybuilder_new_page_field'], 'tallybuilder_new_page_action' )){
			if(isset($_POST['title']) && $_POST['title'] != ''){
				// Add the content of the form to $post as an array
				$post_data = array(
					'post_title' => wp_strip_all_tags($_POST['title']),
					'post_content' => $_POST['description'],
					'post_status' => 'publish',			// Choose: publish, preview, future, etc.
					'post_type' => 'tally_builder'  // Use a custom post type if you want to
				);
				$wp_insert_post = wp_insert_post($post_data);
				
				if($wp_insert_post > 1){
					$page_edit_url =  esc_url(admin_url('admin.php?page=tallybuilder&view=sections&tallybuilder_page_id='.$wp_insert_post));
					echo '<div id="message" class="updated notice notice-success is-dismissible">';
						echo '<p>'.__('New Page Created.', 'tally-builder').' <a href="'.$page_edit_url.'">'.__('Edit it Now', 'tally-builder').'</a></p>';
						echo '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';
					echo '</div>';
				}
			}
		}else{
			_e('Sorry, your nonce did not verify.', 'tally-builder');
		}
	}
}



/*
	Action for Import a New page
-----------------------------------------------------------*/
function tallybuilder_admin_action_import_page(){
	if(isset( $_POST['tallybuilder_import_page_field'] )){
		if(wp_verify_nonce( $_POST['tallybuilder_import_page_field'], 'tallybuilder_import_page_action' )){
			if(isset($_POST['page_import_data']) && $_POST['page_import_data'] != ''){
				
				$page_import = tallybuilder_import_page_from_array(unserialize( tallybuilder_decode( $_POST['page_import_data'] ) ));
				
				if($page_import > 1){
					$page_edit_url =  esc_url(admin_url('admin.php?page=tallybuilder&view=sections&tallybuilder_page_id='.$page_import));
					echo '<div id="message" class="updated notice notice-success is-dismissible">';
						echo '<p>'.__('New Page Created.', 'tally-builder').' <a href="'.$page_edit_url.'">'.__('Edit it Now', 'tally-builder').'</a></p>';
						echo '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';
					echo '</div>';
				}
			}
		}else{
			_e('Sorry, your nonce did not verify.', 'tally-builder');
		}
	}
}


/*
	Action for Delete a Page
-----------------------------------------------------------*/
function tallybuilder_admin_action_deletePage(){
	$action = (isset($_GET['action']) ? $_GET['action'] : NULL);
	$tallybuilder_page_id = (isset($_GET['tallybuilder_page_id']) ? $_GET['tallybuilder_page_id'] : NULL);
	$tallybuilder_page_slug = tallybuilder_post_slug($tallybuilder_page_id);
	$page = (isset($_GET['page']) ? $_GET['page'] : NULL);
	
	
	if(($action == 'delete_page') && ($page == 'tallybuilder') && ($tallybuilder_page_id != NULL)){
		$post_title = get_the_title($tallybuilder_page_id);

		if(wp_delete_post($tallybuilder_page_id)){
			$tpost_query_args = array(
				'post_type' => 'tally_builder_c',
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key'     => 'tallybuilder_parent_page',
						'value'   => $tallybuilder_page_slug,
						'compare' => 'LIKE',
					),
				),
			);
			$tpost_query = new WP_Query( $tpost_query_args );
			if ( $tpost_query->have_posts() ){
				while ( $tpost_query->have_posts() ){ $tpost_query->the_post();
					wp_delete_post(get_the_ID());
				}
			}
		
			echo '<div id="message" class="updated notice notice-success is-dismissible">';
				echo '<p> <strong>'.$post_title.'</strong> '.__('has been deleted.', 'tally-builder').'</p>';
				echo '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';
			echo '</div>';
		}
			
	}
}


/*
	Action for Delete a Section
-----------------------------------------------------------*/
function tallybuilder_admin_action_deleteSection(){
	$action = (isset($_GET['action']) ? $_GET['action'] : NULL);
	$section_id = (isset($_GET['section_id']) ? $_GET['section_id'] : NULL);
	$page = (isset($_GET['page']) ? $_GET['page'] : NULL);
	
	
	if(($action == 'delete_section') && ($page == 'tallybuilder') && ($section_id != NULL)){
		$post_title = get_the_title($section_id);
		if(wp_delete_post($section_id)){
			echo '<div id="message" class="updated notice notice-success is-dismissible">';
				echo '<p> <strong>'.$post_title.'</strong> '.__('has been deleted.', 'tally-builder').'</p>';
				echo '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';
			echo '</div>';
		}
	}
}


/*
	Action for Disable a Section
-----------------------------------------------------------*/
function tallybuilder_admin_action_disableSection(){
	$action = (isset($_GET['action']) ? $_GET['action'] : NULL);
	$section_id = (isset($_GET['section_id']) ? $_GET['section_id'] : NULL);
	$page = (isset($_GET['page']) ? $_GET['page'] : NULL);
	
	
	if(($action == 'disable_section') && ($page == 'tallybuilder') && ($section_id != NULL)){
		$post_title = get_the_title($section_id);
		if(update_post_meta($section_id, 'section_disable', 'yes')){
			echo '<div id="message" class="updated notice notice-success is-dismissible">';
				echo '<p> <strong>'.$post_title.'</strong> '.__('has been disabled.', 'tally-builder').'</p>';
				echo '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';
			echo '</div>';
		}
	}
}



/*
	Action for enable a section
-----------------------------------------------------------*/
function tallybuilder_admin_action_enableSection(){
	$action = (isset($_GET['action']) ? $_GET['action'] : NULL);
	$section_id = (isset($_GET['section_id']) ? $_GET['section_id'] : NULL);
	$page = (isset($_GET['page']) ? $_GET['page'] : NULL);
	
	
	if(($action == 'enable_section') && ($page == 'tallybuilder') && ($section_id != NULL)){
		$post_title = get_the_title($section_id);
		if(update_post_meta($section_id, 'section_disable', 'no')){
			echo '<div id="message" class="updated notice notice-success is-dismissible">';
				echo '<p> <strong>'.$post_title.'</strong> '.__('has been enabled.', 'tally-builder').'</p>';
				echo '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';
			echo '</div>';
		}
	}
}


/*
	Display Page list
-----------------------------------------------------------*/
function tallybuilder_admin_html_pagesList(){
	?>
	<h1><?php _e('Builder Pages', 'tally-builder'); ?></h1>
    <?php do_action('tallybuilder_page_list_before'); ?>
    <?php tallybuilder_admin_action_import_prebuild_page(); ?>
    <?php tallybuilder_admin_action_set_as_home_page(); ?>
    <?php tallybuilder_prebuild_pages(); ?>
 	<table class="wp-list-table widefat fixed striped posts" style="margin-top:20px;">
		<thead>
			<tr>
				<td><?php _e('Pages', 'tally-builder'); ?></td>
				<td><?php _e('Actions', 'tally-builder'); ?></td>
				<td><?php _e('Description', 'tally-builder'); ?></td>
			</tr>
		</thead>
        <tbody id="the-list">
			<?php
				wp_reset_postdata();
                $tpost_query_args = array(
                    'post_type' => 'tally_builder',
                    'posts_per_page' => -1,
                );
                $tpost_query = new WP_Query( $tpost_query_args );
            ?>
        	<?php if ( $tpost_query->have_posts() ): ?>
				<?php while ( $tpost_query->have_posts() ): $tpost_query->the_post(); ?>
                    <?php 
						$page_edit_url =  esc_url(admin_url('admin.php?page=tallybuilder&view=sections&tallybuilder_page_id='.get_the_ID()));
						$set_home_url =  esc_url(admin_url('admin.php?page=tallybuilder&action=set_as_home_page&tallybuilder_page_id='.get_the_ID())); 
					?>
                    <tr>
                        <td><strong><a href="<?php echo $page_edit_url; ?>"><?php the_title(); ?></a></strong></td>
                        <td>
                        	<a href="<?php echo $page_edit_url; ?>"><?php _e('Edit', 'tally-builder'); ?></a> | 
                            <a href="<?php echo $set_home_url; ?>" onclick="return confirm('You are going to Setup this page as the home page of your site!');"><?php _e('Set As Home', 'tally-builder'); ?></a> | 
                            <?php tallybuilder_get_prebuild_php_code_in_admin(get_the_ID()); ?>
                            <?php do_action('tallybuilder_page_action_menu');  ?>
                        </td>
                        <td><?php the_content(); ?></td>
                    </tr>
                <?php endwhile; ?>
			<?php 
			endif; 
			wp_reset_postdata();
			?>
		</tbody>
	</table>
    <?php do_action('tallybuilder_page_list_after'); ?>
    <?php
}




/*
	Display Section list
-----------------------------------------------------------*/
function tallybuilder_admin_html_editPage(){
	$tallybuilder_page_id = (isset($_GET['tallybuilder_page_id']) ? $_GET['tallybuilder_page_id'] : NULL);
	?>
    
	<h1 style="margin-bottom:15px;"><?php _e('Edit: ', 'tally-builder'); echo get_the_title($_GET['tallybuilder_page_id']); ?></h1>
    
    <?php do_action('tallybuilder_sections_list_before'); ?>
    <?php
    	tallybuilder_admin_action_disableSection(); 
		tallybuilder_admin_action_enableSection();
	?>
    <table class="wp-list-table widefat fixed striped posts" style="margin-top:20px;">
		<thead>
			<tr>
				<td><?php _e('Sections', 'tally-builder'); ?></td>
				<td><?php _e('Actions', 'tally-builder'); ?></td>
				<td><?php _e('Description', 'tally-builder'); ?></td>
			</tr>
		</thead>
        <tbody id="the-list" class="sortable">
			<?php
				wp_reset_postdata();
                $tpost_query_args = array(
                    'post_type' => 'tally_builder_c',
                    'posts_per_page' => -1,
					'orderby' => 'menu_order',
					'order' => 'ASC',
                );
                $tpost_query = new WP_Query( $tpost_query_args );
            ?>
        	<?php if ( $tpost_query->have_posts() ): ?>
				<?php while ( $tpost_query->have_posts() ): $tpost_query->the_post(); ?>
                	<?php if(get_post_meta(get_the_ID(), 'tallybuilder_parent_page', true) == tallybuilder_post_slug($tallybuilder_page_id)): ?>
						<?php 
                        $section_edit_url =  esc_url(admin_url('post.php?post='.get_the_ID().'&action=edit&tallybuilder_page_id='.$tallybuilder_page_id));
						$section_disable_url = esc_url(admin_url('admin.php?page=tallybuilder&action=disable_section&section_id='.get_the_ID().'&tallybuilder_page_id='.$tallybuilder_page_id.'&view=sections'));
						$section_enable_url = esc_url(admin_url('admin.php?page=tallybuilder&action=enable_section&section_id='.get_the_ID().'&tallybuilder_page_id='.$tallybuilder_page_id.'&view=sections'));
                        ?>
                        <tr id="item_<?php the_ID(); ?>">
                            <td><strong><a href="<?php echo $section_edit_url; ?>"><?php the_title(); ?></a></strong></td>
                            <td>
                            	<a href="<?php echo $section_edit_url; ?>"><?php _e('Edit', 'tally-builder'); ?></a> | 
                                <?php
									if(get_post_meta(get_the_ID(), 'section_disable', true) == 'yes'){
										echo 'This Section is currently Disabled <a href="'.$section_enable_url.'">'.__('Enable it', 'tally-builder').'</a>';
									}else{
										echo '<a href="'.$section_disable_url.'">'.__('Disable', 'tally-builder').'</a>';
									}
								?>
                                <?php do_action('tallybuilder_section_action_menu'); ?>
                            </td>
                            <td><?php the_content(); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
			<?php 
			endif; 
			wp_reset_postdata();
			?>
		</tbody>
	</table>
    <?php do_action('tallybuilder_sections_list_after'); ?>
    <?php
}