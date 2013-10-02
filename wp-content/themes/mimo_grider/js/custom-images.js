jQuery(document).ready(function() {
 
	jQuery('.custom_upload_image_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).siblings('.custom_preview_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			classes = jQuery('img', html).attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});
 
	jQuery('.custom_clear_image_button').click(function() {
		var defaultImage = jQuery('.custom_default_image').text();
		jQuery(this).parent().parent().find('.custom_upload_image').val('');
		jQuery(this).parent().parent().find('.custom_preview_image').attr('src', defaultImage);
		return false;
	});
 
        jQuery('.repeatable-add').click(function() {
                var defaultImage = jQuery('.custom_default_image').text();
                field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
                fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
                jQuery('img.custom_preview_image', field).attr('src', defaultImage);
                jQuery('input.custom_upload_image', field).val('').attr('name', function(index, name) {
                        return name.replace(/(\d+)/, function(fullMatch, n) {
                                return Number(n) + 1;
                        });
                })
                field.insertAfter(fieldLocation, jQuery(this).closest('td'))
                return false;
        });
 
        jQuery('.repeatable-remove').click(function(){
                jQuery(this).parent().remove();
                return false;
        });
 //Se comenta porque falla en firefox y no funciona
       
 
});
