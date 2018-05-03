<?php
/*
	Map existing shortcodes to Visual Composer
	Shortcodes already defined in add_shortcodes.php
*/
if (function_exists('vc_map')) {
	/*
		Gallery shortcode - ok
	*/
	if (shortcode_exists('js_swp_gallery')) {
	
		add_action( 'vc_before_init', 'LUCILLE_SWP_map_js_swp_gallery' );
		function LUCILLE_SWP_map_js_swp_gallery() {
			vc_map( array(
				  "name" => esc_html__("Gallery", "lucille-music-core"),
				  "base" => "js_swp_gallery",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_gallery.png",
				  "front_enqueue_js" => CDIR_URL . "visual_composer/js/front_enqueue/js_swp_gallery.js",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Row height in pixels", "lucille-music-core"),
						"param_name" => "rowheight",
						"value" => "180",
						"admin_label"	=> true,
						"description" => esc_html__("Row height in pixels. Digits only. Default value: 180", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "View all text message", "lucille-music-core"),
						"param_name" => "viewallmessage",
						"value" => "",
						"description" => esc_html__("View all text message. If empty, default value is: View All Images", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Gallery Page URL", "lucille-music-core"),
						"param_name" => "photosurl",
						"value" => "",
						"description" => esc_html__("URL to all Photo Gallery page.", "lucille-music-core")
					),						
					array(
						"type" => "attach_images",
						"class" => "",
						"heading" => esc_html__( "Add images", "lucille-music-core"),
						"param_name" => "images",
						"value" => "",
						"description" => esc_html__("Add your images here", "lucille-music-core")
					)
				  )
			));
		}
	}
	
	/*
		Featured Album Ahortcode - ok
	*/
	if (shortcode_exists('js_swp_last_album')) {
	
		add_action( 'vc_before_init', 'LUCILLE_SWP_map_js_swp_last_album' );
		function LUCILLE_SWP_map_js_swp_last_album() {
			$args = array(
				'numberposts'		=> 	100,
				'posts_per_page'   => 100,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'js_albums',
				'post_status'      => 'publish',
				'suppress_filters' => true
			);
			$album_posts = get_posts($args);
			
			$albums_dropdown = array(); /*key(post_id)	=> value(post_name)*/
			foreach($album_posts as $single_album) {
					$my_post_id = $single_album->ID;
					$my_post_name = $single_album->post_title;
					
					$albums_dropdown[$my_post_name] = $my_post_id;
			}
			wp_reset_postdata();
			
			vc_map( array(
				  "name" => esc_html__("Featured Music Album", "lucille-music-core"),
				  "base" => "js_swp_last_album",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_music_album.png",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Select Album", "lucille-music-core"),
						"param_name" => "album_id",
						"value" => $albums_dropdown,
						"admin_label"	=> true,
						"description" => esc_html__("Select The Album You Want To Promote", "lucille-music-core")
					),
					array(
						"type" => "textarea_html",
						"class" => "",
						"heading" => esc_html__( "Short Album Description", "lucille-music-core"),
						"param_name" => "content",
						"value" => '',
						"description" => esc_html__("Please add the album description.", "lucille-music-core")
					)
				  )
			));
		}
	}

	/*
		Latest Albums
	*/
	if (shortcode_exists('js_swp_latest_albums')) {
		add_action( 'vc_before_init', 'LUCILLE_SWP_map_js_swp_latest_albums');
		function LUCILLE_SWP_map_js_swp_latest_albums() {
			$artist_dropdown = LUCILLE_SWP_artists_dropdown(true);

			vc_map( array(
				  "name" => esc_html__("Latest Music Albums", "lucille-music-core"),
				  "base" => "js_swp_latest_albums",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_music_album.png",
				  "front_enqueue_js" => CDIR_URL . "visual_composer/js/front_enqueue/js_swp_latest_albums.js",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "View more text message", "lucille-music-core"),
						"param_name" => "viewallmessage",
						"value" => "",
						"description" => esc_html__("View all text message. If empty, default value is: View More", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Discography Page URL", "lucille-music-core"),
						"param_name" => "discographypageurl",
						"value" => "",
						"description" => esc_html__("URL to Discography page.", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Number of Albums To Show", "lucille-music-core"),
						"param_name" => "albumsnumber",
						"value" => "3",
						"admin_label"	=> true,
						"description" => esc_html__("Number of Albums Displayed. Default value: 3.", "lucille-music-core")
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Albums On Row", "lucille-music-core"),
						"param_name" => "albums_on_row",
						"value" =>  array( 
										"3 Default" => "3",
										"2 On Row" => "2",
										"4 On Row" => "4",
										"5 On Row" => "5"
									),
						"admin_label"	=> true,
						"description" => esc_html__("Choose the number of albums on row.", "lucille-music-core")
					),
					array(
						"type" => "lucille_album_cat",
						"heading" => esc_html__( "Album Category", "lucille-music-core"),
						"param_name" => "album_category",
						"value" =>  "",
						"admin_label"	=> true,
						"description" => esc_html__("Show only albums from this category.", "lucille-music-core")
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Artist Name", "lucille-music-core"),
						"param_name" => "artist_id",
						"value" =>  $artist_dropdown,
						"admin_label"	=> true,
						"description" => esc_html__("Select the artist.", "lucille-music-core")
					)
				  )
			));
		}
	}
	
	/*
		Latest Videos Shortcode - ok
	*/
	if (shortcode_exists('js_swp_last_videos')) {
	
		add_action( 'vc_before_init', 'LUCILLE_SWP_map_js_swp_last_videos' );
		function LUCILLE_SWP_map_js_swp_last_videos() {
			$args = array(
					'numberposts'		=> 	-1,
					'category'         => '',
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'include'          => '',
					'exclude'          => '',
					'meta_key'         => '',
					'meta_value'       => '',
					'post_type'        => 'js_videos',
					'post_mime_type'   => '',
					'post_parent'      => '',
					'post_status'      => 'publish',
					'suppress_filters' => true
				);	
			$video_posts = get_posts($args);
			
			$video_dropdown = array(); /*key(post_id)	=> value(post_name)*/
			foreach($video_posts as $single_video) {
					$my_post_id = $single_video->ID;
					$my_post_name = $single_video->post_title;
					
					$video_dropdown[$my_post_name] = $my_post_id;
			}
			wp_reset_postdata();
			
			vc_map( array(
				  "name" => esc_html__("Featured Video", "lucille-music-core"),
				  "base" => "js_swp_last_videos",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_video.png",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Choose Video", "lucille-music-core"),
						"param_name" => "video_id",
						"value" => $video_dropdown,
						"admin_label"	=> true,
						"description" => esc_html__("Choose Featured Video", "lucille-music-core")
					)
				  )
			));
		}
	}
	
	/*
		Upcoming Events Shortcode - ok
	*/
	if (shortcode_exists('js_swp_last_events')) {

		add_action( 'vc_before_init', 'LUCILLE_SWP_map_js_swp_last_events_shortcode' );
		function LUCILLE_SWP_map_js_swp_last_events_shortcode() {
			$artist_dropdown = LUCILLE_SWP_artists_dropdown(true);

			vc_map( array(
				  "name" => esc_html__("Next Events", "lucille-music-core"),
				  "base" => "js_swp_last_events",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_event.png",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "View all text message", "lucille-music-core"),
						"param_name" => "viewallmessage",
						"value" => "",
						"description" => esc_html__("View all text message. If empty, default value is: View All Events", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Events Page URL", "lucille-music-core"),
						"param_name" => "eventspageurl",
						"value" => "",
						"description" => esc_html__("URL to Events page.", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Number of Events", "lucille-music-core"),
						"param_name" => "eventsnumber",
						"admin_label"	=> true,
						"value" => "5",
						"description" => esc_html__("Number of Events Displayed. Default value: 5.", "lucille-music-core")
					),
					array(
						"type" => "lucille_event_cat",
						"class" => "",
						"heading" => esc_html__("Event Category", "lucille-music-core"),
						"param_name" => "event_category",
						"admin_label"	=> true,
						"value" => "",
						"description" => esc_html__("Choose the event category. By default, events from all categories are shown.", "lucille-music-core")
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Show Events", "lucille-music-core"),
						"param_name" => "past_next",
						"value" =>  array( 
										"Upcoming" => "next",
										"Past" => "past"
									),
						"admin_label"	=> true,
						"description" => esc_html__("Choose to display upcoming or past events.", "lucille-music-core")
					),					
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Emphasize", "lucille-music-core"),
						"param_name" => "emphasize",
						"value" =>  array( 
										"First Row" => "first",
										"All Rows" => "all",
										"None" => "none"
									),
						"description" => esc_html__("Choose to display in a fancy way only the first row or all rows.", "lucille-music-core")
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Artist Name", "lucille-music-core"),
						"param_name" => "artist_id",
						"value" =>  $artist_dropdown,
						"admin_label"	=> true,
						"description" => esc_html__("Select the artist.", "lucille-music-core")
					)
				  )
			));
		}
	}
	
	/*
		Contact Form Shortcode - ok
	*/
	if (shortcode_exists('js_swp_ajax_contact_form')) {
	
		add_action( 'vc_before_init', 'LUCILLE_SWP_js_swp_ajax_contact_shortcode' );
		function LUCILLE_SWP_js_swp_ajax_contact_shortcode() {
			vc_map( array(
				  "name" => esc_html__("Ajax Contact Form", "lucille-music-core"),
				  "base" => "js_swp_ajax_contact_form",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_contact.png",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Input Styling", "lucille-music-core"),
						"param_name" => "input_styling",
						"value" =>  array( 
										"One on Row" => "one_on_row",
										"Three on Row" => "three_on_row"
									),
						"admin_label"	=> true,
						"description" => esc_html__("Choose how to render the input fields", "lucille-music-core")
					)
				  )
			));
		}
	}
	
	/*
		Section Heading - ok
	*/
	if (shortcode_exists('js_swp_row_heading')) {
	
		add_action( 'vc_before_init', 'LUCILLE_SWP_js_swp_row_heading_shortcode' );

		function LUCILLE_SWP_js_swp_row_heading_shortcode() {
			$defa_title = 'Section  <span class="lc_vibrant_color">Title</span>';

			vc_map( array(
				  "name" => esc_html__("Section Heading", "lucille-music-core"),
				  "base" => "js_swp_row_heading",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_heading.png",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "textarea_raw_html",
						"class" => "",
						"heading" => esc_html__( "Title", "lucille-music-core"),
						"param_name" => "title",
						"value" => "U2VjdGlvbiAgPHNwYW4gY2xhc3M9ImxjX3ZpYnJhbnRfY29sb3IiPlRpdGxlPC9zcGFuPg==",
						"description" => esc_html__("Section title - use &lt;span class=&quot;lc_vibrant_color&quot;&gt;some colored text&lt;/span&gt; to color one or more words in vibrant color.", "lucille-music-core")
					),/*
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Title transform" ),
						"param_name" => "title_transform",
						"value" => array(
							"No transform"	=> "no_transform",
							"Uppercase"		=> "text_uppercase"
						),
						"description" => esc_html__("Make section title uppercase", "lucille-music-core")
					),*/
					array(
						"type" => "textarea_raw_html",
						"class" => "",
						"heading" => esc_html__( "Subtitle", "lucille-music-core"),
						"param_name" => "subtitle",
						"value" => "U0VDVElPTiBTVUJUSVRMRQ==",
						"description" => esc_html__("Section subtitle (optional) - use &lt;span class=&quot;lc_vibrant_color&quot;&gt;some colored text&lt;/span&gt; to color one or more words in vibrant color.", "lucille-music-core")
					),/*
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Subtitle transform", "lucille-music-core"),
						"param_name" => "subtitle_transform",
						"value" => array(
							"No transform"	=> "no_transform",
							"Uppercase"		=> "text_uppercase"
						),
						"description" => esc_html__("Make section subtitle uppercase", "lucille-music-core")
					),*/
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Text align", "lucille-music-core"),
						"param_name" => "text_align",
						"value" => array(
							"Center"	=> "text_center",
							"Left"		=> "text_left",
							"Rigth"		=> "text_right"
						),
						"description" => esc_html__("Make section subtitle uppercase", "lucille-music-core")
					)
				  )
			));
		}
	}
	
	/*
		Lucille Button - ok
	*/
	if (shortcode_exists('js_swp_theme_button')) {
	
		add_action( 'vc_before_init', 'LUCILLE_SWP_js_swp_theme_button_map' );
		function LUCILLE_SWP_js_swp_theme_button_map() {
			vc_map( array(
				  "name" => esc_html__("Lucille Button", "lucille-music-core"),
				  "base" => "js_swp_theme_button",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_button.png",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Button Text", "lucille-music-core"),
						"param_name" => "button_text",
						"value" => "",
						"description" => esc_html__("Text shown on Button", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Button URL", "lucille-music-core"),
						"param_name" => "button_url",
						"value" => "",
						"description" => esc_html__("URL for this button", "lucille-music-core")
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Button Align", "lucille-music-core"),
						"param_name" => "button_align",
						"value"		=> array( 
										"Left" => "button_left",
										"Center" => "button_center",
										"Right" => "button_right"
									),
						"description" => esc_html__("Button alignment", "lucille-music-core")
					)
				  )
			));
		}
	}

	/*
		User Review - ok
	*/
	if (shortcode_exists('lc_swp_user_review')) {
		add_action( 'vc_before_init', 'LUCILLE_SWP_lc_swp_user_review_map' );
		function LUCILLE_SWP_lc_swp_user_review_map()
		{
			vc_map(array(
				  "name" => esc_html__("User Review", "lucille-music-core"),
				  "base" => "lc_swp_user_review",
				   "content_element" => true,
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_user_single.png",
				  "as_child" => array('only' => 'lc_review_slider'),
				  "params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__("Reviewer Name", "lucille-music-core"),
						"param_name" => "reviewer_name",
						"value" => "",
						"admin_label"	=> true,
						"description" => esc_html__("Reviewer Name", "lucille-music-core")
					),
					array(
						"type" => "attach_image",
						"class" => "",
						"heading" => esc_html__( "Reviewer Image", "lucille-music-core"),
						"param_name" => "reviewer_image",
						"value" => "",
						"description" => esc_html__("Image for the review author", "lucille-music-core")
					),
					array(
						"type" => "textarea",
						"class" => "",
						"heading" => esc_html__( "Review Content", "lucille-music-core"),
						"param_name" => "review_content",
						"value"		=> "",
						"admin_label"	=> true,
						"description" => esc_html__("Review Content", "lucille-music-core")
					)
				  )
			));
		}
	}
	
	if (shortcode_exists('lc_review_slider')) {
		add_action( 'vc_before_init', 'LUCILLE_SWP_lc_review_slider_map' );
		function LUCILLE_SWP_lc_review_slider_map()
		{
			vc_map( array(
				"name" => esc_html__("User Reviews Slider", "lucille-music-core"),
				"base" => "lc_review_slider",
				"category" => esc_html__("Lucille Elements", "lucille-music-core"),
				"as_parent" => array('only' => 'lc_swp_user_review'), /* Use only|except attributes to limit child shortcodes (separate multiple values with comma)*/
				"content_element" => true,
				"show_settings_on_create" => true,
				"is_container" => true,
				"js_view" => 'VcColumnView',
				"icon" => CDIR_URL . "visual_composer/vc_icons/vc_users.png",
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__("Slide Speed", "lucille-music-core"),
						"param_name" => "slide_speed",
						"value" => "400",
						"description" => esc_html__("Slide speed in milliseconds. Please use a value between 400 and 1000.", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Slide Delay", "lucille-music-core"),
						"param_name" => "slide_delay",
						"value" => "4000",
						"description" => esc_html__("Slide delay in milliseconds. Please use a value between 1000 and 10000.", "lucille-music-core")
					)
				  )
			));
		}
		
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_lc_review_slider extends WPBakeryShortCodesContainer {
			}
		}
	}

	/*Audio Player*/
	if (shortcode_exists('lc_wave_player')) {
		add_action( 'vc_before_init', 'LUCILLE_SWP_lc_wave_player_map' );
		function LUCILLE_SWP_lc_wave_player_map()
		{
			vc_map( array(
				"name" => esc_html__("Wave Player", "lucille-music-core"),
				"base" => "lc_wave_player",
				"category" => esc_html__("Lucille Elements", "lucille-music-core"),
				"as_parent" => array('only' => 'lc_swp_wave_song'), /* Use only|except attributes to limit child shortcodes (separate multiple values with comma)*/
				"content_element" => true,
				"show_settings_on_create" => true,
				"is_container" => true,
				"js_view" => 'VcColumnView',
				"icon" => CDIR_URL . "visual_composer/vc_icons/vc_play.png",
				"params" => array(
					array(
						"type" => "attach_image",
						"class" => "",
						"heading" => esc_html__("Add Cover Image", "lucille-music-core"),
						"param_name" => "cover_img",
						"value" => "",
						"description" => esc_html__("Attach a cover image for your player.", "lucille-music-core")
					),
			        array(
			            "type" => "colorpicker",
			            "class" => "",
			            "heading" => __( "Wave Color", "my-text-domain" ),
			            "param_name" => "wave_color",
			            "value" => '#9999999',
			        ),
			        array(
			            "type" => "colorpicker",
			            "class" => "",
			            "heading" => __( "Wave Progress Color", "my-text-domain" ),
			            "param_name" => "wave_progress_color",
			            "value" => '#555555',
			        ),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Autoplay", "lucille-music-core"),
						"param_name" => "autoplay",
						"value"		=> array( 
										"No" => "no",
										"Yes" => "yes"
									)
					)			         

				  )
			));
		}
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_lc_wave_player extends WPBakeryShortCodesContainer {
			}
		}		
	}	

	/*
		Wave Player Item
	*/
	if (shortcode_exists('lc_swp_wave_song')) {
		add_action( 'vc_before_init', 'LUCILLE_SWP_lc_swp_wave_song_map' );
		function LUCILLE_SWP_lc_swp_wave_song_map()
		{
			vc_map(array(
				  "name" => esc_html__("Player Entry", "lucille-music-core"),
				  "base" => "lc_swp_wave_song",
				  "content_element" => true,
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_music_list.png",
				  'admin_enqueue_js' => array(CDIR_URL . '/visual_composer/js/map_elements.js'),
				  'admin_enqueue_css' => array(CDIR_URL . '/visual_composer/css/map_elements.css'),
				  'front_enqueue_css' => array(CDIR_URL . '/visual_composer/css/map_elements.css'),
				  "as_child" => array('only' => 'lc_wave_player'),
				  "params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__("Song Name", "lucille-music-core"),
						"param_name" => "song_name",
						"value" => "",
						"admin_label"	=> true,
						"description" => esc_html__("Song Name", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Artist Name", "lucille-music-core"),
						"param_name" => "artist_name",
						"value" => "",
						"admin_label"	=> true,
						"description" => esc_html__("Name of the artist.", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Buy Text", "lucille-music-core"),
						"param_name" => "buy_txt",
						"value" => "Buy",
						"description" => esc_html__("Link text for buy or download (ex: Buy or Download) .", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Buy URL", "lucille-music-core"),
						"param_name" => "buy_url",
						"value" => "",
						"description" => esc_html__("URL where the visitor can buy or download song.", "lucille-music-core")
					),
					array(
						"type" => "lucille_attach_music",
						"class" => "",
						"heading" => esc_html__( "Media File", "lucille-music-core"),
						"param_name" => "media_file_id",
						"value" => "",
						"description" => esc_html__("Please attach a media file in mp3 format.", "lucille-music-core")
					)
				  )
			));
		}
	}

	/*
		add new params for visual composer
	*/
	add_action( 'vc_before_init', 'LUCILLE_SWP_add_lucille_new_params' );
	function LUCILLE_SWP_add_lucille_new_params() {
		vc_add_shortcode_param('lucille_post_cat', 'LUCILLE_SWP_vc_param_post_cat');
		vc_add_shortcode_param('lucille_event_cat', 'LUCILLE_SWP_vc_param_event_cat');
		vc_add_shortcode_param('lucille_album_cat', 'LUCILLE_SWP_vc_param_album_cat');
		vc_add_shortcode_param('lucille_attach_music', 'LUCILLE_SWP_vc_attach_music', CDIR_URL . '/visual_composer/js/map_elements.js');
	}
	function LUCILLE_SWP_vc_param_post_cat($settings, $value) {
		$args = array(
			'show_option_all'    => 'All',
			'class'              => 'wpb_vc_param_value',
			'name'               => $settings['param_name'],
			'selected'           => $value
		);

		ob_start();
		wp_dropdown_categories($args);
		$output = ob_get_clean();
		return $output;
	}

	function LUCILLE_SWP_vc_param_event_cat($settings, $value) {
		$args = array(
			'taxonomy'           => 'event_category',
			'show_option_all'    => 'All',
			'class'              => 'wpb_vc_param_value',
			'name'               => $settings['param_name'],
			'selected'           => $value
		);

		ob_start();
		wp_dropdown_categories($args);
		$output = ob_get_clean();
		return $output;		
	}

	function LUCILLE_SWP_vc_param_album_cat($settings, $value) {
		$args = array(
			'taxonomy'           => 'album_category',
			'show_option_all'    => 'All',
			'class'              => 'wpb_vc_param_value',
			'name'               => $settings['param_name'],
			'selected'           => $value
		);

		ob_start();
		wp_dropdown_categories($args);
		$output = ob_get_clean();
		return $output;			
	}

	function LUCILLE_SWP_vc_attach_music($settings, $value) {
		ob_start();

		$add_preview_class = "";
		if (!empty($value)) {
			$add_preview_class .= "show_song_title";
		}
		?>
        <input type="hidden" name="<?php echo esc_attr($settings['param_name']); ?>" 
        class="wpb_vc_param_value wpb-textinput <?php echo esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field'; ?>" 
        value="<?php echo esc_attr($value); ?>"/>

        <div class="lc_wave_song_preview <?php echo esc_attr($add_preview_class); ?>">
        	<?php echo wp_basename(get_attached_file($value)); ?>
        </div>

        <div class="attach_music_buttons clearfix">
	        <a class="lc_add_media_file_btn" title="<?php echo esc_attr(esc_html__( "Add Music File", "lucille-music-core"));?>" href="#">
	        	<i class="vc-composer-icon vc-c-icon-add"></i>
	        </a>

			<a class="lc_remove_media_file_btn" title="<?php echo esc_attr(esc_html__( "Remove File", "lucille-music-core"));?>" href="#">
	        	<i class="vc-composer-icon vc-c-icon-close"></i>
	        </a>
        </div>
		<?php
		$output = ob_get_clean();

		return $output;
	}

	/*
		Blog Shortcode - ok
	*/
	if (shortcode_exists('js_swp_blog_shortcode')) {
		add_action( 'vc_before_init', 'LUCILLE_SWP_blog_shortcode_map' );
		function LUCILLE_SWP_blog_shortcode_map()
		{
			vc_map(array(
				  "name" => esc_html__("Blog Posts", "lucille-music-core"),
				  "base" => "js_swp_blog_shortcode",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_blog.png",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__("Number Of Posts", "lucille-music-core"),
						"param_name" => "postsnumber",
						"value" => "3",
						"admin_label"	=> true,
						"description" => esc_html__("Number of posts to show. Default value: 3", "lucille-music-core")
					),
					array(
						"type" => "lucille_post_cat",
						"class" => "",
						"heading" => esc_html__("Post Category", "lucille-music-core"),
						"param_name" => "post_category",
						"value" => "",
						"admin_label"	=> true,
						"description" => esc_html__("Choose the post category. By default, posts from all categories are shown.", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__("Excerpt length", "lucille-music-core"),
						"param_name" => "user_excerpt_length",
						"value" => "15",
						"admin_label"	=> true,
						"description" => esc_html__("Number of words that the short description shoud have (excerpt). Use an integer value between 0 and 20. Default - 15 words.", "lucille-music-core")
					)
				  )
			));
		}
	}

	/*
		Social Profiles Shortcode - ok
	*/
	if (shortcode_exists('js_swp_social_profiles_icons')) {
		add_action( 'vc_before_init', 'LUCILLE_SWP_social_profiles_shortcode_map' );
		function LUCILLE_SWP_social_profiles_shortcode_map() {
			vc_map(array(
				  "name" => esc_html__("Social Profiles", "lucille-music-core"),
				  "base" => "js_swp_social_profiles_icons",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_social.png",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Align Icons", "lucille-music-core"),
						"param_name" => "center_icons",
						"value" =>  array( 
							"Center" => "text_center",
							"Left" => "text_left",
							"Right" => "text_right",
						),
						"description" => esc_html__("Align icons center, left or right. Icons are selected automatically for the social networks filled in Lucille Settings - Social Options.", "lucille-music-core")
					)
				  )
			));
		}
	}


	/*
		Social Profiles Shortcode - ok
	*/
	if (shortcode_exists('js_swp_single_artist_shortcode')) {
		add_action( 'vc_before_init', 'LUCILLE_SWP_single_artist_shortcode_map' );
		function LUCILLE_SWP_single_artist_shortcode_map() {
			$args = array(
						'numberposts'		=> 	-1,
						'orderby'          => 'post_date',
						'order'            => 'DESC',
						'post_type'        => 'js_artist',
						'post_status'      => 'publish'
					);	
			$artist_posts = get_posts($args);
			
			$artist_dropdown = array(); 
			/*key(post_id)	=> value(post_name)*/
			foreach($artist_posts as $single_artist) {
				$my_post_id = $single_artist->ID;
				$my_post_name = $single_artist->post_title;
				
				$artist_dropdown[$my_post_name] = $my_post_id;
			}
			wp_reset_postdata();

			vc_map(array(
				  "name" => esc_html__("Single Artist", "lucille-music-core"),
				  "base" => "js_swp_single_artist_shortcode",
				  "class" => "",
				  "icon" => CDIR_URL . "visual_composer/vc_icons/vc_social.png",
				  "category" => esc_html__("Lucille Elements", "lucille-music-core"),
				  "front_enqueue_js" => CDIR_URL . "visual_composer/js/front_enqueue/js_swp_single_artist_shortcode.js",
				  "params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Artist Name", "lucille-music-core"),
						"param_name" => "artist_id",
						"value" =>  $artist_dropdown,
						"admin_label"	=> true,
						"description" => esc_html__("Select the artist.", "lucille-music-core")
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Element Width", "lucille-music-core"),
						"param_name" => "width",
						"admin_label"	=> true,
						"value" =>  array( 
										esc_html__("Full Width", "lucille-music-core") => "full",
										esc_html__("Custom Width", "lucille-music-core") => "custom"
									),						"admin_label"	=> true,
						"description" => esc_html__("Select the element width.", "lucille-music-core")
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( "Custom Width", "lucille-music-core"),
						"param_name" => "user_width",
						"value" => "300",
	                    'dependency' => array(
	                        'element'   => 'width',
	                        'value' => 'custom'
	                    ),					
						"description" => esc_html__("Element width in pixels. Digits only. Default value: 300", "lucille-music-core")
					),
			        array(
			            "type" => "colorpicker",
			            "class" => "",
			            "heading" => __( "Overlay Color", "lucille-music-core" ),
			            "param_name" => "overlay_color",
			            "value" => '#151515',
			        )
				  )
			));
		}
	}
} /*function_exists('vc_map')*/


/*
	Utils for vc_map
*/
function LUCILLE_SWP_artists_dropdown($show_option_all = false) {
	$args = array(
				'numberposts'		=> 	-1,
				'orderby'          => 'post_date',
				'order'            => 'DESC',
				'post_type'        => 'js_artist',
				'post_status'      => 'publish'
			);	
	$artist_posts = get_posts($args);
	
	$artist_dropdown = array();
	if ($show_option_all) {
		$artist_dropdown["All"] = 0;
	}

	/*key(post_id)	=> value(post_name)*/
	foreach($artist_posts as $single_artist) {
		$my_post_id = $single_artist->ID;
		$my_post_name = $single_artist->post_title;
		
		$artist_dropdown[$my_post_name] = $my_post_id;
	}
	wp_reset_postdata();

	return $artist_dropdown;
}

?>