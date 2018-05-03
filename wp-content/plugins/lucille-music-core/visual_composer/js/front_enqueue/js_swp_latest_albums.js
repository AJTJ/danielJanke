window.InlineShortcodeView_js_swp_latest_albums = window.InlineShortcodeView.extend({
	
	/* Render called every time when some of attributes changed.*/
	render: function () {

        /* it is recommended to call parent method to avoid new versions problems.*/
		window.InlineShortcodeView_js_swp_latest_albums.__super__.render.call(this); 

		/* There is a place where you can implement logic for rendering / element param changing and all other javascript logic what you can imagine.*/
		this.handleCoverBgImageFrontEditor();
		return this;
	},

	handleCoverBgImageFrontEditor: function() {
		jQuery(this.$el.find(".lc_swp_background_image")).each(function() {
			var imgSrc = jQuery(this).data("bgimage");

			jQuery(this).css("background-image", "url("+imgSrc+")");
			jQuery(this).css("background-position", "center center");
			jQuery(this).css("background-repeat", "no-repeat");
			jQuery(this).css("background-size","cover");
		});		
	}
});