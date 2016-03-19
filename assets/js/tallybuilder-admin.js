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