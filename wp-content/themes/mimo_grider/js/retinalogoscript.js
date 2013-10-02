var formfield3, tbframe_interval;
jQuery(document).ready(function() {
    // Bind the click to your upload image button
    jQuery('.upload_retinalogoimage_button').click(function() {
            // Which gets the name of the input field
            formfield3 = '.retinalogoimage_input';
            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
            // Set an interval to change the button text from Insert Into Post
            tbframe_interval = setInterval(function() {
                jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');
                }, 2000);
            return false;
    });
    // Bind event to the focus of the input field to trigger the media upload
    jQuery('.retinalogoimage_input').focus(function() {
        jQuery('.upload_retinalogoimage_button').trigger(click);
    });
    // Bind click event to the delete button if it is already displayed
    jQuery('.deleteretinalogo').click(function() {removeImage3();});
    // Get original send to editor because we are about to override it
    window.old_send_to_editor = window.send_to_editor;
    // Custom function to override where media upload sends data
    window.send_to_editor = function(html3) {
        // If formfield set, means we're using our custom function
        if (formfield3) {
                // Have to add tags around html in order to be sure finds img src
                imgurl3 = jQuery('img','<p>' + html3 + '</p>').attr('src');
                // Send the img url to the input field
                jQuery(formfield3).val(imgurl3);
                // Remove the media upload box
                tb_remove();
                // Call our function to display image
                renderImage3(imgurl3);
                // Clear the formfield
                formfield3 = "";
                // Clear the interval that changes the button name
                clearInterval(tbframe_interval);
            // If not, use the original function
            } else {
                window.old_send_to_editor(html3);
            }
      }
});

// function to load the image url into the correct input box
function renderImage3(img3) {
    // Load the image into the div we set up to display it
    // Also throws in a delete button to remove the image
    jQuery('#preview_retinalogoimage').html('<img src="' + img3 + '" alt="" /><div class="clear"></div>');
    // Bind the click to the delete in order to remove the image
    jQuery('.deleteretinalogo').click(function() {removeImage3();});
}

// Function we call when the delete button is clicked
function removeImage3() {
    jQuery('#preview_retinalogoimage').html('');
    jQuery('.retinalogoimage_input').val('');
}
