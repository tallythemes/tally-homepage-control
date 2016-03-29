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
	
	$(".tbmb_content_item.disabled :input").attr("disabled", true);
	$(".tbmb_content_item.disabled").css("display", 'none');
	
	$('.tbmb_content_type').change(function() {    
	
		var selected_item_class = '.tbmb_content_item'+$(this).attr('rel')+'__'+$(this).val();
		var all_item_class = '.tbmb_content_item'+$(this).attr('rel');
		
		$(all_item_class+" :input").attr("disabled", true);
		$(all_item_class).addClass("disabled");
		$(all_item_class).css("display", 'none');
		$(selected_item_class+" :input").attr("disabled", false);
		$(selected_item_class).removeClass("disabled");
		$(selected_item_class).css("display", 'block');
	
	}).change();
	
	
	
	$( ".tbmb_enable_content" ).on( "click", function() {
		var tbmb_enable_content = $(this).attr('rel');
		if($(this).is(":checked")){
			$(tbmb_enable_content).css("display", 'block');
		}
		else if($(this).is(":not(:checked)")){
			$(tbmb_enable_content).css("display", 'none');
		}
	});
});