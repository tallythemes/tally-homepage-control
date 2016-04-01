<?php
function tallytbs_text_metabox() {
	global $post;
	if(!empty($post)){
		if( get_post_meta( $post->ID, 'section_type', true ) == 'text' ){
    		add_meta_box( 'tbSection_text_metabox', 'Text Settings', 'tallytbs_text_metabox_html', 'tally_builder_c', 'normal', 'high' );
		}
	}
}
add_action( 'add_meta_boxes', 'tallytbs_text_metabox' );

function tallytbs_text_metabox_html( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'tallytbsf_text_metabox_nonce' );
	$meta_id = 'tbsf_text';
    $meta_data = get_post_meta( $post->ID, $meta_id, true );
	$post_id = $post->ID;
	//print_r($meta_data);
    ?>
    <div class="tallybuilder_mb_tab">
    	<ul class="nav-tab-wrapper">
        	<li class="ui-state-active"><a href="#tabs-content" class="nav-tab">Content</a></li>
            <li><a href="#tabs-image" class="nav-tab">Image</a></li>
            <li><a href="#tabs-setting" class="nav-tab">Section Setting</a></li>
        	<li><a href="#tabs-background" class="nav-tab">Section Background</a></li>
            <li><a href="#tabs-color" class="nav-tab">Color</a></li>
            <li><a href="#tabs-animation" class="nav-tab">Animation</a></li>
		</ul>
        <div id="tabs-content">
			<?php				
				$settings = array(
					'key' => 'title',
					'title' => 'Title',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'wp_kses',
					'p' => 'n',
				);
				tallybuilder_metabox_form_text($settings);
				
				$settings = array(
					'key' => 'subtitle',
					'title' => 'Sub Title',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'wp_kses',
					'p' => 'n',
				);
				tallybuilder_metabox_form_text($settings);
				
				$settings = array(
					'key' => 'des',
					'title' => 'Content',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'wp_kses',
					'p' => 'n',
				);
				tallybuilder_metabox_form_editor($settings);
				
				$settings = array(
					'key' => 'more1_text',
					'title' => 'Read More Text',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'wp_kses',
					'p' => 'y',
				);
				tallybuilder_metabox_form_text($settings);
				
				$settings = array(
					'key' => 'more1_link',
					'title' => 'Read More Link',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'wp_kses',
					'p' => 'n',
				);
				tallybuilder_metabox_form_text($settings) ;
				
				$settings = array(
					'key' => 'more2_text',
					'title' => 'R2nd Read More Text',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'wp_kses',
					'p' => 'y',
				);
				tallybuilder_metabox_form_text($settings);
				
				$settings = array(
					'key' => 'more2_link',
					'title' => 'R2nd Read More Link',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'wp_kses',
					'p' => 'n',
				);
				tallybuilder_metabox_form_text($settings) ;
				
				$fields = array(
					array(
						'title' => 'Top Padding',
						'key' => 'top',
					),
					array(
						'title' => 'Right Padding',
						'key' => 'right',
					),
					array(
						'title' => 'Bottom Padding',
						'key' => 'bottom',
					),
					array(
						'title' => 'Left Padding',
						'key' => 'left',
					),
				);
				$settings = array(
					'key' => 'content_padding',
					'title' => 'Content Padding',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'fields' => $fields,
				);
				tallybuilder_metabox_form_4text($settings);
				
				$fields = array(
					array(
						'title' => 'Top Margin',
						'key' => 'top',
					),
					array(
						'title' => 'Right Margin',
						'key' => 'right',
					),
					array(
						'title' => 'Bottom Margin',
						'key' => 'bottom',
					),
					array(
						'title' => 'Left Margin',
						'key' => 'left',
					),
				);
				$settings = array(
					'key' => 'content_margin',
					'title' => 'Content Margin',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'fields' => $fields,
				);
				tallybuilder_metabox_form_4text($settings);
				
			?>
		</div>
		<div id="tabs-setting">
        	<?php
				$predefined_class = apply_filters('tallybuilder_section_text_predefined_class', NULL);
				if($predefined_class){
					$key = 'predefined_class';
					$title = __('Pre Defined Style', 'kutub');
					$settings = array(
						'key' => 'predefined_class',
						'title' => 'Pre Defined Style',
						'meta_id' => $meta_id,
						'data' => $meta_data,
						'value' => '',
						'sanitize' => 'sanitize_text_field',
						'p' => 'y',
						'select_items' => $predefined_class,
					);
					tallybuilder_metabox_form_select($settings);
				}
				
				$settings = array(
					'key' => 'padding_top',
					'title' => 'Padding Top',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_text($settings) ;
				
				$settings = array(
					'key' => 'padding_bottom',
					'title' => 'Padding Bottom',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_text($settings) ;
				
				$select_items = array(
					array('title' => 'none', 'value' => NULL),
					array('title' => 'Left', 'value' => 'left'),
					array('title' => 'Right', 'value' => 'right'),
					array('title' => 'Center', 'value' => 'center'),
				);
				$settings = array(
					'key' => 'align',
					'title' => 'Text Align',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'select_items' => $select_items,
				);
				tallybuilder_metabox_form_select($settings);
				
				$select_items = array(
					array('title' => 'Center', 'value' => 'center'),
					array('title' => 'Left', 'value' => 'left'),
					array('title' => 'Right', 'value' => 'right'),
				);
				$settings = array(
					'key' => 'content_align',
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
					'key' => 'content_width',
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
				
				$settings = array(
					'key' => 'div_id',
					'title' => 'Section ID',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_text($settings) ;
				
				$settings = array(
					'key' => 'div_class',
					'title' => 'CSS Class',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_text($settings) ;
				
				$settings = array(
					'key' => 'title_size',
					'title' => 'Title Font Size',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_text($settings);
				
				$settings = array(
					'key' => 'subtitle_size',
					'title' => 'SubTitle Font Size',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_text($settings) ;
				
				$settings = array(
					'key' => 'font_size',
					'title' => 'Font Size',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_text($settings) ;
				
				$select_items = array(
					array('title' => 'Normal', 'value' => ''),
					array('title' => 'Small', 'value' => 'sm'),
					array('title' => 'Large', 'value' => 'lg'),
					array('title' => 'Extra Small', 'value' => 'xs'),
				);
				$settings = array(
					'key' => 'button_size',
					'title' => 'Button Size',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'select_items' => $select_items,
				);
				tallybuilder_metabox_form_select($settings);
			?>
		</div>
        <div id="tabs-image">
        	<?php
				$settings = array(
					'key' => 'image',
					'title' => 'Image',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_image($settings);
				
				$select_items = array(
					array('title' => 'Don\'t Display Image', 'value' => 'none'),
					array('title' => 'Top', 'value' => 'top'),
					array('title' => 'Bottom', 'value' => 'bottom'),
					array('title' => 'Left', 'value' => 'left'),
					array('title' => 'Right', 'value' => 'right'),
					array('title' => 'Full Right Half', 'value' => 'right_half'),
					array('title' => 'Full Left Half', 'value' => 'left_half'),
				);
				$settings = array(
					'key' => 'image_position',
					'title' => 'Image Position',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'select_items' => $select_items,
				);
				tallybuilder_metabox_form_select($settings);
				
				$select_items = array(
					array('title' => 'None', 'value' => 'none'),
					array('title' => 'Left', 'value' => 'left'),
					array('title' => 'Right', 'value' => 'right'),
					array('title' => 'Top Left', 'value' => 'top_left'),
					array('title' => 'Top Right', 'value' => 'top_right'),
					array('title' => 'Bottom Left', 'value' => 'bottom_left'),
					array('title' => 'Bottom Right', 'value' => 'bottom_right'),
				);
				$settings = array(
					'key' => 'image_float',
					'title' => 'Image Float',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'select_items' => $select_items,
				);
				tallybuilder_metabox_form_select($settings);
				
				$fields = array(
					array(
						'title' => 'Top Margin',
						'key' => 'top',
					),
					array(
						'title' => 'Right Margin',
						'key' => 'right',
					),
					array(
						'title' => 'Bottom Margin',
						'key' => 'bottom',
					),
					array(
						'title' => 'Left Margin',
						'key' => 'left',
					),
				);
				$settings = array(
					'key' => 'image_margin',
					'title' => 'Image Margin',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'fields' => $fields,
				);
				tallybuilder_metabox_form_4text($settings);
				
				$fields = array(
					array(
						'title' => 'Top Padding',
						'key' => 'top',
					),
					array(
						'title' => 'Right Padding',
						'key' => 'right',
					),
					array(
						'title' => 'Bottom Padding',
						'key' => 'bottom',
					),
					array(
						'title' => 'Left Padding',
						'key' => 'left',
					),
				);
				$settings = array(
					'key' => 'image_padding',
					'title' => 'Image Padding',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'fields' => $fields,
				);
				tallybuilder_metabox_form_4text($settings);
				
				
				$fields = array(
					array(
						'title' => 'Max Height',
						'key' => 'max_height',
					),
					array(
						'title' => 'Max Width',
						'key' => 'max_width',
					),
					array(
						'title' => 'Height',
						'key' => 'height',
					),
					array(
						'title' => 'Width',
						'key' => 'width',
					),
				);
				$settings = array(
					'key' => 'image_dimensions',
					'title' => 'Image Dimensions',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'fields' => $fields,
				);
				tallybuilder_metabox_form_4text($settings);
			?>
        </div>
		<div id="tabs-background">
   			<?php
				$settings = array(
					'key' => 'bg_image',
					'title' => 'Background Image',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_image($settings);
				
				$settings = array(
					'key' => 'bg_color',
					'title' => 'Background Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_color($settings);
				
				$settings = array(
					'key' => 'bg_overlay_color',
					'title' => 'Background Overlay Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_color($settings);

				$select_items = array(
					array('title' => '0.5', 'value' => '0.5'),
					array('title' => '1', 'value' => '1'),
					array('title' => '0.9', 'value' => '0.9'),
					array('title' => '0.8', 'value' => '0.8'),
					array('title' => '0.7', 'value' => '0.7'),
					array('title' => '0.6', 'value' => '0.6'),
					
					array('title' => '0.4', 'value' => '0.4'),
					array('title' => '0.3', 'value' => '0.3'),
					array('title' => '0.2', 'value' => '0.2'),
					array('title' => '0.1', 'value' => '0.1'),
				);
				$settings = array(
					'key' => 'bg_overlay_opacity',
					'title' => 'Background Overlay opacity',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'select_items' => $select_items,
				);
				tallybuilder_metabox_form_select($settings);

				
				
				$select_items = array(
					array('title' => 'repeat', 'value' => 'repeat'),
					array('title' => 'no-repeat', 'value' => 'no-repeat'),
					array('title' => 'repeat-x', 'value' => 'repeat-x'),
					array('title' => 'repeat-y', 'value' => 'repeat-y'),
				);
				$settings = array(
					'key' => 'bg_repeat',
					'title' => 'Background Repeat',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'select_items' => $select_items,
				);
				tallybuilder_metabox_form_select($settings);
				
				$select_items = array(
					array('title' => 'scroll', 'value' => 'scroll'),
					array('title' => 'fixed', 'value' => 'fixed'),
					array('title' => 'initial', 'value' => 'initial'),
				);
				$settings = array(
					'key' => 'bg_attachment',
					'title' => 'Background Attachment',
					'meta_id' => $meta_id,
					'data' => $meta_data,
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
					'key' => 'bg_position',
					'title' => 'Background Position',
					'meta_id' => $meta_id,
					'data' => $meta_data,
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
					'key' => 'bg_size',
					'title' => 'Background Size',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'select_items' => $select_items,
				);
				tallybuilder_metabox_form_select($settings);
				
				$select_items = array(
					array('title' => 'no', 'value' => 'no'),
					array('title' => 'yes', 'value' => 'yes'),
				);
				$settings = array(
					'key' => 'video_bg',
					'title' => 'Enable Video Background',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
					'select_items' => $select_items,
				);
				tallybuilder_metabox_form_select($settings);
				
				$settings = array(
					'key' => 'video_bg_mp4',
					'title' => 'MP4 Video',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_upload($settings);
				
				$settings = array(
					'key' => 'video_bg_webm',
					'title' => 'WEBM Video',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_upload($settings);
				
				$settings = array(
					'key' => 'video_bg_ogv',
					'title' => 'OGV Video',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_upload($settings);
				
				$settings = array(
					'key' => 'video_bg_poster',
					'title' => 'Video Poster Image',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'sanitize' => 'sanitize_text_field',
					'p' => 'y',
				);
				tallybuilder_metabox_form_image($settings);
			?>
		</div>
		<div id="tabs-color">
    		<?php
				$settings = array(
					'key' => 'color_title',
					'title' => 'Title Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
				);
				tallybuilder_metabox_form_color($settings);
				
				$settings = array(
					'key' => 'color_subtitle',
					'title' => 'SubTitle Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
				);
				tallybuilder_metabox_form_color($settings);
				
				$settings = array(
					'key' => 'color_text',
					'title' => 'Text Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
				);
				tallybuilder_metabox_form_color($settings);
				
				$settings = array(
					'key' => 'color_border',
					'title' => 'Border Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
				);
				tallybuilder_metabox_form_color($settings);
				
				$settings = array(
					'key' => 'color_link',
					'title' => 'Link Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
				);
				tallybuilder_metabox_form_color($settings);
				
				$settings = array(
					'key' => 'color_link_hover',
					'title' => 'Link Hover Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
				);
				tallybuilder_metabox_form_color($settings);
				
				$select_items = array(
					array('title' => 'default', 'value' => 'default'),
					array('title' => 'white', 'value' => 'white'),
					array('title' => 'primary', 'value' => 'primary'),
					array('title' => 'success', 'value' => 'success'),
					array('title' => 'info', 'value' => 'info'),
					array('title' => 'warning', 'value' => 'warning'),
					array('title' => 'danger', 'value' => 'danger'),
					array('title' => 'link', 'value' => 'link'),
				);
				$settings = array(
					'key' => 'color_button1',
					'title' => 'Button Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
					'select_items' => $select_items
				);
				tallybuilder_metabox_form_select($settings);
				
				$select_items = array(
					array('title' => 'default', 'value' => 'default'),
					array('title' => 'white', 'value' => 'white'),
					array('title' => 'primary', 'value' => 'primary'),
					array('title' => 'success', 'value' => 'success'),
					array('title' => 'info', 'value' => 'info'),
					array('title' => 'warning', 'value' => 'warning'),
					array('title' => 'danger', 'value' => 'danger'),
					array('title' => 'link', 'value' => 'link'),
				);
				$settings = array(
					'key' => 'color_button2',
					'title' => '2nd Button Color',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
					'select_items' => $select_items
				);
				tallybuilder_metabox_form_select($settings);
			?>
		</div>
        <div id="tabs-animation">
        	<?php
				$animation_items = array(
					array('title' => 'None', 'value' => ''),
					array('title' => 'lightSpeedIn', 'value' => 'wow lightSpeedIn'),
					array('title' => 'bounceIn', 'value' => 'wow bounceIn'),
					array('title' => 'bounceInUp', 'value' => 'wow bounceInUp'),
					array('title' => 'bounceInDown', 'value' => 'wow bounceInDown'),
					array('title' => 'bounceInLeft', 'value' => 'wow bounceInLeft'),
					array('title' => 'bounceInRight', 'value' => 'wow bounceInRight'),
					array('title' => 'fadeIn', 'value' => 'wow fadeIn'),
					array('title' => 'fadeInDown', 'value' => 'wow fadeInDown'),
					array('title' => 'fadeInDownBig', 'value' => 'wow fadeInDownBig'),
					array('title' => 'fadeInLeft', 'value' => 'wow fadeInLeft'),
					array('title' => 'fadeInLeftBig', 'value' => 'wow fadeInLeftBig'),
					array('title' => 'fadeInRight', 'value' => 'wow fadeInRight'),
					array('title' => 'fadeInRightBig', 'value' => 'wow fadeInRightBig'),
					array('title' => 'fadeInUp', 'value' => 'wow fadeInUp'),
					array('title' => 'fadeInUpBig', 'value' => 'wow fadeInUpBig'),
					array('title' => 'flip', 'value' => 'wow flip'),
					array('title' => 'flipInX', 'value' => 'wow flipInX'),
					array('title' => 'rotateIn', 'value' => 'wow rotateIn'),
					array('title' => 'rotateInDownLeft', 'value' => 'wow rotateInDownLeft'),
					array('title' => 'rotateInDownRight', 'value' => 'wow rotateInDownRight'),
					array('title' => 'rotateInUpLeft', 'value' => 'wow rotateInUpLeft'),
					array('title' => 'rotateInUpRight', 'value' => 'wow rotateInUpRight'),
					array('title' => 'slideInUp', 'value' => 'wow slideInUp'),
					array('title' => 'slideInDown', 'value' => 'wow slideInDown'),
					array('title' => 'slideInLeft', 'value' => 'wow slideInLeft'),
					array('title' => 'slideInRight', 'value' => 'wow slideInRight'),
					array('title' => 'zoomIn', 'value' => 'wow zoomIn'),
					array('title' => 'zoomInDown', 'value' => 'wow zoomInDown'),
					array('title' => 'zoomInLeft', 'value' => 'wow zoomInLeft'),
					array('title' => 'zoomInRight', 'value' => 'wow zoomInRight'),
					array('title' => 'zoomInUp', 'value' => 'wow zoomInUp'),
					array('title' => 'rollIn', 'value' => 'wow rollIn'),
				);
			
				$settings = array(
					'key' => 'title_ani',
					'title' => 'Title Animation',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
					'animation_items' => $animation_items
				);
				tallybuilder_metabox_form_animation($settings);
				
				$settings = array(
					'key' => 'subtitle_ani',
					'title' => 'SubTitle Animation',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
					'animation_items' => $animation_items
				);
				tallybuilder_metabox_form_animation($settings);
				
				$settings = array(
					'key' => 'text_ani',
					'title' => 'Text Animation',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
					'animation_items' => $animation_items
				);
				tallybuilder_metabox_form_animation($settings);
				
				$settings = array(
					'key' => 'button1_ani',
					'title' => 'Button Animation',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
					'animation_items' => $animation_items
				);
				tallybuilder_metabox_form_animation($settings);
				
				$settings = array(
					'key' => 'button2_ani',
					'title' => '2nd Button Animation',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
					'animation_items' => $animation_items
				);
				tallybuilder_metabox_form_animation($settings);
				
				$settings = array(
					'key' => 'image_ani',
					'title' => 'Image Animation',
					'meta_id' => $meta_id,
					'data' => $meta_data,
					'value' => '',
					'p' => 'y',
					'animation_items' => $animation_items
				);
				tallybuilder_metabox_form_animation($settings);
			?>
        </div>
    </div>
    <?php
}


/**
 * Saves the custom meta input
 */
function tallytbs_text_metabox_save( $post_id ) {
	
	$meta_id = 'tbsf_text';
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'tallytbsf_text_metabox_nonce' ] ) && wp_verify_nonce( $_POST[ 'tallytbsf_text_metabox_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
	
	
	tallybuilder_metabox_form_save($post_id, $meta_id, 'wp_kses');
	
}
add_action( 'save_post', 'tallytbs_text_metabox_save' );