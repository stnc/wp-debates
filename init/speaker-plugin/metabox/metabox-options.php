<?php

if (tvsDebate_post_type() ["post_type"] === "speaker" || tvsDebate_post_type() ["get_type"] === "speaker") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebate_speaker_related_init_metabox");
        add_action("load-post-new.php", "tvsDebate_speaker_related_init_metabox");
    }
}


function tvsDebate_related_selected_save($post_id) {
    if (wp_is_post_autosave($post_id)) {
        return;
    }
    // Check if not a revision.
    if (wp_is_post_revision($post_id)) {
        return;
    }
    // Stop the script when doing autosave
    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return $post_id;
    }

    if (isset ($_POST['tvsDebateMB_speaker'])) {
        update_post_meta($post_id, "tvsDebateMB_speaker", sanitize_text_field($_POST['tvsDebateMB_speaker']));
    }


}



/*register metabox */
function tvsDebate_speaker_related_init_metabox() {
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_selected_speaker_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebate_related_selected_save");
}


function tvsDebate_selected_speaker_add_meta_box() {
    add_meta_box("tvsDebate_speaker_", __("Related", "debateLang"), "tvsDebate_speaker_selected_html", "speaker", "normal", // normal  side  advanced
    "default");
}




function tvsDebate_speaker_selected_html($post) {
wp_nonce_field("_related_selected_nonce", "related_selected_nonce"); 

$json_related_list = tvsDebate_selected_get_meta_simple('tvsDebateMB_speaker');
$json_related_list= json_decode($json_related_list, true);
?>
<div class="wp-core-ui  ss-metabox-form widthOverride">
    <ul style="width:50%">
        <li>
            <h2 data-required="pageSetting_background_repeat"><strong>Related Debate </strong></h2>
        </li>
        <li id="tvsDebateMB_speaker_li">
            <label for="tvsDebateMB_speaker">Select Debate</label>
            <select name="tvsDebateMB_speaker" id="tvsDebateMB_speaker">
        <?php
			$list_speaker_db = tvsDebate_selected_get_meta_simple('tvsDebateMB_speaker');
            //print_r($list_speaker_db);
            $args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'debate', 'post_status' => array('publish', 'future', 'private'));
            $opinions = get_posts($args);
    
            if ($opinions) {
            echo '<option  value="0">Select Opinion</option>';
            foreach ($opinions as $opinion) {
                if ($opinion->ID == $list_speaker_db) {
                    $selected = "selected";
                    echo '<option ' . $selected . ' value="'.  $opinion->ID . '">' .$opinion->post_title .'</option>';
                } else {
                    $selected = "";
                    echo '<option ' . $selected . ' value="'.  $opinion->ID . '">' .$opinion->post_title .'</option>';
                }
            }
            }
		 ?>
            </select>
            <!-- <span class="form_hint">Please Debate</span> -->
        </li>
    </ul>
</div>

<?php
}