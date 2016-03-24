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
			$this->section_settings_html('head', $meta_data, $post_id);
			
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
		if($this->show_settings == true){
			
			echo '<a href="" class="tbmb_edit_section_setting" rel=".tbmb_section_settings">Customize Section</a>';
			echo '<div style="display:none">';
				echo '<div class="tbmb_section_settings">';
					//Content will be here
				echo '</div>';
			echo '</div>';
			
		}
	}
	
	
	
	function row_settings_html($meta_data, $post_id, $row, $row_i){
		
		$row_layout = (isset($meta_data['row'.$row_i.'_layout'])) ? $meta_data['row'.$row_i.'_layout'] : '';
		
		if($row['show_settings'] == true){
			echo 'Layout';
			echo '<select name="'.$this->meta_id.'[row'.$row_i.'_layout]">';
				echo '<option '.selected( $row_layout, '0,0,0,0', false ).' value="0,0,0,0">Disable</option>';
				echo '<option '.selected( $row_layout, '12,0,0,0', false ).' value="12,0,0,0">Full</option>';
				echo '<option '.selected( $row_layout, '6,6,0,0', false ).' value="6,6,0,0">1/2 and 1/2</option>';
				echo '<option '.selected( $row_layout, '4,4,4,0', false ).' value="4,4,4,0">1/3 + 1/3 + 1/3</option>';
				echo '<option '.selected( $row_layout, '3,3,3,3', false ).' value="3,3,3,3">1/4 + 1/4 + 1/4 + 1/4</option>';
				echo '<option '.selected( $row_layout, '6,3,3,0', false ).' value="6,3,3,0">1/6 + 1/4 + 1/4 </option>';
				echo '<option '.selected( $row_layout, '3,3,6,0', false ).' value="3,3,6,0">1/4 + 1/4 + 1/6</option>';
			echo '</select>';
			echo '<a href="" class="tbmb_edit_row_setting" rel=".tbmb_row'.$row_i.'_settings">Customize Row</a>';
			echo '<div style="display:none">';
				echo '<div class="tbmb_row'.$row_i.'_settings">';
					//Content will be here
				echo '</div>';
			echo '</div>';
		}
	}
	
	function column_settings_html($meta_data, $post_id, $row, $row_i, $column, $column_i){
		if($row['show_settings'] == true){
			echo '<a href="" class="tbmb_edit_column_setting" rel=".tbmb_column'.$row_i.$column_i.'_settings">Customize Column</a>';
			echo '<div style="display:none">';
				echo '<div class="tbmb_column'.$row_i.$column_i.'_settings">';
					//Content will be here
				echo '</div>';
			echo '</div>';
		}
	}
	
	
	function column_html($meta_data, $post_id, $row, $row_i, $column, $column_i){
		
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
								
		echo '</div>';
	}
	
}