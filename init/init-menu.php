<?php
function tvsDebate_configuration_menu()
{
    add_submenu_page("edit.php?post_type=debate", __("Locations", 'debateLang'), __("Press List Categories", 'debateLang'), "edit_posts", "edit-tags.php?taxonomy=presslist&post_type=debate");//chfw condi

    add_submenu_page( "edit.php?post_type=debate",  __( 'Settings', 'debateLang' ), __( 'Settings', 'debateLang' ), 'manage_options', 'tvsDebateSetting', 'tvsDebate_configuration_content' ); 

    add_submenu_page( "edit.php?post_type=debate",   __( 'About', 'debateLang' ) ,   __( 'About', 'debateLang' ) , 'manage_options', 'tvsDebateAbout', 'tvsDebate_about_page' ); 

}
add_action('admin_menu', 'tvsDebate_configuration_menu');



require_once (tvsDebate_init_Path .'c_debate-opinions-type.php');


add_filter('manage_debate_posts_columns', 'CHfw2_add_img_column');
add_filter('manage_debate_posts_custom_column', 'CHfw2_manage_img_column', 10, 2);

/*
add custom_colum
@use http://bit.ly/2zKE0k4
*/
function CHfw2_add_img_column($columns)
{
    $columns['img'] = 'Featured Image';
    return $columns;
}

function CHfw2_manage_img_column($column_name, $post_id)
{
    if ($column_name == 'img') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }

    return $column_name;
}
