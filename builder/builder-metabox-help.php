<?php
function tallybuilder_wp_kses_allowed_html(){
	global $allowedposttags;
	
	$tags = $allowedposttags;
	
	$tags['iframe'] = array(
		'src' => true,
		'width' => true,
		'height' => true,
		'frameborder' => true,
		'style' => true,
		'allowfullscreen' => true,
		'class' => true,
		'id' => true,
	);
	
	return $tags;
}
function tallybuilder_metabox_form_text($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'n',
	), $settings ));
		
	
	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, tallybuilder_wp_kses_allowed_html());
	}else{
		$value = $sanitize($value);
	}
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }
	
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }
	
	echo '<div class="tallybuilder_mb_item item-warning-'.$pp.'">';
		echo '<label for="'. $name.'">'.$title.'</label>';
		if($pp){
			echo '<input type="hidden" name="'. $name.'" id="'. $div_id.'" value="'. $value.'"  />';
			echo '<input type="text" placeholder="'. $value.'" disabled="disabled"/>';
			echo '<span class="robin">Available on Pro Version Only Only</span>';
		}else{
			echo '<input type="text" name="'. $name.'" id="'. $div_id.'" value="'. $value.'"  />';
			
		}
	echo '</div>';
}
function tallybuilder_metabox_form_textarea($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'n',
	), $settings ));
		
	
	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, tallybuilder_wp_kses_allowed_html());
	}else{
		$value = $sanitize($value);
	}
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }
	
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }
	
	echo '<div class="tallybuilder_mb_item item-warning-'.$pp.'">';
		echo '<label for="'. $name.'">'.$title.'</label>';
		if($pp){
			echo '<input type="hidden" name="'. $name.'" id="'. $div_id.'" value="'. $value.'"  />';
			echo '<textarea placeholder="'. $value.'" disabled="disabled"></textarea>';
			echo '<span class="robin">Available on Pro Version Only Only</span>';
		}else{
			echo '<textarea name="'. $name.'" id="'. $div_id.'" style="width:100%; height:70px;">'. $value.'</textarea>';			
		}
	echo '</div>';
}
function tallybuilder_metabox_form_editor($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'wp_kses',
		'p' => 'n',
	), $settings ));

	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, tallybuilder_wp_kses_allowed_html());
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

function tallybuilder_metabox_form_select($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'n',
		'select_items' => '',
	), $settings ));
	
	$items = $select_items;

	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, tallybuilder_wp_kses_allowed_html());
	}else{
		$value = $sanitize($value);
	}
		
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }
	
	if(is_array($items)){
		echo '<div class="tallybuilder_mb_item item-warning-'.$pp.'">';
			echo '<label for="'. $name.'">'.$title.'</label>';
			if($pp){
				echo '<input type="hidden" name="'. $name.'" id="'. $div_id.'" value="'. $value.'"  />';
				echo '<span class="robin">Available on Pro Version Only Only</span>';
				echo '<select disabled="disabled">';
					echo '<option>'.$value.'</option>';
				echo '</select>';
			}else{
				echo '<select name="'. $name.'" id="'. $div_id.'" >';
					foreach($items as $item){
						echo '<option value="'.$item['value'].'" '.selected( $value, $item['value'], false ).'>'.$item['title'].'</option>';
					}
				echo '</select>';
			}
		echo '</div>';
	}
}
function tallybuilder_metabox_form_post_select($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'n',
		'post_type' => '',
	), $settings ));
	

	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, tallybuilder_wp_kses_allowed_html());
	}else{
		$value = $sanitize($value);
	}
		
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }
	
	echo '<div class="tallybuilder_mb_item item-warning-'.$pp.'">';
		echo '<label for="'. $name.'">'.$title.'</label>';
		if($pp){
			echo '<input type="hidden" name="'. $name.'" id="'. $div_id.'" value="'. $value.'"  />';
			echo '<span class="robin">Available on Pro Version Only Only</span>';
			echo '<select disabled="disabled">';
				echo '<option>'.$value.'</option>';
			echo '</select>';
		}else{
			echo '<select name="'. $name.'" id="'. $div_id.'" >';
				$query_args = array(
					'post_type' => $post_type,
					'posts_per_page' => -1,
				);
				$the_query = new WP_Query( $query_args );
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts()){ $the_query->the_post();
						echo '<option value="'.tallybuilder_post_slug(get_the_ID()).'" '.selected( $value, $the_query->ID, false ).'>'.get_the_title().'</option>';
					}
				}
			echo '</select>';
		}
	echo '</div>';
}
function tallybuilder_metabox_form_color($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'n',
	), $settings ));
	
	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, tallybuilder_wp_kses_allowed_html());
	}else{
		$value = $sanitize($value);
	}
		
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }
	
	echo '<div class="tallybuilder_mb_item item-warning-'.$pp.'">';
		echo '<label for="'. $name.'">'.$title.'</label>';
		if($pp){
			echo '<input type="hidden" name="'. $name.'" id="'. $div_id.'" value="'. $value.'"  />';
			echo '<input type="text" placeholder="'. $value.'" disabled="disabled" class="tallybuilder_mb_color"/>';
			echo '<span class="robin">Available on Pro Version Only Only</span>';
		}else{
			echo '<input type="text" name="'. $name.'" id="'. $div_id.'" value="'. $value.'" class="tallybuilder_mb_color" />';
			
		}
	echo '</div>';
	
}
function tallybuilder_metabox_form_image($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'n',
	), $settings ));
	
	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, tallybuilder_wp_kses_allowed_html());
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
function tallybuilder_metabox_form_upload($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'n',
	), $settings ));
	
	if ( isset ( $data[$key] ) ) { $value = $data[$key]; }
	if($sanitize == 'wp_kses'){
       $value = $sanitize($value, tallybuilder_wp_kses_allowed_html());
	}else{
		$value = $sanitize($value);
	}
		
	$div_id = $meta_id.'__'.$key;
	$name = $meta_id.'['.$key.']';
	
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }
		
	echo '<div class="tallybuilder_mb_item item-warning-'.$pp.'">';
		echo '<label for="'. $name.'">'.$title.'</label>';
		
		if($pp){
			echo '<input type="hidden" name="'. $name.'" id="'. $div_id.'" value="'. $value.'"  />';
			echo '<input type="text" placeholder="'. $value.'" disabled="disabled" />';
			echo '<input type="button" class="button-primary" value="Upload" disabled="disabled">';
			echo '<span class="robin">Available on Pro Version Only Only</span>';
		}else{
			echo '<input type="text" name="'. $name.'" id="'. $div_id.'" value="'. $value.'" />';
			echo '<input type="button" name="upload-btn" id="'. $div_id.'-upload-btn" class="button-primary" value="Upload">';
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					$('#<?php echo $div_id; ?>-upload-btn').click(function(e) {
						e.preventDefault();
						var image = wp.media({ 
							title: 'Upload',
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
						});
					});
				});
			</script>
			<?php
		}
	echo '</div>';
}
function tallybuilder_metabox_form_4text($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'n',
		'fields' => array(),
	), $settings ));
	
	$base_key = $key;
	
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }

	echo '<div class="tallybuilder_mb_item item-warning-'.$pp.'">';
		echo '<label>'.$title.'</label>';
		if(is_array($fields)){
			foreach($fields as $field){
				
				$div_id = $meta_id.'__'.$base_key.'_'.$field['key'];
				$name = $meta_id.'['.$base_key.'_'.$field['key'].']';
				
				if ( isset ( $data[$base_key.'_'.$field['key']] ) ) { $value = $data[$base_key.'_'.$field['key']]; }
				if($sanitize == 'wp_kses'){ $value = $sanitize($value, tallybuilder_wp_kses_allowed_html()); }else{ $value = $sanitize($value); }
				
				if($pp){
					echo '<div class="tallybuilder_mb_oneforth">';
						echo '<label>'.$field['title'].'</label>';
						echo '<input type="hidden" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
						echo '<input type="text" placeholder="'. $value.'" disabled="disabled" />';
						echo '<span class="robin">Available on Pro Version Only Only</span>';
					echo '</div>';
				}else{
					echo '<div class="tallybuilder_mb_oneforth">';
						echo '<label for="'.$name.'">'.$field['title'].'</label>';
						echo '<input type="text" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
					echo '</div>';
				}
			}
		}
		echo '<div class="clear clearfix"></div>';
	echo '</div>';
}


function tallybuilder_metabox_form_animation($settings = array()){
	extract( array_merge( array(
		'meta_id' => '',
		'data' => '',
		'key' => '',
		'title' => '',
		'value' => '',
		'sanitize' => 'sanitize_text_field',
		'p' => 'n',
		'animation_items' => ''
	), $settings ));
	
	$items = $animation_items;
	$base_key = $key;
	$pp = false; if(($p == 'y') && !tallybuilder_tc()){ $pp = true; }
	
	echo '<div class="tallybuilder_mb_item item-warning-'.$pp.'">';
		if($pp){ echo '<span class="robin">Available on Pro Version Only Only</span>';}
		echo '<label>'.$title.'</label>';
		echo '<div class="clear clearfix"></div>';
		if(is_array($items)){	
				
			$div_id = $meta_id.'__'.$base_key.'_type';
			$name = $meta_id.'['.$base_key.'_type]';
			if ( isset ( $data[$base_key.'_type'] ) ) { $value = $data[$base_key.'_type']; }
			if($sanitize == 'wp_kses'){ $value = $sanitize($value, tallybuilder_wp_kses_allowed_html()); }else{ $value = $sanitize($value); }
			echo '<div class="tallybuilder_mb_oneforth">';
				echo '<label for="'.$name.'">Type</label>';
				if($pp){
					echo '<input type="hidden" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
					echo '<select name="'. $name.'" id="'. $div_id.'" disabled="disabled" />';
						echo '<option selected="selected">'.$value.'</option>';
					echo '</select>';
				}else{
					echo '<select name="'. $name.'" id="'. $div_id.'" />';
						foreach($items as $item){
							echo '<option value="'.$item['value'].'" '.selected( $value, $item['value'], false ).'>'.$item['title'].'</option>';
						}
					echo '</select>';
				}
			echo '</div>';
			
			$div_id = $meta_id.'__'.$base_key.'_duration';
			$name = $meta_id.'['.$base_key.'_duration]';
			if ( isset ( $data[$base_key.'_duration'] ) ) { $value = $data[$base_key.'_duration']; }
			if($sanitize == 'wp_kses'){ $value = $sanitize($value, tallybuilder_wp_kses_allowed_html()); }else{ $value = $sanitize($value); }
			echo '<div class="tallybuilder_mb_oneforth">';
				echo '<label for="'.$name.'">Duration</label>';
				if($pp){
					echo '<input type="hidden" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
					echo '<input type="text" placeholder="'. $value.'" disabled="disabled"/>';
				}else{
					echo '<input type="text" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
				}
			echo '</div>';
			
			$div_id = $meta_id.'__'.$base_key.'_delay';
			$name = $meta_id.'['.$base_key.'_delay]';
			if ( isset ( $data[$base_key.'_delay'] ) ) { $value = $data[$base_key.'_delay']; }
			if($sanitize == 'wp_kses'){ $value = $sanitize($value, tallybuilder_wp_kses_allowed_html()); }else{ $value = $sanitize($value); }
			echo '<div class="tallybuilder_mb_oneforth">';
				echo '<label for="'.$name.'">Delay</label>';
				if($pp){
					echo '<input type="hidden" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
					echo '<input type="text" placeholder="'. $value.'" disabled="disabled"/>';
				}else{
					echo '<input type="text" name="'.$name.'" id="'.$div_id.'" value="'. $value.'"/>';
				}
			echo '</div>';
		}
		echo '<div class="clear clearfix"></div>';
	echo '</div>';
}

function tallybuilder_metabox_form_background($bg = array()){	
	$bg = array_merge( array(
		'bg_base' => '',
		'data' => '',
		'title' => 'Background',
		'value' => '',
		'meta_id' => '',
	), $bg );
	
	echo '<div class="tallybuilder_mb_item tallybuilder_mb_item_bg">';
	
		echo '<h3>'.$bg['title'].'</h3>';
		echo '<div class="clear clearfix"></div>';

		$settings = array(
			'key' => $bg['bg_base'].'_image',
			'title' => 'Image',
			'meta_id' => $bg['meta_id'],
			'data' => $bg['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
		);
		tallybuilder_metabox_form_image($settings);
				
		$settings = array(
			'key' => $bg['bg_base'].'_color',
			'title' => 'Color',
			'meta_id' => $bg['meta_id'],
			'data' => $bg['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'n',
		);
		tallybuilder_metabox_form_color($settings);
		
		$select_items = array(
			array('title' => 'repeat', 'value' => 'repeat'),
			array('title' => 'no-repeat', 'value' => 'no-repeat'),
			array('title' => 'repeat-x', 'value' => 'repeat-x'),
			array('title' => 'repeat-y', 'value' => 'repeat-y'),
		);
		$settings = array(
			'key' => $bg['bg_base'].'_repeat',
			'title' => 'Repeat',
			'meta_id' => $bg['meta_id'],
			'data' => $bg['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'n',
			'select_items' => $select_items,
		);
		tallybuilder_metabox_form_select($settings);
				
		$select_items = array(
			array('title' => 'scroll', 'value' => 'scroll'),
			array('title' => 'fixed', 'value' => 'fixed'),
			array('title' => 'initial', 'value' => 'initial'),
		);
		$settings = array(
			'title' => 'Attachment',
			'key' => $bg['bg_base'].'_attachment',
			'meta_id' => $bg['meta_id'],
			'data' => $bg['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
			'select_items' => $select_items,
		);
		tallybuilder_metabox_form_select($settings);
				
		$select_items = array(
			array('title' => 'left top', 'value' => 'left top'),
			array('title' => 'left center', 'value' => 'left center'),
			array('title' => 'left bottom', 'value' => 'left bottom'),
			array('title' => 'right top', 'value' => 'right top'),
			array('title' => 'right center', 'value' => 'right center'),
			array('title' => 'right bottom', 'value' => 'right bottom'),
			array('title' => 'center top', 'value' => 'center top'),
			array('title' => 'center center', 'value' => 'center center'),
			array('title' => 'center bottom', 'value' => 'center bottom'),
			array('title' => 'initial', 'value' => 'initial'),
		);
		$settings = array(
			'title' => 'Repeat',
			'key' => $bg['bg_base'].'_repeat',
			'meta_id' => $bg['meta_id'],
			'data' => $bg['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
			'select_items' => $select_items,
		);
		tallybuilder_metabox_form_select($settings);
		
		$select_items = array(
			array('title' => 'cover', 'value' => 'cover'),
			array('title' => 'contain', 'value' => 'contain'),
			array('title' => 'initial', 'value' => 'initial'),
		);
		$settings = array(
			'title' => 'Background Size',
			'title' => 'Size',
			'key' => $bg['bg_base'].'_size',
			'meta_id' => $bg['meta_id'],
			'data' => $bg['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
			'select_items' => $select_items,
		);
		tallybuilder_metabox_form_select($settings);
		
		echo '<div class="clear clearfix"></div>';
	echo '</div>';
}

function tallybuilder_metabox_form_fontStyle($font = array()){	
	$font = array_merge( array(
		'bg_base' => '',
		'data' => '',
		'title' => 'Font Style',
		'value' => '',
		'meta_id' => '',
	), $font );
	
	echo '<div class="tallybuilder_mb_item tallybuilder_mb_item_font">';
	
		echo '<h3>'.$font['title'].'</h3>';
		echo '<div class="clear clearfix"></div>';

		$settings = array(
			'key' => $font['bg_base'].'_size',
			'title' => 'Font Size',
			'meta_id' => $font['meta_id'],
			'data' => $font['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
		);
		tallybuilder_metabox_form_text($settings);
				
		$settings = array(
			'key' => $font['bg_base'].'_color',
			'title' => 'Font Color',
			'meta_id' => $font['meta_id'],
			'data' => $font['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
		);
		tallybuilder_metabox_form_color($settings);
		
		$settings = array(
			'key' => $font['bg_base'].'_lineheight',
			'title' => 'Line Height',
			'meta_id' => $font['meta_id'],
			'data' => $font['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
		);
		tallybuilder_metabox_form_text($settings);
				
		$settings = array(
			'title' => 'Font Weight',
			'key' => $font['bg_base'].'_fontweight',
			'meta_id' => $font['meta_id'],
			'data' => $font['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
		);
		tallybuilder_metabox_form_text($settings);
		
		
		echo '<div class="clear clearfix"></div>';
	echo '</div>';
}


function tallybuilder_metabox_form_videoBackground($font = array()){	
	$font = array_merge( array(
		'bg_base' => '',
		'data' => '',
		'title' => 'Video Background',
		'value' => '',
		'meta_id' => '',
	), $font );
	
	echo '<div class="tallybuilder_mb_item tallybuilder_mb_item_videobg">';
	
		echo '<h3>'.$font['title'].'</h3>';
		echo '<div class="clear clearfix"></div>';

		$select_items = array(
			array('title' => 'no', 'value' => 'no'),
			array('title' => 'yes', 'value' => 'yes'),
		);
		$settings = array(
			'key' => $font['bg_base'].'_enable',
			'title' => 'Enable Video Background',
			'meta_id' => $font['meta_id'],
			'data' => $font['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
			'select_items' => $select_items,
		);
		tallybuilder_metabox_form_select($settings);
		
		$settings = array(
			'title' => 'MP4 Video',
			'key' => $font['bg_base'].'_mp4',
			'meta_id' => $font['meta_id'],
			'data' => $font['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
		);
		tallybuilder_metabox_form_upload($settings);
				
		$settings = array(
			'title' => 'WEBM Video',
			'key' => $font['bg_base'].'_webm',
			'meta_id' => $font['meta_id'],
			'data' => $font['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
		);
		tallybuilder_metabox_form_upload($settings);
				
		$settings = array(
			'title' => 'OGV Video',
			'key' => $font['bg_base'].'_ogv',
			'meta_id' => $font['meta_id'],
			'data' => $font['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
		);
		tallybuilder_metabox_form_upload($settings);
		
		$settings = array(
			'title' => 'Video Poster Image',
			'key' => $font['bg_base'].'_poster',
			'meta_id' => $font['meta_id'],
			'data' => $font['data'],
			'value' => '',
			'sanitize' => 'sanitize_text_field',
			'p' => 'y',
		);
		tallybuilder_metabox_form_image($settings);
		
		
		echo '<div class="clear clearfix"></div>';
	echo '</div>';
}

function tallybuilder_metabox_form_save($post_id, $meta_id, $sanitize = 'wp_kses'){
	if( isset( $_POST[ $meta_id ] ) ) {
		
		if($sanitize == 'wp_kses'){
        	update_post_meta( $post_id, $meta_id, $sanitize( $_POST[ $meta_id ], tallybuilder_wp_kses_allowed_html() ) );
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
		return $sanitize($data, tallybuilder_wp_kses_allowed_html() );
	}else{
		return $sanitize($data);
	}
}