(function( $ ) {
 
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $( '.tallybuilder_mb_color').wpColorPicker();
		$( ".tallybuilder_mb_tab" ).tabs();
    });

})( jQuery );


/*(function($){
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
})(jQuery);*/



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
	
	
});
})(jQuery);




jQuery(document).ready(function($) {
		
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