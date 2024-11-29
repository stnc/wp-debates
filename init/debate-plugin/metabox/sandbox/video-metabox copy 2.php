<?php



/***SIDEBAR Speaker select METABOX (ONLY debate )  ****/


function tvs_cc($data)
{
    return sanitize_text_field(wp_unslash($data));
}

function tvsDebate_selected_save($post_id)
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

    if (isset($_POST["speakers"])) {
        foreach ($_POST["speakers"] as $key => $data) {
            $initialData_[$key] = ["speaker" => tvs_cc($data['speaker']), "introduction" => tvs_cc($data['introduction']), "opinions" => tvs_cc($data['opinions'])];
        }
        $json_data = json_encode($initialData_);
        update_post_meta($post_id, "tvsDebateMB_speakerList", $json_data);
    }
}





if (tvsDebate_post_type()["post_type"] === "debate" || tvsDebate_post_type()["get_type"] === "debate") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebate_debate_init_metabox");
        add_action("load-post-new.php", "tvsDebate_debate_init_metabox");
    }
}
/*register metabox */
function tvsDebate_debate_init_metabox()
{
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_selected_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebate_selected_save");
}
function tvsDebate_selected_add_meta_box()
{
    add_meta_box(
        "tvs_debate_metabox",
        __("Speaker", "debateLang"),
        "tvsDebate_selected_html",
        "debate",
        "normal", // normal  side  advanced
        "default"
    );
}




function tvsDebate_selected_html($post)
{
    wp_nonce_field("_video_selected_nonce", "video_selected_nonce");

    $json_video_list = tvsDebate_selected_get_meta_simple('tvsDebateMB_videoList');

    // echo  "<pre>";

    // print_r ($json_video_list);

    $json_video_list = json_decode($json_video_list, true);
    // die;
    if ($json_video_list):
        foreach ($json_video_list as $key => $json_video):
            $key=$key+1;
            ?>


            <div class="repeater-speaker">


                <div class="rep-video" data-repeater-list="speaker">


                    <!-- widgetBody -->

                    <fieldset style="border: 1px solid black; padding: 10px;" data-repeater-item class="rep-element">
                        <legend style="width: auto;padding:10px;">Video </legend>

                        <div class="stnc-row ">
                            <div class="column column-25 ">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue" for="youtube">Youtube Video
                                        URL</label><br>
                                    <input type="text" id="youtube" class="form-control"
                                        value="<?php echo isset($json_video_list[$key]["youtube"]) ? $json_video_list[$key]["youtube"] : ''; ?>"
                                        name="videos[0][youtube]" maxlength="128">
                                </div>
                            </div>

                            <div class="column column-25 ">
                                <input type="text" name="speaker_name" value="<?php echo isset($json_video_list[$key]["description"]) ? $json_video_list[$key]["description"] : ''; ?>" class="speaker_video_inputC"
                                    id="speaker_video_input<?php echo $key ?>" style="display:none1;">

                                <a data-index="<?php echo $key ?>" data-name="speaker_video"
                                    class="page_upload_trigger_element button button-primary button-large">Select Picture</a>

                                <br>
                                <div class="speaker_video_listC" id="speaker_video_list<?php echo $key ?>">
                                    <div class="background_attachment_metabox_container"></div>
                                </div>



                            </div>


                            <div class="column column-25 ">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue" for="description">Description</label>
                                    <textarea name="videos[0][description]" style="display: block;" rows='5'
                                        cols='50'><?php echo isset($json_video_list[$key]["description"]) ? $json_video_list[$key]["description"] : ''; ?></textarea>
                                </div>
                            </div>

                            <div class="column column-10 ">
                                <input data-repeater-delete type="button" value="Delete" />
                            </div>

                        </div>



                    </fieldset>
                </div>

                <input data-repeater-create type="button" onclick="myFunction()" value="Add" />
            </div>

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
                                                echo '<option  value="' . $speaker->ID . '">' . $speaker->post_title . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>


                                </div>
                            </div>



                            <div class="column column-30">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue;" for="full_name_0">Introduction</label>
                                    <input type="text" id="full_name_0" style="width: 500px;" class="form-control"
                                        name="speakers[0][introduction]" maxlength="128">
                                </div>
                            </div>


                            <div class="column column-10">
                                <div class="form-group">
                                    <label class="control-label" style="color:red" for="state_0"> Opinions</label>

                                    <select id="state_0" class="form-control select2-init" name="speakers[0][opinions]">
                                        <option value="1">FOR</option>
                                        <option value="2"> AGAINST</option>
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



    </div>
    <div style="color:red;background-color:black;padding:5px;">If the speaker has not been determined yet, please select
        the
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






        function myFunction() {
            timeout = setTimeout(alertFunc, 1000);
        }

        function alertFunc() {


            jQuery('fieldset[class="rep-element"]').each(function (index, item) {
                var i = 1;
                // if(parseInt($(item).data('index'))>2){
                //     $(item).html('Testimonial '+(index+1)+' by each loop');
                // butun elemanlarda gezinecek sonra inputlara bir class verecek mesela pic1 gibi 
                // }
                i = index + 1;
                console.log ("de"+i)
                // console.log(jQuery(item).parent().find(".speaker_video_inputC"))
                jQuery(item).parent().find(".speaker_video_inputC").removeAttr('id');
                jQuery(item).parent().find(".speaker_video_listC").removeAttr('id');
                jQuery(item).parent().find(".page_upload_trigger_element").attr('data-index', i);
                jQuery(item).parent().find(".speaker_video_inputC").attr('id', "speaker_video_input" + i);
                jQuery(item).parent().find(".speaker_video_listC").attr('id', "speaker_video_list" + i);

            });
        }


    </script>

    <?php
}