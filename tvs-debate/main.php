<?php
/**
 * Plugin Name: Tvs Debates
 * Author: Tvs Debate Teams
 * Text-domain: wp-single-system
 * Version: 1.0.0
 * Description: Tvs Debates Plugin  
 * *License: GPLv2 or later
 * *License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */


function tvsDebate_post_type()
{
    $tvsDebate_post_type_postID = isset ($_GET['post']) ? $_GET['post'] : null;
    $tvsDebate_get_type = get_post_type($tvsDebate_post_type_postID);
    $tvsDebate_post_type = isset ($_REQUEST['post_type']) ? $_REQUEST['post_type'] : 'post';
    return array(
        "post_id" =>  $tvsDebate_post_type_postID ,
        "get_type" => $tvsDebate_get_type,
        "post_type" => $tvsDebate_post_type,
    );
}

define('tvsDebate_init_Path', plugin_dir_path(__FILE__) . 'init/');

define('tvsDebate_pages_Path', plugin_dir_path(__FILE__) . 'pages/');

require_once (tvsDebate_init_Path .'init-languages.php');

require_once (tvsDebate_init_Path ."init-menu.php");

//---- Custom Post type
require_once (tvsDebate_init_Path .'debate-custom-type.php');

require_once (tvsDebate_init_Path .'debate-speaker_custom-type.php');
require_once (tvsDebate_init_Path .'debate-transcript_custom-type.php');
require_once (tvsDebate_init_Path .'debate-opinions_custom-type.php');

//---- Extra Menu  
require_once (tvsDebate_pages_Path ."about/about.php");


//---- SIDEBAR 
require_once (tvsDebate_init_Path .'c_sidebar.php');


require_once (tvsDebate_init_Path .'init-assets.php');


function tvsDebate_init_languages() {
	// Retrieve the directory for the internationalization files
    load_plugin_textdomain('debateLang', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action( 'plugins_loaded', 'tvsDebate_init_languages' );