<?php



/***SIDEBAR Speaker select METABOX (ONLY debate )  ****/



function tvsDebate_speaker_selected_save($post_id) {
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



    $initialData_ = array();

    if (isset($_POST["speakers"])) {
        foreach ($_POST["speakers"] as $key => $data) {
            $initialData_[$key]=   ["speaker" =>     tvs_cc($data['speaker'])  ,"introduction" => tvs_cc($data['introduction']),"opinions" => tvs_cc($data['opinions'])];
       }
        $json_data = json_encode($initialData_);
        update_post_meta($post_id, "tvsDebateMB_speakerList", $json_data);
    }
}





if (tvsDebate_post_type() ["post_type"] === "debate" || tvsDebate_post_type() ["get_type"] === "debate") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebate_speaker_init_metabox");
        add_action("load-post-new.php", "tvsDebate_speaker_init_metabox");
    }
}
/*register metabox */
function tvsDebate_speaker_init_metabox() {
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_speaker_selected_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebate_speaker_selected_save");
}
function tvsDebate_speaker_selected_add_meta_box() {
    add_meta_box(
        "tvs_debate_speaker_metabox", 
    __("Speaker", "debateLang"),
     "tvsDebate_speaker_selected_html",
      "debate", 
      "normal", // normal  side  advanced
    "default");
}




function tvsDebate_speaker_selected_html($post) {
    wp_nonce_field("_speaker_selected_nonce", "speaker_selected_nonce"); 




$speaker_list_db = tvsDebate_selected_get_meta_simple('tvsDebateMB_speakerList');
$speaker_list_json= json_decode($speaker_list_db, true);
// print_r($speaker_list_json);
// die;
if ($speaker_list_json) :
foreach ($speaker_list_json as $key =>  $json_speaker) :
?>
<div id="stnc-container">
    <div class="panel-body container-item">
        <fieldset class="item panel panel-default" style="border: 1px solid black; padding: 10px;">
            <!-- widgetBody -->
            <legend style="width: auto;padding:10px;">Speaker </legend>
            <div class="panel-body">
                <div class="stnc-row">
                    <div class="column column-20 ">
                        <div class="form-group">
                            <label class="control-label" style="color:green" for="state_0">Select Speaker </label> <br>  


                            <select class="form-control select2-init" name="speakers[0][speaker]">
                             <option  value="0"> Later (Not Clear Yet) </option>
                         <?php
                            $args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'speaker', 'post_status' => array('publish', 'future', 'private'));
                            $speakers = get_posts($args);

                            if ($speakers) {
                            // echo '<option  value="0">'. _e("Select Speaker", "debateLang") .'</option>';
                            foreach ($speakers as $speaker) {
                                if ($speaker->ID == $speaker_list_json[$key]["speaker"] ) {
                                    $selected = "selected";
                                    echo '<option ' . $selected . ' value="'.   $speaker->ID . '">'.$speaker->post_title .'</option>';
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



                    <div class="column column-30">
                        <div class="form-group">
                            <label class="control-label" style="color:blue" for="introduction">Introduction</label> <br>  
                            <input type="text" id="introduction" style="width: 500px;"  class="form-control"
                                value="<?php echo   isset($speaker_list_json[$key]["introduction"]) ? $speaker_list_json[$key]["introduction"] : ''?> "
                                name="speakers[0][introduction]" maxlength="128">
                        </div>
                    </div>


                    <div class="column column-10" style="float: left;" >
                        <div class="form-group">
                            <label class="control-label" style="color:red" for="state_0"> Opinions</label> <br>    

                            <select id="state_0" class="form-control select2-init" name="speakers[0][opinions]">
                                <option value="1"
                                    <?php    if (1 == $speaker_list_json[$key]["opinions"] )  echo  "selected"; ?>>FOR
                                </option>
                                <option value="2"
                                    <?php    if (2 == $speaker_list_json[$key]["opinions"] )  echo  "selected"; ?>>
                                    AGAINST</option>
                            </select>
                        </div>
                    </div>

                    <div class="column column-10">
                        <div>
                            <a href="javascript:void(0)"
                                class="remove-item stnc-button-primary remove-social-media">X</a>
                        </div>
                    </div>

                </div>


            </div>
        </fieldset>

        <br>
    </div>


</div>
<!-- <hr> -->
<?php
endforeach;
?>

<?php else: ?>

    <div id="stnc-container">
    <div class="panel-body container-item">
        <fieldset class="item panel panel-default" style="border: 1px solid black; padding: 10px;">
            <!-- widgetBody -->
            <legend style="width: auto;padding:10px;">Speaker </legend>
            <div class="panel-body">
                <div class="stnc-row">
                    <div class="column column-20 ">
                        <div class="form-group">
                            <label class="control-label" style="color:green" for="state_0">Select Speaker </label>


                            <select class="form-control select2-init" name="speakers[0][speaker]">
                         <?php
                            $args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'speaker', 'post_status' => array('publish', 'future', 'private'));
                            $speakers = get_posts($args);

                            if ($speakers) {
                            // echo '<option  value="0">'. _e("Select Speaker", "debateLang") .'</option>';
                            foreach ($speakers as $speaker) {
                                    echo '<option  value="' .  $speaker->ID . '">'.$speaker->post_title .'</option>';
                            }
                            }
		                   ?>
                            </select>


                        </div>
                    </div>



                    <div class="column column-30">
                        <div class="form-group">
                            <label class="control-label" style="color:blue;" for="full_name_0">Introduction</label>
                            <input type="text" id="full_name_0" style="width: 500px;"  class="form-control" name="speakers[0][introduction]" maxlength="128">
                        </div>
                    </div>


                    <div class="column column-10">
                        <div class="form-group">
                            <label class="control-label" style="color:red" for="state_0"> Opinions</label>

                            <select id="state_0" class="form-control select2-init" name="speakers[0][opinions]">
                                <option value="1">FOR</option>
                                <option value="2">  AGAINST</option>
                            </select>
                        </div>
                    </div>

                    <div class="column column-10">
                        <div>
                            <a href="javascript:void(0)"
                                class="remove-item stnc-button-primary remove-social-media">X</a>
                        </div>
                    </div>

                </div>


            </div>
        </fieldset>
    </div>


</div>

 <?php
endif;
?>

<div class="row">
    <div class="col-sm-6">
        <a href="javascript:;" class="pull-right stnc-button-primary" id="add-more"><i class="fa fa-plus"></i>
            </a>
        <div class="clearfix"></div>
    </div>


</div>
<div style="color:red;background-color:black;padding:5px;">If the speaker has not been determined yet, please select the <strong>"Later (Not Clear Yet)"</strong> option.</div>



<script type="text/javascript">
jQuery('a#add-more').cloneData({
    mainContainerId: 'stnc-container', // Main container Should be ID
    cloneContainer: 'container-item', // Which you want to clone
    removeButtonClass: 'remove-item', // Remove button for remove cloned HTML
    removeConfirm: true, // default true confirm before delete clone item
    removeConfirmMessage: 'Are you sure want to delete?', // confirm delete message
    //append: '<a href="javascript:void(0)" class="remove-item btn btn-sm btn-danger remove-social-media">Remove</a>', // Set extra HTML append to clone HTML
    minLimit: 1, // Default 1 set minimum clone HTML required
    maxLimit: 8, // Default unlimited or set maximum limit of clone HTML
    defaultRender: 1,
    init: function() {
        console.info(':: Initialize Plugin ::');
    },
  /*  beforeRender: function() {
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
    }*/

});
</script>

<?php
}