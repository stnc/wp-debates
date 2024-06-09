<?php
if (tvsDebate_post_type() ["post_type"] === "debate" || tvsDebate_post_type() ["get_type"] === "debate") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebate_debate_init_metabox");
        add_action("load-post-new.php", "tvsDebate_debate_init_metabox");
    }
}
/*register metabox */
function tvsDebate_debate_init_metabox() {
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_selected_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebate_selected_save");
}
function tvsDebate_selected_add_meta_box() {
    add_meta_box("tvs_debate_metabox", __("Speaker", "debateLang"), "tvsDebate_selected_html", "debate", "normal", // normal  side  advanced
    "default");
}
function tvsDebate_selected_html($post) {
    wp_nonce_field("_speaker_selected_nonce", "speaker_selected_nonce"); 

?>

<div id='speakersList'>
    <table class='speakersEditor'>
        <tr>
            <th style="color:red">Select Speaker  </th>
            <th style="color:blue"> Introduction  </th>
            <th style="color:orange"> Opinions</th>
            <th></th>
        </tr>
        <tbody data-bind="foreach: speakers">
            <tr>
                <td>
                    <select name="speaker" data-bind='value: speaker' id="speaker">
                        <?php
						$args = ["posts_per_page" => - 1, "orderby" => "title", "order" => "asc", "post_type" => "speaker", "post_status" => ["publish", "future", "private"], ];
						//'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')
						$posts_array = get_posts($args);
						if ($posts_array) {
							foreach ($posts_array as $key => $location) {
								$locations[$key]["id"] = $location->ID;
								$locations[$key]["title"] = $location->post_title;
							}
						}
						// echo '<option  value="0">' . _e("Select Speaker", "debateLang") . "</option>";
						foreach ($locations as $location) {
					
								$selected = "";
								echo "<option " . $selected . ' value="' . $location["id"] . ' ">' . $location["title"] . "</option>";
							
						}
						?>
                    </select>

					
                </td>

                <td>
                    <input class="form-control" id="introduction" data-bind='value: introduction' type="text">
                </td>

                <td>
                    <select name="opinionsStatus" data-bind='value: opinionsStatus' id="opinionsStatus">
                        <option value="FOR">FOR</option>
                        <option value="AGAINST">AGAINST</option>
                    </select>
                </td>

                <td>
                    <a href='#' data-bind='click: $root.removeSpeaker'>Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
    <button id="addSpeakerEvent" data-bind='click: addSpeaker'>New Speaker Add</button>
    <button style="display: block" id="SaveJson" data-bind='click: save2, enable: speakers().length > 0'>Save to
        JSON</button>
    <textarea name="tvsDebateMB_selectSpeakerData[]" style="display: block;" data-bind='value: lastSavedJson' rows='5'
        cols='60'> </textarea>
</div>




https://stackoverflow.com/questions/14291970/selecting-a-nested-object-based-on-nested-dropdowns-with-knockoutjs


https://stackoverflow.com/questions/14673702/selected-value-in-select-statement-using-options-in-knockout-js

https://stackoverflow.com/questions/38193457/getting-selected-value-from-dropdown-list-in-knockout-js



<script type="text/javascript">
jQuery("#publish").click(function() {
    jQuery("#SaveJson").click();
});


var speakersModel = function(speakers) {
    var self = this;
    self.speakers = ko.observableArray(ko.utils.arrayMap(speakers, function(speaker) {
        return {
            speaker: speaker.speaker,
            introduction: speaker.introduction,
            opinionsStatus: speaker.opinionsStatus
        };
    }));

    self.addSpeaker = function() {
        self.speakers.push({
            speaker: "erhan",
            introduction: "",
            opinionsStatus: "",

        });
    };

    self.removeSpeaker = function(speaker) {
        self.speakers.remove(speaker);
    };




    self.save2 = function() {
        self.lastSavedJson(JSON.stringify(ko.toJS(self.speakers), null, 2));
    };

    self.lastSavedJson = ko.observable("")
};

ko.applyBindings(new speakersModel());
</script>


<?php
}
/***SIDEBAR Speaker select METABOX (ONLY debate )  ****/
function tvsDebate_selected_get_meta_simple($value) {
    global $post;
    return get_post_meta($post->ID, $value, true);
}
function tvsDebate_selected_save($post_id) {
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
    if (isset($_POST["tvsDebateMB_selectSpeakerData"])) {
        $selectedOptionlist_locations = implode(",", $_POST["tvsDebateMB_selectSpeakerData"]);
        update_post_meta($post_id, "tvsDebateMB_selectSpeakerData", sanitize_text_field($selectedOptionlist_locations));
    }
}
