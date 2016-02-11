<?php
function tallybuilder_metabox_form_text($meta_id, $data, $key, $title, $value = '', $sanitize = 'sanitize_text_field'){
	
	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, wp_kses_allowed_html('post'));
	}else{
		$value = $sanitize($value);
	}
	
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	echo '<div class="tallybuilder_mb_item">';
		echo '<label for="'. $name.'">'.$title.'</label>';
		echo '<input type="text" name="'. $name.'" id="'. $div_id.'" value="'. $value.'"  />';
	echo '</div>';
}
function tallybuilder_metabox_form_editor($meta_id, $data, $key, $title, $value = '', $sanitize = 'wp_kses'){

	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, wp_kses_allowed_html('post'));
	}else{
		$value = $sanitize($value);
	}
	
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	echo '<div class="tallybuilder_mb_item">';
		echo '<label for="'. $name.'">'.$title.'</label>';
		 wp_editor( $value, $div_id, array('textarea_name' => $name, 'wpautop' => true) );
	echo '</div>';
}
function tallybuilder_metabox_form_select($meta_id, $data, $key, $title, $value = '', $items, $sanitize = 'sanitize_text_field'){

	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, wp_kses_allowed_html('post'));
	}else{
		$value = $sanitize($value);
	}
		
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	if(is_array($items)){
		echo '<div class="tallybuilder_mb_item">';
			echo '<label for="'. $name.'">'.$title.'</label>';
			echo '<select name="'. $name.'" id="'. $div_id.'" />';
				foreach($items as $item){
					echo '<option value="'.$item['value'].'" '.selected( $value, $item['value'], false ).'>'.$item['title'].'</option>';
				}
			echo '</select>';
		echo '</div>';
	}
}
function tallybuilder_metabox_form_color($meta_id, $data, $key, $title, $value = '', $sanitize = 'sanitize_text_field'){
	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, wp_kses_allowed_html('post'));
	}else{
		$value = $sanitize($value);
	}
		
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	echo '<div class="tallybuilder_mb_item">';
		echo '<label for="'. $name.'">'.$title.'</label>';
		echo '<input type="text" name="'. $name.'" id="'. $div_id.'" value="'. $value.'" class="tallybuilder_mb_color" />';
	echo '</div>';
}
function tallybuilder_metabox_form_image($meta_id, $data, $key, $title, $value = '', $sanitize = 'sanitize_text_field'){
	
	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, wp_kses_allowed_html('post'));
	}else{
		$value = $sanitize($value);
	}
		
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	echo '<div class="tallybuilder_mb_item">';
		echo '<label for="'. $name.'">'.$title.'</label>';
		echo '<img id="'. $div_id.'-img" src="'. $value.'" width="200" /><br />';
		echo '<input type="text" name="'. $name.'" id="'. $div_id.'" value="'. $value.'" />';
		echo '<input type="button" name="upload-btn" id="'. $div_id.'-upload-btn" class="button-primary" value="Upload Image">';
		?>
        <script type="text/javascript">
			jQuery(document).ready(function($){
				$('#<?php echo $div_id; ?>-upload-btn').click(function(e) {
					e.preventDefault();
					var image = wp.media({ 
						title: 'Upload Image',
						// mutiple: true if you want to upload multiple files at once
						multiple: false
					}).open()
					.on('select', function(e){
						// This will return the selected image from the Media Uploader, the result is an object
						var uploaded_image = image.state().get('selection').first();
						// We convert uploaded_image to a JSON object to make accessing it easier
						// Output to the console uploaded_image
						console.log(uploaded_image);
						var image_url = uploaded_image.toJSON().url;
						// Let's assign the url value to the input field
						$('#<?php echo $div_id; ?>').val(image_url);
						$('#<?php echo $div_id; ?>-img').attr('src',image_url);
					});
				});
			});
		</script>
        <?php
	echo '</div>';
}
function tallybuilder_metabox_form_4text($meta_id, $data, $base_key, $title, $value = '', $sanitize = 'sanitize_text_field', $fields = array()){

	echo '<div class="tallybuilder_mb_item">';
		echo '<label>'.$title.'</label>';
		if(is_array($fields)){
			foreach($fields as $field){
				
				$div_id = $meta_id.'__'.$base_key.'_'.$field['key'];
				$name = $meta_id.'['.$base_key.'_'.$field['key'].']';
				
				if ( isset ( $data[$base_key.'_'.$field['key']] ) ) { $value = $data[$base_key.'_'.$field['key']]; }
				if($sanitize == 'wp_kses'){ $value = $sanitize($value, wp_kses_allowed_html('post')); }else{ $value = $sanitize($value); }
				echo '<div class="tallybuilder_mb_oneforth">';
					echo '<label for="'.$name.'">'.$field['title'].'</label>';
					echo '<input type="text" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
				echo '</div>';
			}
		}
		echo '<div class="clear clearfix"></div>';
	echo '</div>';
}


function tallybuilder_metabox_form_animation($meta_id, $data, $base_key, $title, $value = '', $items, $sanitize = 'sanitize_text_field'){
	
	echo '<div class="tallybuilder_mb_item">';
		echo '<label>'.$title.'</label>';
		echo '<div class="clear clearfix"></div>';
		if(is_array($items)){				
			$div_id = $meta_id.'__'.$base_key.'_type';
			$name = $meta_id.'['.$base_key.'_type]';
			if ( isset ( $data[$base_key.'_type'] ) ) { $value = $data[$base_key.'_type']; }
			if($sanitize == 'wp_kses'){ $value = $sanitize($value, wp_kses_allowed_html('post')); }else{ $value = $sanitize($value); }
			echo '<div class="tallybuilder_mb_oneforth">';
				echo '<label for="'.$name.'">Type</label>';
				echo '<select name="'. $name.'" id="'. $div_id.'" />';
					foreach($items as $item){
						echo '<option value="'.$item['value'].'" '.selected( $value, $item['value'], false ).'>'.$item['title'].'</option>';
					}
				echo '</select>';
				//echo $value.'s'.$data[$base_key.'_type'];
			echo '</div>';
			
			$div_id = $meta_id.'__'.$base_key.'_duration';
			$name = $meta_id.'['.$base_key.'_duration]';
			if ( isset ( $data[$base_key.'_duration'] ) ) { $value = $data[$base_key.'_duration']; }
			if($sanitize == 'wp_kses'){ $value = $sanitize($value, wp_kses_allowed_html('post')); }else{ $value = $sanitize($value); }
			echo '<div class="tallybuilder_mb_oneforth">';
				echo '<label for="'.$name.'">Duration</label>';
				echo '<input type="text" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
			echo '</div>';
			
			$div_id = $meta_id.'__'.$base_key.'_delay';
			$name = $meta_id.'['.$base_key.'_delay]';
			if ( isset ( $data[$base_key.'_delay'] ) ) { $value = $data[$base_key.'_delay']; }
			if($sanitize == 'wp_kses'){ $value = $sanitize($value, wp_kses_allowed_html('post')); }else{ $value = $sanitize($value); }
			echo '<div class="tallybuilder_mb_oneforth">';
				echo '<label for="'.$name.'">Delay</label>';
				echo '<input type="text" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
			echo '</div>';
		}
		echo '<div class="clear clearfix"></div>';
	echo '</div>';
}


function tallybuilder_metabox_form_save($post_id, $meta_id, $sanitize = 'wp_kses'){
	if( isset( $_POST[ $meta_id ] ) ) {
		
		if($sanitize == 'wp_kses'){
        	update_post_meta( $post_id, $meta_id, $sanitize( $_POST[ $meta_id ], wp_kses_allowed_html('post') ) );
		}else{
			update_post_meta( $post_id, $meta_id, $sanitize( $_POST[ $meta_id ] ) );
		}
    }
}


function tallybuilder_meta($meta_id, $key, $post_id = NULL, $sanitize = 'wp_kses'){
	if($post_id == NULL){
		$post_id = get_the_ID();
	}
	
	$data = get_post_meta($post_id, $meta_id, true);
	
	if(isset($data[$key])){ $data = $data[$key]; }else{ $data = NULL; }
	
	if($sanitize == 'wp_kses'){
		return $sanitize($data, wp_kses_allowed_html('post') );
	}else{
		return $sanitize($data);
	}
}