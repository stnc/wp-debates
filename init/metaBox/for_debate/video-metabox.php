<?php



/***SIDEBAR Speaker select METABOX (ONLY debate )  ****/




function tvsDebate_video_selected_save($post_id)
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

    if (isset($_POST["tvs_videos"])) {
        foreach ($_POST["tvs_videos"] as $key => $data) {
            $initialData_[$key] = ["youtube_link" => tvs_cc($data['youtube_link']), "youtubePicture" => tvs_cc($data['youtubePicture']), "description" => tvs_cc($data['description'])];
        }
        $json_data = json_encode($initialData_);
        update_post_meta($post_id, "tvsDebateMB_videoList", $json_data);
    }
}





if (tvsDebate_post_type()["post_type"] === "debate" || tvsDebate_post_type()["get_type"] === "debate") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebate_video_init_metabox");
        add_action("load-post-new.php", "tvsDebate_video_init_metabox");
    }
}
/*register metabox */
function tvsDebate_video_init_metabox()
{
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_selected_video_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebate_video_selected_save");
}
function tvsDebate_selected_video_add_meta_box()
{
    add_meta_box(
        "tvs_debate_video_metabox",
        __("Video", "debateLang"),
        "tvsDebate_video_selected_html",
        "debate",
        "normal", // normal  side  advanced
        "default"
    );
}




function tvsDebate_video_selected_html($post)
{
    wp_nonce_field("_video_selected_nonce", "video_selected_nonce");

    $json_video_list = tvsDebate_selected_get_meta_simple('tvsDebateMB_videoList');

    //  echo  "<pre>";

    //  print_r ($json_video_list);

    $json_video_list = json_decode($json_video_list, true);
    // print_r ($json_video_list);
    // print_r ($json_video_list[0]["youtube_link"]);
    // die;
    if ($json_video_list):
        ?>


        <div class="repeater-tvsvideos">


            <div class="rep-video" data-repeater-list="tvs_videos">
                <?php

                foreach ($json_video_list as $key => $json_video):
                    $keyNew = $key + 1;
                    ?>

                    <fieldset style="border: 1px solid black; padding: 10px;" data-repeater-item class="rep-element">
                        <legend style="width: auto;padding:10px;">Video </legend>

                        <div class="stnc-row ">
                            <div class="column column-25 ">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue" for="youtube_link">Youtube Video URL</label><br>
                                    <input type="text" id="youtube_link" class="form-control"
                                        value="<?php echo isset($json_video["youtube_link"]) ? $json_video["youtube_link"] : ''; ?>"
                                        name="youtube_link" maxlength="128">
                                </div>
                            </div>

                            <div class="column column-25 ">
                                <input type="text" name="youtubePicture"
                                    value="<?php echo isset($json_video["youtubePicture"]) ? $json_video["youtubePicture"] : ''; ?>"
                                    class="tvs_videometa_inputC" id="tvs_videometa_input<?php echo $keyNew ?>"
                                    style="display:none;">

                                <a data-index="<?php echo $keyNew ?>" data-name="tvs_videometa"
                                    class="page_upload_trigger_element button button-primary button-large">Select Picture</a>

                                <br>
                                <div class="tvs_videometa_listC" id="tvs_videometa_list<?php echo $keyNew ?>">
                                    <div class="background_attachment_metabox_container">
                                        <div class="images-containerBG">
                                            <div class="single-imageBG"><span class="delete">X</span>
                                                <img data-targetid="tvs_videometa_input" class="attachment-100x100 wp-post-image"
                                                    witdh="100" height="100"
                                                    src="<?php echo isset($json_video["youtubePicture"]) ? $json_video["youtubePicture"] : ''; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="column column-33 ">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue" for="description">Description</label>
                                    <textarea name="description" style="display: block;" rows='8'
                                        cols='57'><?php echo isset($json_video["description"]) ? $json_video["description"] : ''; ?></textarea>
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
                onclick="videoFunction()" value="Add" />
        </div>



    <?php else: ?>

        <div class="repeater-tvsvideos">


            <div class="rep-video" data-repeater-list="tvs_videos">
                <fieldset style="border: 1px solid black; padding: 10px;" data-repeater-item class="rep-element">
                    <legend style="width: auto;padding:10px;">Video </legend>

                    <div class="stnc-row ">
                        <div class="column column-25 ">
                            <div class="form-group">
                                <label class="control-label" style="color:blue" for="youtube_link">Youtube Video URL</label><br>
                                <input type="text" id="youtube_link" class="form-control" value="" name="youtube_link"
                                    maxlength="128">
                            </div>
                        </div>

                        <div class="column column-25 ">
                            <input type="text" name="youtubePicture" value="" class="tvs_videometa_inputC"
                                id="tvs_videometa_input" style="display:none;">

                            <a data-index="" data-name="tvs_videometa"
                                class="page_upload_trigger_element button button-primary button-large">Select Picture</a>

                            <br>
                            <div class="tvs_videometa_listC" id="tvs_videometa_list">
                                <div class="background_attachment_metabox_container"></div>
                            </div>
                        </div>


                        <div class="column column-33 ">
                            <div class="form-group">
                                <label class="control-label" style="color:blue" for="description">Description</label>
                                <textarea name="description" style="display: block;" rows='8' cols='57'></textarea>
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
                onclick="videoFunction()" value="Add" />
        </div>

        <?php
    endif;
    ?>




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






        function videoFunction() {
            setTimeout(videoFunc, 1000);
        }

        function videoFunc() {
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