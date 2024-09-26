<?php

if (tvsDebate_post_type()["post_type"] === "debate" || tvsDebate_post_type()["get_type"] === "debate") {
    if (is_admin()) {
        add_action("load-post.php", "tvsDebateMB_sidebar_related_init_metabox");
        add_action("load-post-new.php", "tvsDebateMB_sidebar_related_init_metabox");
    }
}


function tvsDebateMB_sidebar_selected_save($post_id)
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

    if (isset($_POST['tvsDebateMB_sidebar'])) {
        update_post_meta($post_id, "tvsDebateMB_sidebar", sanitize_text_field($_POST['tvsDebateMB_sidebar']));
    }


}



/*register metabox */
function tvsDebateMB_sidebar_related_init_metabox()
{
    // add meta box
    add_action("add_meta_boxes", "tvsDebate_selected_sidebar_add_meta_box");
    // metabox save
    add_action("save_post", "tvsDebateMB_sidebar_selected_save");
}


function tvsDebate_selected_sidebar_add_meta_box()
{
    add_meta_box(
        "tvsDebateMB_sidebar_",
        __("Sidebar", "debateLang"),
        "tvsDebateMB_sidebar_selected_html",
        "debate",
        "side", // normal  side  advanced
        "default"
    );
}




function tvsDebateMB_sidebar_selected_html($post)
{
    ?>
    <div class="wp-core-ui  ss-metabox-form widthOverride">
        <?php wp_nonce_field(basename(__FILE__), 'tvsDebateMB_sidebar_nonce'); ?>
        <div class="form-field term-meta-text-wrap">
            <label for="term-meta-text"><?php _e('Sidebar Menu', 'debateLang'); ?></label>
            <select type="text" id="term-meta-text" name="tvsDebateMB_sidebar" id="tvsDebateMB_sidebar">

                <?php

                $selectedSidebarID = tvsDebate_selected_get_meta_simple('tvsDebateMB_sidebar');
                $selected = "selected";
                $menus = get_terms('nav_menu');
                $menus = array_combine(wp_list_pluck($menus, 'term_id'), wp_list_pluck($menus, 'name'));
                if ($menus) {
                    echo '<option  value="0">Select Opinion</option>';
                    foreach ($menus as $sidebarID => $description) {
                        if ($sidebarID == $selectedSidebarID) {
                            $selected = "selected";
                            echo '<option ' . $selected . ' value="' . $sidebarID . '">' . $description . '</option>';
                        } else {
                            echo '<option  value="' . $sidebarID . '">' . $description . '</option>';
                        }
                    }
                }
                ?>
            </select>
        </div>
    </div>

    <?php
}