<?php

if (ssDebate_post_type()["post_type"] === 'debate' || ssDebate_post_type()["get_type"] === 'debate') {
	if (is_admin()) {
		add_action('load-post.php', 'ssDebate_debate_init_metabox');
		add_action('load-post-new.php', 'ssDebate_debate_init_metabox');
	}
}

/*register metabox */
function ssDebate_debate_init_metabox()
{
	// add meta box
	add_action('add_meta_boxes', 'ssDebate_selected_add_meta_box');
	// metabox save
	add_action('save_post', 'ssDebate_selected_save');
}

function ssDebate_selected_add_meta_box()
{
	add_meta_box(
		'tvs_wp_debate_metabox',
		__('Sube Sorumlusu Atama', 'debateLang'),
		'ssDebate_selected_html',
		'debate',
		'side',
		'default'
	);
}

function ssDebate_selected_html($post)
{
	wp_nonce_field('_speaker_selected_nonce', 'speaker_selected_nonce'); ?>

	<label for="tvs_wp_debate_slide_time_metaBox">
		<?php _e('Sube Sorumlusu Seciniz', 'debateLang'); ?>
	</label>
	<br>

	<select name="tvs_wp_debate_slide_time_metaBox[]" id="tvs_wp_debate_slide_time_metaBox">
		<?php
		//https://developer.wordpress.org/reference/functions/query_posts/
		$list_location_db = ssDebate_selected_get_meta_simple('tvs_wp_debate_slide_time_metaBox');
		$list_location_db = explode(',', $list_location_db);
		//print_r($list_location_db);
		//burası custom post verisi okur --burada location ın verisi okunmuş 
		$args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'speaker', 'post_status' => array('publish', 'future', 'private'));
		//'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')
		$posts_array = get_posts($args);
		if ($posts_array) {
			foreach ($posts_array as $key => $location) {
				$locations[$key]["id"] = $location->ID;
				$locations[$key]["title"] = $location->post_title;
			}
		}

		echo '<option  value="0">'. _e("Sube Sorumlusu Seciniz", "debateLang") .'</option>';
		foreach ($locations as $location) {

			if (in_array($location['id'], $list_location_db)) {
				$selected = "selected";
				echo '<option ' . $selected . ' value="' . $location['id'] . ' ">' . $location['title'] . '</option>';

			} else {
				$selected = "";
				echo '<option ' . $selected . ' value="' . $location['id'] . ' ">' . $location['title'] . '</option>';

			}
		}
		?>
	</select>
	<?php
}

/***SIDEBAR Speaker select METABOX (ONLY debate )  ****/

function ssDebate_selected_get_meta_simple($value)
{
	global $post;
	return get_post_meta($post->ID, $value, true);
}




function ssDebate_selected_save($post_id)
{
	if (wp_is_post_autosave($post_id)) {
		return;
	}
	// Check if not a revision.
	if (wp_is_post_revision($post_id)) {
		return;
	}
	// Stop the script when doing autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}


	// //services save
	// if (isset($_POST['tvs_wp_debate_DrAndDep_program_and_services'])) {
	// 	foreach ($_POST['tvs_wp_debate_DrAndDep_program_and_services'] as $selectedOption) {
	// 		$selectedOptionlist[] = $selectedOption;
	// 	}
	// 	$selectedOptionlist = implode(",", $selectedOptionlist);
	// 	update_post_meta($post_id, 'tvs_wp_debate_DrAndDep_program_and_services', sanitize_text_field($selectedOptionlist));
	// }



	
	if (isset ($_POST['tvs_wp_debate_slide_time_metaBox'])) {

		foreach ($_POST['tvs_wp_debate_slide_time_metaBox'] as $selectedOption_locations) {
			$selectedOptionlist_locations[] = $selectedOption_locations;
		}
		$selectedOptionlist_locations = implode(",", $selectedOptionlist_locations);
		update_post_meta($post_id, 'tvs_wp_debate_slide_time_metaBox', sanitize_text_field($selectedOptionlist_locations));
	}
}