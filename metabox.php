<?php
/*
	Common Metabox for sections
-------------------------------------------------------------*/
function tallybuilder_section_common_metaBox() {
    add_meta_box( 'tallybuilder_section_common_metaBox', 'Section Settings', 'tallybuilder_section_common_metaBox_html', 'tally_builder_c', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'tallybuilder_section_common_metaBox' );

function tallybuilder_section_common_metaBox_html( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'tallybuilder_section_common_metaBox_nonce' );
    $smdata = get_post_meta( $post->ID );
	$tallybuilder_page_id = (isset($_GET['tallybuilder_page_id']) ? $_GET['tallybuilder_page_id'] : NULL);
    ?>
    <p>
    	<?php 
		$id_name = 'section_type';
		$value = '';
		if ( isset ( $smdata[$id_name] ) ) { $value = $smdata[$id_name][0]; }
		$active_it = apply_filters('tallybuilder_active_meta_section_type', false);
		$disabled = ($active_it ? NULL : 'disabled');
		
		$section_items = apply_filters('tallybuilder_sections_list', NULL);
		?>
        <label style="min-width:150px;display:inline-block; font-weight:bold;vertical-align: top;" for="<?php echo $id_name; ?>"><?php _e('Section Type', 'tally-builder'); ?></label>
        <select name="<?php echo $id_name; ?>" id="<?php echo $id_name; ?>" <?php echo $disabled; ?>>
        	<?php if(is_array($section_items)): ?>
            	<?php foreach($section_items as $section_name => $section_location): ?>
            		<option value="text" <?php selected( $value, $section_name ); ?>><?php echo $section_name; ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </p>
    <p>
    	<?php 
		$id_name = 'tallybuilder_parent_page';
		$value = '';
		if ( isset ( $smdata[$id_name] ) ) { $value = $smdata[$id_name][0]; }
		if($tallybuilder_page_id != NULL){ $value = tallybuilder_post_slug($tallybuilder_page_id); }
		?>
        <input type="hidden" name="<?php echo $id_name; ?>" id="<?php echo $id_name; ?>" value="<?php echo $value; ?>"  />
    </p>
    
    <?php  
}


/**
 * Saves the custom meta input
 */
function tallybuilder_section_common_metaBox_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'tallybuilder_section_common_metaBox_nonce' ] ) && wp_verify_nonce( $_POST[ 'tallybuilder_section_common_metaBox_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
	
	$active_it = apply_filters('tallybuilder_active_meta_section_type', false);
	if($active_it){
		$id_name = 'section_type';
		if( isset( $_POST[ $id_name ] ) ) {
			update_post_meta( $post_id, $id_name, sanitize_text_field( $_POST[ $id_name ] ) );
		}
	}
	
	$id_name = 'tallybuilder_parent_page';
	if( isset( $_POST[ $id_name ] ) ) {
        update_post_meta( $post_id, $id_name, sanitize_text_field( $_POST[ $id_name ] ) );
    }
}
add_action( 'save_post', 'tallybuilder_section_common_metaBox_save' );


/*
	Metabox for pages
-------------------------------------------------------------*/
function tallybuilder_page_metaBox() {
    add_meta_box( 'tallybuilder_page_metaBox', 'Builder Layout', 'tallybuilder_page_metaBox_html', 'page', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'tallybuilder_page_metaBox' );

function tallybuilder_page_metaBox_html( $post ) {
	global $wpdb;
	wp_nonce_field( basename( __FILE__ ), 'tallybuilder_page_metaBox_nonce' );
    $smdata = get_post_meta( $post->ID );
    ?>
    <p>
    	<?php 
		$id_name = 'tallybuilder';
		$value = '';
		if ( isset ( $smdata[$id_name] ) ) { $value = $smdata[$id_name][0]; }
		?>
        <label for="<?php echo $id_name; ?>"><?php _e('Builder Page', 'tally-builder'); ?></label>
        <select name="<?php echo $id_name; ?>" id="<?php echo $id_name; ?>">
        	<?php
			echo '<option value="">-- Select a Page --</option>';
			$sections_db = $wpdb->get_results( 'SELECT * FROM '.$wpdb->posts.' WHERE `post_type` = "tally_builder" AND `post_status`="publish"', ARRAY_A  );
			if ( is_array($sections_db) ){
				foreach($sections_db as $section_db){
					echo '<option value="'.$section_db['post_name'].'" '.selected( $value, $section_db['post_name'], false ).'>'.$section_db['post_title'].'</option>';
				}
			}
			?>
        </select>
    </p>
    <?php  
}


/**
 * Saves the custom meta input
 */
function tallybuilder_page_metaBox_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'tallybuilder_page_metaBox_nonce' ] ) && wp_verify_nonce( $_POST[ 'tallybuilder_page_metaBox_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
	
	$id_name = 'tallybuilder';
	if( isset( $_POST[ $id_name ] ) ) {
		update_post_meta( $post_id, $id_name, sanitize_text_field( $_POST[ $id_name ] ) );
	}
}
add_action( 'save_post', 'tallybuilder_page_metaBox_save' );