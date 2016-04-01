<?php if(get_post_meta(get_the_ID(), 'section_disable', true) != 'yes'): ?>
	<?php
	$meta_id = 'tbsf_text';
	$content_column = '6';
	$image_column = '6';
	
	$title = tallybuilder_meta($meta_id, 'title');
	$subtitle = tallybuilder_meta($meta_id, 'subtitle');
	$des = tallybuilder_meta($meta_id, 'des');
	$image = tallybuilder_meta($meta_id, 'image');
	$image_position	= tallybuilder_meta($meta_id, 'image_position');
	$image_float	= tallybuilder_meta($meta_id, 'image_float');
	$more1_text	= tallybuilder_meta($meta_id, 'more1_text');
	$more1_link	= tallybuilder_meta($meta_id, 'more1_link');
	$more2_text	= tallybuilder_meta($meta_id, 'more2_text');
	$more2_link	= tallybuilder_meta($meta_id, 'more2_link');
	
	$align = tallybuilder_meta($meta_id, 'align');
	$content_align = tallybuilder_meta($meta_id, 'content_align');
	$div_id = (tallybuilder_meta($meta_id, 'div_id') == '' ? NULL : 'id="'.tallybuilder_meta($meta_id, 'div_id').'"' );
	$div_class = tallybuilder_meta($meta_id, 'div_class');
	$button_size = tallybuilder_meta($meta_id, 'button_size');
	$color_button2 = tallybuilder_meta($meta_id, 'color_button2');
	$color_button1 = tallybuilder_meta($meta_id, 'color_button1');
	
	$ani_title = tallybuilder_meta($meta_id, 'title_ani_type');
	$ani_image = tallybuilder_meta($meta_id, 'image_ani_type');
	$ani_subtitle = tallybuilder_meta($meta_id, 'subtitle_ani_type');
	$ani_text = tallybuilder_meta($meta_id, 'text_ani_type');
	$ani_button1 = tallybuilder_meta($meta_id, 'button1_ani_type');
	$ani_button2 = tallybuilder_meta($meta_id, 'button2_ani_type');
	
	$title_ani_duration = (tallybuilder_meta($meta_id, 'title_ani_duration') == '' ? '' : 'data-wow-duration="'.tallybuilder_meta($meta_id, 'title_ani_duration').'"' );
	$subtitle_ani_duration = (tallybuilder_meta($meta_id, 'subtitle_ani_duration') == '' ? '2s' : 'data-wow-duration="'.tallybuilder_meta($meta_id, 'subtitle_ani_duration').'"' );
	$image_ani_duration = (tallybuilder_meta($meta_id, 'image_ani_duration') == '' ? '' : 'data-wow-duration="'.tallybuilder_meta($meta_id, 'image_ani_duration').'"' );
	$text_ani_duration = (tallybuilder_meta($meta_id, 'text_ani_duration') == '' ? '' : 'data-wow-duration="'.tallybuilder_meta($meta_id, 'text_ani_duration').'"' );
	$button1_ani_duration = (tallybuilder_meta($meta_id, 'button1_ani_duration') == '' ? '2s' : 'data-wow-duration="'.tallybuilder_meta($meta_id, 'button1_ani_duration').'"' );
	$button2_ani_duration = (tallybuilder_meta($meta_id, 'button2_ani_duration') == '' ? '2s' : 'data-wow-duration="'.tallybuilder_meta($meta_id, 'button2_ani_duration').'"' );
	
	$title_ani_delay = (tallybuilder_meta($meta_id, 'title_ani_delay') == '' ? '' : 'data-wow-delay="'.tallybuilder_meta($meta_id, 'title_ani_delay').'"' );
	$subtitle_ani_delay = (tallybuilder_meta($meta_id, 'subtitle_ani_delay') == '' ? '2s' : 'data-wow-delay="'.tallybuilder_meta($meta_id, 'subtitle_ani_delay').'"' );
	$image_ani_delay = (tallybuilder_meta($meta_id, 'image_ani_delay') == '' ? '' : 'data-wow-delay="'.tallybuilder_meta($meta_id, 'image_ani_delay').'"' );
	$text_ani_delay = (tallybuilder_meta($meta_id, 'text_ani_delay') == '' ? '' : 'data-wow-delay="'.tallybuilder_meta($meta_id, 'text_ani_delay').'"' );
	$button1_ani_delay = (tallybuilder_meta($meta_id, 'button1_ani_delay') == '' ? '2s' : 'data-wow-delay="'.tallybuilder_meta($meta_id, 'button1_ani_delay').'"' );
	$button2_ani_delay = (tallybuilder_meta($meta_id, 'button2_ani_delay') == '' ? '2s' : 'data-wow-delay="'.tallybuilder_meta($meta_id, 'button2_ani_delay').'"' );
	
	$predefined_class = (tallybuilder_meta($meta_id, 'predefined_class') == '' ? NULL : ' tb_text_'.tallybuilder_meta($meta_id, 'predefined_class') );
	
	if(($image != '') && ($image_position != 'none')){ 
		$image = '<div class="col-md-'.$image_column.' tb_image_warp"><div class="tb_image_warp_inner"><img src="'.$image.'" alt="'.$title.'" class="tb_image '.$ani_image.'" '.$image_ani_duration.' '.$image_ani_delay.'></div></div>'; 
	}else{
		$image = '';
		$content_column = '12';
	}
	
	$video_bg = tallybuilder_meta($meta_id, 'video_bg');
	$video_bg_mp4 = (tallybuilder_meta($meta_id, 'video_bg_mp4') == '' ? NULL : 'mp4:'.tallybuilder_meta($meta_id, 'video_bg_mp4').', ');
	$video_bg_webm = (tallybuilder_meta($meta_id, 'video_bg_webm') == '' ? NULL : 'webm:'.tallybuilder_meta($meta_id, 'video_bg_webm').', ');
	$video_bg_ogv = (tallybuilder_meta($meta_id, 'video_bg_ogv') == '' ? NULL : 'ogv:'.tallybuilder_meta($meta_id, 'video_bg_ogv').', ');
	$video_bg_poster = (tallybuilder_meta($meta_id, 'video_bg_poster') == '' ? NULL : 'poster:'.tallybuilder_meta($meta_id, 'video_bg_poster').', ');
	
	if(($video_bg == 'yes') && ($video_bg_mp4 != '')){
		$video_bg = 'data-vide-bg="'.$video_bg_mp4 . $video_bg_webm . $video_bg_ogv . $video_bg_poster.'" ';
		$video_bg .= 'data-vide-options="posterType: jpg, loop: false, muted: false, position: 0% 0%, autoplay: true,  loop: true"';
	}else{
		$video_bg = '';	
	}
	
	$css_classes = 'tallybuilder_section tbs_text ';
	$css_classes .= ' tb_align_'.$align;
	$css_classes .= ' tbs_text_'.get_the_ID();
	$css_classes .= ' tb_image_position_'.$image_position;
	$css_classes .= ' tb_image_float_'.$image_float;
	$css_classes .= ' tb_content_align_'.$content_align;
	$css_classes .= ' '.$predefined_class;
	if( $video_bg != '' ){ $css_classes .= ' no-bg'; }
	?>
	<section class="<?php echo $css_classes . ' ' . $div_class; ?>" <?php echo $div_id; ?> <?php echo $video_bg; ?>>
    	<div class="tallybuilder_section_inner">
        	<div class="container-fluid tb_1st_con">
            	<div class="row tb_1st_row">
        			<?php if(($image_position != 'bottom') && ($image_position != 'right') && ($image_position != 'right_half')){ echo $image; } ?>
                    <div class="col-md-<?php echo $content_column; ?> tb_content_warp">
						<div class="tb_content_warp_inner">
							<?php if(($title != '') || ($subtitle != '')): ?>
								<div class="tb_title">
									<h1 class="<?php echo $ani_title; ?>" <?php echo $title_ani_duration; ?> <?php echo $title_ani_delay; ?>><?php echo $title; ?></h1>
									<h3 class="<?php echo $ani_subtitle; ?>" <?php echo $subtitle_ani_duration; ?> <?php echo $subtitle_ani_delay; ?>><?php echo $subtitle; ?></h3>
								</div>
							<?php endif; ?>
                                
							<?php if(($des != '')): ?>
								<div class="tb_content <?php echo $ani_text; ?>" <?php echo $text_ani_duration; ?> <?php echo $text_ani_delay; ?>>
									<?php echo apply_filters('the_content', $des); ?>
								</div>
							<?php endif; ?>
                                
							<?php if(($more1_text != '') && ($more1_link != '')): ?>
								<a href="<?php echo $more1_link; ?>" class="btn btn-<?php echo $button_size; ?> btn-<?php echo $color_button1; ?> <?php echo $ani_button1; ?>" <?php echo $button1_ani_duration; ?> <?php echo $button1_ani_delay; ?>>
									<?php echo $more1_text; ?>
								</a>
							<?php endif; ?>
							<?php if(($more2_text != '') && ($more2_link != '')): ?>
								<a href="<?php echo $more2_link; ?>" class="btn btn-<?php echo $button_size; ?> btn-<?php echo $color_button2; ?>  <?php echo $ani_button2; ?>" <?php echo $button2_ani_duration; ?> <?php echo $button2_ani_delay; ?>>
									<?php echo $more2_text; ?>
								</a>
							<?php endif; ?>
						</div>
                    </div>
            		<?php if(($image_position == 'bottom') || ($image_position == 'right') || ($image_position == 'right_half')){ echo $image; } ?>
            	</div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
<?php endif; ?>