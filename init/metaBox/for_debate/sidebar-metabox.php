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
          $initialData_["speakerlist"][$key]=["name" => $data->post_name,"id" => $data->ID,"selected" => false];
     }
 }
 
$initialData_["opinionsStatus"][0] = ['id' => 1, 'name' => "FOR", 'selected' => false];
$initialData_["opinionsStatus"][1] = ['id' => 2, 'name' => "AGAINST", 'selected' => false];
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










<div id="stnc-container">


    <div class="panel-body container-item">
        <fieldset class="item panel panel-default" style="border: 1px solid black; padding: 10px;">
            <!-- widgetBody -->
            <legend style="width: auto;padding:10px;">Speaker</legend>
            <div class="panel-body">



                <div class="stnc-row">

                    <div class="column">

                        <div class="form-group">
                            <label class="control-label" style="color:green" for="state_0">Select Speaker </label>

                    

                            <select class="form-control select2-init" name="speaker[0][state]">
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
                            echo '<option ' . $selected . ' value="'.  $speaker->ID . '">'.$speaker->post_title .'</option>';
                        } else {
                            $selected = "";
                            echo '<option ' . $selected . ' value="' .  $speaker->ID . '">'.$speaker->post_title .'</option>';

                        }
                    }
                    }
		            ?>
                </select>


                        </div>
                    </div>

            

                    <div class="column">
                        <div class="form-group">
                            <label class="control-label" style="color:blue" for="full_name_0">Introduction</label>
                            <input type="text" id="full_name_0" class="form-control" name="speaker[0][introduction]"
                                maxlength="128" placeholder="Introduction">
                        </div>
                    </div>


                    <div class="column">
                        <div class="form-group">
                            <label class="control-label" style="color:red" for="state_0"> Opinions</label>

                            <select id="state_0" class="form-control select2-init" name="speaker[0][opinions]">
                                <option value="1" data-select2-id="2">FOR</option>
                                <option value="2" data-select2-id="2">AGAINST</option>
                            </select>
                        </div>
                    </div>

                    <div class="column">
                        <div>
                            <a href="javascript:void(0)"
                                class="remove-item btn btn-sm btn-danger remove-social-media">Remove</a>
                        </div>
                    </div>

                </div>

               
            </div>
        </fieldset>
    </div>


</div>
<hr>




<div class="row">
    <div class="col-sm-6">
        <a href="javascript:;" class="pull-right btn btn-success btn-xs" id="add-more"><i class="fa fa-plus"></i>
            Add more address</a>
        <div class="clearfix"></div>
    </div>

 
</div>





<!-- <div data-bind="text: ko.toJSON($root)"></div> -->

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

jQuery('a#add-more').cloneData({
    mainContainerId: 'stnc-container', // Main container Should be ID
    cloneContainer: 'container-item', // Which you want to clone
    removeButtonClass: 'remove-item', // Remove button for remove cloned HTML
    removeConfirm: true, // default true confirm before delete clone item
    removeConfirmMessage: 'Are you sure want to delete?', // confirm delete message
    //append: '<a href="javascript:void(0)" class="remove-item btn btn-sm btn-danger remove-social-media">Remove</a>', // Set extra HTML append to clone HTML
    minLimit: 1, // Default 1 set minimum clone HTML required
    maxLimit: 5, // Default unlimited or set maximum limit of clone HTML
    defaultRender: 1,
    init: function() {
        console.info(':: Initialize Plugin ::');
    },
    beforeRender: function() {
        console.info(':: Before rendered callback called');
    },
    afterRender: function() {
        console.info(':: After rendered callback called');
        //jQuery(".selectpicker").selectpicker('refresh');
    },
    afterRemove: function() {
        console.warn(':: After remove callback called');
    },
    beforeRemove: function() {
        console.warn(':: Before remove callback called');
    }

});
</script>

<?php
}