<?php
/**
 * Plugin Name: Tvs Debates
 * Author: Tvs Debate Teams
 * Text-domain: wp-single-system
 * Version: 3.0.0
 * Description: Tvs Debates Plugin  
 * *License: GPLv2 or later
 * *License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */


function ssDebate_post_type()
{
    $ssDebate_post_type_postID = isset ($_GET['post']) ? $_GET['post'] : null;
    $ssDebate_get_type = get_post_type($ssDebate_post_type_postID);
    $ssDebate_post_type = isset ($_REQUEST['post_type']) ? $_REQUEST['post_type'] : 'post';
    return array(
        "post_id" =>  $ssDebate_post_type_postID ,
        "get_type" => $ssDebate_get_type,
        "post_type" => $ssDebate_post_type,
    );
}

define('ssDebate_init_Path', plugin_dir_path(__FILE__) . 'init/');

define('ssDebate_pages_Path', plugin_dir_path(__FILE__) . 'pages/');

require_once (ssDebate_init_Path .'init-languages.php');

require_once (ssDebate_init_Path ."init-menu.php");


require_once (ssDebate_init_Path .'c_debate-custom-type.php');
require_once (ssDebate_init_Path .'c_debate-speaker_custom-type.php');

require_once (ssDebate_init_Path . "metaBox/class.metabox-engine.php");

require_once (ssDebate_init_Path . "metaBox/load-metabox.php");

require_once (ssDebate_pages_Path ."about/about.php");

require_once (ssDebate_init_Path .'init-assets.php');

function ssDebate_init_languages() {
	// Retrieve the directory for the internationalization files
    load_plugin_textdomain('debateLang', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action( 'plugins_loaded', 'ssDebate_init_languages' );