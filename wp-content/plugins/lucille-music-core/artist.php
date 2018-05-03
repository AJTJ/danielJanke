<?php

add_action('init', 'LUCILLE_SWP_create_artist_post', 8);
function LUCILLE_SWP_create_artist_post() 
{
	$slug = LUCILLE_SWP_JPT_get_plugin_option("artist");
	if ("" == $slug) {
		$slug = "js_artist";
	}
	
	register_post_type('js_artist',
		array(
			'labels' => array(
				'name' =>  esc_html__('Artists', 'lucille-music-core') ,
				'singular_name' =>  esc_html__('Artist', 'lucille-music-core') ,
				'add_new' => esc_html__('Add New Artist', 'lucille-music-core'),
				'add_new_item' => esc_html__('Add New Artist', 'lucille-music-core'),
				'edit' => esc_html__('Edit', 'lucille-music-core'),
				'edit_item' => esc_html__('Edit Artist', 'lucille-music-core'),
				'new_item' => esc_html__('New Artist', 'lucille-music-core'),
				'view' => esc_html__('View', 'lucille-music-core'),
				'view_item' => esc_html__('View Artist', 'lucille-music-core'),
				'search_items' => esc_html__('Search Artists', 'lucille-music-core'),
				'not_found' => esc_html__('No Artist Found','lucille-music-core'),
				'not_found_in_trash' => esc_html__('No Event Found in Trash','lucille-music-core'),
				'parent' => esc_html__('Parent Artist','lucille-music-core')
			),
		'public' => true,
		'rewrite' => array(
			'slug' => $slug,
			'with_front' => false
			),
		'supports' => array('title', 'editor', 'comments', 'thumbnail'),
		'menu_icon' => 'dashicons-admin-users',
		)
	); 
}

/*
	Add metabox
*/

add_action('admin_init', 'LUCILLE_SWP_artist_admin_init');
function LUCILLE_SWP_artist_admin_init() 
{
	/* artist information */
    add_meta_box('artist_meta_box', 			/*the required HTML id attribute*/
        esc_html__('Artist Settings','lucille-music-core'), 		/*text visible in the heading of meta box section*/
        'LUCILLE_SWP_display_artist_meta_box',				/* callback FUNCTION which renders the contents of the meta box*/
        'js_artist', 							/*the name of the custom post type where the meta box will be displayed*/
		'normal', 								/*defines the part of the page where the edit screen section should be shown*/
		'high' 									/*defines the priority within the context where the boxes should show*/
   );
}

function LUCILLE_SWP_display_artist_meta_box($artistObject) {
	$artist_id = $artistObject->ID;

	/*general options*/
	$artist_nickname = esc_html(get_post_meta($artist_id, 'artist_nickname', true));
	$artist_website = esc_url(get_post_meta($artist_id, 'artist_website', true));

	/*social options*/
	$artist_facebook = esc_url(get_post_meta($artist_id, 'artist_facebook', true));
	$artist_twitter = esc_url(get_post_meta($artist_id, 'artist_twitter', true));
	$artist_instagram = esc_url(get_post_meta($artist_id, 'artist_instagram', true));
	$artist_soundcloud = esc_url(get_post_meta($artist_id, 'artist_soundcloud', true));
	$artist_youtube = esc_url(get_post_meta($artist_id, 'artist_youtube', true));

	/*how to align image*/
	$artist_img_align = esc_html(get_post_meta($artist_id, 'artist_img_align', true));
	if (empty($artist_img_align)) {
		$artist_img_align = "top";
	}
	$artist_img_align_opts = array( 
			esc_html__("Top", "lucille-music-core") => "top",
			esc_html__("Center", "lucille-music-core") => "center",
			esc_html__("Bottom", "lucille-music-core") => "bottom"
	);

	/*second image*/
	$artist_add_img = esc_html(get_post_meta($artist_id, 'artist_add_img', true));

?>
	<table class= "swp_artist_cpt_opts swp_cpt_opts">
		<tr>
            <td class="swp_setting_name">
            	<?php echo esc_html__('Nickname', 'lucille-music-core');?>
            </td>
			<td>
				<input class="swp_cpt_setting_input" type="text" name="artist_nickname" value="<?php echo esc_attr($artist_nickname); ?>" />
				<div class="description swp_cpt_setting_desc">
					<?php echo esc_html__('Artist nickname, or position in the band, ex: [bass player].', 'lucille-music-core'); ?>
				</div>
			</td>
        </tr>

		<tr>
            <td class="swp_setting_name">
            	<?php echo esc_html__('Artist Website', 'lucille-music-core');?>
            </td>
			<td>
				<input class="swp_cpt_setting_input" type="text" name="artist_website" value="<?php echo esc_attr($artist_website); ?>" />
				<div class="description swp_cpt_setting_desc">
					<?php echo esc_html__('The URL to the artist website.', 'lucille-music-core'); ?>
				</div>
			</td>
        </tr>

		<tr>
            <td class="swp_setting_name">
            	<?php echo esc_html__('Artist Facebook URL', 'lucille-music-core');?>
            </td>
			<td>
				<input class="swp_cpt_setting_input" type="text" name="artist_facebook" value="<?php echo esc_attr($artist_facebook); ?>" />
				<div class="description swp_cpt_setting_desc">
					<?php echo esc_html__('The URL to the artist Facebook profile.', 'lucille-music-core'); ?>
				</div>
			</td>
        </tr>

		<tr>
            <td class="swp_setting_name">
            	<?php echo esc_html__('Artist Twitter URL', 'lucille-music-core');?>
            </td>
			<td>
				<input class="swp_cpt_setting_input" type="text" name="artist_twitter" value="<?php echo esc_attr($artist_twitter); ?>" />
				<div class="description swp_cpt_setting_desc">
					<?php echo esc_html__('The URL to the artist Twitter profile.', 'lucille-music-core'); ?>
				</div>
			</td>
        </tr>

		<tr>
            <td class="swp_setting_name">
            	<?php echo esc_html__('Artist Instagram URL', 'lucille-music-core');?>
            </td>
			<td>
				<input class="swp_cpt_setting_input" type="text" name="artist_instagram" value="<?php echo esc_attr($artist_instagram); ?>" />
				<div class="description swp_cpt_setting_desc">
					<?php echo esc_html__('The URL to the artist Instagram profile.', 'lucille-music-core'); ?>
				</div>
			</td>
        </tr> 

		<tr>
            <td class="swp_setting_name">
            	<?php echo esc_html__('Artist SoundCloud URL', 'lucille-music-core');?>
            </td>
			<td>
				<input class="swp_cpt_setting_input" type="text" name="artist_soundcloud" value="<?php echo esc_attr($artist_soundcloud); ?>" />
				<div class="description swp_cpt_setting_desc">
					<?php echo esc_html__('The URL to the artist SoundCloud profile.', 'lucille-music-core'); ?>
				</div>
			</td>
        </tr>

		<tr>
            <td class="swp_setting_name">
            	<?php echo esc_html__('Artist YouTube URL', 'lucille-music-core');?>
            </td>
			<td>
				<input class="swp_cpt_setting_input" type="text" name="artist_youtube" value="<?php echo esc_attr($artist_youtube); ?>" />
				<div class="description swp_cpt_setting_desc">
					<?php echo esc_html__('The URL to the artist YouTube profile.', 'lucille-music-core'); ?>
				</div>
			</td>
        </tr>

		<tr>
            <td class="swp_setting_name">
            	<?php echo esc_html__('Vertically align artist image', 'lucille-music-core');?>
            </td>
			<td>
        		<select id="artist_img_align" name="artist_img_align">
        			<?php LMC_SWP_render_select_options($artist_img_align_opts, $artist_img_align); ?>
        		</select>

				<div class="description swp_cpt_setting_desc">
					<?php echo esc_html__('Choose how to aligh the artist image when used on a visual composer element or for artist archive page.', 'lucille-music-core'); ?>
				</div>
			</td>
        </tr>        

		<tr>
            <td class="swp_setting_name">
            	<?php echo esc_html__('Artist Additional Image (optional)', 'lucille-music-core');?>
            </td>
			<td>
				<input class="swp_cpt_setting_input swp_hidden_input" id="artist_add_img_val" type="text" name="artist_add_img" value="<?php echo esc_attr(esc_html($artist_add_img)); ?>" />
				<input id="swp_upload_artist_add_img" type="button" class="button" value="<?php echo esc_html__('Upload Image', 'lucille-music-core'); ?>" />
				<input id="swp_remove_artist_add_img" type="button" class="button" value="<?php echo esc_html__('Remove Image', 'lucille-music-core'); ?>" />
				<div class="description swp_cpt_setting_desc">
					<?php 
					echo esc_html__('Choose an additional image that will be shown when the visitor hovers the artist image. We recommend a square aspect ratio for the image.', 'lucille-music-core'); 
					?>
				</div>
			</td>
        </tr>

        <tr class="swp_artist_add_img_preview">
        	<td class="swp_setting_name"></td>
        	<td class="img_preview_col">
				<div id="artist_add_img_preview">
					<img class="swp_preview_artist_img" src="<?php echo esc_url($artist_add_img); ?>">
				</div>	        
			</td>	
        </tr>

	</table>
<?php
}

add_action('save_post', 'LUCILLE_SWP_save_artist_fields', 10, 2);
function LUCILLE_SWP_save_artist_fields($artist_id, $artistObject) {
	if ($artistObject->post_type != 'js_artist') {
		return;
	}

	if (isset($_POST['artist_nickname'])) {
		update_post_meta($artist_id, 'artist_nickname', $_POST['artist_nickname']);
	}
	if (isset($_POST['artist_website'])) {
		update_post_meta($artist_id, 'artist_website', $_POST['artist_website']);
	}
	if (isset($_POST['artist_facebook'])) {
		update_post_meta($artist_id, 'artist_facebook', $_POST['artist_facebook']);
	}
	if (isset($_POST['artist_twitter'])) {
		update_post_meta($artist_id, 'artist_twitter', $_POST['artist_twitter']);
	}
	if (isset($_POST['artist_instagram'])) {
		update_post_meta($artist_id, 'artist_instagram', $_POST['artist_instagram']);
	}
	if (isset($_POST['artist_soundcloud'])) {
		update_post_meta($artist_id, 'artist_soundcloud', $_POST['artist_soundcloud']);
	}
	if (isset($_POST['artist_youtube'])) {
		update_post_meta($artist_id, 'artist_youtube', $_POST['artist_youtube']);
	}
	if (isset($_POST['artist_add_img'])) {
		update_post_meta($artist_id, 'artist_add_img', $_POST['artist_add_img']);
	}
	if (isset($_POST['artist_img_align'])) {
		update_post_meta($artist_id, 'artist_img_align', $_POST['artist_img_align']);
	}
}


/*
	Adding custom columns to admin menu using filter  [manage_edit-{post_type}_columns]
*/
add_filter('manage_edit-js_artist_columns', 'LUCILLE_SWP_artist_admin_columns_func');

function LUCILLE_SWP_artist_admin_columns_func($columns)
{
	$columns = array(
		'cb'	=> '<input type="checkbox" />',
		'title' => esc_html__('Artist Name', 'lucille-music-core'),
		'date'		=> esc_html__('Date', 'lucille-music-core')		
	);
	
	return $columns;
}


/*
	Fill the custom columns on admin - not needed
*/


/*
	Create Category for Events
*/
add_action('init', 'LUCILLE_SWP_create_artist_category', 11);

function LUCILLE_SWP_create_artist_category()
{
	$slug = LUCILLE_SWP_JPT_get_plugin_option("artist_tax");
	if ("" == $slug) {
		$slug = "artist_category";
	}
	
	register_taxonomy(
			'artist_category',
			'js_artist',
			array(
				'labels' => array(
					'name' => esc_html__('Artist Categories', 'lucille-music-core'),
					'singular_name'     => esc_html__('Artist Category', 'lucille-music-core'),
					'search_items'      => esc_html__('Search Artist Categories', 'lucille-music-core' ),
					'all_items'         => esc_html__('All Artist Categories', 'lucille-music-core' ),
					'parent_item'       => esc_html__('Parent Artist Category', 'lucille-music-core' ),
					'parent_item_colon' => esc_html__('Parent Artist Category:', 'lucille-music-core' ),
					'edit_item'         => esc_html__('Edit Artist Category', 'lucille-music-core' ),
					'update_item'       => esc_html__('Update Artist Category', 'lucille-music-core' ),
					'add_new_item' 		=> esc_html__('Add New Artist Category', 'lucille-music-core'),
					'new_item_name' 	=> esc_html__('New Artist Category', 'lucille-music-core'),
				),
				'rewrite' => array(
					'slug' => $slug,
					'with_front' => false
				),
				'show_ui' => true,
				'show_tagcloud' => false,
				'hierarchical' => true
			)
		);
}