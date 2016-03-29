<?php
class tallybuilder_section_metabox_generator2{
	public $meta_id;
	public $title;
	public $context;
	public $priority;
	public $rows;
	public $div_id;
	public $show_settings;
	
	function __construct($settings){
		$settings = array_merge(array(
			'meta_id' => '',
			'title' => '',
			'context' => 'normal',
			'priority' => 'high',
			'rows' => '',
			'div_id' => '',
			'show_settings' => true,
		), $settings);
		
		$this->meta_id = $settings['meta_id'];
		$this->title = $settings['title'];
		$this->context = $settings['context'];
		$this->priority = $settings['priority'];
		$this->rows = $settings['rows'];
		$this->div_id = $settings['div_id'];
		$this->show_settings = $settings['show_settings'];
		
		add_action( 'add_meta_boxes', array($this, 'register_metabox') );
		add_action( 'save_post', array($this, 'metabox_save') );
	}
	
	
	function register_metabox(){
		add_meta_box( $this->div_id, $this->title, array($this, 'metabox_html'), 'tally_builder_c', $this->context, $this->priority );
	}
	
	function metabox_html($post){
		wp_nonce_field( basename( __FILE__ ), $this->div_id.'_nonce' );
		$meta_id = $this->meta_id;
		$meta_data = get_post_meta( $post->ID, $meta_id, true );
		$post_id = $post->ID;
		
		echo '<div class="tallybuilder_metabox '.$this->div_id.' tbmb_box">';
			
			
			$this->section_settings_html($meta_data, $post_id);
			
			if(is_array($this->rows)){
				$row_i = 1;
				foreach($this->rows as $row){
					echo '<div class="tbmb_row tbmb_row_'.$row_i.'">';
						$this->row_settings_html($meta_data, $post_id, $row, $row_i);
						if(is_array($row['columns'])){
							echo '<div class="clear clearfix"></div>';
							$column_i = 1;
							foreach($row['columns'] as $column){
								$this->column_html($meta_data, $post_id, $row, $row_i, $column, $column_i);
								$column_i++;
							}
							echo '<div class="clear clearfix"></div>';
						}
					echo '</div>';
					$row_i++;
				}
				
			}
		echo '</div>';
	}
	
	function metabox_save($post_id){
		$meta_id = $this->meta_id;
 
		// Checks save status
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ $this->div_id.'_nonce' ] ) && wp_verify_nonce( $_POST[ $this->div_id.'_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
	 
		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}
		
		tallybuilder_metabox_form_save($post_id, $meta_id, 'wp_kses');
	}
	
	function section_settings_html($meta_data, $post_id){
		$meta_id = $this->meta_id;
		
		if($this->show_settings == true){

			echo '<a href="" class="tbmb_edit_section_setting tbmb_showhide" rel=".tbmb_section_settings">Customize Section</a>';
			echo '<div class="tbmb_popup tbmb_section_settings"  style="display:none;">';
				echo '<div class="tbmb_popup_in">';
					echo '<a href="#" class="tbmb_showhide_close button-primary">Close</a>';
					$settings = array(
						'base_id' => 'section_padding',
						'title' => 'Padding',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_padding($settings);
					
					$settings = array(
					'base_id' => 'section_bg',
						'title' => 'Background',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_background($settings);
					
					$settings = array(
						'base_id' => 'section_video_bg',
						'title' => 'Section Video Background',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_videoBackground($settings);
					
					$settings = array(
						'key' => 'section_class',
						'title' => 'CSS Class',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings) ;
					
					$settings = array(
						'key' => 'section_id',
						'title' => 'CSS ID',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings) ;
					
					$settings = array(
						'key' => 'section_width',
						'title' => 'Section Width',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings) ;
					
					$settings = array(
						'key' => 'section_max_width',
						'title' => 'Section Max Width',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings) ;
					
					echo '<a href="#" class="tbmb_showhide_close foot button-primary">Close</a>';
				echo '</div>';
			echo '</div>';
			
		}
	}
	
	
	
	function row_settings_html($meta_data, $post_id, $row, $row_i){
		
		$meta_id = $this->meta_id;
		$get_row_layout = (isset($meta_data['row'.$row_i.'_layout'])) ? $meta_data['row'.$row_i.'_layout'] : $row['column_layout'];
		$row_layout = ($get_row_layout == '') ? $row['column_layout'] : $get_row_layout;
		
		if($row['show_settings'] == true){
			if($row['edit_layour'] == true){
				echo 'Layout';
				echo '<select name="'.$this->meta_id.'[row'.$row_i.'_layout]" id="tbmb_row'.$row_i.'_layout">';
					echo '<option '.selected( $row_layout, '0,0,0,0', false ).' value="0,0,0,0">Disable</option>';
					echo '<option '.selected( $row_layout, '12,0,0,0', false ).' value="12,0,0,0">Full</option>';
					echo '<option '.selected( $row_layout, '6,6,0,0', false ).' value="6,6,0,0">1/2 and 1/2</option>';
					echo '<option '.selected( $row_layout, '4,4,4,0', false ).' value="4,4,4,0">1/3 + 1/3 + 1/3</option>';
					echo '<option '.selected( $row_layout, '3,3,3,3', false ).' value="3,3,3,3">1/4 + 1/4 + 1/4 + 1/4</option>';
					echo '<option '.selected( $row_layout, '6,3,3,0', false ).' value="6,3,3,0">1/2 + 1/4 + 1/4 </option>';
					echo '<option '.selected( $row_layout, '3,3,6,0', false ).' value="3,3,6,0">1/4 + 1/4 + 1/2</option>';
					echo '<option '.selected( $row_layout, '4,8,0,0', false ).' value="4,8,0,0">1/4 + 3/4</option>';
					echo '<option '.selected( $row_layout, '8,4,0,0', false ).' value="8,4,0,0">3/4 + 1/4</option>';
					echo '<option '.selected( $row_layout, '6,3,3,0', false ).' value="6,3,3,0">1/2 + 1/3 + 1/3</option>';
					echo '<option '.selected( $row_layout, '3,3,6,0', false ).' value="3,3,6,0">1/3 + 1/3 + 1/2</option>';
				echo '</select>';
			}
			echo '<a href="" class="tbmb_edit_row_setting tbmb_edit_row'.$row_i.'_setting tbmb_edit_row_setting_'.($row_layout == "0,0,0,0"?'none':'show').' tbmb_showhide" rel=".tbmb_row'.$row_i.'_settings">Customize Row</a>';
			echo '<div class="tbmb_popup tbmb_row'.$row_i.'_settings"  style="display:none;">';
				echo '<div class="tbmb_popup_in">';
					echo '<a href="#" class="tbmb_showhide_close button-primary">Close</a>';
					echo '<h3>Row #'.$row_i.' <small>Settings</small></h3>';
					$prefix = 'row'.$row_i.'_';
					
					$settings = array(
						'base_id' => $prefix.'padding',
						'title' => 'Padding',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_padding($settings);
					
					$settings = array(
						'base_id' => $prefix.'margin',
						'title' => 'Margin',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_margin($settings);
					
					$settings = array(
					'base_id' => $prefix.'bg',
						'title' => 'Background',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_background($settings);
					
					$settings = array(
						'base_id' => $prefix.'video_bg',
						'title' => 'Video Background',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_videoBackground($settings);
					
					$settings = array(
						'key' => $prefix.'class',
						'title' => 'CSS Class',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings) ;
					
					$settings = array(
						'key' => $prefix.'id',
						'title' => 'CSS ID',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings) ;
					
					
					$select_items = array(
						array('title' => 'Center', 'value' => 'center'),
						array('title' => 'Left', 'value' => 'left'),
						array('title' => 'Right', 'value' => 'right'),
					);
					$settings = array(
						'key' => $prefix.'content_align',
						'title' => 'Content Align',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
						'select_items' => $select_items,
					);
					tallybuilder_metabox_form_select($settings);
					
					$settings = array(
						'key' => $prefix.'width',
						'title' => 'Width',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings) ;
					
					$settings = array(
						'key' => $prefix.'max_width',
						'title' => 'Max Width',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings) ;
					
					echo '<a href="#" class="tbmb_showhide_close foot button-primary">Close</a>';
				echo '</div>';
			echo '</div>';
		}
	}
	
	function column_settings_html($meta_data, $post_id, $row, $row_i, $column, $column_i){
		$meta_id = $this->meta_id;
		
		if($row['show_settings'] == true){
			echo '<a href="" class="tbmb_edit_column_setting tbmb_showhide" rel=".tbmb_column'.$row_i.$column_i.'_settings">Customize Column</a>';
			echo '<div class="tbmb_popup tbmb_column'.$row_i.$column_i.'_settings"  style="display:none;">';
				echo '<div class="tbmb_popup_in">';
					echo '<a href="#" class="tbmb_showhide_close button-primary">Close</a>';
					
					$prefix = 'col'.$row_i.$column_i.'_';
					$settings = array(
						'base_id' => $prefix.'padding',
						'title' => 'Padding',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_padding($settings);
					
					$settings = array(
						'base_id' => $prefix.'margin',
						'title' => 'Margin',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_margin($settings);
					
					$settings = array(
					'base_id' => $prefix.'bg',
						'title' => 'Background',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_background($settings);
					
					$settings = array(
						'base_id' => $prefix.'video_bg',
						'title' => 'Video Background',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
					);
					tallybuilder_metabox_form_videoBackground($settings);
					
					$settings = array(
						'key' => $prefix.'class',
						'title' => 'CSS Class',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings);
					
					$settings = array(
						'key' => $prefix.'id',
						'title' => 'CSS ID',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings);
					
					echo '<a href="#" class="tbmb_showhide_close foot button-primary">Close</a>';
				echo '</div>';
			echo '</div>';
		}
	}
	
	
	function column_html($meta_data, $post_id, $row, $row_i, $column, $column_i){
		$meta_id = $this->meta_id;
		
		$get_row_layout = (isset($meta_data['row'.$row_i.'_layout'])) ? $meta_data['row'.$row_i.'_layout'] : $row['column_layout'];
		$row_layout = ($get_row_layout == '') ? $row['column_layout'] : $get_row_layout;
		
		$grid_class = 'tbmb_col tbmb_col_';
		$column_position = $column_i - 1;
		
		$div_cols =  explode(",", $row_layout);
		
		if(isset($div_cols[$column_position])){
			$grid_class = 'tbmb_col tbmb_col_'.$div_cols[$column_position];
		}
		
		echo '<div class="tbmb_column tbmb_column_'.$row_i.$column_i.' '.$grid_class.'">';
								
			$this->column_settings_html($meta_data, $post_id, $row, $row_i, $column, $column_i);
			
			if(is_array($column['contents'])){
				$content_i = 1;
				foreach($column['contents'] as $content){
					
					$this->content_html($meta_data, $post_id, $row, $row_i, $column, $column_i, $content, $content_i);
					
					$content_i++;
				}
			}
								
		echo '</div>';
	}
	
	
	function content_html($meta_data, $post_id, $row, $row_i, $column, $column_i, $content, $content_i){
		$meta_id = $this->meta_id;
		$content_type =$content['type'];
		$admin_label =$content['label'];
		$enable_content =(isset($meta_data['the_con'.$row_i.$column_i.$content_i.'_enable'])) ? $meta_data['the_con'.$row_i.$column_i.$content_i.'_enable'] : '';
		
		echo '<div class="tbmb_content tbmb_content_'.$row_i.$column_i.$content_i.'">';
			
			echo '<div class="tbmb_content_head">';			
				echo '<a href="#" class="tbmb_edit_content_setting tbmb_content_head'.$row_i.$column_i.$content_i.' tbmb_showhide" rel=".tbmb_content'.$row_i.$column_i.$content_i.'_settings" style="'.(($enable_content == 1)?'display:block;':'display:none;').'">';
					echo '<strong>'.$content_type.':</strong><em>'.$admin_label.'</em>';
				echo '</a>';
				echo '<input type="checkbox" class="tbmb_enable_content" rel=".tbmb_content_head'.$row_i.$column_i.$content_i.'" name="'.$this->meta_id.'[the_con'.$row_i.$column_i.$content_i.'_enable]" '.checked( $enable_content, 1, false ).' value="1"  >';
			echo '</div>';
							
			$this->content_popup_html($meta_data, $post_id, $row, $row_i, $column, $column_i, $content, $content_i);
		echo '</div>';
	}
	
	
	function content_popup_html($meta_data, $post_id, $row, $row_i, $column, $column_i, $content, $content_i){
		$meta_id = $this->meta_id;
		$db_type =(isset($meta_data['the_con'.$row_i.$column_i.$content_i.'_type'])) ? $meta_data['the_con'.$row_i.$column_i.$content_i.'_type'] : '';
		$admin_label =(isset($meta_data['the_con'.$row_i.$column_i.$content_i.'_label'])) ? $meta_data['the_con'.$row_i.$column_i.$content_i.'_label'] : '';
							
		echo '<div class="tbmb_popup tbmb_content_in tbmb_content'.$row_i.$column_i.$content_i.'_settings" style="display:none;">';
			echo '<div class="tbmb_popup_in">';
				echo '<a href="#" class="tbmb_showhide_close button-primary">Close</a>';
												
				echo '<div class="tbmb_content_holder tbmb_content'.$row_i.$column_i.$content_i.'_holder">';
					$this->content_item($meta_data, $post_id, $row, $row_i, $column, $column_i, $content, $content_i, $content['type']);
				echo '</div>';
						
				echo '<a href="#" class="tbmb_showhide_close foot button-primary">Close</a>';
			echo '</div>';
		echo '</div>';
	}
	
	
	function content_item($meta_data, $post_id, $row, $row_i, $column, $column_i, $content, $content_i, $type){
		$meta_id = $this->meta_id;
		
		$db_type =(isset($meta_data['the_con'.$row_i.$column_i.$content_i.'_type'])) ? $meta_data['the_con'.$row_i.$column_i.$content_i.'_type'] : '';
		$content_function = 'tallybuilder_SContent_MB__'.$type;
		$prefix = 'con'.$row_i.$column_i.$content_i.'_';
		$disabled = ( $type == $db_type ) ? '' : 'disabled';
				
		if(function_exists($content_function)){
			echo '<div class="tbmb_content_item '.$disabled.' tbmb_content_item'.$row_i.$column_i.$content_i.'__'.$type.' tbmb_content_item'.$row_i.$column_i.$content_i.'">';
				$content_function($meta_data, $meta_id, $post_id, $prefix);
			echo '</div>';
		}
	}
	
}






class tallybuilder_section_html_generator2{
	public $meta_id;
	public $rows;
	
	function __construct($settings){
		$settings = array_merge(array(
			'meta_id' => '',
			'rows' => '',
		), $settings);
		
		$this->meta_id = $settings['meta_id'];
		$this->rows = $settings['rows'];
		
		$this->html();
	}
	
	
	function html(){
		$meta_id = $this->meta_id;
		$meta_data = get_post_meta( get_the_ID(), $meta_id, true );
		$post_id = get_the_ID();
		$unique_class = 'tb_section_'.$post_id;
		
		$section_class = 'tallybuilder_section '.$unique_class.' '.tallybuilder_meta($meta_id, 'section_class', $post_id).' ';
		$section_div_id = (tallybuilder_meta($meta_id, 'section_id', $post_id) == '') ? '' : 'id="'.tallybuilder_meta($meta_id, 'section_id', $post_id).'"' ;
		$section_video_content = tallybuilder_meta_bgVideo_content($meta_id, 'section_video_bg', $post_id);
		
		
		if(get_post_meta(get_the_ID(), 'section_disable', true) != 'yes'){
			echo '<div class="'.$section_class.'" '.$section_div_id.' '.$section_video_content.'>';
				echo '<div class="tallybuilder_section_inner">';
					if(is_array($this->rows)){
						$row_i = 1;
						foreach($this->rows as $row){
							$this->row_html($meta_data, $meta_id, $post_id, $row, $row_i);
							$row_i++;
						}
					}
				echo '</div>';	
			echo '</div>';
		}
	}
	
	
	function row_html($meta_data, $meta_id, $post_id, $row, $row_i){
		$unique_class = 'tb_row_'.$post_id.$row_i;
		$get_row_layout = (isset($meta_data['row'.$row_i.'_layout'])) ? $meta_data['row'.$row_i.'_layout'] : $row['column_layout'];
		$row_layout = ($get_row_layout == '') ? $row['column_layout'] : $get_row_layout;
		$prefix = 'row'.$row_i.'_';
		$row_video_content = tallybuilder_meta_bgVideo_content($meta_id, $prefix.'video_bg', $post_id);
		$row_div_class = 'tallybuilder_row '.$unique_class.' container-fluid tb_row_align_'.tallybuilder_meta($meta_id, $prefix.'content_align', $post_id).' ';
		$row_div_class .= tallybuilder_meta($meta_id, $prefix.'class', $post_id);
		$row_div_id = (tallybuilder_meta($meta_id, 'id', $post_id) == '') ? '' : 'id="'.tallybuilder_meta($meta_id, 'id', $post_id).'"' ;
		
		if($row_layout != '0,0,0,0'){
			echo '<div class="'.$row_div_class.'" '.$row_video_content.' '.$row_div_id.'>';
				echo '<div class="tallybuilder_row_inner row">';
					if(is_array($row['columns'])){
						$column_i = 1;
						foreach($row['columns'] as $column){
							$this->column_html($meta_data, $meta_id, $post_id, $row, $row_i, $column, $column_i);
							$column_i++;
						}
					}
				echo '</div>';
			echo '</div>';
		}
	}
	
	
	function column_html($meta_data, $meta_id, $post_id, $row, $row_i, $column, $column_i){
		$unique_class = 'tb_column_'.$post_id.$row_i.$column_i;
		$get_row_layout = (isset($meta_data['row'.$row_i.'_layout'])) ? $meta_data['row'.$row_i.'_layout'] : $row['column_layout'];
		$row_layout = ($get_row_layout == '') ? $row['column_layout'] : $get_row_layout;
		$row_layout_array = explode(",", $row_layout);
		$column_layout = $row_layout_array[$column_i - 1];
		
		$prefix = 'col'.$row_i.$column_i.'_';
		$col_video_content = tallybuilder_meta_bgVideo_content($meta_id, $prefix.'video_bg', $post_id);
		$col_div_class = 'tallybuilder_column '.$unique_class.' col-md-'.$column_layout.' ';
		$col_div_class .= tallybuilder_meta($meta_id, $prefix.'class', $post_id);
		$col_div_id = (tallybuilder_meta($meta_id, 'id', $post_id) == '') ? '' : 'id="'.tallybuilder_meta($meta_id, 'id', $post_id).'"' ;
		
		if($column_layout != '0'){
			echo '<div class="'.$col_div_class.'" '.$col_div_id.' >';
				echo '<div class="tallybuilder_column_inner" '.$col_video_content.'>';
					if(is_array($column['contents'])){
						$content_i = 1;
						foreach($column['contents'] as $content){
							$this->content_html($meta_data, $meta_id, $post_id, $row, $row_i, $column, $column_i, $content, $content_i);
							$content_i++;
						}
					}
				echo '</div>';
			echo '</div>';
		}
	}
	
	function content_html($meta_data, $meta_id, $post_id, $row, $row_i, $column, $column_i, $content, $content_i){
		$unique_class = 'tb_content_'.$post_id.$row_i.$column_i.$content_i;
		$type = $content['type'];
		$content_function = 'tallybuilder_SContent_HTML__'.$type;
		$prefix = 'con'.$row_i.$column_i.$content_i.'_';
		$enable_content =(isset($meta_data['the_con'.$row_i.$column_i.$content_i.'_enable'])) ? $meta_data['the_con'.$row_i.$column_i.$content_i.'_enable'] : '';
		
		if($enable_content == true){
			if(function_exists($content_function)){
				echo '<div class="tallybuilder_content '.$unique_class.' tb_content_'.$type.'">';
					echo '<div class="tallybuilder_content_inner">';
						$content_function($meta_data, $meta_id, $post_id, $prefix);
					echo '</div>';
				echo '</div>';
			}
		}
	}
	
}




class tallybuilder_section_css_generator2{
	public $meta_id;
	public $rows;
	
	function __construct($settings){
		$settings = array_merge(array(
			'meta_id' => '',
			'rows' => '',
		), $settings);
		
		$this->meta_id = $settings['meta_id'];
		$this->rows = $settings['rows'];
		
		$this->css();
	}
	
	
	function css(){
		$meta_id = $this->meta_id;
		$meta_data = get_post_meta( get_the_ID(), $meta_id, true );
		$post_id = get_the_ID();
		$unique_class = '.tb_section_'.$post_id;
		
		if(get_post_meta(get_the_ID(), 'section_disable', true) != 'yes'){
			
			echo ''."\n";
			echo tallybuilder_meta_padding_css($unique_class, $meta_id, 'section_padding', $post_id);
			echo tallybuilder_meta_margin_css($unique_class, $meta_id, 'section_margin', $post_id);
			echo tallybuilder_meta_background_css($unique_class, $meta_id, 'section_bg', $post_id);
			$video_bg = tallybuilder_meta_bgVideo_content($meta_id, 'section_video_bg', $post_id);
			if($video_bg != ''){ echo $unique_class.'{ background:none; }'; }
			tallybuilder_css_style($unique_class.' .tallybuilder_section_inner', tallybuilder_meta($meta_id, 'section_width', $post_id), 'width:%s%;');
			tallybuilder_css_style($unique_class.' .tallybuilder_section_inner', tallybuilder_meta($meta_id, 'section_max_width', $post_id), 'max-width:%s%;');
			echo ''."\n";

			if(is_array($this->rows)){
				$row_i = 1;
				foreach($this->rows as $row){
					$this->row_css($meta_data, $meta_id, $post_id, $row, $row_i);
					$row_i++;
				}
			}
				
		}
	}
	
	
	function row_css($meta_data, $meta_id, $post_id, $row, $row_i){
		$unique_class = '.tb_row_'.$post_id.$row_i;
		$get_row_layout = (isset($meta_data['row'.$row_i.'_layout'])) ? $meta_data['row'.$row_i.'_layout'] : $row['column_layout'];
		$row_layout = ($get_row_layout == '') ? $row['column_layout'] : $get_row_layout;
		$prefix = 'row'.$row_i.'_';
		
		if($row_layout != '0,0,0,0'){
			echo ''."\n";
			echo tallybuilder_meta_padding_css($unique_class, $meta_id, $prefix.'padding', $post_id);
			echo tallybuilder_meta_margin_css($unique_class, $meta_id, $prefix.'margin', $post_id);
			echo tallybuilder_meta_background_css($unique_class, $meta_id, $prefix.'bg', $post_id);
			$video_bg = tallybuilder_meta_bgVideo_content($meta_id, $prefix.'video_bg', $post_id);
			if($video_bg != ''){ echo $unique_class.'{ background:none; }'; }
			tallybuilder_css_style($unique_class.' .tallybuilder_row_inner', tallybuilder_meta($meta_id, $prefix.'width', $post_id), 'width:%s%;');
			tallybuilder_css_style($unique_class.' .tallybuilder_row_inner', tallybuilder_meta($meta_id, $prefix.'max_width', $post_id), 'max-width:%s%;');
			echo ''."\n";
			
			if(is_array($row['columns'])){
				$column_i = 1;
				foreach($row['columns'] as $column){
					$this->column_css($meta_data, $meta_id, $post_id, $row, $row_i, $column, $column_i);
					$column_i++;
				}
			}
		}
	}
	
	
	function column_css($meta_data, $meta_id, $post_id, $row, $row_i, $column, $column_i){
		$unique_class = '.tb_column_'.$post_id.$row_i.$column_i;
		$get_row_layout = (isset($meta_data['row'.$row_i.'_layout'])) ? $meta_data['row'.$row_i.'_layout'] : $row['column_layout'];
		$row_layout = ($get_row_layout == '') ? $row['column_layout'] : $get_row_layout;
		$row_layout_array = explode(",", $row_layout);
		$column_layout = $row_layout_array[$column_i - 1];
		$prefix = 'col'.$row_i.$column_i.'_';
		
		if($column_layout != '0'){
			
			echo ''."\n";
			echo tallybuilder_meta_padding_css($unique_class.' .tallybuilder_column_inner', $meta_id, $prefix.'padding', $post_id);
			echo tallybuilder_meta_margin_css($unique_class.' .tallybuilder_column_inner', $meta_id, $prefix.'margin', $post_id);
			echo tallybuilder_meta_background_css($unique_class.' .tallybuilder_column_inner', $meta_id, $prefix.'bg', $post_id);
			$video_bg = tallybuilder_meta_bgVideo_content($meta_id, $prefix.'video_bg', $post_id);
			if($video_bg != ''){ echo $unique_class.' .tallybuilder_column_inner{ background:none; }'; }
			echo ''."\n";
			
			if(is_array($column['contents'])){
				$content_i = 1;
				foreach($column['contents'] as $content){
					$this->content_css($meta_data, $meta_id, $post_id, $row, $row_i, $column, $column_i, $content, $content_i);
					$content_i++;
				}
			}
		}
	}
	
	function content_css($meta_data, $meta_id, $post_id, $row, $row_i, $column, $column_i, $content, $content_i){
		$unique_class = 'tb_content_'.$post_id.$row_i.$column_i.$content_i;
		$type = $content['type'];
		$content_function = 'tallybuilder_SContent_CSS__'.$type;
		$prefix = 'con'.$row_i.$column_i.$content_i.'_';
		$enable_content =(isset($meta_data['the_con'.$row_i.$column_i.$content_i.'_enable'])) ? $meta_data['the_con'.$row_i.$column_i.$content_i.'_enable'] : '';
		
		if($enable_content == true){
			if(function_exists($content_function)){

				$content_function($meta_data, $meta_id, $post_id, $prefix);

			}
		}
	}
	
}