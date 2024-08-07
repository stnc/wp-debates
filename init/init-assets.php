<?php 
function tvsDebate_admin_enqueue_style()
{   
  wp_enqueue_style('tvsDebate_style', plugins_url('../assets/css/min/ss-system-custom-post-admin.css', __FILE__),"","1.4.28");
}


function tvsDebate_script_in_admin($hook) {
    // wp_register_script( 'tvsDebate-admin',plugin_dir_url( __FILE__ ) . '../assets/js/ss-admin.js', "","1.4.41");
    // wp_enqueue_script('tvsDebate-admin');

    wp_register_script( 'tvsDebate-admin-color',plugin_dir_url( __FILE__ ) . '../assets/js/ss-color-picker-init.js',"","1.4.28");
    wp_enqueue_script('tvsDebate-admin-color');
}


if  (tvsDebate_post_type()["post_type"] === 'debate' || tvsDebate_post_type()["get_type"] === 'debate' ||  
tvsDebate_post_type()["get_type"] === 'speaker' || tvsDebate_post_type()["get_type"] === 'speaker' ||  
tvsDebate_post_type()["get_type"] === 'press' || tvsDebate_post_type()["get_type"] === 'press') {

    add_action('admin_enqueue_scripts', 'tvsDebate_admin_enqueue_style');
    add_action('admin_enqueue_scripts', 'tvsDebate_script_in_admin');
}


// -------- for only debate 

function ssOnlyDebate_script_in_admin($hook) {
    // wp_register_script( 'tvsDebateOnly-admin',plugin_dir_url( __FILE__ ) . '../assets/js/knockout-min.js', '',true );
    wp_register_script( 'tvsDebateOnly-admin',plugin_dir_url( __FILE__ ) . '../assets/js/jquery.repeater.min.js', "","1.4.28");
    // wp_register_script( 'tvsDebateOnly-admin',plugin_dir_url( __FILE__ ) . '../assets/js/CloneData.js', "","1.4.28" );
    wp_enqueue_script('tvsDebateOnly-admin');
}



if  (tvsDebate_post_type()["post_type"] === 'debate' || tvsDebate_post_type()["get_type"] === 'debate' ) {
    // add_action('admin_enqueue_scripts', 'tvsDebate_admin_enqueue_style');
    add_action('admin_enqueue_scripts', 'ssOnlyDebate_script_in_admin');
}