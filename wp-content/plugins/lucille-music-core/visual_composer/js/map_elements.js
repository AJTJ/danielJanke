jQuery(document).ready(function($){
	"use strict";

	var meta_image_frame;

	$('.lc_add_media_file_btn').click(function(e){
		e.preventDefault();

		var $trigger_btn = $(this);

        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }

        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: "Add Media File",
            button: { text:  "Attach Media" },
            library: { type: 'audio' },
            multiple: false
        });

        meta_image_frame.on('select', function(){
			var audio_selection = meta_image_frame.state().get('selection').first().toJSON();

			$trigger_btn.parent().parent().find('input').val(audio_selection.id);
			$trigger_btn.parent().parent().find('.lc_wave_song_preview').text(audio_selection.filename);
			$trigger_btn.parent().parent().find('.lc_wave_song_preview').addClass("show_song_title");
         });
 
        meta_image_frame.open();        
	});

	$('.lc_remove_media_file_btn').click(function(e){
		e.preventDefault();
		$(this).parent().parent().find('input').val('');
		$(this).parent().parent().find('.lc_wave_song_preview').empty();
		$(this).parent().parent().find('.lc_wave_song_preview').removeClass("show_song_title");
		
	});
});