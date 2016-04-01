<?php if(get_post_meta(get_the_ID(), 'section_disable', true) != 'yes'): ?>
	
	<?php
	$meta_id = 'tbsf_text';
	$base = '.tbs_text_'.get_the_ID();
	
	$padding_top = (tallybuilder_meta($meta_id, 'padding_top') == '' ? '' : 'padding-top:'.tallybuilder_meta($meta_id, 'padding_top').';' );
	$padding_bottom = (tallybuilder_meta($meta_id, 'padding_bottom') == '' ? '' : 'padding-bottom:'.tallybuilder_meta($meta_id, 'padding_bottom').';' );
	$title_size = (tallybuilder_meta($meta_id, 'title_size') == '' ? '' : 'font-size:'.tallybuilder_meta($meta_id, 'title_size').';' );
	$subtitle_size = (tallybuilder_meta($meta_id, 'subtitle_size') == '' ? '' : 'font-size:'.tallybuilder_meta($meta_id, 'subtitle_size').';' );
	$font_size = (tallybuilder_meta($meta_id, 'font_size') == '' ? '' : 'font-size:'.tallybuilder_meta($meta_id, 'font_size').';' );
	
	$bg_color = (tallybuilder_meta($meta_id, 'bg_color') == '' ? '' : 'background-color:'.tallybuilder_meta($meta_id, 'bg_color').';' );
	$bg_image = (tallybuilder_meta($meta_id, 'bg_image') == '' ? '' : 'background-image:url('.tallybuilder_meta($meta_id, 'bg_image').');' );
	$bg_repeat = (tallybuilder_meta($meta_id, 'bg_repeat') == '' ? '' : 'background-repeat:'.tallybuilder_meta($meta_id, 'bg_repeat').';' );
	$bg_attachment = (tallybuilder_meta($meta_id, 'bg_attachment') == '' ? '' : 'background-attachment:'.tallybuilder_meta($meta_id, 'bg_attachment').';' );
	$bg_position = (tallybuilder_meta($meta_id, 'bg_position') == '' ? '' : 'background-position:'.tallybuilder_meta($meta_id, 'bg_position').';' );
	$bg_size = (tallybuilder_meta($meta_id, 'bg_size') == '' ? '' : 'background-size:'.tallybuilder_meta($meta_id, 'bg_size').';' );
	
	$color_title = (tallybuilder_meta($meta_id, 'color_title') == '' ? '' : 'color:'.tallybuilder_meta($meta_id, 'color_title').';' );
	$color_subtitle = (tallybuilder_meta($meta_id, 'color_subtitle') == '' ? '' : 'color:'.tallybuilder_meta($meta_id, 'color_subtitle').';' );
	$color_text = (tallybuilder_meta($meta_id, 'color_text') == '' ? '' : 'color:'.tallybuilder_meta($meta_id, 'color_text').';' );
	$color_border = (tallybuilder_meta($meta_id, 'color_border') == '' ? '' : 'border-color:'.tallybuilder_meta($meta_id, 'color_border').';' );
	$color_link = (tallybuilder_meta($meta_id, 'color_link') == '' ? '' : 'color:'.tallybuilder_meta($meta_id, 'color_link').';' );
	$color_link_hover = (tallybuilder_meta($meta_id, 'color_link_hover') == '' ? '' : 'color:'.tallybuilder_meta($meta_id, 'color_link_hover').';' );
	
	$content_padding_top = (tallybuilder_meta($meta_id, 'content_padding_top') == '' ? '' : 'padding-top:'.tallybuilder_meta($meta_id, 'content_padding_top').';' );
	$content_padding_bottom = (tallybuilder_meta($meta_id, 'content_padding_bottom') == '' ? '' : 'padding-bottom:'.tallybuilder_meta($meta_id, 'content_padding_bottom').';' );
	$content_padding_left = (tallybuilder_meta($meta_id, 'content_padding_left') == '' ? '' : 'padding-left:'.tallybuilder_meta($meta_id, 'content_padding_left').';' );
	$content_padding_right = (tallybuilder_meta($meta_id, 'content_padding_right') == '' ? '' : 'padding-right:'.tallybuilder_meta($meta_id, 'content_padding_right').';' );
	
	$content_margin_top = (tallybuilder_meta($meta_id, 'content_margin_top') == '' ? '' : 'margin-top:'.tallybuilder_meta($meta_id, 'content_margin_top').';' );
	$content_margin_bottom = (tallybuilder_meta($meta_id, 'content_margin_bottom') == '' ? '' : 'margin-bottom:'.tallybuilder_meta($meta_id, 'content_margin_bottom').';' );
	$content_margin_left = (tallybuilder_meta($meta_id, 'content_margin_left') == '' ? '' : 'margin-left:'.tallybuilder_meta($meta_id, 'content_margin_left').';' );
	$content_margin_right = (tallybuilder_meta($meta_id, 'content_margin_right') == '' ? '' : 'margin-right:'.tallybuilder_meta($meta_id, 'content_margin_right').';' );
	
	$image_padding_top = (tallybuilder_meta($meta_id, 'image_padding_top') == '' ? '' : 'padding-top:'.tallybuilder_meta($meta_id, 'image_padding_top').';' );
	$image_padding_bottom = (tallybuilder_meta($meta_id, 'image_padding_bottom') == '' ? '' : 'padding-bottom:'.tallybuilder_meta($meta_id, 'image_padding_bottom').';' );
	$image_padding_left = (tallybuilder_meta($meta_id, 'image_padding_left') == '' ? '' : 'padding-left:'.tallybuilder_meta($meta_id, 'image_padding_left').';' );
	$image_padding_right = (tallybuilder_meta($meta_id, 'image_padding_right') == '' ? '' : 'padding-right:'.tallybuilder_meta($meta_id, 'image_padding_right').';' );
	
	$image_margin_top = (tallybuilder_meta($meta_id, 'image_margin_top') == '' ? '' : 'margin-top:'.tallybuilder_meta($meta_id, 'image_margin_top').';' );
	$image_margin_bottom = (tallybuilder_meta($meta_id, 'image_margin_bottom') == '' ? '' : 'margin-bottom:'.tallybuilder_meta($meta_id, 'image_margin_bottom').';' );
	$image_margin_left = (tallybuilder_meta($meta_id, 'image_margin_left') == '' ? '' : 'margin-left:'.tallybuilder_meta($meta_id, 'image_margin_left').';' );
	$image_margin_right = (tallybuilder_meta($meta_id, 'image_margin_right') == '' ? '' : 'margin-right:'.tallybuilder_meta($meta_id, 'image_margin_right').';' );
	
	$image_max_height = (tallybuilder_meta($meta_id, 'image_max_height') == '' ? '' : 'max-height:'.tallybuilder_meta($meta_id, 'image_max_height').';' );
	$image_max_width = (tallybuilder_meta($meta_id, 'image_max_width') == '' ? '' : 'max-width:'.tallybuilder_meta($meta_id, 'image_max_width').'; width: 100%;' );
	$image_height = (tallybuilder_meta($meta_id, 'image_height') == '' ? '' : 'height:'.tallybuilder_meta($meta_id, 'image_height').';' );
	$image_width = (tallybuilder_meta($meta_id, 'image_width') == '' ? '' : 'width:'.tallybuilder_meta($meta_id, 'image_width').';' );
	$image = (tallybuilder_meta($meta_id, 'image') == '' ? '' : 'background-image:url('.tallybuilder_meta($meta_id, 'image').');' );
	
	tallybuilder_css_style($base.':before', tallybuilder_meta($meta_id, 'bg_overlay_color'), 'background-color:%s%;');
	tallybuilder_css_style($base.':before', tallybuilder_meta($meta_id, 'bg_overlay_opacity'), 'opacity:%s%;');
	tallybuilder_css_style($base.' .tallybuilder_section_inner .tb_1st_con', tallybuilder_meta($meta_id, 'content_width'), 'max-width:%s%;');
	tallybuilder_css_style($base.' .tallybuilder_section_inner', tallybuilder_meta($meta_id, 'section_width'), 'max-width:%s%; width: 100%;');

	?>
    <?php echo $base; ?>{
		<?php 
		echo $bg_color;
		echo $bg_image;
		echo $bg_attachment;
		echo $bg_position;
		echo $bg_size;
		echo $bg_repeat;
		echo $color_text;
		echo $font_size;
		echo $color_border;
		echo $padding_top;
		echo $padding_bottom; 
		?>
    }
	<?php echo $base; ?> .tb_title h1{
		<?php 
		echo $color_title;
		echo $title_size;
		?>
	}
	<?php echo $base; ?> .tb_title h3{
		<?php 
		echo $color_title;
		echo $subtitle_size;
		?>
	}
	<?php echo $base; ?> a{
		<?php echo $color_link; ?>
	}
	<?php echo $base; ?> a:hover{
		<?php echo $color_link_hover; ?>
	}
    <?php echo $base; ?> .tb_content_warp_inner{
     	<?php 
		echo $content_padding_top;
		echo $content_padding_bottom;
        echo $content_padding_left;
        echo $content_padding_right;
        echo $content_margin_top;
		echo $content_margin_bottom;
        echo $content_margin_left;
        echo $content_margin_right; 
        ?>
    }
    <?php echo $base; ?> .tb_image_warp_inner{
     	<?php 
		echo $image_padding_top;
		echo $image_padding_bottom;
        echo $image_padding_left;
        echo $image_padding_right;
        echo $image_margin_top;
		echo $image_margin_bottom;
        echo $image_margin_left;
        echo $image_margin_right;
		?>
    }
    <?php echo $base; ?> .tb_image{
		<?php 
		echo $image_max_width;
    	echo $image_max_height; 
		echo $image_height;
		echo $image_width;
		?>
    }
    <?php echo $base; ?>.tb_image_position_right_half .tb_image_warp_inner,
    <?php echo $base; ?>.tb_image_position_left_half .tb_image_warp_inner{
       <?php echo $image; ?>
    }
    
    @media (max-width: 991px) {
		<?php echo $base; ?>{
            <?php 
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'padding_top'), 'padding-top', '/', 2);
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'padding_bottom'), 'padding-bottom', '/', 2);
            ?>
        }
        <?php echo $base; ?> .tb_content_warp_inner{
			<?php 
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'content_padding_top'), 'padding-top', '/', 2);
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'content_padding_bottom'), 'padding-bottom', '/', 2);
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'content_margin_top'), 'margin-top', '/', 2);
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'content_margin_bottom'), 'margin-bottom', '/', 2);
            ?>
        }
        <?php echo $base; ?> .tb_image_warp_inner{
            <?php 
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'image_padding_top'), 'padding-top', '/', 2);
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'image_padding_bottom'), 'padding-bottom', '/', 2);
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'image_margin_top'), 'margin-top', '/', 2);
			echo tallybuilder_css_margin_padding(tallybuilder_meta($meta_id, 'image_margin_bottom'), 'margin-bottom', '/', 2);
            ?>
        }
	}
<?php endif; ?>