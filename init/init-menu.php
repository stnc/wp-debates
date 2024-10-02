<?php
function tvsDebate_configuration_menu()
{
    add_submenu_page("edit.php?post_type=debate", __("Locations", 'debateLang'), __("Press List Categories", 'debateLang'), "edit_posts", "edit-tags.php?taxonomy=presslist&post_type=press");//chfw condi

    add_submenu_page( "edit.php?post_type=debate",  __( 'Settings', 'debateLang' ), __( 'Settings', 'debateLang' ), 'manage_options', 'tvsDebateSetting', 'tvsDebate_configuration_content' ); 

    add_submenu_page( "edit.php?post_type=debate",   __( 'About', 'debateLang' ) ,   __( 'About', 'debateLang' ) , 'manage_options', 'tvsDebateAbout', 'tvsDebate_about_page' ); 

}
add_action('admin_menu', 'tvsDebate_configuration_menu');



require_once (tvsDebate_init_Path .'c_debate-opinions-type.php');
