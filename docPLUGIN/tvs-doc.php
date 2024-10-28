<?php
/**
 * Plugin Name: Tvs Debates Core
 * Author: Tvs Debate Teams
 * Text-domain: wp-single-system
 * Version: 1.0.0
 * Description: Tvs Debates Plugin  
 * *License: GPLv2 or later
 * *License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */


// _self - Default. Opens the document in the same window/tab as it was clicked
// _blank - Opens the document in a new window or tab
// _parent - Opens the document in the parent frame
// _top - Opens the document in the full body of the window

/**
 * /
 * @param mixed $atts
 * @return string
 * @example [tvs_link target='_self']
 */
function wpb_tvs_link($atts): string
{

    $default = array(
        'target' => '_blank',
    );

    $a = shortcode_atts($default, $atts);


    // Things that you want to do.
    $message = ' <a href="https://tvs.nanotheralab.com/" target="' . $a['target'] . '">TVS Site</a> ';

    // Output needs to be return
    return $message;
}
// register shortcode

add_shortcode('tvs_link', 'wpb_tvs_link'); // @example [tvs_link target='_self']


//------------------------------------------------------------------------------------


// DEV  and trial version 
function wpb_tvs_try_link($atts): string
{

    $default = array(
        'target' => '_blank',
    );

    $a = shortcode_atts($default, $atts);


    // Things that you want to do.
    $message = ' <a href="https://tvs.nanotheralab.com/" target="' . $a['target'] . '">TVS DEBATE - DEV Website</a> ';

    // Output needs to be return
    return $message;
}
add_shortcode('tvs_try_link', 'wpb_tvs_try_link'); // @example [tvs_try_link target='_self'] or   [tvs_try_link]


// DEV  and trial version 
function wpb_tvs_trial_link($atts): string
{

    $default = array(
        'target' => '_blank',
        'link' => '',
        'c' => 'TVS DEBATE - DEV Website',
    );

    $a = shortcode_atts($default, $atts);


    // Things that you want to do.
    $rett = ' <a href="https://tvs.nanotheralab.com/' . $a['link'] . '" target="' . $a['target'] . '">' . $a['c'] . '</a> ';

    // Output needs to be return
    return $rett;
}
add_shortcode('tvs_trial_link', 'wpb_tvs_trial_link'); // @example [tvs_trial_link target='_self' link='/blablas'] or   [tvs_trial_link]