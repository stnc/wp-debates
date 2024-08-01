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
        __("Video", "debateLang"),
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
            $key = $key + 1;
            ?>


            <div class="repeater-tvsvideos">


                <div class="rep-video" data-repeater-list="tvsvideos">


                    <!-- widgetBody -->

                    <fieldset style="border: 1px solid black; padding: 10px;" data-repeater-item class="rep-element">
                        <legend style="width: auto;padding:10px;">Video </legend>

                        <div class="stnc-row ">
                            <div class="column column-25 ">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue" for="youtube_link">Youtube Video
                                        URL</label><br>
                                    <input type="text" id="youtube_link" class="form-control"
                                        value="<?php echo isset($json_video_list[$key]["youtube_link"]) ? $json_video_list[$key]["youtube_link"] : ''; ?>"
                                        name="youtube_link" maxlength="128">
                                </div>
                            </div>

                            <div class="column column-25 ">
                                <input type="text" name="youtubePicture"
                                    value="<?php echo isset($json_video_list[$key]["youtubePicture"]) ? $json_video_list[$key]["youtubePicture"] : ''; ?>"
                                    class="tvs_videometa_inputC" id="tvs_videometa_input<?php echo $key ?>" style="display:none1;">

                                <a data-index="<?php echo $key ?>" data-name="tvs_videometa"
                                    class="page_upload_trigger_element button button-primary button-large">Select Picture</a>

                                <br>
                                <div class="tvs_videometa_listC" id="tvs_videometa_list<?php echo $key ?>">
                                    <div class="background_attachment_metabox_container"></div>
                                </div>



                            </div>


                            <div class="column column-33 ">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue" for="description">Description</label>
                                    <textarea name="description" style="display: block;" rows='8'
                                        cols='57'><?php echo isset($json_video_list[$key]["description"]) ? $json_video_list[$key]["description"] : ''; ?></textarea>
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
                    onclick="myFunction()" value="Add" />
            </div>

            <?php
        endforeach;
        ?>

    <?php else: ?>



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


            /* ==========================================================================
                #Post-meta class media manager trigger  http://bit.ly/2g83CQ7
                ========================================================================== */

            jQuery(document).on('click', '.page_upload_trigger_element', function (e) {

                var _custom_media = true;
                var _orig_send_attachment = wp.media.editor.send.attachment;
                var send_attachment_bkp = wp.media.editor.send.attachment;
                var button = jQuery(this);
                // var id = button.attr('data-name').replace('_button', '');  //<a  data-index="1" data-name="tvs_videometa_button"    console.log(id)
                var id = button.attr('data-name');

                var index = button.attr('data-index');


                // button.closest('.'+settings.cloneContainer).find("label[for='" + id + "']")
                _custom_media = true;
                wp.media.editor.send.attachment = function (props, attachment) {
                    if (_custom_media) {

                        jQuery("#" + id + '_input' + index).val(attachment.url);

                        var filename = attachment.url;
                        var file_extension = filename.split('.').pop();//find picture extension
                        console.log("#" + id + '_list' + index + ' .background_attachment_metabox_container')
                        if (file_extension == "jpg" || file_extension == "jpeg" || file_extension == "png" || file_extension == "gif" || file_extension == "webp") {

                            jQuery("#" + id + '_list' + index + ' .background_attachment_metabox_container').html('<div class="images-containerBG"><div class="single-imageBG"><span class="delete">X</span>  <img data-targetid="tvs_videometa_input' + index + '" class="attachment-100x100 wp-post-image" witdh="100" height="100" src="' + attachment.url + '"></div></div>');
                        } else {
                            jQuery("#" + id + '_list' + index + ' .background_attachment_metabox_container').html('<div class="images-containerBG">' +
                                '<div style="width: 53px; height: 53px;" class="single-imageBG"><span data-targetid="tvs_videometa_input' + index + '"  class="delete_media">X</span> ' +
                                '<span style="font-size: 46px" class="info dashicons dashicons-admin-media"></span> </div></div>');
                        }
                        /* important notes jQuery("#" + id + '_li .background_attachment_metabox_container').html('<div class="images-containerBG">' +
                         '<div class="single-imageBG_"><span class="info">'+attachment.url+'</span></div></div>');*/

                    } else {
                        return _orig_send_attachment.apply(this, [props, attachment]);
                    }
                };
                wp.media.editor.open(button);
                return false;
            });



            /* ==========================================================================
             #Delete image element
             ========================================================================== */
            jQuery(document).on("click touchstart", ".background_attachment_metabox_container .single-imageBG span.delete", function () {
                //   var imageurl = jQuery(this).parent().find('img').attr('src');
                var target_id = jQuery(this).parent().find('img').attr('data-targetid');
                jQuery('#' + target_id).val("");
                jQuery(this).parent().hide(400);
            });



            jQuery('.repeater-tvsvideos').repeater({
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
                console.log("de" + i)

                //  jQuery(item).parent().find(".tvs_videometa_inputC").removeAttr('id');
                //  jQuery(item).parent().find(".tvs_videometa_listC").removeAttr('id');
                jQuery(item).children().find(".page_upload_trigger_element").attr('data-index', i);
                jQuery(item).children().find(".tvs_videometa_inputC").attr('id', "tvs_videometa_input" + i);
                jQuery(item).children().find(".tvs_videometa_listC").attr('id', "tvs_videometa_list" + i);

            });
        }


    </script>

    <?php
}