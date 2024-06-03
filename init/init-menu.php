<?php
function ssDebate_configuration_menu()
{
    // add_submenu_page( "edit.php?post_type=debate", 'Ayarlar', 'Ayarlar', 'manage_options', 'ssDebate-config', 'ssDebate_configuration_page' ); 
    add_submenu_page( "edit.php?post_type=debate",   __( 'About', 'debateLang' ) ,   __( 'About', 'debateLang' ) , 'manage_options', 'ssDebate-about', 'ssDebate_about_page' ); 

}
add_action('admin_menu', 'ssDebate_configuration_menu');