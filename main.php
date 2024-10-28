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


function tvsDebate_post_type(): array
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

define('tvsDebate_init_Path', value: plugin_dir_path(__FILE__) . 'init/');

define('tvsDebate_pages_Path', plugin_dir_path(__FILE__) . 'pages/');



//---- Custom Post type
require_once (tvsDebate_init_Path .'c_debate-debate01-type.php');
require_once (tvsDebate_init_Path .'c_debate-debate02-topics-taxonomy-type.php');
//require_once (tvsDebate_init_Path .'___c_debate-debate03_term-taxonomy-metabox.php'); // //cancel - deprecated
require_once (tvsDebate_init_Path .'c_debate-speaker-type.php');
require_once (tvsDebate_init_Path .'c_debate-transcript-type.php');

require_once (tvsDebate_init_Path .'c_debate-opinions-type.php');



require_once (tvsDebate_init_Path .'c_debate-press01-type.php');
require_once (tvsDebate_init_Path .'c_debate-press02-topics-taxonomy-type.php');
//require_once (tvsDebate_init_Path .'___c_debate-press03_term-taxonomy-metabox.php'); //cancel -- deprecated

require_once (tvsDebate_init_Path .'c_debate-galleries01-type.php');
// require_once (tvsDebate_init_Path .'c_debate-galleries02-album-taxonomy-type.php'); //cancel -- deprecated 


//----METABOX init for  Custom Post type
require_once (tvsDebate_init_Path . "metaBox/class.metabox-engine.php");
require_once (tvsDebate_init_Path . "metaBox/load-metabox.php");

//---- Extra Menu  
require_once (tvsDebate_pages_Path ."about/about.php");

// require_once (tvsDebate_init_Path .'___c_sidebar.php'); //cancel -- deprecated 

require_once (tvsDebate_init_Path .'init-assets.php');

require_once (tvsDebate_init_Path .'widget/recent_posts.php');


// require_once (tvsDebate_init_Path .'widget/elementor/last-videos.php'); // BETA 

require_once ('theme_page_templates/theme_page_templates-engine.php');

require_once(tvsDebate_pages_Path ."configurationPages/init.php");

require_once (tvsDebate_init_Path . "rewrite_rule_list.php");


require_once (tvsDebate_init_Path .'init-languages.php');

require_once (tvsDebate_init_Path ."init-menu.php");



// include "other/customTaxonomies.php";
// include "other/example_post_type.php";
// include "other/special-rewrite-rule/special-rewrite-rule.php";
// include "other/speakers-custom-rewrite-url/speakers-page-init.php";