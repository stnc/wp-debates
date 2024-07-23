<?php


if (tvsDebate_post_type()["post_type"] === "debate" || tvsDebate_post_type()["get_type"] === "debate") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebate_debate_video_init_metabox");
        add_action("load-post-new.php", "tvsDebate_debate_video_init_metabox");
    }
}


function str_replace_json($search, $replace, $subject)
{
    return json_decode(str_replace($search, $replace, json_encode($subject)));
}


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

    if (isset($_POST["videos"])) {

        // FIXME:  here should be html and " cleaning this with foreach

        $selectedOptionlist_video = $_POST["videos"];
        // $selectedOptionlist_video = $_POST["videos"] ["description"];
        // // $selectedOptionlist_video = str_replace(  '"', "'",  $selectedOptionlist_video);
        // print_r(   $_POST["videos"]);
        // print_r(   $selectedOptionlist_video);
        // die;
        $selectedOptionlist_video = json_encode($selectedOptionlist_video, true);
        update_post_meta($post_id, "tvsDebateMB_videoList", sanitize_text_field($selectedOptionlist_video));
    }
}






/*register metabox */
function tvsDebate_debate_video_init_metabox()
{
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_selected_video_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebate_video_selected_save");
}


function tvsDebate_selected_video_add_meta_box()
{
    add_meta_box(
        "tvs_debate_vide_metabox",
        __("Videos", "debateLang"),
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

    // echo  "<pre>";

    // print_r ($json_video_list);

    $json_video_list = json_decode($json_video_list, true);

    // $json_video_list=str_replace_json( '"', "'",  $json_video_list);

    // [{"youtube":"https://www.youtube.com/watch?v=-4A4XzRx0UY","youtubePicture":"https://i.ytimg.com/vi/uS3wEQGuqbc/hqdefault.jpg","description":"ll "},{"youtube":"https://www.youtube.com/watch?v=aUhDzk1pSKY","youtubePicture":"https://media.ssyoutube.com/get?__sig=jYQKWNdOMWMrTgHL4X_RgQ&__expires=1718306046&uri=httpsi.ytimg.comviaUhDzk1pS","description":""}]

    // print_r ($json_video_list);
// die;
    if ($json_video_list):
        foreach ($json_video_list as $key => $json_video):
            ?>


            <div id="stnc-video-container">
                <div class="panel-body container-item-video">
                    <fieldset class="item panel panel-default" style="border: 1px solid black; padding: 10px;">
                        <!-- widgetBody -->
                        <legend style="width: auto;padding:10px;">Video </legend>
                        <div class="panel-body">
                            <div class="stnc-row">

                                <div class="column column-25 ">
                                    <div class="form-group">
                                        <label class="control-label" style="color:blue" for="youtube">Youtube Video URL</label><br>
                                        <input type="text" id="youtube" class="form-control"
                                            value="<?php echo isset($json_video_list[$key]["youtube"]) ? $json_video_list[$key]["youtube"] : ''; ?>"
                                            name="videos[0][youtube]" maxlength="128">
                                    </div>
                                </div>

                                <div class="column column-25 ">
                                    <label for="stnc_wp_kiosk_Metabox_video"></label>
                                    <input type="text" value="" class="" style="display:none;" name="stnc_wp_kiosk_Metabox_video"
                                        id="stnc_wp_kiosk_Metabox_video">

                                    <input id="stnc_wp_kiosk_Metabox_video_extra1"
                                        class="page_upload_trigger_element button button-primary button-large"
                                         name="videos[0][picture]" type="button" value="Select Picture">
                                        
                                    <!-- <span class="form_hint">Etc</span> -->
                                    <br>
                                    <div id="stnc_wp_kiosk_Metabox_video_li">
                                    <div class="background_attachment_metabox_container">
                                      
                                      </div>

                                    </div>
                                   
                                    
                                </div>









                                <div class="column column-33 ">
                                    <div class="form-group">
                                        <label class="control-label" style="color:blue" for="description">Description</label>
                                        <textarea name="videos[0][description]" style="display: block;" rows='5'
                                            cols='50'><?php echo isset($json_video_list[$key]["description"]) ? $json_video_list[$key]["description"] : ''; ?></textarea>
                                    </div>
                                </div>

                                <div class="column column-10 ">
                                    <div>
                                        <a href="javascript:void(0)"
                                            class="remove-item-video stnc-button-primary remove-social-media">X</a>
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

        <div id="stnc-video-container">
            <div class="panel-body container-item-video">
                <fieldset class="item panel panel-default" style="border: 1px solid black; padding: 10px;">
                    <!-- widgetBody -->
                    <legend style="width: auto;padding:10px;">Video </legend>
                    <div class="panel-body">
                        <div class="stnc-row">

                            <div class="column column-25">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue" for="youtube">Youtube Video URL</label>
                                    <input type="text" id="youtube" class="form-control" value="" name="videos[0][youtube]"
                                        maxlength="128">
                                </div>
                            </div>



                            <div class="column column-25">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue" for="youtubePicture">Youtube Video
                                        Picture</label>
                                    <input type="text" id="youtubePicture" class="form-control" name="videos[0][youtubePicture]"
                                        maxlength="128">
                                </div>
                            </div>


                            <div class="column column-33">
                                <div class="form-group">
                                    <label class="control-label" style="color:blue" for="description">Description</label>
                                    <textarea name="videos[0][description]" style="display: block;" rows='5'
                                        cols='50'> </textarea>

                                </div>
                            </div>

                            <div class="column column-10">
                                <div>
                                    <a href="javascript:void(0)"
                                        class="remove-item-video stnc-button-primary remove-social-media">X</a>
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
            <a href="javascript:;" class="pull-right stnc-button-primary" id="add-more-video"><i class="fa fa-plus"></i></a>
            <div class="clearfix"></div>
        </div>
    </div>



    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('a#add-more-video').cloneData({
                mainContainerId: 'stnc-video-container', // Main container Should be ID
                cloneContainer: 'container-item-video', // Which you want to clone
                removeButtonClass: 'remove-item-video', // Remove button for remove cloned HTML
                removeConfirm: true, // default true confirm before delete clone item
                removeConfirmMessage: 'Are you sure want to delete?', // confirm delete message
                //append: '<a href="javascript:void(0)" class="remove-item btn btn-sm btn-danger remove-social-media">Remove</a>', // Set extra HTML append to clone HTML
                minLimit: 0, // Default 1 set minimum clone HTML required
                maxLimit: 8, // Default unlimited or set maximum limit of clone HTML
                defaultRender: 1,
                /*  init: function() {
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
                  }*/

            });
        });
    </script>

    <?php
}