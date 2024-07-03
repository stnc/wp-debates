<?php
function tvsDebate_configuration_menu()
{
    add_submenu_page( "edit.php?post_type=debate",   __( 'About', 'debateLang' ) ,   __( 'About', 'debateLang' ) , 'manage_options', 'tvsDebate-about', 'tvsDebate_about_page' ); 

}
add_action('admin_menu', 'tvsDebate_configuration_menu');