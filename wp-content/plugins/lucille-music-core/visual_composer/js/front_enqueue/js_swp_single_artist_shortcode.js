window.InlineShortcodeView_js_swp_single_artist_shortcode = window.InlineShortcodeView.extend({
	
	/* Render called every time when some of attributes changed.*/
	render: function () {

        /* it is recommended to call parent method to avoid new versions problems.*/
		window.InlineShortcodeView_js_swp_single_artist_shortcode.__super__.render.call(this); 

		/* There is a place where you can implement logic for rendering / element param changing and all other javascript logic what you can imagine.*/
		this.handleCoverBgImageFrontEditor();
		this.handleArtistImageContainer();
		this.handleBgColorForOverlay();
		return this;
	},

	handleCoverBgImageFrontEditor: function() {
		jQuery(this.$el.find(".lc_swp_background_image")).each(function() {
			var imgSrc = jQuery(this).data("bgimage");
			var bg_position = "center center";

			if (jQuery(this).hasClass('swp_align_bg_img')) {
				bg_position = "center " + jQuery(this).data('valign');
			}

			jQuery(this).css("background-image", "url("+imgSrc+")");
			jQuery(this).css("background-position", bg_position);
			jQuery(this).css("background-repeat", "no-repeat");
			jQuery(this).css("background-size","cover");
		});
	},

	handleArtistImageContainer: function() {
		jQuery(this.$el.find('.artist_img_container')).each(function() {
			var no_px_width = parseFloat(jQuery(this).css('width'));
			jQuery(this).css("height", no_px_width * 1.1);
			jQuery(this).parent().parent().css("opacity", 1);
		});
	},

	handleBgColorForOverlay: function() {
		jQuery(this.$el.find(".lc_swp_bg_color")).each(function() {
			var bgColor = jQuery(this).data("color");
			jQuery(this).css("background-color", bgColor)
		});		
	}
});