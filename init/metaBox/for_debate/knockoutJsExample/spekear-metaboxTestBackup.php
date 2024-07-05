<?php
/*
https://tatvog.wordpress.com/2016/06/22/knockout-js-binding-the-disabled-attribute-in-select-tag/

*/


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


function  tvsDebate_PushData(){
    $args = [
        "posts_per_page" => - 1, 
        "orderby" => "title", 
        "order" => "asc", 
        "post_type" => "speaker", 
        "post_status" => ["publish", "future", "private"]
     ];
 $posts_array = get_posts($args);
 $initialData_ = array();
 $initialData_["introduction"]= "";
 $initialData_["speakerlist"]= array();
 $initialData_["opinionsStatus"]=array(); 
 if ($posts_array) {
     foreach ($posts_array as $key => $data) {
     $initialData_["speakerlist"][$key]=["name" => $data->post_name,"id" => $data->ID,/*"selected" => false*/];
     }
 }
 
$initialData_["opinionsStatus"][0] = ['id' => 1, 'name' => "FOR", /*'selected' => false*/];
$initialData_["opinionsStatus"][1] = ['id' => 2, 'name' => "AGAINST", /*'selected' => false*/];
//  print_r( $initialData_);
//  print_r( json_encode($initialData_));
return  json_encode($initialData_);
}


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
            <th style="color:red">Select Speaker </th>
            <th style="color:blue"> Introduction </th>
            <th style="color:orange"> Opinions</th>
            <th></th>
        </tr>
        <tbody  data-bind='foreach: lines'>
            <tr>
                <td>
                <select data-bind="options: speakers, optionsText: 'name', optionsValue: 'id',  value: selectedItemId1">
                        <?php
			$list_speaker_db = tvsDebate_selected_get_meta_simple('tvs_wp_debate_slide_time_metaBox');
            $list_speaker_db = explode(',', $list_speaker_db);
            //print_r($list_speaker_db);
            $args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'speaker', 'post_status' => array('publish', 'future', 'private'));
            $speakers = get_posts($args);
    
            if ($speakers) {
            // echo '<option  value="0">'. _e("Select Speaker", "debateLang") .'</option>';
            foreach ($speakers as $speaker) {
                if (in_array($speaker->id, $list_speaker_db)) {
                    $selected = "selected";
                    echo '<option ' . $selected . ' value="'.  $speaker->ID . '">' .$speaker->post_title .'</option>';
                } else {
                    $selected = "";
                    echo '<option ' . $selected . ' value="'.  $speaker->ID . '">' .$speaker->post_title .'</option>';
    
                }
            }
            }
		?>
                    </select>


                </td>

                <td>
                    <input class="form-control" id="introduction" data-bind='value: introduction' type="text">
                </td>

                <td>
                    <select >
                        <option>
                        </option>
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

<a href="#" data-bind="click: function () {setValue(0)}">Set Value to 1</a>

<button data-bind='click: save'>Submit order</button>

<!-- <div data-bind="text: ko.toJSON($root)"></div> -->
<textarea style="display: block;" data-bind="text: ko.toJSON($root)" rows='5' cols='60'> </textarea>

<script type="text/javascript">
jQuery("#publish").click(function() {
    jQuery("#SaveJson").click();
});

// jQuery(document).ready(function() {

//     jQuery('.speakerlist').on('change', function() {
//         jQuery(".speakerlist :selected" ).attr('selected','selected');
//         // jQuery(".speakerlist :selected" ).removeAttr('selected');
//         alert (   jQuery(".speakerlist :selected").val());
//     });

// });



var speakersModel = function() {
    var self = this;

    self.speakers = ko.observableArray(); //TODO:  look here  
    self.speakers = ko.observableArray(); //TODO:  look here  

    self.addSpeaker = function() {
        self.speakers.push(<?php echo tvsDebate_PushData() ?>);
    };

    this.selectedItemId1 = ko.observable(78);

    this.selectedItem = function() {
    var self = this;
    return ko.utils.arrayFirst(this.items(), function(item) {
      return self.selectedItemId1() == item.id;
    });
  }.bind(this);


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