jQuery(window).load(function(){
	
	jQuery('.repeatable_videos-add').click(function() {  
    field = jQuery(this).closest('td').find('.custom_repeatable_videos li:last').clone(true);  
    fieldLocation = jQuery(this).closest('td').find('.custom_repeatable_videos li:last');  
    jQuery('input', field).val('').attr('name', function(index, name) {  
        return name.replace(/(\d+)/, function(fullMatch, n) {  
            return Number(n) + 1;  
        });  
    })  
    field.insertAfter(fieldLocation, jQuery(this).closest('td'))  
    return false;  
});  
  
jQuery('.repeatable_videos-remove').click(function(){  
    jQuery(this).parent().remove();  
    return false;  
});  
   
});