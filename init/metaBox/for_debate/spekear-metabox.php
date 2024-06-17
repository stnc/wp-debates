<?php



/***SIDEBAR Speaker select METABOX (ONLY debate )  ****/




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




    if (isset($_POST["speakers"])) {
  
        $selectedOptionlist_speaker = json_encode($_POST["speakers"]);
        // print_r( $selectedOptionlist_speaker);
        update_post_meta($post_id, "tvsDebateMB_speakerList", sanitize_text_field($selectedOptionlist_speaker));
    }
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




$speaker_list_db = tvsDebate_selected_get_meta_simple('tvsDebateMB_speakerList');
$json_speaker_list= json_decode($speaker_list_db, true);
// print_r($json_speaker_list);
// die;
if ($json_speaker_list) :
foreach ($json_speaker_list as $key =>  $json_speaker) :
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
                            <label class="control-label" style="color:green" for="state_0">Select Speaker </label>


                            <select class="form-control select2-init" name="speakers[0][speaker]">
                         <?php
                            $args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'speaker', 'post_status' => array('publish', 'future', 'private'));
                            $speakers = get_posts($args);

                            if ($speakers) {
                            // echo '<option  value="0">'. _e("Select Speaker", "debateLang") .'</option>';
                            foreach ($speakers as $speaker) {
                                if ($speaker->ID == $json_speaker_list[$key]["speaker"] ) {
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



                    <div class="column column-20">
                        <div class="form-group">
                            <label class="control-label" style="color:blue" for="introduction">Introduction</label>
                            <input type="text" id="introduction" class="form-control"
                                value="<?php echo   isset($json_speaker_list[$key]["introduction"]) ? $json_speaker_list[$key]["introduction"] : ''?> "
                                name="speakers[0][introduction]" maxlength="128">
                        </div>
                    </div>


                    <div class="column column-20">
                        <div class="form-group">
                            <label class="control-label" style="color:red" for="state_0"> Opinions</label>

                            <select id="state_0" class="form-control select2-init" name="speakers[0][opinions]">
                                <option value="1"
                                    <?php    if (1 == $json_speaker_list[$key]["opinions"] )  echo  "selected"; ?>>FOR
                                </option>
                                <option value="2"
                                    <?php    if (2 == $json_speaker_list[$key]["opinions"] )  echo  "selected"; ?>>
                                    AGAINST</option>
                            </select>
                        </div>
                    </div>

                    <div class="column column-10">
                        <div>
                            <a href="javascript:void(0)"
                                class="remove-item stnc-button-primary remove-social-media">Remove</a>
                        </div>
                    </div>

                </div>


            </div>
        </fieldset>
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



                    <div class="column column-20">
                        <div class="form-group">
                            <label class="control-label" style="color:blue" for="full_name_0">Introduction</label>
                            <input type="text" id="full_name_0" class="form-control" name="speakers[0][introduction]" maxlength="128">
                        </div>
                    </div>


                    <div class="column column-20">
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
                                class="remove-item stnc-button-primary remove-social-media">Remove</a>
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
        <a href="javascript:;" class="pull-right btn btn-success btn-xs" id="add-more"><i class="fa fa-plus"></i>
            Add more address</a>
        <div class="clearfix"></div>
    </div>


</div>



<script type="text/javascript">
jQuery('a#add-more').cloneData({
    mainContainerId: 'stnc-container', // Main container Should be ID
    cloneContainer: 'container-item', // Which you want to clone
    removeButtonClass: 'remove-item', // Remove button for remove cloned HTML
    removeConfirm: true, // default true confirm before delete clone item
    removeConfirmMessage: 'Are you sure want to delete?', // confirm delete message
    //append: '<a href="javascript:void(0)" class="remove-item btn btn-sm btn-danger remove-social-media">Remove</a>', // Set extra HTML append to clone HTML
    minLimit: 0, // Default 1 set minimum clone HTML required
    maxLimit: 8, // Default unlimited or set maximum limit of clone HTML
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