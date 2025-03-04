<?php
//--------------debate-------------

function tvs_youtubeLinkParse($str)
{
	//https://regex101.com/r/rq2KLv/1/codegen?language=php
	$re = '/(?:https?:\/\/)?(?:www\.)?youtu(?:\.be\/|be.com\/\S*(?:watch|embed)(?:(?:(?=\/[-a-zA-Z0-9_]{11,}(?!\S))\/)|(?:\S*v=|v\/)))([-a-zA-Z0-9_]{11,})/m';
	preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
	return $matches;
}

function tvsDebate_selected_get_meta_simple($value)
{
	global $post;
	return get_post_meta($post->ID, $value, true);
}



function tvs_cc($data)
{
	return sanitize_text_field(wp_unslash($data));
}




function tvsDebate_debate_options_()
{
	include ('debate-plugin/metabox/metabox-options.php');
	$tvsDebate_debate_options['0'] = $tvs_debate_OptionsPageSetting;
	new ssSytemMetaboxEngine($tvsDebate_debate_options, 'tvs_debate-setting', true);
}



if (tvsDebate_post_type()["get_type"] == 'debate' || tvsDebate_post_type()["post_type"] == 'debate') {
	tvsDebate_debate_options_();
	include 'debate-plugin/metabox/speaker-metabox.php';
	include 'debate-plugin/metabox/video-metabox.php';
	include "debate-plugin/metabox/related-metabox.php";
	include "debate-plugin/metabox/metabox-sidebar.php";
}


function tvsDebate_press_options_()
{
	include ('press-plugin/metabox/metabox-options.php');
	$tvsDebate_press_options['0'] = $tvs_press_OptionsPageSetting;
	new ssSytemMetaboxEngine($tvsDebate_press_options, 'tvs_debate-setting', true);

}

if (tvsDebate_post_type()["get_type"] == 'press' || tvsDebate_post_type()["post_type"] == 'press') {
	tvsDebate_press_options_();
}

/*
if (tvsDebate_post_type()["get_type"] == 'speaker' || tvsDebate_post_type()["post_type"] == 'speaker') {
	include 'for_speaker/metabox_options.php';
}
*/

if (tvsDebate_post_type()["get_type"] == 'transcript' || tvsDebate_post_type()["post_type"] == 'transcript') {
	include 'transcript-plugin/metabox/metabox-options.php';
	// include "for_transcript/_Cancel-metabox-sidebar.php";
}

if (tvsDebate_post_type()["get_type"] == 'opinion' || tvsDebate_post_type()["post_type"] == 'opinion') {
	include 'opinions-plugin/metabox/metabox-options.php';
}



//--------------post-------------  cancel 

// function tvs_wp_post_options_()
// {
// 	include('for-post/metabox-options.php');
// 	$tvsDebate_debate_options['0'] = $tvsDebate_OptionsPageSetting;
// 	 new tvs_wp_metabox_engine($tvsDebate_debate_options, 'tvs_wp_post-Setting', true);
// }


// if (tvsDebate_post_type()["get_type"] ==  'post' || tvsDebate_post_type()["post_type"] == 'post' ) {
// 	tvs_wp_post_options_();
// }