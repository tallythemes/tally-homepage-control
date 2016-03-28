(function( $ ) {
 
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $( '.tallybuilder_mb_color').wpColorPicker();
		$( ".tallybuilder_mb_tab" ).tabs();
    });

})( jQuery );


(function($){
$(function() {
	var all_section = $('div[id*="tbSection_"]');
	$(all_section).css('display', 'none');
	
    $('#section_type').change(function() {
		var tbSection_name = $(this).val();
		var tbSection_id = '#tbSection_'+tbSection_name+"_metabox";
		$(all_section).css('display', 'none');
		$(tbSection_id).css('display', 'block');
    }).change();

});
})(jQuery);



(function($){
$(function() {
	
	$('.tbmb_showhide').click(function(){
		var tbmb_showhide_div = $(this).attr('rel');
		$(tbmb_showhide_div).css('display', 'block');
		
		return false;
	});
	$('.tbmb_showhide_close').click(function(){
		$(this).parent().parent().css('display', 'none');
		
		return false;
	});
	
	
	
	function tbRow_layout( row_i ){
		var row_id = '#tbmb_row'+row_i+'_layout';
		var row_edit_setting = '.tbmb_edit_row'+row_i+'_setting';
		var col_1 = '.tbmb_column_'+row_i+'1';
		var col_2 = '.tbmb_column_'+row_i+'2';
		var col_3 = '.tbmb_column_'+row_i+'3';
		var col_4 = '.tbmb_column_'+row_i+'4';
		
		
		$(row_id).change(function() {
			
			var tbRow_layout = $(this).val();
			var tbRow_layout_array = tbRow_layout.split(",");
			
			if(tbRow_layout == "0,0,0,0"){
				$(row_edit_setting).removeClass('tbmb_edit_row_setting_show');
				$(row_edit_setting).addClass('tbmb_edit_row_setting_none');
			}else{
				$(row_edit_setting).removeClass('tbmb_edit_row_setting_none');
				$(row_edit_setting).addClass('tbmb_edit_row_setting_show');
			}
			
			$(col_1).removeClass('tbmb_col_0');
			$(col_1).removeClass('tbmb_col_3');
			$(col_1).removeClass('tbmb_col_4');
			$(col_1).removeClass('tbmb_col_6');
			$(col_1).removeClass('tbmb_col_8');
			$(col_1).removeClass('tbmb_col_12');
			$(col_1).addClass('tbmb_col_'+tbRow_layout_array[0]);
			
			$(col_2).removeClass('tbmb_col_0');
			$(col_2).removeClass('tbmb_col_3');
			$(col_2).removeClass('tbmb_col_4');
			$(col_2).removeClass('tbmb_col_6');
			$(col_2).removeClass('tbmb_col_8');
			$(col_2).removeClass('tbmb_col_12');
			$(col_2).addClass('tbmb_col_'+tbRow_layout_array[1]);
			
			$(col_3).removeClass('tbmb_col_0');
			$(col_3).removeClass('tbmb_col_3');
			$(col_3).removeClass('tbmb_col_4');
			$(col_3).removeClass('tbmb_col_6');
			$(col_3).removeClass('tbmb_col_8');
			$(col_3).removeClass('tbmb_col_12');
			$(col_3).addClass('tbmb_col_'+tbRow_layout_array[2]);
			
			$(col_4).removeClass('tbmb_col_0');
			$(col_4).removeClass('tbmb_col_3');
			$(col_4).removeClass('tbmb_col_4');
			$(col_4).removeClass('tbmb_col_6');
			$(col_4).removeClass('tbmb_col_8');
			$(col_4).removeClass('tbmb_col_12');
			$(col_4).addClass('tbmb_col_'+tbRow_layout_array[3]);
			
		}).change();
	}
	
	tbRow_layout( 1 );
	tbRow_layout( 2 );
	tbRow_layout( 3 );
	tbRow_layout( 4 );
	tbRow_layout( 5 );
});
})(jQuery);




jQuery(document).ready(function($) {
	
	tinymce.init({
            //selector: 'customEditor-' + nextPlusSignId,
            editor_selector: 'tb_mb_editor_textarea',
            mode: "specific_textareas",
            media_buttons: false,
            menubar: false,
            //content_css: nw.baseurl + '/skins/wordpress/wp-content.css',
            body_class: 'mceContentBody webkit wp-editor wp-autoresize html4-captions has-focus',

        });
	
	$('.tbmb_content_type').change(function() {    
	
		var data = {
			'action': 'tbmb_metabox_content',
			'meta_data': $('#tbmb_all_meta_data').val(),
			'meta_id': $('#tbmb_all_meta_id').val(),
			'post_id': $('#tbmb_all_post_id').val(),
			'prefix' : $(this).attr('data-prefix'),
			'con_type' : $(this).val(),
		};
		
		var result_div = $(this).attr('rel');
		
		// We can also pass the url value separately from ajaxurl for front end AJAX implementations
		jQuery.post(tbmb_object.ajax_url, data, function(response) {
			$(result_div).html(response);
			
			tinymce.init(tinyMCEPreInit.mceInit['tb_mb_editor_textarea']);
		});
	
	}).change();
});