<?php
class tallybuilder_section_metabox_generator{
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
		
		add_action( 'wp_ajax_tbmb_metabox_content', array($this, 'content_ajax_process') );
	}
	
	
	function register_metabox(){
		add_meta_box( $this->div_id, $this->title, array($this, 'metabox_html'), 'tally_builder_c', $this->context, $this->priority );
	}
	
	function metabox_html($post){
		wp_nonce_field( basename( __FILE__ ), $this->div_id.'_nonce' );
		$meta_id = $this->meta_id;
		$meta_data = get_post_meta( $post->ID, $meta_id, true );
		$post_id = $post->ID;
		
		print_r($meta_data);
		
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
					
					
					$select_items = array(
						array('title' => 'Center', 'value' => 'center'),
						array('title' => 'Left', 'value' => 'left'),
						array('title' => 'Right', 'value' => 'right'),
					);
					$settings = array(
						'key' => 'section_content_align',
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
						'key' => 'section_content_width',
						'title' => 'Content Width',
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
					
					echo '<a href="#" class="tbmb_showhide_close foot button-primary">Close</a>';
				echo '</div>';
			echo '</div>';
			
		}
	}
	
	
	
	function row_settings_html($meta_data, $post_id, $row, $row_i){
		
		$meta_id = $this->meta_id;
		$row_layout = (isset($meta_data['row'.$row_i.'_layout'])) ? $meta_data['row'.$row_i.'_layout'] : '';
		
		if($row['show_settings'] == true){
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
						'key' => $prefix.'content_width',
						'title' => 'Content Width',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
					);
					tallybuilder_metabox_form_text($settings) ;
					
					$settings = array(
						'key' => $prefix.'width',
						'title' => 'Section Width',
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
					
					echo '<a href="#" class="tbmb_showhide_close foot button-primary">Close</a>';
				echo '</div>';
			echo '</div>';
		}
	}
	
	
	function column_html($meta_data, $post_id, $row, $row_i, $column, $column_i){
		$meta_id = $this->meta_id;
		
		$grid_class = 'tbmb_col tbmb_col_';
		$column_position = $column_i - 1;
		if(isset($meta_data['row'.$row_i.'_layout'])){
			$div_cols =  explode(",", $meta_data['row'.$row_i.'_layout']);
		}
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
		$db_type =(isset($meta_data['the_con'.$row_i.$column_i.$content_i.'_type'])) ? $meta_data['the_con'.$row_i.$column_i.$content_i.'_type'] : '';
		$admin_label =(isset($meta_data['the_con'.$row_i.$column_i.$content_i.'_label'])) ? $meta_data['the_con'.$row_i.$column_i.$content_i.'_label'] : '';
		$enable_content =(isset($meta_data['the_con'.$row_i.$column_i.$content_i.'_enable'])) ? $meta_data['the_con'.$row_i.$column_i.$content_i.'_enable'] : '';
		
		echo '<div class="tbmb_content tbmb_content_'.$row_i.$column_i.$content_i.'">';
			
			echo '<div class="tbmb_content_head">';			
				echo '<a href="#" class="tbmb_edit_content_setting tbmb_content_head'.$row_i.$column_i.$content_i.' tbmb_showhide" rel=".tbmb_content'.$row_i.$column_i.$content_i.'_settings" style="'.(($enable_content == 1)?'display:block;':'display:none;').'">';
					echo '<strong>'.$db_type.':</strong><em>'.$admin_label.'</em>';
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
											
				echo '<div class="tbmb_content_type">';	
					echo '<strong>Content Type</strong>: ';								
					echo '<select  name="'.$this->meta_id.'[the_con'.$row_i.$column_i.$content_i.'_type]" class="tbmb_content_type" rel="'.$row_i.$column_i.$content_i.'">';
						echo '<option '.selected( $db_type, 'text', false ).' value="text">Text</option>';
						echo '<option '.selected( $db_type, 'image', false ).' value="image">Image</option>';
						echo '<option '.selected( $db_type, 'grid', false ).' value="grid">Grid</option>';
					echo '</select>';
				echo '</div>';
					
				echo '<div class="tbmb_admin_label">';
					echo '<label for="'.$this->meta_id.'[the_con'.$row_i.$column_i.$content_i.'_label]">Admin label</label>';
					echo '<input type="text" name="'.$this->meta_id.'[the_con'.$row_i.$column_i.$content_i.'_label]" value="'.$admin_label.'">';
				echo '</div>';
								
				echo '<div class="tbmb_content_holder tbmb_content'.$row_i.$column_i.$content_i.'_holder">';
					$this->content_item($meta_data, $post_id, $row, $row_i, $column, $column_i, $content, $content_i, 'text');
					$this->content_item($meta_data, $post_id, $row, $row_i, $column, $column_i, $content, $content_i, 'image');
					$this->content_item($meta_data, $post_id, $row, $row_i, $column, $column_i, $content, $content_i, 'grid');
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