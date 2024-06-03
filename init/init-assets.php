<?php 
function ssDebate_admin_enqueue_style()
{   
  wp_enqueue_style('ssDebate_style', plugins_url('../assets/css/min/ss-system-custom-post-admin.css', __FILE__));
}


function ssDebate_script_in_admin($hook) {
    wp_register_script( 'ssDebate-admin',plugin_dir_url( __FILE__ ) . '../assets/js/ss-admin.js', '',true );
    wp_enqueue_script('ssDebate-admin');

    wp_register_script( 'ssDebate-admin-color',plugin_dir_url( __FILE__ ) . '../assets/js/ss-color-picker-init.js', '',true );
    wp_enqueue_script('ssDebate-admin-color');
}


if  (ssDebate_post_type()["post_type"] === 'debate' || ssDebate_post_type()["get_type"] === 'debate' ||  ssDebate_post_type()["get_type"] === 'tvs_speaker' || ssDebate_post_type()["get_type"] === 'tvs_speaker') {
    add_action('admin_enqueue_scripts', 'ssDebate_admin_enqueue_style');
    add_action('admin_enqueue_scripts', 'ssDebate_script_in_admin');
}