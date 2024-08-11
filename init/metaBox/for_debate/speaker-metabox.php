<?php



/***SIDEBAR Speaker select METABOX (ONLY debate )  ****/



function tvsDebate_speaker_selected_save($post_id)
{
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

    if (isset($_POST["tvs_speakers"])) {
        foreach ($_POST["tvs_speakers"] as $key => $data) {
            $initialData_[$key] = ["speaker" => tvs_cc($data['speaker']), "introduction" => tvs_cc($data['introduction']), "opinions" => tvs_cc($data['opinions'])];
        }
        $json_data = json_encode($initialData_);
        update_post_meta($post_id, "tvsDebateMB_speakerList", $json_data);
    } else {
        delete_post_meta($post_id, "tvsDebateMB_speakerList");
    }
}





if (tvsDebate_post_type()["post_type"] === "debate" || tvsDebate_post_type()["get_type"] === "debate") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebate_speaker_init_metabox");
        add_action("load-post-new.php", "tvsDebate_speaker_init_metabox");
    }
}
/*register metabox */
function tvsDebate_speaker_init_metabox()
{
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_speaker_selected_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebate_speaker_selected_save");
}
function tvsDebate_speaker_selected_add_meta_box()
{
    add_meta_box(
        "tvs_debate_speaker_metabox",
        __("Speaker", "debateLang"),
        "tvsDebate_speaker_selected_html",
        "debate",
        "normal", // normal  side  advanced
        "default"
    );
}




function tvsDebate_speaker_selected_html($post)
{
    wp_nonce_field("_speaker_selected_nonce", "speaker_selected_nonce");




    $speaker_list_db = tvsDebate_selected_get_meta_simple('tvsDebateMB_speakerList');
    $speaker_list_json = json_decode($speaker_list_db, true);
    // print_r($speaker_list_json);
// die;
    if ($speaker_list_json):

            ?>
            <div class="repeater-speaker">


                <div class="rep-speaker" data-repeater-list="tvs_speakers">
                <?php
           
        foreach ($speaker_list_json as $key => $json_speaker):
            ?>
                    <fieldset data-repeater-item class="rep-element" style="border: 1px solid black; padding: 10px;">
                        <!-- widgetBody -->
                        <legend style="width: auto;padding:10px;">Speaker </legend>

                        <div class="stnc-row">

                            <div class="column column-20 ">
                                <div class="form-group">
                                    <label class="control-label" style="color:green" for="state_0">Select Speaker </label> <br>


                                    <select class="form-control select2-init" name="speaker">
                                        <option value="0"> Later (Not Clear Yet) </option>
                                        <?php
                                        $args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'speaker', 'post_status' => array('publish', 'future', 'private'));
                                        $speakers = get_posts($args);

                                        if ($speakers) {
                                            // echo '<option  value="0">'. _e("Select Speaker", "debateLang") .'</option>';
                                            foreach ($speakers as $speaker) {
                                                if ($speaker->ID == $json_speaker["speaker"]) {
                                                    $selected = "selected";
                                                    echo '<option ' . $selected . ' value="' . $speaker->ID . '">' . $speaker->post_title . '</option>';
                                                } else {
                                                    $selected = "";
                                                    echo '<option ' . $selected . ' value="' . $speaker->ID . '">' . $speaker->post_title . '</option>';

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
                                    <input type="text" id="introduction" style="width: 500px;" class="form-control"
                                        value="<?php echo isset($json_speaker["introduction"]) ? $json_speaker["introduction"] : '' ?> "
                                        name="introduction" maxlength="128">
                                </div>
                            </div>

                            <div class="column column-10" >
                                <div class="form-group">
                                    <label class="control-label" style="color:red" for="state_0"> Opinions</label> <br>

                                    <select id="state_0" class="form-control select2-init" name="opinions">
                                        <option value="1" <?php if (1 == $json_speaker["opinions"])
                                            echo "selected"; ?>>FOR
                                        </option>
                                        <option value="2" <?php if (2 == $json_speaker["opinions"])
                                            echo "selected"; ?>>
                                            AGAINST</option>
                                    </select>
                                </div>
                            </div>

                            <div class="column column-10 ">
                                <input data-repeater-delete type="button" class=" button button-primary button-large"
                                    value="Delete" />
                            </div>

                        </div>
                    </fieldset>
                    <?php
        endforeach;
        ?>
                </div>

                <input data-repeater-create type="button" class=" button button-secondary button-large" style="margin:10px"
                    value="Add" />

            </div>


    <?php else: ?>

        <div class="repeater-speaker">


            <div class="rep-speaker" data-repeater-list="tvs_speakers">
                <fieldset data-repeater-item class="rep-element" style="border: 1px solid black; padding: 10px;">
                    <!-- widgetBody -->
                    <legend style="width: auto;padding:10px;">Speaker </legend>

                    <div class="stnc-row">

                        <div class="column column-20 ">
                            <div class="form-group">
                                <label class="control-label" style="color:green" for="state_0">Select Speaker </label> <br>


                                <select class="form-control select2-init" name="speaker">
                                    <option value="0"> Later (Not Clear Yet) </option>
                                    <?php
                                    $args = array("posts_per_page" => -1, "orderby" => "title", "order" => "asc", 'post_type' => 'speaker', 'post_status' => array('publish', 'future', 'private'));
                                    $speakers = get_posts($args);

                                    if ($speakers) {
                                        // echo '<option  value="0">'. _e("Select Speaker", "debateLang") .'</option>';
                                        foreach ($speakers as $speaker) {
                                            echo '<option  value="' . $speaker->ID . '">' . $speaker->post_title . '</option>';
                                        }

                                    }
                                    ?>
                                </select>


                            </div>
                        </div>

                        <div class="column column-30">
                            <div class="form-group">
                                <label class="control-label" style="color:blue" for="introduction">Introduction</label> <br>
                                <input type="text" id="introduction" style="width: 500px;" class="form-control"
                                    name="introduction" maxlength="128">
                            </div>
                        </div>

                        <div class="column column-10" style="float: left;">
                            <div class="form-group">
                                <label class="control-label" style="color:red" for="state_0"> Opinions</label> <br>

                                <select id="state_0" class="form-control select2-init" name="opinions">
                                    <option value="1">FOR</option>
                                    <option value="2"> AGAINST</option>
                                </select>
                            </div>
                        </div>

                        <div class="column column-10 ">
                            <input data-repeater-delete type="button" class=" button button-primary button-large"
                                value="Delete" />
                        </div>

                    </div>
                </fieldset>
            </div>

            <input data-repeater-create type="button" class=" button button-secondary button-large" style="margin:10px"
                value="Add" />

        </div>

        <?php
    endif;
    ?>

    <div style="color:red;background-color:black;padding:5px;">If the speaker has not been determined yet, please select the
        <strong>"Later (Not Clear Yet)"</strong> option.
    </div>


    <script>
        jQuery(document).ready(function () {
            jQuery('.repeater-speaker').repeater({
                // defaultValues: {
                //     'textarea-input': 'foo',
                //     'text-input': 'stnc',
                //     'select-input': 'B',
                //     'checkbox-input': ['A', 'B'],
                //     'radio-input': 'B'
                // },
                show: function () {
                    jQuery(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        jQuery(this).slideUp(deleteElement);
                    }
                },
                ready: function (setIndexes) {
                    // alert (setIndexes)
                }
            });
        });

    </script>

    <?php
}