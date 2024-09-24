<?php
function tvsDebate_admin_enqueue_style()
{
    wp_enqueue_style('tvsDebateStyle', plugins_url('../assets/css/min/ss-system-custom-post-admin.css', __FILE__), "", "1.4.32");
  //  wp_enqueue_style('tvsDebateMin', plugins_url('../assets/css/min/pico.min.css', __FILE__), "", "2.0.1");
    wp_enqueue_style('tvsDebate-bootsrap-grid', plugins_url('../assets/css/min/bootsrap-grid.css', __FILE__), "", "2.0.1");
}




if (
    tvsDebate_post_type()["post_type"] === 'debate' || tvsDebate_post_type()["get_type"] === 'debate' ||
    tvsDebate_post_type()["get_type"] === 'speaker' || tvsDebate_post_type()["get_type"] === 'speaker' ||
    tvsDebate_post_type()["get_type"] === 'press' || tvsDebate_post_type()["get_type"] === 'press'
) {
    add_action('admin_enqueue_scripts', 'tvsDebate_admin_enqueue_style');
}


// -------- for only debate 

function ssOnlyDebate_script_in_admin($hook)
{
    // wp_register_script( 'tvsDebateOnly-admin',plugin_dir_url( __FILE__ ) . '../assets/js/knockout-min.js', '',true );
        // wp_register_script( 'tvsDebateOnly-admin',plugin_dir_url( __FILE__ ) . '../assets/js/CloneData.js', "","1.4.28" );
    wp_register_script('tvsDebateOnly-admin', plugin_dir_url(__FILE__) . '../assets/js/jquery.repeater.min.js', "", "1.4.28");
    wp_enqueue_script('tvsDebateOnly-admin');
}



if (tvsDebate_post_type()["post_type"] === 'debate' || tvsDebate_post_type()["get_type"] === 'debate') {
    add_action('admin_enqueue_scripts', 'ssOnlyDebate_script_in_admin');
}


add_action( 'wp_enqueue_scripts', 'enqueue_and_register_my_scripts' );

function enqueue_and_register_my_scripts(){
    wp_register_script( 'my_child_script', get_stylesheet_directory_uri().'/assets/js/jquery.magnific-popup.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'my_child_script' );
}