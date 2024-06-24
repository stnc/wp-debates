<?php


if (tvsDebate_post_type() ["post_type"] === "debate" || tvsDebate_post_type() ["get_type"] === "debate") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebate_debate_related_init_metabox");
        add_action("load-post-new.php", "tvsDebate_debate_related_init_metabox");
    }
}


function str_replace2_json($search, $replace, $subject){
    return json_decode(str_replace($search, $replace,  json_encode($subject)));
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

    if (isset ($_POST['tvsDebateMB_opinion'])) {
        update_post_meta($post_id, "tvsDebateMB_opinion", sanitize_text_field($_POST['tvsDebateMB_opinion']));
    }

    if (isset ($_POST['tvsDebateMB_transcript'])) {
        update_post_meta($post_id, "tvsDebateMB_transcript", sanitize_text_field($_POST['tvsDebateMB_transcript']));
    }
}






/*register metabox */
function tvsDebate_debate_related_init_metabox() {
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_selected_related_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebate_related_selected_save");
}


function tvsDebate_selected_related_add_meta_box() {
    add_meta_box("tvs_debate_related_metabox", __("Related", "debateLang"), "tvsDebate_related_selected_html", "debate", "normal", // normal  side  advanced
    "default");
}




function tvsDebate_related_selected_html($post) {
wp_nonce_field("_related_selected_nonce", "related_selected_nonce"); 

$json_related_list = tvsDebate_selected_get_meta_simple('tvsDebateMB_relatedList');

// echo  "<pre>";

// print_r ($json_related_list);

$json_related_list= json_decode($json_related_list, true);


?>


<div class="wp-core-ui  ss-metabox-form" style="">
    <ul>
        <li>
            <h2 data-required="pageSetting_background_repeat"><strong>Related Data </strong></h2>
        </li>


        <li id="tvsDebateMB_opinion_li"><label for="tvsDebateMB_opinion">Select Opinion</label>
            <select name="tvsDebateMB_opinion" id="tvsDebateMB_opinion">


                <?php
			$list_opinion_db = tvsDebate_selected_get_meta_simple('tvsDebateMB_opinion');
            //print_r($list_opinion_db);
            $args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'opinion', 'post_status' => array('publish', 'future', 'private'));
            $opinions = get_posts($args);
    
            if ($opinions) {
            echo '<option  value="0">Select Opinion</option>';
            foreach ($opinions as $opinion) {
                if ($opinion->ID == $list_opinion_db) {
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
            <span class="form_hint">Please Select Opinion</span>
        </li>



        <li id="tvsDebateMB_transcript_li"><label for="tvsDebateMB_transcript">Select Transcript</label>
            <select name="tvsDebateMB_transcript" id="tvsDebateMB_transcript">
       

            <?php
  $list_transcript_db = tvsDebate_selected_get_meta_simple('tvsDebateMB_transcript');
//   print_r($list_transcript_db);
//   die;
  $args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'transcript', 'post_status' => array('publish', 'future', 'private'));
  $transcripts = get_posts($args);

  if ($transcripts) {
    echo '<option  value="0">Select Transcript</option>';
  foreach ($transcripts as $transcript) {
      if ($transcript->ID == $list_transcript_db) {
          $selected = "selected";
          echo '<option ' . $selected . ' value="'.  $transcript->ID . '">' .$transcript->post_title .'</option>';
      } else {
          $selected = "";
          echo '<option ' . $selected . ' value="'.  $transcript->ID . '">' .$transcript->post_title .'</option>';

      }
  }
  }
?>



            </select>
            <span class="form_hint">Please Select Transcript</span>
        </li>


        </li>
    </ul>
</div>





<?php
}