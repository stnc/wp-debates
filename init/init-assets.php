<?php
function tvsDebate_admin_enqueue_style()
{
    wp_enqueue_style('tvsDebateStyle', plugins_url('../assets/css/min/ss-system-custom-post-admin.css', __FILE__), "", "1.4.32");
  //  wp_enqueue_style('tvsDebateMin', plugins_url('../assets/css/min/pico.min.css', __FILE__), "", "2.0.1");
    wp_enqueue_style('tvsDebate-bootsrap-grid', plugins_url('../assets/css/min/bootsrap-grid.css', __FILE__), "", "2.0.1");

    wp_register_style( 'tvsflatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.css' );
    wp_enqueue_style('tvsflatpickr');
}







// -------- for only debate 

function ssOnlyDebate_script_in_admin($hook)
{
    wp_register_script('tvsDebateOnlyJS', plugin_dir_url(__FILE__) . '../assets/js/jquery.repeater.min.js', "", "1.4.28");
    wp_enqueue_script('tvsDebateOnlyJS');

    wp_register_script( 'tvsflatpickrJS', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.js' );
    wp_enqueue_script('tvsflatpickrJS');

    // wp_register_script( 'tvsflatpickrRJS', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js' );
    // wp_enqueue_script('tvsflatpickrRJS');

}





//for frontend 
function enqueue_and_register_my_scripts(){
    wp_register_script( 'tvsmagnific', get_stylesheet_directory_uri().'/assets/js/jquery.magnific-popup.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'tvsmagnific' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_and_register_my_scripts' );



if (
    tvsDebate_post_type()["post_type"] === 'debate' || tvsDebate_post_type()["get_type"] === 'debate' ||
    tvsDebate_post_type()["get_type"] === 'speaker' || tvsDebate_post_type()["get_type"] === 'speaker' ||
    tvsDebate_post_type()["get_type"] === 'press' || tvsDebate_post_type()["get_type"] === 'press'
) {
    add_action('admin_enqueue_scripts', 'tvsDebate_admin_enqueue_style');
    add_action('admin_enqueue_scripts', 'ssOnlyDebate_script_in_admin');
    
}



if (tvsDebate_post_type()["post_type"] === 'debate' || tvsDebate_post_type()["get_type"] === 'debate') {
    add_action('admin_enqueue_scripts', 'ssOnlyDebate_script_in_admin');
}
