jQuery(document).ready(function($){
	"use strict";

	var upload_image_frame;

	$('#swp_upload_artist_add_img').click(function(e){
		e.preventDefault();
 
 		openAndHandleMedia($, upload_image_frame, '#artist_add_img_val', '#artist_add_img_preview img', "Choose Artist Image", "Use this image");
	});

	$('#swp_remove_artist_add_img').click(function(){ 
			$('#artist_add_img_preview img').attr('src', '');
			$('#artist_add_img_val').val('');
	});

	handleMultiDayCheckOnEvent($);
});

function openAndHandleMedia($, meta_image_frame, inputId, pathToImgId, titleText, buttonText) {
	// If the frame already exists, re-open it.
	if ( upload_image_frame ) {
		upload_image_frame.open();
		return;
	}

	// Sets up the media library frame
	upload_image_frame = wp.media.frames.upload_image_frame = wp.media({
		title: titleText,
		button: {text:  buttonText},
		library: {type: 'image'}
	});

	// Runs when an image is selected.
	upload_image_frame.on('select', function(){

		// Grabs the attachment selection and creates a JSON representation of the model.
		var media_attachment = upload_image_frame.state().get('selection').first().toJSON();

		// Sends the attachment URL to our custom image input field.
		$(inputId).val(media_attachment.url);
		$(pathToImgId).attr('src', media_attachment.url);
	});

	// Opens the media library frame.
	upload_image_frame.open();
}

function handleMultiDayCheckOnEvent($) {
	$('.event_multiday_check').each(function(){
	    if (this.checked) {
	    	$('.event_end_date_container').show();
	    } else {
			$('.event_end_date_container').hide();
	    }
	});

	$('.event_multiday_check').click(function() {
	    if (this.checked) {
	    	$('.event_end_date_container').show();
	    	$('.event_end_date_input').val($('.event_date_input').val());
	    } else {
			$('.event_end_date_container').hide();
			$('event_end_date_input').val("");
	    }
	});
}